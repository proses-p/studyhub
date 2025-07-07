<?php 
include 'db.php';

// kupata vitabu vyote vya degree year 1
$query = "SELECT books.title AS book_title, books.file_path, courses.code, courses.title AS course_title FROM books JOIN courses ON books.course_id = courses.id WHERE courses.level = 'Degree' AND courses.year = 3";
$result = mysqli_query($dbconn, $query);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>Degree Books - year 3</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
    </head>
    <body>
        <h2>Degree Books - year 3</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <ul>
                <?php while ($book = mysqli_fetch_assoc($result)): ?>
                    <li>
                        <strong><?= htmlspecialchars($book['book_title']) ?></strong><br>
                        course: <?= htmlspecialchars($book['code']) ?> - <?= htmlspecialchars($book['course_title']) ?><br>
                        <a href="<?= htmlspecialchars($book['file_path']) ?>" target="_blank">Download</a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No books for degree year 3 uploaded yet</p>
        <?php endif ?>
    </body>
</html>