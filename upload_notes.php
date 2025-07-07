<?php 
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    echo "You are not allowed to upload notes (admin only)";
    exit;
}
include 'db.php';
$courses = mysqli_query($dbconn, "SELECT id, code, name FROM courses ORDER BY code");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>Upload notes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif; padding: 20px; background-color: #f9f9f9;
            }
            input, button {
                padding: 10px;
                margin: 5px 0;
                width: 40%;
            }
        </style>
    </head>
    <body>
        <h2>Upload Notes</h2>
        <form action="upload_notes_process.php" method="post" enctype="multipart/form-data">
            <label>Course:</label>
            <select name="course_id" required>
                <option value="">-- Select course --</option>
                <?php 
                while($c = mysqli_fetch_assoc($courses)){
                    echo "<option value='{$c['id']}'>". htmlspecialchars($c['code'].' - '. $c['name'])."</option>";
                }
                ?>
            </select>
            <label>Title:</label>
            <input type="text" name="title" placeholder="Title of the notes" required><br>
             <label>Semester:</label>
             <input type="text" name="semester" required>   
            <label>File(PDF):</label>
            <input type="file" name="file_path" required><br>
            <button type="submit">Upload Notes</button>
        </form>
    </body>
</html>

