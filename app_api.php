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
        return 0;
    }

    $sat = 0;
    $sun = 0;
    $s = $conn->prepare("SELECT include_saturday, include_sunday FROM user_daily_settings WHERE username = ?");
    $s->bind_param('s', $me);
    $s->execute();
    $r = $s->get_result();
    if ($row = $r->fetch_assoc()) {
        $sat = (int)$row['include_saturday'];
        $sun = (int)$row['include_sunday'];
    }
    $s->close();

    $dow = (int)date('w', strtotime($today));
    if (($dow === 6 && !$sat) || ($dow === 0 && !$sun)) {
        markGenerated($conn, $me, $today);
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
        // Nothing selected yet: don't mark, so checking a task later can still
        // generate it for the current day.
        return 0;
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

    markGenerated($conn, $me, $today);
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

    $added = generateForToday($conn, $me);
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
