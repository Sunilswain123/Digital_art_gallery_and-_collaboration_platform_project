<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $tn = isset($_POST['tn']) ? $_POST['tn'] : '';
    $collaboration_details = isset($_POST['collaboration_details']) ? mysqli_real_escape_string($conn, $_POST['collaboration_details']) : '';
    $mob_mail = $_SESSION['mob_mail'];
    $image_path = '';

    if ($post_id > 0 && !empty($tn) && !empty($collaboration_details)) {
        // Handle the file upload
        if (isset($_FILES['collaboration_image']) && $_FILES['collaboration_image']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = 'images/';
            $image_path = $upload_dir . basename($_FILES['collaboration_image']['name']);
            if (!move_uploaded_file($_FILES['collaboration_image']['tmp_name'], $image_path)) {
                echo "Failed to upload image.";
                exit;
            }
        }
        $conmob=$mob_mail."cs";
        $conmob1=$tn."cr";
        $query = "INSERT INTO $conmob VALUES (0, '$tn', 1 , '$image_path','$collaboration_details','$post_id' )";
        $qry="INSERT INTO $conmob1 VALUES(0,'$mob_mail',1,'$image_path','$collaboration_details','$post_id')";
        if (mysqli_query($conn, $query) && mysqli_query($conn,$qry)) {
            header('Location: home_page.php'); // Redirect to the homepage or any other page
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid input.";
    }
} else {
    echo "Invalid request method.";
}
?>
