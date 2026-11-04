<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'krc_system');
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed']);
    exit;
}

$me = $_SESSION['username'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

ensureSchema($conn);

switch ($action) {
    case 'heartbeat':
        heartbeat($conn, $me);
        break;

    case 'users':
        listUsers($conn, $me);
        break;

    case 'messages':
        getMessages($conn, $me);
        break;

    case 'send_message':
        sendMessage($conn, $me);
        break;

    case 'settings':
        getSettings($conn, $me);
        break;

    case 'get_account':
        getAccount($conn, $me);
        break;

    case 'update_account':
        updateAccount($conn, $me);
        break;

    case 'save_templates':
        saveTemplates($conn, $me);
        break;

    case 'copy_from_user':
        copyFromUser($conn, $me);
        break;

    case 'generate_now':
        $added = generateForToday($conn, $me);
        jout(['status' => 'ok', 'generated' => $added]);
        break;

    default:
        jout(['status' => 'error', 'message' => 'Unknown action']);
}

// ---------------------------------------------------------------------------
// Schema helpers (safe to run against older databases)
// ---------------------------------------------------------------------------
function ensureSchema($conn)
{
    $conn->query("CREATE TABLE IF NOT EXISTS `daily_task_templates` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(50) NOT NULL,
        `activity` text NOT NULL,
        `start_time` varchar(20) DEFAULT NULL,
        `end_time` varchar(20) DEFAULT NULL,
        `remarks` varchar(20) DEFAULT '-DONE',
        `sort_order` int(11) NOT NULL DEFAULT 0,
        `created_at` datetime DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        KEY `username` (`username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $conn->query("CREATE TABLE IF NOT EXISTS `daily_task_generation` (
        `username` varchar(50) NOT NULL,
        `report_date` date NOT NULL,
        `generated_at` datetime DEFAULT current_timestamp(),
        PRIMARY KEY (`username`, `report_date`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $conn->query("CREATE TABLE IF NOT EXISTS `user_daily_settings` (
        `username` varchar(50) NOT NULL,
        `include_saturday` tinyint(1) NOT NULL DEFAULT 0,
        `include_sunday` tinyint(1) NOT NULL DEFAULT 0,
        `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $conn->query("CREATE TABLE IF NOT EXISTS `messages` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(50) NOT NULL,
        `employee_name` varchar(100) DEFAULT NULL,
        `message` text NOT NULL,
        `created_at` datetime NOT NULL,
        `recipient` varchar(50) DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `created_at` (`created_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $check = $conn->query("SHOW COLUMNS FROM `messages` LIKE 'recipient'");
    if (!$check || $check->num_rows === 0) {
        $conn->query("ALTER TABLE `messages` ADD COLUMN `recipient` varchar(50) DEFAULT NULL");
    }
}

// ---------------------------------------------------------------------------
// Helpers
// ---------------------------------------------------------------------------
function jout($data)
{
    echo json_encode($data);
    exit;
}

function body()
{
    $raw = file_get_contents('php://input');
    $json = json_decode($raw, true);
    return is_array($json) ? $json : [];
}

function heartbeat($conn, $me)
{
    $stmt = $conn->prepare("UPDATE users SET last_seen = NOW() WHERE username = ?");
    $stmt->bind_param('s', $me);
    $stmt->execute();
    $stmt->close();

    $added = generateForToday($conn, $me);
    jout(['status' => 'ok', 'generated' => $added]);
}

/**
 * Creates today's tasks from the user's checked templates.
 * Idempotent: never inserts an activity that already exists for today.
 */
function generateForToday($conn, $me)
{
    // Use the database clock so the generated date always matches NOW()/last_seen.
    $clock = $conn->query("SELECT CURDATE() AS d, DATE_FORMAT(NOW(), '%b %d, %Y') AS disp")->fetch_assoc();
    $today = $clock['d'];
    $display = $clock['disp'];

    $chk = $conn->prepare("SELECT 1 FROM daily_task_generation WHERE username = ? AND report_date = ?");
    $chk->bind_param('ss', $me, $today);
    $chk->execute();
    $chk->store_result();
    $already = $chk->num_rows > 0;
    $chk->close();
    if ($already) {
        return ensureWeekendPlaceholders($conn, $me);
    }

    $dow = (int)date('w', strtotime($today));
    if ($dow === 6 || $dow === 0) {
        $weekendAdded = ensureWeekendPlaceholders($conn, $me);
        markGenerated($conn, $me, $today);
        return $weekendAdded;
    }

    $t = $conn->prepare("SELECT activity, start_time, end_time, remarks FROM daily_task_templates WHERE username = ? ORDER BY sort_order, id");
    $t->bind_param('s', $me);
    $t->execute();
    $tr = $t->get_result();
    $templates = [];
    while ($row = $tr->fetch_assoc()) {
        $templates[] = $row;
    }
    $t->close();

    if (!$templates) {
        // Nothing selected yet: don't mark, so checking a task later can still
        // generate it for the current day.
        return ensureWeekendPlaceholders($conn, $me);
    }

    $exists = $conn->prepare("SELECT 1 FROM accomplishments WHERE username = ? AND report_date = ? AND activity = ? LIMIT 1");
    $ins = $conn->prepare("INSERT INTO accomplishments (username, report_date, activity, start_time, end_time, remarks) VALUES (?, ?, ?, ?, ?, ?)");
    $added = 0;

    foreach ($templates as $tpl) {
        $activity = $tpl['activity'];
        $exists->bind_param('sss', $me, $display, $activity);
        $exists->execute();
        $exists->store_result();
        if ($exists->num_rows > 0) {
            $exists->free_result();
            continue;
        }
        $exists->free_result();

        $start = isset($tpl['start_time']) ? $tpl['start_time'] : '';
        $end = isset($tpl['end_time']) ? $tpl['end_time'] : '';
        $remarks = isset($tpl['remarks']) && $tpl['remarks'] !== '' ? $tpl['remarks'] : '-DONE';
        $ins->bind_param('ssssss', $me, $display, $activity, $start, $end, $remarks);
        $ins->execute();
        $added++;
    }
    $exists->close();
    $ins->close();

    $weekendAdded = ensureWeekendPlaceholders($conn, $me);

    markGenerated($conn, $me, $today);
    return $added + $weekendAdded;
}

/**
 * Fills every Saturday and Sunday position for every month found in the
 * database with a default empty placeholder (day name, empty time/remarks).
 * Existing entries are never touched.
 */
function ensureWeekendPlaceholders($conn, $me)
{
    $stmt = $conn->prepare("SELECT DISTINCT report_date FROM accomplishments WHERE username = ?");
    $stmt->bind_param('s', $me);
    $stmt->execute();
    $res = $stmt->get_result();
    $dates = [];
    $months = [];
    while ($row = $res->fetch_assoc()) {
        $parsed = strtotime($row['report_date']);
        if ($parsed === false) {
            continue;
        }
        $key = date('Y-m-d', $parsed);
        $dates[$key] = true;
        $months[substr($key, 0, 7)] = true;
    }
    $stmt->close();

    $targets = [];
    foreach ($months as $ym => $unused) {
        list($year, $month) = array_map('intval', explode('-', $ym));
        $daysInMonth = (int)date('t', mktime(0, 0, 0, $month, 1, $year));

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $ts = mktime(0, 0, 0, $month, $day, $year);
            $dow = (int)date('w', $ts);
            if ($dow === 6) {
                $targets[date('Y-m-d', $ts)] = 'Saturday';
            } elseif ($dow === 0) {
                $targets[date('Y-m-d', $ts)] = 'Sunday';
            }
        }
    }

    if (!$targets) {
        return 0;
    }

    ksort($targets);

    $ins = $conn->prepare("INSERT INTO accomplishments (username, report_date, activity, start_time, end_time, remarks) VALUES (?, ?, ?, '', '', '')");
    $added = 0;

    foreach ($targets as $key => $label) {
        if (isset($dates[$key])) {
            continue;
        }
        $ts = strtotime($key);
        $displayDate = date('M d, Y', $ts);
        $ins->bind_param('sss', $me, $displayDate, $label);
        if ($ins->execute()) {
            $added++;
            $dates[$key] = true;
        }
    }

    $ins->close();
    return $added;
}

/**
 * Applies the user's checked templates to every working day (Mon-Fri) of the
 * given YYYY-MM month. Weekends are skipped. Existing activities are never
 * duplicated, so manual edits are preserved.
 */
function generateForMonthWorkingDays($conn, $me, $month)
{
    if (!preg_match('/^(\d{4})-(\d{2})$/', (string)$month, $m)) {
        return 0;
    }
    $year = (int)$m[1];
    $mon = (int)$m[2];
    if ($year < 2000 || $mon < 1 || $mon > 12) {
        return 0;
    }

    $t = $conn->prepare("SELECT activity, start_time, end_time, remarks FROM daily_task_templates WHERE username = ? ORDER BY sort_order, id");
    $t->bind_param('s', $me);
    $t->execute();
    $tr = $t->get_result();
    $templates = [];
    while ($row = $tr->fetch_assoc()) {
        $templates[] = $row;
    }
    $t->close();

    if (!$templates) {
        return 0;
    }

    $daysInMonth = (int)date('t', mktime(0, 0, 0, $mon, 1, $year));
    $exists = $conn->prepare("SELECT 1 FROM accomplishments WHERE username = ? AND activity = ? AND STR_TO_DATE(report_date, '%b %d, %Y') = ? LIMIT 1");
    $ins = $conn->prepare("INSERT INTO accomplishments (username, report_date, activity, start_time, end_time, remarks) VALUES (?, ?, ?, ?, ?, ?)");
    $added = 0;

    for ($day = 1; $day <= $daysInMonth; $day++) {
        $ts = mktime(0, 0, 0, $mon, $day, $year);
        $dow = (int)date('w', $ts);
        if ($dow === 0 || $dow === 6) {
            continue;
        }
        $display = date('M d, Y', $ts);
        $dateKey = date('Y-m-d', $ts);

        foreach ($templates as $tpl) {
            $activity = $tpl['activity'];
            $exists->bind_param('sss', $me, $activity, $dateKey);
            $exists->execute();
            $exists->store_result();
            if ($exists->num_rows > 0) {
                $exists->free_result();
                continue;
            }
            $exists->free_result();

            $start = isset($tpl['start_time']) ? $tpl['start_time'] : '';
            $end = isset($tpl['end_time']) ? $tpl['end_time'] : '';
            $remarks = isset($tpl['remarks']) && $tpl['remarks'] !== '' ? $tpl['remarks'] : '-DONE';
            $ins->bind_param('ssssss', $me, $display, $activity, $start, $end, $remarks);
            $ins->execute();
            $added++;
        }
    }

    $exists->close();
    $ins->close();
    return $added;
}

function markGenerated($conn, $me, $today)
{
    $mark = $conn->prepare("INSERT IGNORE INTO daily_task_generation (username, report_date) VALUES (?, ?)");
    $mark->bind_param('ss', $me, $today);
    $mark->execute();
    $mark->close();
}

function listUsers($conn, $me)
{
    $res = $conn->query("SELECT username, employee_name, last_seen FROM users ORDER BY employee_name ASC");
    $users = [];
    while ($row = $res->fetch_assoc()) {
        $users[] = $row;
    }
    jout(['status' => 'ok', 'users' => $users, 'me' => $me]);
}

function getMessages($conn, $me)
{
    $with = isset($_GET['with']) ? trim($_GET['with']) : '';

    if ($with === '' || $with === 'everyone') {
        $stmt = $conn->prepare("SELECT id, username, employee_name, message, created_at FROM messages WHERE recipient IS NULL OR recipient = '' ORDER BY id ASC LIMIT 500");
    } else {
        $stmt = $conn->prepare("SELECT id, username, employee_name, message, created_at FROM messages WHERE (username = ? AND recipient = ?) OR (username = ? AND recipient = ?) ORDER BY id ASC LIMIT 500");
        $stmt->bind_param('ssss', $me, $with, $with, $me);
    }

    $stmt->execute();
    $res = $stmt->get_result();
    $messages = [];
    while ($row = $res->fetch_assoc()) {
        $row['mine'] = ($row['username'] === $me);
        $messages[] = $row;
    }
    $stmt->close();
    jout(['status' => 'ok', 'messages' => $messages]);
}

function sendMessage($conn, $me)
{
    $data = body();
    $message = isset($data['message']) ? trim($data['message']) : '';
    $recipient = isset($data['recipient']) ? trim($data['recipient']) : '';

    if ($message === '') {
        jout(['status' => 'error', 'message' => 'Empty message']);
    }

    $name = '';
    $s = $conn->prepare("SELECT employee_name FROM users WHERE username = ?");
    $s->bind_param('s', $me);
    $s->execute();
    $r = $s->get_result();
    if ($row = $r->fetch_assoc()) {
        $name = $row['employee_name'];
    }
    $s->close();

    $rec = ($recipient === '' || $recipient === 'everyone') ? null : $recipient;

    $ins = $conn->prepare("INSERT INTO messages (username, employee_name, message, created_at, recipient) VALUES (?, ?, ?, NOW(), ?)");
    $ins->bind_param('ssss', $me, $name, $message, $rec);
    if (!$ins->execute()) {
        jout(['status' => 'error', 'message' => 'Could not send message']);
    }
    $ins->close();

    jout(['status' => 'ok']);
}

function getAccount($conn, $me)
{
    $stmt = $conn->prepare("SELECT username, employee_name, staff_name, staff_position, head_name, head_title, administrative_name, administrative_title, department FROM users WHERE username = ?");
    $stmt->bind_param('s', $me);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$row) {
        jout(['status' => 'error', 'message' => 'User not found']);
    }

    jout(['status' => 'ok', 'account' => $row]);
}

function updateAccount($conn, $me)
{
    $data = body();
    $field = function ($key) use ($data) {
        return isset($data[$key]) ? trim((string)$data[$key]) : '';
    };

    $employee_name = $field('employee_name');
    $new_username = $field('username');
    $password = isset($data['password']) ? (string)$data['password'] : '';

    if ($employee_name === '' || $new_username === '') {
        jout(['status' => 'error', 'message' => 'Name and username are required']);
    }
    if (strlen($new_username) > 50) {
        jout(['status' => 'error', 'message' => 'Username is too long']);
    }
    if (!preg_match('/^[A-Za-z0-9_.-]+$/', $new_username)) {
        jout(['status' => 'error', 'message' => 'Username may only contain letters, numbers, dot, dash or underscore']);
    }

    if ($new_username !== $me) {
        $chk = $conn->prepare("SELECT 1 FROM users WHERE username = ? LIMIT 1");
        $chk->bind_param('s', $new_username);
        $chk->execute();
        $chk->store_result();
        $exists = $chk->num_rows > 0;
        $chk->close();
        if ($exists) {
            jout(['status' => 'error', 'message' => 'That username is already taken']);
        }
    }

    $staff_name = $field('staff_name');
    $staff_position = $field('staff_position');
    $head_name = $field('head_name');
    $head_title = $field('head_title');
    $administrative_name = $field('administrative_name');
    $administrative_title = $field('administrative_title');
    $department = $field('department');

    $conn->begin_transaction();

    if ($password !== '') {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, employee_name = ?, staff_name = ?, staff_position = ?, head_name = ?, head_title = ?, administrative_name = ?, administrative_title = ?, department = ? WHERE username = ?");
        $stmt->bind_param('sssssssssss', $new_username, $hash, $employee_name, $staff_name, $staff_position, $head_name, $head_title, $administrative_name, $administrative_title, $department, $me);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username = ?, employee_name = ?, staff_name = ?, staff_position = ?, head_name = ?, head_title = ?, administrative_name = ?, administrative_title = ?, department = ? WHERE username = ?");
        $stmt->bind_param('ssssssssss', $new_username, $employee_name, $staff_name, $staff_position, $head_name, $head_title, $administrative_name, $administrative_title, $department, $me);
    }

    if (!$stmt->execute()) {
        $conn->rollback();
        jout(['status' => 'error', 'message' => 'Could not update account']);
    }
    $stmt->close();

    if ($new_username !== $me) {
        foreach (['accomplishments', 'daily_task_templates', 'daily_task_generation', 'user_daily_settings', 'messages'] as $table) {
            $up = $conn->prepare("UPDATE `$table` SET username = ? WHERE username = ?");
            $up->bind_param('ss', $new_username, $me);
            if (!$up->execute()) {
                $up->close();
                $conn->rollback();
                jout(['status' => 'error', 'message' => 'Could not update related records']);
            }
            $up->close();
        }

        $up = $conn->prepare("UPDATE messages SET recipient = ? WHERE recipient = ?");
        $up->bind_param('ss', $new_username, $me);
        $up->execute();
        $up->close();

        $_SESSION['username'] = $new_username;
    }

    if ($new_username !== $me || $employee_name !== '') {
        $up = $conn->prepare("UPDATE messages SET employee_name = ? WHERE username = ?");
        $up->bind_param('ss', $employee_name, $new_username);
        $up->execute();
        $up->close();
    }

    $conn->commit();

    jout(['status' => 'ok', 'message' => 'Account updated', 'username' => $new_username]);
}

function getSettings($conn, $me)
{
    $recent = [];
    $sql = "SELECT a.activity, a.start_time, a.end_time, a.remarks, a.report_date
            FROM accomplishments a
            INNER JOIN (
                SELECT activity, MAX(id) AS mx
                FROM accomplishments
                WHERE username = ? AND TRIM(activity) <> ''
                GROUP BY activity
            ) latest ON a.id = latest.mx
            ORDER BY a.id DESC
            LIMIT 60";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $me);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $recent[] = $row;
    }
    $stmt->close();

    $templates = [];
    $stmt = $conn->prepare("SELECT id, activity, start_time, end_time, remarks, sort_order FROM daily_task_templates WHERE username = ? ORDER BY sort_order, id");
    $stmt->bind_param('s', $me);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $templates[] = $row;
    }
    $stmt->close();

    $settings = ['include_saturday' => 0, 'include_sunday' => 0];
    $stmt = $conn->prepare("SELECT include_saturday, include_sunday FROM user_daily_settings WHERE username = ?");
    $stmt->bind_param('s', $me);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        $settings = $row;
    }
    $stmt->close();

    jout(['status' => 'ok', 'recent' => $recent, 'templates' => $templates, 'settings' => $settings]);
}

function saveTemplates($conn, $me)
{
    $data = body();
    $templates = isset($data['templates']) && is_array($data['templates']) ? $data['templates'] : [];

    $conn->begin_transaction();
    $del = $conn->prepare("DELETE FROM daily_task_templates WHERE username = ?");
    $del->bind_param('s', $me);
    $del->execute();
    $del->close();

    $ins = $conn->prepare("INSERT INTO daily_task_templates (username, activity, start_time, end_time, remarks, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
    $order = 0;
    foreach ($templates as $tpl) {
        $activity = isset($tpl['activity']) ? trim($tpl['activity']) : '';
        if ($activity === '') {
            continue;
        }
        $start = isset($tpl['start_time']) ? $tpl['start_time'] : '';
        $end = isset($tpl['end_time']) ? $tpl['end_time'] : '';
        $remarks = isset($tpl['remarks']) && $tpl['remarks'] !== '' ? $tpl['remarks'] : '-DONE';
        $ins->bind_param('sssssi', $me, $activity, $start, $end, $remarks, $order);
        $ins->execute();
        $order++;
    }
    $ins->close();
    $conn->commit();

    // Allow today's tasks to be generated with the updated selection.
    $delg = $conn->prepare("DELETE FROM daily_task_generation WHERE username = ? AND report_date = CURDATE()");
    $delg->bind_param('s', $me);
    $delg->execute();
    $delg->close();

    $month = isset($data['month']) ? trim($data['month']) : '';
    if (!preg_match('/^\d{4}-\d{2}$/', $month)) {
        $month = date('Y-m');
    }

    $added = generateForToday($conn, $me);
    $added += generateForMonthWorkingDays($conn, $me, $month);
    jout(['status' => 'ok', 'generated' => $added]);
}

function copyFromUser($conn, $me)
{
    $data = body();
    $source = isset($data['username']) ? trim($data['username']) : '';
    $mode = isset($data['mode']) ? $data['mode'] : 'day';

    if ($source === '' || $source === $me) {
        jout(['status' => 'error', 'message' => 'Please choose another user']);
    }

    $chk = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $chk->bind_param('s', $source);
    $chk->execute();
    $chk->store_result();
    if ($chk->num_rows === 0) {
        $chk->close();
        jout(['status' => 'error', 'message' => 'User not found']);
    }
    $chk->close();

    if ($mode === 'month') {
        $target = isset($data['month']) ? $data['month'] : '';
        if (!preg_match('/^\d{4}-\d{2}$/', $target)) {
            jout(['status' => 'error', 'message' => 'Invalid month']);
        }
    } else {
        $target = isset($data['date']) ? $data['date'] : '';
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $target)) {
            jout(['status' => 'error', 'message' => 'Invalid date']);
        }
    }

    $stmt = $conn->prepare("SELECT report_date, activity, start_time, end_time, remarks FROM accomplishments WHERE username = ? ORDER BY id ASC");
    $stmt->bind_param('s', $source);
    $stmt->execute();
    $res = $stmt->get_result();

    $groups = [];
    while ($row = $res->fetch_assoc()) {
        $ts = strtotime($row['report_date']);
        if ($ts === false) {
            continue;
        }

        $match = ($mode === 'month')
            ? (date('Y-m', $ts) === $target)
            : (date('Y-m-d', $ts) === $target);

        if (!$match) {
            continue;
        }

        $key = $row['report_date'];
        if (!isset($groups[$key])) {
            $groups[$key] = ['date' => $key, 'tasks' => []];
        }
        $groups[$key]['tasks'][] = [
            'desc' => $row['activity'],
            'start' => $row['start_time'],
            'end' => $row['end_time'],
            'remarks' => $row['remarks'],
        ];
    }
    $stmt->close();

    jout(['status' => 'ok', 'groups' => array_values($groups)]);
}
