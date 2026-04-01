<?php
session_start();
header("Content-Type: application/json");

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "krc_system");
$logged_user = $_SESSION['username'];

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// GET: Load data ONLY for the logged-in user
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conn->prepare("SELECT * FROM accomplishments WHERE username = ? ORDER BY id ASC");
    $stmt->bind_param("s", $logged_user);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}

// POST: Save/Sync data for the logged-in user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (empty($data)) {
        echo json_encode(["status" => "error", "message" => "No data received"]);
        exit;
    }

    // ONLY clear data belonging to THIS user (do NOT use TRUNCATE)
    $delete_stmt = $conn->prepare("DELETE FROM accomplishments WHERE username = ?");
    $delete_stmt->bind_param("s", $logged_user);
    $delete_stmt->execute();

    $stmt = $conn->prepare("INSERT INTO accomplishments (username, report_date, activity, start_time, end_time) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($data as $row) {
        // Map JS keys to DB columns + include the username
        $stmt->bind_param("sssss", 
            $logged_user, 
            $row['date'], 
            $row['desc'], 
            $row['start'], 
            $row['end']
        );
        $stmt->execute();
    }
    echo json_encode(["status" => "success"]);
}

$conn->close();
?>