<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['fullname'];
    $emailphone = $_POST['emailphone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fullname, emailphone, password) VALUES ('$fullname', '$emailphone', '$password')";
    if (mysqli_query($dbconn, $sql)) {
        echo "registration successifully!";
        header('refresh:1; url=index.html');
    } else {
        echo "registration denied: " . mysqli_error($conn);
    }
} else {
    echo "fomu haikutumwa kwa njia sahiihi (POST)";
}
?>