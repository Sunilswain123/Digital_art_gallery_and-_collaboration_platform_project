
<?php
// session_start();
?>
<script src="https://cdn.jsdelivr.net/npm/autotyping@1.2.6/dist/AutoTyping.min.js"></script>
    <!-- Navbar -->
<nav class=" navbar navbar-expand-lg" style="background-color: transparent;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home_page.php"><i class="bi bi-house-heart-fill" style="font-size: 20px;"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="chat.php"><i class="bi bi-chat-heart-fill" style="font-size: 20px;"></i></a>
        </li>
      </ul>
      <marquee behavior="alternate" direction="right" style="color:red; font-weight:bold; ">~~~DIGITAL ART GALLERY~~~</marquee>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="upload.php"><i class="bi bi-camera-fill" style="font-size: 20px;"></i></a>
                </li>
              <li class="nav-item">
                <?php 
                error_reporting(E_ALL & ~E_WARNING);
                $mob_mail=$_SESSION['mob_mail'];
                // error_reporting(E_ALL & ~E_WARNING); 
                if($mob_mail == null){ 
                  ?>
                <a class="nav-link" href="#"><i class="bi bi-people-fill" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size:20px"></i></a>
                <?php } else { 
                  $_SESSION['mob_mail']=$mob_mail;
                  ?>
                  <a class="nav-link" href="friends.php"><i class="bi bi-people-fill" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size:20px"></i></a>
                <?php } ?>
              </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" aria-controls="offcanvasWithBothOptions" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"><i class="bi bi-person-fill-gear" style="font-size: 20px;"></i></a>
                </li>
                <li clas="nav-item">
                <i id="theme-toggle" class="bx bxs-moon theme_toggle"></i>
                </li>
            </ul>
      </div>
   </nav>
  </div>
</nav>
    </div>
  </div>
</nav>

<!-- offcanvas -->

<div class="offcanvas offcanvas-end" data-bs-scroll="true" id="offcanvasWithBothOptions" >
  <div class="offcanvas-header">
     <div class="sub-menu-wrap" id="subMenu">
       <div class="sub-menu">
          <div class="user-info">
            <img src="../image_file/avatar.png" alt="">
            <!-- <h5>Sunil kumar swain</h5> -->
            <?php
             error_reporting(E_ALL & ~E_WARNING);
            if($_SESSION['mob_mail'] == null){
              ?>
              <a href="log-reg.php"><h5>Log in/Sign up</h5></a>
              <?php
            } else {
              ?>
              <h5> <?php echo $_SESSION['name']; ?> </h5>
              <?php
            }
            ?>
            
          </div>
          <hr>
          <?php
          if($_SESSION['name']!==null){
            ?>
           <a href="./view_profile.php" class="sub-menu-link">
          <img src="../image_file/avatar.png" alt="" style="width: 30px;">
          <p>View Profile</p>
          <span>></span>
          </a>
          <?php
          }
          ?>
          <a href="privacy.php" class="sub-menu-link">
          <img src="../image_file/avatar.png" alt="" style="width: 30px;">
          <p>Privacy</p>
          <span>></span>
          </a>
          <a href="./about.php" class="sub-menu-link">
          <img src="../image_file/avatar.png" alt="" style="width: 30px;">
          <p>About</p>
          <span>></span>
          </a>
          <a href="#" class="sub-menu-link">
          <img src="../image_file/avatar.png" alt="" style="width: 30px;">
          <p>Help & Support</p>
          <span>></span>
          </a>
          <?php
          if($_SESSION['name']!==null){
            ?>
          <a href="logout.php" class="sub-menu-link" onclick="return confirm('Are you Sure to LogOut?');">
          <img src="../image_file/avatar.png" alt="" style="width: 30px;">
          <p>Log Out</p>
          <span>></span>
          </a>
          <?php
          }
          ?>
        </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
</div>
<script src="../js_file/try2.js"></script>
<script src="../Assets/bootstrap.bundle.min.js"></script>




