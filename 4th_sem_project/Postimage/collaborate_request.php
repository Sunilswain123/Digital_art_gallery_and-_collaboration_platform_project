<?php
session_start();
require 'connection.php';

// Fetch user session information
$mob = $_SESSION['mob_mail'];
$conmob = $mob . "cr";
$x = mysqli_query($conn, "SELECT * FROM $conmob");
$res = mysqli_fetch_assoc($x);
$serial = $res['post_id'];
$details = $res['details'];
$image = $res['image'];
$cr_mob = $res['cr_mob'];
$sl = $res['sl_no'];

$qry = mysqli_query($conn, "SELECT * FROM `$mob` WHERE sl=$serial");
if ($qry) {
    $row = mysqli_fetch_assoc($qry);
}
$img1 = $row['img_vdo'];
$your_caption = $row['caption'];
$cat=$row['category'];

if (isset($_POST['accept'])) {
    $your_img = "images/" . $img1;
    $xmob = $mob . "cr";
    $ymob = $cr_mob . "cs";
    $img2= "images/".$image;
    $qry1 = mysqli_query($conn, "INSERT INTO collaborations VALUES ('$serial', '$cr_mob', '$mob', '$your_img', '$image', '$your_caption', '$details')");
    $qry3= mysqli_query($conn, "DELETE FROM $xmob WHERE sl_no=$sl");
    $qry4= mysqli_query($conn, "UPDATE $ymob SET cs_status=0 WHERE cs_mob=$mob");
    $qry5 = mysqli_query($conn,"UPDATE `$mob` SET collaborate=1 WHERE sl=$serial");
    $qry6 = mysqli_query($conn,"INSERT INTO `$cr_mob` VALUES ('$img2','$cat','$details',0,0,1)");
    
    if ($qry1 && $qry3 && $qry4 && $qry5 && $qry6) {
        header('Location: home_page.php');
        exit;
    } else {
        echo "<script>alert('Error inserting into collaborations table.')</script>";
    }
}

if (isset($_POST['reject'])) {
    $xmob = $mob . "cr";
    $ymob = $cr_mob . "cs";
    $qry2 = mysqli_query($conn, "DELETE FROM $xmob WHERE sl_no=$sl");
    $qry7 = mysqli_query($conn, "DELETE FROM $ymob WHERE sl_no=$sl");
    if ($qry2 && $qry7) {
        header('Location: home_page.php');
        exit;
    } else {
        echo "<script>alert('Error deleting collaboration request.')</script>";
    }
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
                    <div class="row">
                        <!-- First image section -->
                        <div class="col-md-6">
                            <h3>Your Post</h3>
                            <img src="images/<?php echo $img1; ?>" alt="Post Image" class="img-fluid" style="height:200px; width:100%;">
                            <h6><?php echo htmlspecialchars($your_caption); ?></h6>
                        </div>
                        <!-- Second image section -->
                        <div class="col-md-6">
                            <h3>Collaborative Post</h3>
                            <img src="<?php echo htmlspecialchars($image); ?>" alt="Post Image" class="img-fluid second-image" id="secondImage" style="height:200px; width:100%; cursor: pointer;">
                            <h6><?php echo htmlspecialchars($details); ?></h6>
                        </div>
                    </div>
                </div>
                <div class="collaborate-form">
                    <h4>Collaborate on this Post</h4>
                    <form method="post" action="">
                        <input type="submit" class="btn btn-outline-primary" name="accept" value="Accept Collaboration">
                        <input type="submit" class="btn btn-outline-danger" name="reject" value="Reject Collaboration"> 
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../Assets/bootstrap.bundle.min.js"></script>
</body>
</html>
