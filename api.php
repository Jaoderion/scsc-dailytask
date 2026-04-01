<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "krc_system");

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed"]));
}

// LOAD DATA
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM accomplishments ORDER BY id ASC");
    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}

// SAVE DATA
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Clear existing for a fresh sync
    $conn->query("TRUNCATE TABLE accomplishments");

    $stmt = $conn->prepare("INSERT INTO accomplishments (report_date, activity, start_time, end_time) VALUES (?, ?, ?, ?)");
    
    foreach ($data as $row) {
        $stmt->bind_param("ssss", $row['date'], $row['desc'], $row['start'], $row['end']);
        $stmt->execute();
    }
    echo json_encode(["status" => "success"]);
}

$conn->close();
?>