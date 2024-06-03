<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['mob_mail'])) {
    header("Location: log-reg.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];
    $username = $_SESSION['mob_mail'];

    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO event_support (event_id, username, photo) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $event_id, $username, $target_file);
            $stmt->execute();
            header("Location: view_event.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    $event_id = $_GET['event_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Event</title>
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <style>
        .image-preview {
            max-width: 100%;
            max-height: 300px;
            margin-top: 20px;
        }
    </style>
</head>
<body style="background-image: url(./images/wallp.jpg);">
    <?php include_once 'nav.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Support Event</h2>
        <form action="support_event.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="photo" class="form-label">Upload Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" required onchange="previewImage(event)">
            </div>
            <img id="imagePreview" class="image-preview" src="#" alt="Image Preview" style="display: none;">
            <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event_id); ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script src="../Assets/bootstrap.bundle.min.js"></script>
</body>
</html>
