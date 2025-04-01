<?php
session_start();

if (!isset($_SESSION["user"])) {
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$userEmail = $_SESSION["user"];
$profileImage = file_exists("uploads/$userEmail.png") ? "uploads/$userEmail.png" : "uploads/default.png";

echo json_encode([
    "email" => $userEmail,
    "profileImage" => $profileImage
]);
?>
