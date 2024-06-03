<?php
session_start();
$phone=$_SESSION['mob_mail'];
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
                <?php
                $mob_mail=$_SESSION['mob_mail'];
                  $qry1="SELECT * FROM register WHERE phone='$mob_mail' OR email='$mob_mail'";
                  $res1=$conn->query($qry1);
                  $row1=$res1->fetch_assoc();
                  
                ?>
                
                <form action="" method="post">
                  <div style="position: relative;">
                      <img src='images/<?php echo $row1['image'] ?>' alt='' class='card_img'>
                      <i class="bi bi-patch-plus-fill text-primary" style="position: absolute; right: 23%; bottom: 70%; font-size: 40px;"></i>
                      <input type="file" id="fileInput" style="position: absolute; top: 0; left: 0; opacity: 0; width: 100%; height: 100%;" name="img">
                  </div>
                  <div class="card_body">
                      <h2><b>Name:</b></h2>
                      <input type="text" value="<?php echo $row1['name'] ?>" name="name"><br>
                      <h2><b>Bio:</b></h2>
                      <textarea name="bio"><?php echo $row1['bio'] ?></textarea><br>
                      <h2><b>DoB:</b></h2>
                      <input type="date" value="<?php echo $row1['dob'] ?>" name="dob"><br>
                      <h2><b>Gender:</b></h2>
                      <input type="text" value="<?php echo $row1['gender'] ?>" name="gender"><br><br>
                      <input type="submit" value="Update" name="update">
                  </div>
              </form>
              </div>   
              </div>
        </div>
    </div>

<script src="../Assets/bootstrap.bundle.min.js"></script>
<script src="../js_file/try2.js"></script>

</body>
</html>
<?php
  if(isset($_POST['update'])){
    $name=$_POST['name'];
    $bio=$_POST['bio'];
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    $img=$_POST['img'];

    $folder='images/'.$img;

    $qry="UPDATE register SET name='$name',bio='$bio',dob='$dob',gender='$gender' WHERE phone='$phone'";
    if($conn->query($qry)){
      if(move_uploaded_file($tempname,$folder)){
      echo "<script>alert('Successfully updated!')</script>";
      header('location:home_page.php');
    }
  }
}
?>