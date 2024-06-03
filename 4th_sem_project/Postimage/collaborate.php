<?php
session_start();
require 'connection.php';

// Fetch the post ID and table name from the URL query parameters
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
$tn = isset($_GET['tn']) ? $_GET['tn'] : '';
$mob = $_SESSION['mob_mail'];

if ($post_id > 0 && !empty($tn)) {
    // Fetch post details from the database
    $post_query = "SELECT * FROM `$tn` WHERE sl = $post_id";
    $post_result = mysqli_query($conn, $post_query);

    if ($post_result && mysqli_num_rows($post_result) > 0) {
        $post_details = mysqli_fetch_assoc($post_result);
    } else {
        echo "Post not found.";
        exit;
    }
} else {
    echo "Invalid post ID or table name.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborate on Post</title>
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css_file/navbar1.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 20px;
        }
        .post-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .collaborate-form {
            margin-top: 20px;
        }
        .hidden-file-input {
            display: none;
        }
        .second-image {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include_once 'nav.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="post-details">
                    <h3><?php echo htmlspecialchars($post_details['caption']); ?></h3>
                    <div class="row">
                        <!-- First image section -->
                        <div class="col-md-6">
                            <img src="images/<?php echo htmlspecialchars($post_details['img_vdo']); ?>" alt="Post Image" class="img-fluid" style="height:200px; width:100%;">
                        </div>
                        <!-- Second image section with click event -->
                        <div class="col-md-6">
                            <form action="collaborate_action.php" method="post" enctype="multipart/form-data">
                                <img src="images/<?php echo htmlspecialchars($post_details['img_vdo']); ?>" alt="Post Image" class="img-fluid second-image" id="secondImage" style="height:200px; width:100%; cursor: pointer;">
                                <input type="file" class="form-control hidden-file-input" id="collaboration-image" name="collaboration_image" accept="image/*">
                                <p><?php echo htmlspecialchars($post_details['category']); ?></p>
                        </div>
                    </div>
                </div>
                <div class="collaborate-form">
                    <h4>Collaborate on this Post</h4>
                    
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                        <input type="hidden" name="tn" value="<?php echo htmlspecialchars($tn); ?>">
                        <div class="mb-3">
                            <label for="collaboration-details" class="form-label">Your Collaboration Details</label>
                            <textarea class="form-control" id="collaboration-details" name="collaboration_details" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="collaboration-image" class="form-label">Upload an Image for Collaboration</label> -->
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Send Collaboration Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../Assets/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const secondImage = document.querySelector('.second-image');
            const fileInput = document.getElementById('collaboration-image');

            secondImage.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (fileInput.files && fileInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        secondImage.src = e.target.result;
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        });
    </script>
</body>
</html>
