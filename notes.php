<?php
include 'db.php';
$result = mysqli_query($dbconn, "SELECT * FROM notes ORDER BY course_id DESC");
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
            .container {
                max-width: 1000px;
                padding: 20px;
                margin: auto;
            }
            .year-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                margin-top: 40px;
            }
            .year-card {
                background-color: white;
                border-left: 5px solid #ff6600;
                padding: 20px;
                cursor: pointer;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
                transition: transform 0.2s;
                text-align: center;
            }
            .year-card:hover {
                transform: scale(1.03);
            }
            .year-card h3 {
                margin: 0;
                color: #333;
            }
            .year-card p {
                font-size: 14px;
                color: #555;
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
            .hero {
                padding: 50px;
                text-align: center;
            }
        </style>
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
                <h2>Notes & Questions</h2>
                <p>here you can find notes of each course of the specific year</p>
            </section>
            <div class="container">
                <h2>Choose your year of study</h2>
                <div class="year-grid">
                    <div class="year-card" onclick="location.href='notes_diploma_year1.php'">
                      <h3>Diploma year 1</h3>
                      <p>View notes for the given courses</p>
                    </div>
                    <div class="year-card" onclick="location.href='notes_diploma_year2.php'">
                      <h3>Diploma year 2</h3>
                      <p>View notes for the given courses</p>
                    </div>
                    <div class="year-card" onclick="location.href='notes_diploma_year3.php'">
                      <h3>Diploma year 3</h3>
                      <p>view notes for the given courses</p>
                    </div>
                    <div class="year-card" onclick="location.href='notes_degree_year1.php'">
                        <h3>Degree year 1</h3>
                        <p>view notes for the given courses</p>
                    </div>
                    <div class="year-card" onclick="location.href='notes_degree_year2.php'">
                        <h3>Degree year 2</h3>
                        <p>View notes for the given courses</p>
                    </div>
                    <div class="year-card" onclick="location.href='notes_degree_year3.php'">
                        <h3>Degree year 3</h3>
                        <p>View notes for the given courses</p>
                    </div>
                </div>
        </body>
    </head>
</html>