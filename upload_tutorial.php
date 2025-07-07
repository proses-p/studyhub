<?php 
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    exit('Admins only');
}
include 'db.php';
$courses = mysqli_query($dbconn, "SELECT id, code, name, title FROM courses ORDER BY code");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>Upload Tutorials</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                margin: 30px;
            }
            input, textarea, select, button {
                width: 100%;
                padding: 8px;
                margin: 6px 0;
            }
        </style>
    </head>
    <body>
        <h2>Upload Tutorials</h2>
        <form action="upload_tutorial_process.php" method="post" enctype="multipart/form-data">
            <label>Course:</label>
            <select id="courseSelect" name="course_id" required>
                <option value="">-- select course --</option>
                <?php while($c = mysqli_fetch_assoc($courses)): ?>
                    <option value="<?= $c['id'] ?>">
                <?= htmlspecialchars($c['code'].' - '.$c['name']) ?></option>
                <?php endwhile; ?>
            </select>
            <label>Add New Course:</label>
            <input type="text" id="newCourseCode" placeholder="New Course Code">
            <label>Course Name:</label>
            <input type="text" id="newCourseName" placeholder="e.g Computer Programming">
            <button type="button" id="addBtn">+ Add New Course</button>
            <label>Title:</label>
            <input type="text" name="title" required>
            <label>Description:</label>
            <textarea name="description" rows="5" required></textarea>
            <label>File (PDF/MP4/ZIP):</label>
            <input type="file" name="file" required>
            <button type="submit">Upload Tutorial</button>
        </form>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                console.log('Upload-Tutorial JS loaded');
                document.getElementById('addBtn').addEventListener('click', addCourse)

            
            function addCourse() {
                console.log('addCourse clicked');
                const code = document.getElementById("newCourseCode").value.trim();
                const name = document.getElementById("newCourseName").value.trim();
                if (!code || !name) {
                    alert("Please enter a course name & code");
                    return;
                }

                fetch('add_course_ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'code=' + encodeURIComponent(code) +'&name='+encodeURIComponent(name)
                })
                .then(r => r.text())
                .then(txt => {
                    console.log('SERVER:', txt);
                    const data = JSON.parse(txt);
                    if (data.success) {
                        const sel = document.getElementById("courseSelect");
                        sel.add(new Option(`${code} - ${name}`, data.id, true, true));
                        document.getElementById('newCourseCode').value = '';
                        document.getElementById('newCourseName').value = '';
                        alert('Course added!');
                    } else {
                        alert("Course not added: " + data.message);
                    }
                })
                .catch(e => { console.error('fetch error', e); alert('Network error'); });
            }
        });
        </script>
    </body>
</html>