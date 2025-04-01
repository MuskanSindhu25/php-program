<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        echo "<p style='color:red;'>Email and Password are required.</p>";
        exit;
    }

    $users = file("users.txt", FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($storedEmail, $storedPassword) = explode(",", $user);

        if ($email == $storedEmail && password_verify($password, $storedPassword)) {
            $_SESSION["user"] = $email;
            header("Location: welcome.php");
            exit;
        }
    }

    echo "<p style='color:red;'>Invalid email or password.</p>";
}
?>
