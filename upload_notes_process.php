<?php 
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    echo "You are not allowed to upload notes (admin only)";
    exit;
}
include 'db.php';
if (
    empty($_POST['course_id']) ||
    empty($_POST['semester']) ||
    empty($_POST['title']) ||
    empty($_FILES['file_path']) ||
    $_FILES['file_path']['error'] !== 0
) {
    exit('missing fields');
}

$course_id = intval($_POST['course_id']);
$semester = trim($_POST['semester']);
$title = trim($_POST['title']);

if ($_FILES['file_path']['error'] !== UPLOAD_ERR_OK) {
    exit('File upload error code '. $_FILES['file_path']['error']);
}
$chk = $dbconn->prepare("SELECT 1 FROM courses WHERE id=?");
$chk->bind_param('i', $course_id);
$chk->execute(); $chk->store_result();
if ($chk->num_rows===0) exit('Invalid course');

$dir = __DIR__.'/uploads/notes/';
if (!is_dir($dir)) {
     mkdir($dir,0755,true);
}
$filename = time().'_'.basename($_FILES['file_path']['name']);
$path = $dir.$filename;
    if (!move_uploaded_file($_FILES['file_path']['tmp_name'],$path)) {
        exit('could not move uploaded file.');
    }
        $stmt = $dbconn->prepare("INSERT INTO notes (course_id, semester, title, file_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $course_id, $semester, $title, $path);
        $stmt->execute();

        echo "notes uploaded successifully! <a href='notes.php'>View notes</a>";
        header("Location: notes.php?up=1");
?>