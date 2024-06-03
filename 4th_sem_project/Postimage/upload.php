<?php
session_start();
if (!isset($_SESSION['mob_mail'])) {
  header("Location: log-reg.php");
  exit();
}
$mob=$_SESSION['mob_mail'];
include('connection.php');
if(isset($_POST['submit'])){
  $file_name=$_FILES['image']['name'];
  $art=$_POST['art'];
  $tempname=$_FILES['image']['tmp_name'];
  $name=$_POST['name'];
  $folder='images/'.$file_name;
  if($folder===" ")
  echo "<script>alert(' choose a file')</script>";
  $qry=mysqli_query($conn,"SELECT * FROM `$mob` ORDER BY sl DESC LIMIT 1 ");
  if($qry){
    $res=mysqli_fetch_assoc($qry);
    $sl=$res['sl'];
  }
  
  $sl=$sl+1;
  $sql = "INSERT INTO `$mob` (img_vdo, category, caption,flag,sl,collaborate) VALUES ('$file_name', '$art', '$name',0,$sl,0)";

  if($conn->query($sql)){
    echo "Added";
  }else{
    echo "Error";
  }

  if(move_uploaded_file($tempname,$folder)){
    echo "<script>alert(' file uploaded successfully')</script>";
    header('location:home_page.php');
  }
    else{
      echo "<h2> file not  uploaded</h2>";

    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image upload</title>
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css_file/navbar1.css">
    <link rel="stylesheet" href="../css_file/upload1.css">
</head>
<body>
    <div class="container-fluid my-3 ">
      <?php
        include_once "nav.php"
      ?>
        <div class="row ">
            <div class="col-md-6 card mx-auto upload box" >
              <div id="carouselExampleDark" class="carousel slide" data-bs-theme="dark">
                 <div class="carousel-indicators">
                   </div>
                      <div class="carousel-inner">
                         <div class="carousel-item active" data-bs-interval="10000">
                             <img src="../image_file/image6.jpeg" class="d-block" alt="..." id="img-preview" style="max-height:300px; margin-left:30%;">
                               <div class="carousel-caption d-none d-md-block">
                                 <h5 class="m115">Preview Image</h5>
                               </div>
                           </div>
                   </div>
              </div>
              <div class="">
                    <form action="" method="post" enctype="multipart/form-data">
                         <div class="row">
                            <div class="custom-file-upload col-md-6">
                                <input id="image-upload" type="file" name="image" accept="image/*">
                                <label for="image-upload">
                                    <img src="../image_file/image_icon.png" alt="Image Icon">Choose Image
                              </label>
                            </div>
                            <div class="custom-file-upload col-md-6 ">
                                <input id="video-upload" type="file" name="video" accept="video/*">
                                <label for="video-upload" class="">
                                <img src="../image_file/video_icon.png" alt="Video Icon" style="width: 32px; height: 32px;" class="text-right">Choose Video
                                </label>
                            </div>
                         </div><br>
                         <label for="" class=" text-primary m16">Do you want to talk about this Picture...</label>
                             <textarea name="name" id="name" cols="50" rows="2" placeholder="Enter your caption" style="width:100%; right:150%"></textarea><br>
                             <label for="">Choose one art: </label>
                             <select name="art" id="">
                              <option value="">-Select-</option>
                              <option value="paint">Painting</option>
                              <option value="sketch">Sketch</option>
                              <option value="sand">Sand Art</option>
                              <option value="pattachitra">Pattachitra</option>
                              <option value="crafts">Crafts</option>
                             </select><br>
                          <button type="submit" class="btn btn-outline-warning" name="submit" style="margin-left:47%; margin-bottom:5px;">Upload</button>
                    </form> 
              </div>
            </div>
         </div>   
       </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="../js_file/animate.js"></script>
<script src="../Assets/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('image-upload').addEventListener('change', function(event){
    const file = event.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            document.getElementById('img-preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>
</body>
</html>
