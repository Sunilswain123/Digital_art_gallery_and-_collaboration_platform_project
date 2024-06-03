<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['mob_mail'])) {
    header('Location: log-reg.php');
    exit();
}

$user_id = $_SESSION['mob_mail'];

// Fetch challenge requests
$query = "SELECT * FROM challenges WHERE receiver_id='$user_id' AND status='pending'";
$result = mysqli_query($conn, $query);

$query1 = "SELECT * FROM challenges WHERE sender_id='$user_id' AND status='accepted'";
$result1 = mysqli_query($conn, $query1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Challenges</title>
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .accepted {
            background-color: green;
            color: white;
        }
    </style>
</head>
<body style="background-image: url(./images/abstract-blue.jpg);">
    <?php include_once "nav.php"; ?>
    <div class="container mt-4" >
        
        <div class="row">
            <!-- Challenge Request Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Challenge Requests</h2>
                    </div>
                    <?php if (mysqli_num_rows($result) == 0) { ?>
                        <h6>No Challenge found.</h6>
                    <?php } else { ?>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sender</th>
                                    <th>Post</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                $sender_id = $row['sender_id'];
                                $post_id = $row['post_id'];

                                $sender_query = "SELECT name FROM register WHERE phone='$sender_id'";
                                $sender_result = mysqli_query($conn, $sender_query);
                                $sender = mysqli_fetch_assoc($sender_result)['name'];

                                $post_query = "SELECT * FROM `$user_id` WHERE sl='$post_id'";
                                $post_result = mysqli_query($conn, $post_query);
                                $post = mysqli_fetch_assoc($post_result);
                                $cap=$post['caption'];
                                ?>
                                <tr id="challenge_<?php echo $row['id']; ?>">
                                    <td><?php echo $sender; ?></td>
                                    <?php $img = $post['img_vdo']; 
                                    echo $sender_id;
                                    echo $user_id;
                                    ?>
                                    <td><img src="./images/<?php echo $img; ?>" alt="post image" style="height:200px; height:150px;"></td>
                                    <form action="handle_challenge.php" method="post">
                                    <td>
                                        <input type="hidden" name="sender" value="<?php echo $sender_id; ?>">
                                        <input type="hidden" name="user" value="<?php echo $user_id; ?>">
                                        <input type="submit" class="btn btn-success"  value="Accept" name="accept">
                                        <input type="submit"  class="btn btn-danger" value="Reject" name="reject">
                                    </td>
                                    </form>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Accepted Challenge Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Accepted Challenges</h2>
                    </div>
                    <?php 
                        // echo $user_id;
                        // echo $receiver_id."...";
                        $qry2=mysqli_query($conn,"SELECT * FROM challenges WHERE sender_id='$user_id' AND receiver_id='$receiver_id' ");
                        if($qry2){
                            $res=mysqli_fetch_assoc($qry2);
                            $siu=$res['support_image_uploaded'];
                            // echo $siu;
                            if($siu==0){
                                ?>
                           
                    <?php if (mysqli_num_rows($result1) == 0) { ?>
                        <h6>No Results found.</h6>
                    <?php } else { ?>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Receiver</th>
                                    <th>Post</th>
                                    <th>Upload Support Photo</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($row1 = mysqli_fetch_assoc($result1)) {
                                $receiver_id = $row1['receiver_id'];
                                $post_id1 = $row1['post_id'];

                                $sender_query1 = "SELECT name FROM register WHERE phone='$receiver_id'";
                                $sender_result1 = mysqli_query($conn, $sender_query1);
                                $sender1 = mysqli_fetch_assoc($sender_result1)['name'];

                                $post_query1 = "SELECT * FROM `$receiver_id` WHERE sl='$post_id1'";
                                $post_result1 = mysqli_query($conn, $post_query1);
                                $post1 = mysqli_fetch_assoc($post_result1);
                            ?>
                                <tr id="accepted_challenge_<?php echo $row1['id']; ?>">
                                    <td><?php echo $sender1; ?></td>
                                    <?php $img1 = $post1['img_vdo']; ?>
                                    <td><img src="./images/<?php echo $img1; ?>" alt="accepted" style="width:200px; height:150px;"></td>
                                    <td>
                                        <form class="upload-form" action="upload_support.php" method="POST" enctype="multipart/form-data" data-row-id="accepted_challenge_<?php echo $row1['id']; ?>">
                                            <input type="file" name="support_image" required onchange="previewImage(this, 'preview_<?php echo $row1['id']; ?>')">
                                            <input type="hidden" name="challenge_id" value="<?php echo $post1['sl']; ?>">
                                            <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">
                                            <br>
                                            <img id="preview_<?php echo $row1['id']; ?>" src="#" alt="preview" style="display:none; width:200px; height:150px; margin-top:10px;">
                                            <button type="submit" class="btn btn-primary mt-2">Upload</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        }
                        } else {
                            ?>
                            <h6>No record found.</h6>
                            <?php
                        }
                        ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script>
//   function handleChallenge(action, challengeId) {
//     $.ajax({
//         url: 'handle_challenge.php',
//         type: 'POST',
//         data: { action: action, challenge_id: challengeId },
//         success: function(response) {
//             console.log('Server response:', response); // Log the response for debugging
//             if (response.trim() === 'accept') {
//                 $('#challenge_' + challengeId).addClass('accepted').find('td:last').html('Accepted');
//             } else if (response.trim() === 'reject') {
//                 $('#challenge_' + challengeId).remove();
//             } else {
//                 alert('There was an error processing your request.');
//             }
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//             console.error('AJAX error:', textStatus, errorThrown); // Log AJAX errors for debugging
//             alert('There was an error processing your request.');
//         }
//     });
// }



        function previewImage(input, previewId) {
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#' + previewId).attr('src', e.target.result).show();
            };

            reader.readAsDataURL(file);
        }

        $(document).ready(function() {
            $('.upload-form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(this);
                var rowId = form.data('row-id');

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            $('#' + rowId).remove();
                            window.location.href = 'home_page.php';
                        } else {
                            alert(result.message);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
