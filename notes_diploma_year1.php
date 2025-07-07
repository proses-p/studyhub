<?php 
include 'db.php';
$sql = "SELECT n.title AS note_title, n.file_path, n.semester, c.code AS course_code, c.title AS course_title FROM notes n JOIN courses c
 ON n.course_id = c.id WHERE c.level = ? AND c.year = ? ORDER BY c.code ASC, n.semester ASC";
$stmt = $dbconn->prepare($sql);
$level = 'Diploma';
$year = '1';
$stmt->bind_param("si", $level, $year);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <title>Notes - Diploma year 1</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"></style>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 30px;

        }
        table {
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }
      </style>
    </head>
    <body>
        <h2>Notes - Diploma year 1</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <tr>
                    <th>Course</th>
                    <th>Title</th>
                    <th>Semester</th>
                    <th>Download</th>
                </tr>
                <?php while ($note = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($note['course_code']) ?></td>
                        <td><?= htmlspecialchars($note['note_title']) ?></td>
                        <td><?= htmlspecialchars($note['semester']) ?></td>
                        <td><a href="<?= htmlspecialchars($note['file_path']) ?>" target="_blank">Download</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p><em>No notes uploaded yet for diploma year 1.</em></p>
        <?php endif; ?>
    </body>
</html>
</html>