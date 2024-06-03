<?php
// date_default_timezone_get("Asia/Kolkata");
require 'connection.php';
session_start();

if (!isset($_SESSION['mob_mail'])) {
    header('Location: log-reg.php');
    exit();
}

$user_id = $_SESSION['mob_mail'];
$challenge_id = $_POST['challenge_id'];
$receiver_id = $_POST['receiver_id'];
$support_image = $_FILES['support_image']['name'];
$target_dir = "images/";
$target_file = $target_dir . basename($support_image);

$response = array();

if (move_uploaded_file($_FILES['support_image']['tmp_name'], $target_file)) {
    
    $current_time = date('Y-m-d H:i:s');
    // echo $current_time;
    $query = "INSERT INTO support_photos (challenge_id, sender_id, receiver_id, photo2) VALUES ('$challenge_id', '$user_id', '$receiver_id', '$support_image')";
    $update_query = "UPDATE challenges SET support_image_uploaded = 1, support_upload_time = '$current_time' WHERE receiver_id = '$receiver_id'";

    if (mysqli_query($conn, $query) && mysqli_query($conn, $update_query)) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Database error: ' . mysqli_error($conn);
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Sorry, there was an error uploading your file.';
}

echo json_encode($response);
?>
