<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['mob_mail'])) {
    header('Location: log-reg.php');
    exit();
}

$sender = $_POST['sender'];
$user = $_POST['user'];

if (isset($_POST['accept'])) {
    $query = "UPDATE challenges SET status='accepted' WHERE sender_id='$sender' AND receiver_id='$user'";
} elseif (isset($_POST['reject'])) {
    $query = "DELETE FROM challenges WHERE sender_id='$sender' AND receiver_id='$user'";
}

if (mysqli_query($conn, $query)) {
    header('Location: my_challenge.php');
} else {
    echo 'error: ' . mysqli_error($conn);
}
?>
