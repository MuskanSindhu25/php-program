<?php
session_start();
echo "<pre>";
print_r($_POST);
echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $contact = trim($_POST["contact"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $event = $_POST["event"];

    if (empty($firstName)) $errors[] = "First Name is required.";
    if (empty($lastName)) $errors[] = "Last Name is required.";
    if (!preg_match("/^[0-9]{10}$/", $contact)) $errors[] = "Invalid contact number.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if (strlen($password) < 8) $errors[] = "Password must be at least 8 characters.";
    if ($password !== $confirmPassword) $errors[] = "Passwords do not match.";
    if (empty($event)) $errors[] = "Please select an event.";

    if (empty($errors)) {
        $_SESSION['email'] = $email;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['contact'] = $contact;
        $_SESSION['event'] = $event;

        echo "<p style='color:green;'>Registration successful!</p>";
        header("Location: login.html");
        exit();
    } else {
        echo "<p style='color:red;'>Errors found:</p>";
        print_r($errors);
    }
}
?>
