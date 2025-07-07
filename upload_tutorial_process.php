<?php 
include 'db.php';

if (!isset($_POST['course_id'], $_POST['title'], $_POST['description'], $_FILES['file']) || $_POST['course_id']==='' ||
$_POST['title']==='' || $_POST['description']==='') {
    exit('missing required fields');
}
$course_id = intval($_POST['course_id']);
$title = trim($_POST['title']);
$description = trim($_POST['description']);
$file = $_FILES['file'];
$dir = __DIR__ . '/uploads/tutorial/';
if (!is_dir($dir)) { mkdir($dir, 0755, true); }

$target_file = $dir . time().'_'.basename($_FILES['file']['name']);

if (!move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
    exit('file upload failed');
}

$stmt = $dbconn->prepare(
    "INSERT INTO tutorial (course_id, title, description, file_path) VALUES (?, ?, ?, ?)"
);
$stmt->bind_param('isss', $course_id, $title, $description, $target_file);

if ($stmt->execute()) {
    echo "Tutorial uploaded successfully.";
} else {
    echo "DB Error: " . $stmt->error;
}
?>