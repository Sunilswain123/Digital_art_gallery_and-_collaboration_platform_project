<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['mob_mail'])) {
    header("Location: log-reg.php");
    exit();
}

$current_date = date("Y-m-d");
$mob=$_SESSION['mob_mail'];
$query = "SELECT * FROM events WHERE created_by = $mob";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <style>
        .expired {
            border-color: red;
        }
        .ongoing {
            border-color: green;
        }
        .upcoming {
            border-color: blue;
        }
        .preview-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        .preview-image {
            max-width: 80%;
            max-height: 80%;
            border-radius: 10px;
            cursor: pointer;
        }
        .close-preview {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }
        .image-options {
            position: absolute;
            bottom: 10px;
            right: 10px;
            display: none;
        }
        .image-options a {
            color: white;
            margin-left: 10px;
            text-decoration: none;
        }
        .image-options a:hover {
            text-decoration: underline;
        }
        .previewable-container {
            position: relative;
        }
        .previewable-container:hover .image-options {
            display: block;
        }
    </style>
</head>
<body style="background-image: url(./images/wallp.jpg);">
    <?php include_once 'nav.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Events</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <?php
                    $event_date = $row['event_date'];
                    $follow_up_date = $row['follow_up_date'];
                    $event_id = $row['id'];

                    $support_query = "SELECT * FROM event_support WHERE event_id = '$event_id'";
                    $support_result = $conn->query($support_query);

                    $status = '';

                    if ($current_date > $follow_up_date) {
                        $status = 'Expired';
                        $class = 'expired';
                    } elseif ($current_date >= $event_date && $current_date <= $follow_up_date) {
                        $status = 'Ongoing';
                        $class = 'ongoing';
                    } elseif ($current_date < $event_date) {
                        $status = 'Upcoming';
                        $class = 'upcoming';
                    }
                ?>
                <div class="col">
                    <div class="card <?php echo $class; ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="card-title"><?php echo $row['event_name']; ?></h5>
                                    <p class="card-text">Event Date: <?php echo $event_date; ?></p>
                                    <p class="card-text">Follow-up Date: <?php echo $follow_up_date; ?></p>
                                    <p class="card-text">Status: <?php echo $status; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <div class="row row-cols-1 row-cols-md-2 g-4">
                                        <?php while ($support_row = $support_result->fetch_assoc()) : ?>
                                            <div class="col previewable-container">
                                                <img src="<?php echo $support_row['photo']; ?>" class="card-img-top previewable" alt="Support Image" style="width: 200px;">
                                                <div class="image-options">
                                                    <a href="<?php echo $support_row['photo']; ?>" style="color:white; background-color:black; " download>Download</a>
                                                    <a class="preview-image-btn" style="color:white; background-color:black; ">Preview</a>
                                                </div>
                                            </div>
                                           
                                        <?php endwhile; ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="preview-container">
        <span class="close-preview">&times;</span>
        <img src="" class="preview-image" alt="Preview Image">
    </div>

    <script src="../Assets/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const previewContainer = document.querySelector('.preview-container');
            const previewImage = document.querySelector('.preview-image');
            const closePreview = document.querySelector('.close-preview');
            const previewableImages = document.querySelectorAll('.previewable');
            const previewImageBtns = document.querySelectorAll('.preview-image-btn');

            previewableImages.forEach(image => {
                image.addEventListener('click', function() {
                    previewImage.src = this.src;
                    previewContainer.style.display = 'flex';
                });
            });

            previewImageBtns.forEach(btn => {
                btn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const imageSrc = this.parentElement.previousElementSibling.src;
                    previewImage.src = imageSrc;
                    previewContainer.style.display = 'flex';
                });
            });

            closePreview.addEventListener('click', function() {
                previewContainer.style.display = 'none';
            });
        });
    </script>
</body>
</html>
