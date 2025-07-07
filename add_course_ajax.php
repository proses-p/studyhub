<?php 
include 'db.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = trim($_POST['code']);
    $name = trim($_POST['name']);
    // check kama kozi ipo tyr
    $stmt = $dbconn->prepare("SELECT id FROM courses WHERE code = ? OR name = ?");
    $stmt->bind_param("ss", $code, $name);
    $stmt->execute();
    $stmt->store_result();

    if ($code==='' || $name==='') {
        echo json_encode(["success" => false, "message" => "Course already exists."]);
        exit;
    }
    // insert new course if it does not exist
    $stmt = $dbconn->prepare("INSERT INTO courses (code, name) VALUES (?, ?)");
    $stmt->bind_param("ss", $code, $name);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "id" => $stmt->insert_id]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to insert course."]);
    }
}
?>