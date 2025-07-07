<?php 
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    echo "You are not allowed to upload books. Admins only!";
    exit;
}
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $course_id = $_POST['course_id'];
    $file_name = $_FILES['book_file']['name'];
    $file_tmp = $_FILES['book_file']['tmp_name'];
    $upload_dir = "uploads/books/";
    $file_path = $upload_dir . basename($file_name);

    if (move_uploaded_file($file_tmp, $file_path)) {
        $stmt = $dbconn->prepare("INSERT INTO books (course_id, title, author, file_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $course_id, $title, $author, $file_path);
        $stmt->execute();
        echo "Book uploaded successifully!";
    } else {
        echo "Failed to upload file";
    }
}
?>

<h2>Upload Book</h2>
<form action="" method="post" enctype="multipart/form-data">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>
    <label>Author:</label><br>
    <input type="text" name="author"><br><br>
    <label>Course ID:</label><br>
    <input type="number" name="course_id" required><br><br>
    <label>Select Book (PDF):</label><br>
    <input type="file" name="book_file" accept="application/pdf"required><br><br>
    <input type="submit" value="Upload Book">
</form>