<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="
        https://cdn.jsdelivr.net/npm/autotyping@1.2.6/dist/AutoTyping.min.js
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
   
    <link rel="stylesheet" href="style.css" />
    <style>
      label{
        color: red ;
      }
    </style>
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
 
    <div class="container">
     
      <div class="forms-container">
        <div class="signin-signup">

          <!-- SIGN IN FORM -->
            <form action="" class="sign-in-form" method=post>
              <h2 class="title">Sign in</h2>
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" id="signinuser" placeholder="Username" id="signin-username" name="mob_mail"/>
              </div>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" id="signin-password" name="pass" />
              </div>
              <input type="submit" value="Login" class="btn solid" id="signin" name="signin"/>
            </form>

        <!-- SIGN UP FORM -->
          <form action="" method="post" class="sign-up-form" onsubmit="validator(event)">
            <h2 class="title">Sign up</h2>
              <div class="input-field">
                <i class="fas fa-user"></i>
              <input type="text" id="username" placeholder="Name" name="username"/>
                <label id="nameError" class="error"></label>
              </div>
              <div class="input-field">
                <i class="fas fa-phone"></i>
                <input type="tel" placeholder="Phone Number" id="phone" name="phone" />
                <label id="phnError" class="error"></label>
              </div>
              <div class="input-field"> 
                <i class="fas fa-envelope"></i>
                <input type="email" placeholder="Email" id="email" name="email"/>
                <label id="emailError" class="error"></label>
              </div>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" id="password" name="password" />
                <label id="passError" class="error"></label>
              </div>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Confirm Password" id="conpassword" />
                <label id="conpassError" class="error"></label>
              </div>
              <input type="submit" class="btn" id="signup" value="Sign up" name="submit" />
          </form>

        </div>
      </div>

      <!-- CONTROL PANEL -->
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
                Create an account and join our vibrant community.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="image/Login-1.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Welcome back! Sign in to continue your journey.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="image/Registration.svg" class="image" alt="#photo" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>

<?php
  if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    require_once("connection.php");
    $qry=mysqli_query($conn,"INSERT INTO register (name,phone,email,password) VALUES ('$username','$phone','$email','$password')");
    $cr=$phone."cr";
    $cs=$phone."cs";
    $r=$phone."r";
    $s=$phone."s";
    $f=$phone."f";
    $vote=$phone."vote";
    $qry8=mysqli_query($conn,"INSERT INTO info values(0,$phone,'$username')");
    $qry7=mysqli_query($conn,"CREATE TABLE `$phone` (`img_vdo` varchar(255) NOT NULL,`category` varchar(100) NOT NULL,`caption` varchar(255) NOT NULL,`flag` int(11) DEFAULT NULL,`sl` int(11) NOT NULL,`collaborate` int(11) DEFAULT NULL) ");
    $qry1=mysqli_query($conn,"CREATE TABLE `$cr` (`sl_no` int(11) NOT NULL,`cr_mob` bigint(20) NOT NULL,`cr_status` int(11) NOT NULL,`image` varchar(255) DEFAULT NULL,`details` varchar(255) DEFAULT NULL,`post_id` int(11) NOT NULL)");
    $qry2=mysqli_query($conn,"CREATE TABLE `$cs` (`sl_no` int(11) NOT NULL,`cs_mob` bigint(20) NOT NULL,`cs_status` int(11) NOT NULL,`image` varchar(255) DEFAULT NULL,`details` varchar(255) DEFAULT NULL,`post_id` int(11) NOT NULL) ");
    $qry3=mysqli_query($conn,"CREATE TABLE `$f` (`id` int(11) NOT NULL,`frnd_mob` bigint(20) NOT NULL)");
    $qry4=mysqli_query($conn,"CREATE TABLE `$r` (`id` int(11) NOT NULL,`req_mob` bigint(20) NOT NULL,`req_status` int(11) NOT NULL)");
    $qry5=mysqli_query($conn,"CREATE TABLE `$s` (`id` int(11) NOT NULL,`sent_mob` bigint(20) NOT NULL,`sent_status` int(11) NOT NULL) ");
    $qry6=mysqli_query($conn,"CREATE TABLE `$vote` (`post_id` int(11) NOT NULL,`vote` int(11) NOT NULL DEFAULT 0,`voted_to` int(10) NOT NULL DEFAULT 0) ");

    if($qry && $qry1 && $qry2 && $qry3 && $qry4 && $qry5 && $qry6 && $qry7 && $qry8){
      echo "<script>alert('Sign up successfully!')</script>";
    }
  }
?>
<?php
  if(isset($_POST['signin'])){
  
    $mob_mail=$_POST['mob_mail'];
    $pass=$_POST['pass'];
    require_once("connection.php");

    $res=mysqli_query($conn,"SELECT password,name FROM register WHERE phone='$mob_mail' OR email='$mob_mail'");
    $row=mysqli_fetch_assoc($res);
    
    $ori_pass=$row['password'];
    $ori_name=$row['name'];
    // echo $ori_pass;
    if($ori_pass === $pass){
    
    
     $_SESSION['flag']=1;
     $_SESSION['name']=$row['name'];
     $_SESSION['mob_mail']=$mob_mail;
      // echo "<script>alert('Successfully Log in!')</script>";
     header('location:home_page.php');
    } else {
      echo "<script>alert('Invalid Credentials!')</script>";
    }
}

?>