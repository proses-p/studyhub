<?php
include 'db.php';
$sql = "SELECT t.title, t.description, t.file_path, c.code, c.name, c.title AS course_title FROM tutorial t JOIN courses c ON t.course_id = c.id ORDER BY t.uploaded_at DESC";
$result = mysqli_query($dbconn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>StudyHub</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                margin: 0;
                background-color: aliceblue;
            }
            .navigationbar {
                background-color: #f28c28;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px;
                color: white;
            }
            .navigationbar ul {
                list-style: none;
                display: flex;
                gap: 15px;
            }
            .navigationbar a {
                color: white;
                text-decoration: none;
            }
            .wrap {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                
            }
            .box {
                flex: 1 1 300px;
                border: 1px solid #ccc;
                padding: 15px;
                margin: 15px;
                width: 200px;
                display: inline-block;
                vertical-align: top;
                border-radius: 10px;
                background-color: #f8f8f8;
                border-left: 5px solid #f28c28;
            }
            .box h3 {
                margin-top: 0;
            }
        </style>
    </head>
    <body>
        <nav class="navigationbar">
                <h1>StudyHub</h1>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="pastpapers.html">Past Papers</a></li>
                        <li><a href="notes.html">Notes & Questions</a></li>
                        <li><a href="tutorial.php">Tutorial Videos</a></li>
                        <li><a href="books.html">Books</a></li>
                    </ul>
            </nav>
            <section class="hero">
                <h2>Tutorial Videos</h2>
                <p>Specific videos concerning the specific content and notes provided in each lecture of the specific year or semester</p>
            </section>
        <h2>Tutorials</h2>
        <div class="wrap">
        <?php if ($result && mysqli_num_rows($result)): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="box">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($row['description'])) ?></p>
                    <p><strong>Course:</strong><?= htmlspecialchars($row['code'].' - '.$row['name']) ?></p>
                    <a href="<?= htmlspecialchars($row['file_path']) ?>" download>Download Tutorial</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p><em>No tutorials uploaded yet.</em></p>
        <?php endif; ?>

        </div>
    </body>
        
    
</html>