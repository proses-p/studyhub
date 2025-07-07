<?php 
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    echo "You are not allowed to upload pastpapers (admin only)";
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
        <title>Upload pastpapers</title>
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
        <h2>Upload Pastpaper</h2>
        <form action="upload_pastpapers_process.php" method="post" enctype="multipart/form-data">
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
            <input type="text" name="title" placeholder="Title of the paper" required><br>
            <label>Year:</label>
            <input type="text" name="year" placeholder="year (1 - 3)" required><br>
            <label>Level:</label>
            <select name="level" required>
                <option value="">-- select level --</option>
                <option value="Degree">Degree</option>
                <option value="Diploma">Diploma</option>

            </select>
            <select name="semester" required>
                <option value="">-- Select Semester --</option>
                <option value="Semester 1">Semester 1</option>
                <option value="Semester 2">Semester 2</option>
            </select><br>
            <input type="file" name="file_path" accept=".pdf" required><br>
            <button type="submit">Upload Past paper</button>
        </form>
    </body>
</html>

