<?php 
include 'db.php';
$sql = "SELECT pp.title AS paper_title, pp.semester, pp.year, pp.file_path, c.code AS course_code, c.title AS course_title FROM pastpapers pp JOIN courses c ON pp.course_id = c.id WHERE c.level = ? AND c.year = ? ORDER BY pp.year DESC, c.code, pp.semester";

$stmt = $dbconn->prepare($sql);
$level = 'Diploma';
$year = '3';
$stmt->bind_param("si", $level, $year);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, intial-scale=1.0">
      <title>Past papers - Diploma year 3</title>
      <link rel="stylesheet" href="assets/css/style.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
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
        <h2>Past papers - Diploma year 3</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <tr>
                    <th>Course</th>
                    <th>Title</th>
                    <th>Semester</th>
                    <th>level</th>
                    <th>Year</th>
                    <th>Download</th>
                </tr>
                <?php while ($pp = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($pp['course_code']) ?></td>
                        <td><?= htmlspecialchars($pp['pastpaper_title']) ?></td>
                        <td><?= htmlspecialchars($pp['semester']) ?></td>
            
                        <td><?= htmlspecialchars($pp['year']) ?></td>
                        <td><a href="<?= htmlspecialchars($pp['file_path']) ?>" target="_blank">Download</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p><em>No past papers uploaded yet for diploma year 3.</em></p>
        <?php endif; ?>
    </body>
</html>