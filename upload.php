<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profilePicture"])) {
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $userEmail = $_SESSION["user"];
    $fileExtension = pathinfo($_FILES["profilePicture"]["name"], PATHINFO_EXTENSION);
    $fileName = $userEmail . ".png";
    $targetFile = $uploadDir . $fileName;

    $allowedExtensions = ["jpg", "jpeg", "png"];

    if (in_array(strtolower($fileExtension), $allowedExtensions)) {
        if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFile)) {
            header("Location: home.html");
            exit;
        } else {
            echo "<p style='color:red;'>Error uploading file.</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid file type. Only JPG, JPEG, and PNG are allowed.</p>";
    }
}
?>
