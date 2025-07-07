<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// start the session
include 'db.php'; // include connection to the 3307 port
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailphone = strtolower(trim($_POST['emailphone']));
    $password = $_POST['password'];

    $stmt = mysqli_prepare($dbconn, "SELECT * FROM users WHERE emailphone = ?");
    mysqli_stmt_bind_param($stmt, 's',$emailphone);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        # linganisha password na password verify
        if (password_verify($password, $row['password'])) {
            echo "<p style='color:green'> login successfully - redirecting.....</p>";
            # weka data za user kweny session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['emailphone'] = $row['emailphone'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['is_admin'] = ($user['emailphone'] === 'admin@studyhub.com');
            # redirect kwenda home page
            if ($_SESSION['emailphone'] === 'admin@studyhub.com') {
                $_SESSION['is_admin'] = true;
            } else {
                $_SESSION['is_admin'] = false;
            }
            header('refresh:2; url=index.html');
            exit;

        } else {
            echo "<p style='color:red'>incorrect password</p>";
        }
    } else {
        echo "<p style='color:red'>User not found</p>";
    }
}
?>