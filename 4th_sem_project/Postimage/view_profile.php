<?php
session_start();
include('connection.php');
// if(isset($_POST['submit'])){
//   $file_name=$_FILES['image']['name'];
//   $tempname=$_FILES['image']['tmp_name'];
//   $name=$_POST['name'];
//   $folder='images/'.$file_name;
//   if($folder===" ")
//   echo "<script>alert(' choose a file')</script>";

//   // $query=mysqli_query($conn,"insert into images values ('$folder','$name')");
//   $sql = "INSERT INTO profile VALUES('','$file_name', '$name')";
//   if($conn->query($sql)){
//     echo "Added";
//   }else{
//     echo "Error";
//   }

//   if(move_uploaded_file($tempname,$folder)){
//     echo "<script>alert(' file uploaded successfully')</script>";
//     header('location:home_page.php');
//   }
//     else{
//       echo "<h2> file not  uploaded</h2>";

//     }
//   }
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <link rel="stylesheet" href="../css_file/Edit_profile.css">

</head>
<body>
  <?php
  require_once "nav.php";
  ?>
    <div class="container">     
        <div class="card">
            <!-- <i id="theme-toggle" class="bx bxs-moon theme_toggle"></i> -->
            <a href="Edit_profile.php">Edit</a>
            
                <?php
                $mob_mail=$_SESSION['mob_mail'];
                  $qry1="SELECT * FROM register WHERE phone='$mob_mail' OR email='$mob_mail'";
                  $res1=$conn->query($qry1);
                  $row1=$res1->fetch_assoc();
                  
                ?>
                 <img src="images/<?php echo $row1['image'] ?>" alt="" class="card_img">
                 <div class="card_body">
                <h2 class="card_name"><?php echo $row1['name'] ?></h2>
                <span class="card_occupation"><?php echo $row1['skill'] ?></span><br>
                <br>
                <h2><b>Bio:</b></h2>
                <h4><?php echo $row1['bio'] ?></h4>
                <br>
                <h2><b>DoB:</b></h2>
                <h4><?php echo $row1['dob'] ?></h4>
                <br>
                <h2><b>Gender:</b></h2>
                <h4><?php echo $row1['gender'] ?></h4>

                
                    <!-- <form action="" method="post" enctype="multipart/form-data">
                        <a href="#" class="card_button">Edit Profile</a> -->
                        <!-- <input type="file" name="image" id="image" value="Choose your image"><br><br>
                        <label for="" class=" text-primary m16">Enter Your Bio here</label>
                        <textarea name="name" id="name" cols="30" rows="2" placeholder="Write something about you"></textarea>
                        <button type="submit" name="submit" class="card_button">Edit</button>
                    </form> -->

              </div>
                  
                </div>

        </div>
    </div>




<script src="../Assets/bootstrap.bundle.min.js"></script>
<script src="../js_file/try2.js"></script>

</body>
</html>