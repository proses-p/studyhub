<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_SESSION['users_id'])) {
    header('location: login.php');
    exit;
    # code...
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>StudyHub</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
            .hero {
                padding: 50px;
                text-align: center;
            }
            footer {
                background-color: #333;
                color: white;
                padding: 20px;
                text-align: center;
                margin-top: 40px;
            }
            footer a {
                color: #ffa500;
                text-decoration: none;
            }
        </style>
        <body>
            <nav class="navigationbar">
                <h1>StudyHub, <?php echo htmlspecialchars($_SESSION['fullname']); ?></h1>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="pastpapers.html">Past Papers</a></li>
                        <li><a href="notes.html">Notes & Questions</a></li>
                        <li><a href="tutorial.php">Tutorial Videos</a></li>
                        <li><a href="books.html">Books</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
            </nav>

            <section class="hero">
                <h2>Welcome to Proses StudyHub</h2>
                <p>Access pastpapers, notes & questions, tutorial videos, books of each year with specific courses easily</p>
                <p>Study different materials to archieve Your Goals | Tujifunze kwa maendeleo ya watu</p>
            </section>
            <footer style="background-color: #333; color: white; padding: 20px; margin-top: 40px; text-align: center;">
                <h3>Contacts</h3>
                <p>Email: <a href="mailto:prosesprojestus0@gmail.com" style="color: #ffa500;">prosesprojestus0@gmail.com</a></p>
                <p>Phone: <a href="tel:+255780686067" style="color: #ffa500;">+255 780 686 067</a></p>
                <p>Location: Morogoro, Tanzania</p>
                <p>P.O.Box 1 Mzumbe University(main campus)</p>
                <p>&copy; 2025 StudyHub with proses | All right reserved</p>
                <section style="background: #f2f2f2; padding: 40px;">
                    <h2 style="text-align: center; color: #333;">Send me a Message</h2>
                    <form style="max-width: 500px; margin: auto;" onsubmit="sendMessage(event)">
                        <input type="text" id="name" placeholder="Your Name" required style="width: 100%; padding: 10px; margin: 10px 0;">
                        <input type="email" id="email" placeholder="Your Email" required style="width: 100%; padding: 10px; margin: 10px 0;">
                        <textarea id="message" placeholder="Your Message" required style="width: 100%; padding: 10px; margin: 10px 0; height: 100px;"></textarea>
                        <button type="submit" style="padding: 10px 20px; background-color: #ff6600; color: white; border: none;">Send</button>
                    </form>
                    <p id="response" style="text-align: center; color: green; margin-top: 10px;"></p>
                </section>
                <div style="text-align: center; margin-top: 30px;">
                <a href="https://wa.me/255780686067" target="_blank" style="
                display: inline-block;
                bottom: 20px;
                right: 40px;
                background-color: #25D366;
                color: white;
                padding: 12px 15px;
                border-radius: 50%;
                font-size: 24px;
                text-decoration: none;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
                z-index: 999;">
                <i class="fab fa-whatsapp"></i></a>
                </div>
            </footer>
            <script>
                function sendMessage(event) {
                    event.preventDefault();
                    const name = document.getElementById("name").value.trim();
                    const email = document.getElementById("email").value.trim();
                    const message = document.getElementById("message").value.trim();
                    // it just shows feedback for now
                    if (name && email && message) {
                        document.getElementById("response").innerText = "Thanks" + name + ", your message has been sent!";

                        // clear form
                        document.getElementById("name").value = "";
                        document.getElementById("email").value = "";
                        document.getElementById("message").value = "";
                    }
                }
            </script>
        </body>
    </head>
</html>