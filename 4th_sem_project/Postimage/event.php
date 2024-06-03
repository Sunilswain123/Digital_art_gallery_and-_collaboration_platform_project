<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['mob_mail'])) {
    header('Location: log-reg.php');
    exit();
}

$user_id = $_SESSION['mob_mail'];
$post_id = $_GET['post_id'];
$target_user_id = $_GET['user_id'];

// Insert the challenge request into the database
$query = "INSERT INTO challenges (sender_id, receiver_id, post_id, status) VALUES ('$user_id', '$target_user_id', '$post_id', 'pending')";
if (mysqli_query($conn, $query)) {
    echo "Challenge request sent successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}

header('Location: home_page.php');
?>
