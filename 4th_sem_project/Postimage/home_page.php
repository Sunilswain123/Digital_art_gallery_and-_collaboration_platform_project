<?php 
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css_file/navbar1.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/autotyping@1.2.6/dist/AutoTyping.min.js"></script>
    <style>
        /* Style for the red heart */
        .btn.like-btn .fa-heart.red {
            color: red;
        }

        /* Keyframes for burst effect */
        @keyframes burst {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.5);
                opacity: 0.5;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Keyframes for image animation */
        @keyframes imageBurst {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.9;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Applying the burst animation */
        .btn.like-btn .burst {
            animation: burst 0.5s;
        }

        /* Applying the image burst animation */
        .post-image.burst {
            animation: imageBurst 0.5s;
        }

        /* Tooltip styles */
        .btn:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            background: transparent;
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
            top: -100%;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            z-index: 1;
        }
        .profile1 {
            background-color: lightblue;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px 0;
            
            align-items: center;
        }
        #profile{
            border:1px solid blue;
            border-radius:50%;
        }
        .image-container {
    position: relative;
}

.image-thumb {
    cursor: pointer;
    transition: 0.3s;
}

.image-thumb:hover {
    opacity: 0.7;
}

.modal {
    display: none;
    position: fixed;
    z-index: 10000; /* Ensure this is higher than any other element */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.9);
}

.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

.close {
    position: absolute;
    top: 20px;
    right: 35px;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

.download-btn {
    position: absolute;
    top: 20px;
    left: 35px;
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
}

.download-btn:hover {
    background-color: #45a049;
}
span{
    color:white;
    font-weight: bold;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}
#cat{
    color:pink;
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: normal;
}
#cap{
    color:White;
}
    </style>
</head>
<body style="  background-image: url(./images/wallp.jpg);">
   <?php include_once 'nav.php';?>

    <!-- left card -->
    <div class="row container-fluid my-3 overflow-auto">
        <div class="col-md-2" style="position:sticky; ">
            <div class="card" style=" background-color:cornsilk;">
                <div class="card-body">
                  <div class="profile-container">
                  <?php 
                    $ori_name = $_SESSION['name'];
                    $mob_mail = $_SESSION['mob_mail'];
                    $flag = $_SESSION['flag'];
                    // echo "Name: ".$ori_name;
                  ?>
                <?php
                if ($_SESSION['name'] == null) {
                    ?>
                    <img src="../image_file/avatar.png" alt="" height=150 width=150>
                    <a href="log-reg.php"><h6>Log In/Sign Up</h6></a>
                    <p style="text-align:justify;" class="about"></p>
                <?php
                } else {
                  require_once "connection.php";
                  $qry1 = "SELECT * FROM register WHERE phone='$mob_mail' OR email='$mob_mail'";
                  $res1 = $conn->query($qry1);
                  $row1 = $res1->fetch_assoc();
                  ?>
                 
                  <?php
                    if ($row1['image'] == NULL) {
                        ?>
                        <img src="../image_file/avatar1.png" alt="#######" height=150 width=150>
                        <?php
                    } else {
                        ?>
                        <img src="./images/<?php echo $row1['image'];?>" alt="uop" height=150 width=150 id="profile">
                        <?php
                    }
                    ?>
                    <h5 style="text-align:center;"><?php echo $row1['name'] ?></h5>
                    <h6 style="text-align:center;"><?php echo $row1['skill'] ?></h6>
                    <p style="text-align:center;"><?php echo $row1['bio'] ?></p>
                    <?php
                  }  
                  ?>
                  </div>
                </div>
                <?php
                if($mob_mail!==null){
                $mobf=$mob_mail."f";
                $qry10=mysqli_query($conn,"SELECT * FROM $mobf");
                $count2=mysqli_num_rows($qry10);
                ?>
                <div class="card-body border-top">
                    <h6 style="text-align:center; "><a href="" style="text-decoration:none; color:green;">Connections:<?php echo $count2; ?></a></h6>
                </div> 
                <?php
                } else {
                    ?>
                     <div class="card-body border-top">
                    <a href="" style="text-decoration:none; text-align:center;">No connections</a>
                </div> 
                    <?php
                }
                ?>
            </div>
            
            <!-- your post -->
            <div class="card mt-2" >
    <div class="card-body" style="max-height: 280px; overflow-y: auto;  background-color:cornsilk;">
    <h5 style="text-align:center;">Your Posts</h5>
        <?php
        if($mob_mail != null){
        $qry11 = mysqli_query($conn, "SELECT * FROM `$mob_mail`");
        if (mysqli_num_rows($qry11)>0) {
            while ($res4 = mysqli_fetch_assoc($qry11)) {
                $caption = $res4['caption'];
                $img_vdo = $res4['img_vdo'];
                ?>
                <div class="image-container mb-2">
                    <img src="./images/<?php echo $img_vdo; ?>" alt="pic" class="image-thumb" style="height:100px; width:150px;">
                    <h6><?php echo $caption; ?></h6>
                </div>
                <?php
            }
        } else {
            ?>
            <h6>No Posts</h6>
            <?php
        }
    } else {
        ?>
        <h6>No Posts</h6>
        <?php
    }
        ?>
    </div>
</div>




    </div>
    <script>
   document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("imagePreviewModal");
    var modalImg = document.getElementById("modalImage");
    var downloadLink = document.getElementById("downloadLink");
    var closeBtn = document.getElementsByClassName("close")[0];

    document.querySelectorAll('.image-thumb').forEach(function(image) {
        image.addEventListener('click', function () {
            modal.style.display = "block";
            modalImg.src = this.src;
            downloadLink.href = this.src;
        });
    });

    closeBtn.onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});

</script>

        <!-- middle card -->
        <div class="col-md-8 overflow-auto mid" style="max-height:692px; max-width:50% background-color:white;">
    <?php 
    $qry3 = mysqli_query($conn, "SELECT * FROM info");
    if ($qry3) {
        while ($row3 = mysqli_fetch_assoc($qry3)) {
            $tn = $row3['table_name'];
            $qry4 = "UPDATE `$tn` SET flag=0";
            if ($conn->query($qry4)) {}
        }
    }
    $i = 1;
    while ($i < 3) {
    $res1 = mysqli_query($conn, "SELECT * FROM info ORDER BY RAND() LIMIT 1");
    if ($res1) {
        $row1 = mysqli_fetch_assoc($res1);
        $table_name = $row1['table_name'];
        
        $res = mysqli_query($conn, "SELECT * FROM `$table_name` order by rand() limit 1");
        $x=mysqli_query($conn,"SELECT * FROM register WHERE phone=$table_name");
        if($x){
            $row2=mysqli_fetch_assoc($x);
            $img=$row2['image'];
        }
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
              
    ?>
            <div class="card mb-3" style="background-image: url(./images/body.jpg);">
                <div class="card-body" >
                <?php   if ($row['flag'] == 0 && $row['collaborate'] == 0)  { ?>
                    <div class="d-flex profile">
                        <?php if($img === NULL){
                            ?>
                            <div><img src="../image_file/avatar.png" alt="demos" class="rounded-circle" style="width:50px"></div>
                            <?php
                        } else {
                        ?>
                        <div><img src="./images/<?php echo $img; ?>" alt=""  style="width:50px ; height:50px; border-radius:50%;"></div>
                        <?php
                        }
                        ?>
                        <div>
                            <span><?php echo $row1['user_name'] ?></span><br>
                            <span id="cat"><?php echo $row['category'] ?></span>
                        </div>
                    </div>

                    <!--post image -->
                     <img class="img-fluid post-image" src="images/<?php echo $row['img_vdo'] ?>" alt="error" style=" margin-top:15px; height:500px; width:1000px;"> 

                    <h6 class="text-start" id="cap" style="margin-top:10px;"><?php echo $row['caption'] ?></h6>

                    <?php 
                } else if($row['flag'] == 0 && $row['collaborate'] == 1){
                    $qry6=mysqli_query($conn,"SELECT * FROM collaborations WHERE user=$table_name");
                    $y=mysqli_fetch_assoc($qry6);
                    $another_user=$y['table_name'];
                    $details=$y['col_caption'];
                    
                    $qry7=mysqli_query($conn,"SELECT * FROM register WHERE phone=$another_user");
                    $z=mysqli_fetch_assoc($qry7);
                    $dp=$z['image'];
                    ?>

                     <div class="d-flex profile">
                        <?php if($img === NULL && $dp === NULL){
                            ?>
                            <div>
                                <img src="../image_file/avatar.png" alt="demos" class="rounded-circle" style="width:50px">
                                <img src="../image_file/avatar.png" alt="demos" class="rounded-circle" style="width:50px">
                            </div>
                            <div>
                            <span><?php echo $row1['user_name']." and ".$z['name'];?></span><br>
                            <span id="cat"><?php echo $row['category'] ?></span>
                            </div>
                            <?php
                        } else if($img === NULL && $dp !== NULL){
                        ?>
                        <div>
                            <img src="../image_file/avatar.png" alt="demos" class="rounded-circle" style="width:50px">
                            <img src="./images/<?php echo $img; ?>" alt=""  style="width:50px ; height:50px; border-radius:50%;">
                            <div>
                            <span><?php echo $row1['user_name']." and ".$z['name'];?></span><br>
                            <span id="cat"><?php echo $row['category'] ?></span>
                            </div>
                        <?php
                        } else if ($img !== NULL && $dp===NULL){

                            ?>
                             <div>
                                <img src="./images/<?php echo $img; ?>" alt="" style="width:50px ; height:50px; border-radius:50%;">
                                <img src="../image_file/avatar.png" alt="demos" class="rounded-circle" style="width:50px">
                                
                            </div>
                            <div>
                            <span><?php echo $row1['user_name']." and ".$z['name'];?></span><br>
                            <span id="cat"><?php echo $row['category'] ?></span>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div>
                                <img src="./images/<?php echo $img; ?>" alt="" style="width:50px ; height:50px; border-radius:50%;">
                                <img src="./images/<?php echo $dp; ?>" alt="demos"  style="width:50px; height:50px; border-radius:50%; margin-left:-20px;">
                                
                            </div>
                            <div>
                            <span><?php echo $row1['user_name']." and ".$z['name'];?></span><br>
                            <span id="cat"><?php echo $row['category'] ?></span>
                            </div>
                            <br>
                           
                            <?php
                        }
                        ?>
                       
                    </div>

                    <!--post image -->
                     <!-- <img class="img-fluid post-image" src="images/<?php// echo $row['img_vdo'] ?>" alt="error" width="100%">  -->
                     <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" >
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="images/<?php echo $row['img_vdo'] ?>" class="d-block w-100" alt="1st image" style="margin-top:15px; height:500px; width:1000px;">
                                <h6 class="text-start" id="cap"><?php echo $row['caption'] ?></h6>
                                </div>
                                <div class="carousel-item">
                                <img src="<?php echo $y['col_post_img']; ?>" class="d-block w-100" alt="#pic" style="margin-top:15px; height:500px; width:1000px;">
                                <h6 class="text-start" id="cap" style="margin-top:10px;"><?php echo $details; ?></h6>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="color:black;"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            </div>

                   
                    

                    <?php
                }
                ?>
                     <!-- Like, Comment, Share buttons -->
                     <div class="btn-group mt-3 d-flex justify-content-between" role="group" aria-label="Post Actions">
                        <a href="#" class="btn like-btn" data-tooltip="">
                            <i class="far fa-heart" style="color:cyan;"></i> <!-- Like Button for Like -->
                            <span class="like-count" style="font-weight:normal; font-family:system_ui;">100</span> <!-- Like count -->
                        </a>
                        <a href="#" class="btn comment-btn" data-tooltip="Comment">
                            <i class="far fa-comment" style="color:cyan;"></i> <!-- Comment button -->
                            <span class="comment-count" style="font-weight:normal; font-family:system_ui;">50</span> <!-- Comment count -->
                        </a>
                        <a href="#" class="btn share-btn" data-tooltip="Share">
                            <i class="far fa-paper-plane" style="color:cyan;"></i> <!-- Share button -->
                        </a>
                        <a href="collaborate.php?post_id=<?php echo $row['sl']; ?>&tn=<?php echo $table_name; ?>" class="btn collaborate-btn" data-tooltip="Collaborate">
                        <b><i class="bi bi-people-fill" style="color:cyan;"></i></b> <!-- Collaborate button -->
                        </a>
                        <a href="event.php?post_id=<?php echo $row['sl']; ?>&user_id=<?php echo $table_name; ?>" class="btn share-btn" data-tooltip="Challenge">
                        <i class="bi bi-tools" style="color:cyan;"></i> <!-- Share button -->
                        </a>
                    </div>
                </div>
            </div>
            <!-- Include Font Awesome library -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const midContainer = document.querySelector('.mid');
                    midContainer.addEventListener('click', function(event) {
                        if (event.target.closest('.like-btn')) {
                            event.preventDefault();
                            const likeBtn = event.target.closest('.like-btn');
                            const likeIcon = likeBtn.querySelector('.fa-heart');
                            const likeCount = likeBtn.querySelector('.like-count');
                            const postImage = likeBtn.closest('.card').querySelector('.post-image');
                            // Check if the icon is red (liked)
                            const isLiked = likeIcon.classList.contains('red');
                            // Toggle the red class
                            likeIcon.classList.toggle('red');
                            // Add burst effect
                            likeIcon.classList.add('burst');
                            postImage.classList.add('burst');
                            setTimeout(() => {
                                likeIcon.classList.remove('burst');
                                postImage.classList.remove('burst');
                            }, 500); // Remove burst class after animation
                            // Update like count
                            let count = parseInt(likeCount.textContent, 10);
                            likeCount.textContent = isLiked ? count - 1 : count + 1;
                            // Toggle between solid and outlined heart
                            if (isLiked) {
                                likeIcon.classList.remove('fas');
                                likeIcon.classList.add('far');
                            } else {
                                likeIcon.classList.remove('far');
                                likeIcon.classList.add('fas');
                            }
                        }
                    });
                });

                
            </script>
    <?php
            $sl = $row['sl'];
            $qry2 = "UPDATE `$table_name` SET flag=1 WHERE sl=$sl";
            if ($conn->query($qry2)) {}
            }
        }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        $i = $i + 1;
    } 
    

    ?>
</div>

    <!-- right card -->
        <div class="col-md-2">
            <div class="card" style="  background-color:bisque;">
                <div class="card-body">
                    <div class="container">
                        <h3 style="margin-left:-2px;">Collaborative Platform</h3>
                        <div class="profile1">
                    <h5 style="margin-left:-2px;">Collaborations:</h5>
                    <?php
                        if($mob_mail!=null){
                        $crmob=$mob_mail."cr";
                        $crmob1=$mob_mail."cs";
                        // error_reporting(E_ALL & ~E_ERROR);
                        $qry5=mysqli_query($conn,"SELECT * FROM $crmob");
                        $qry8=mysqli_query($conn,"SELECT * FROM $crmob1 WHERE cs_status=0");
                        $count=mysqli_num_rows($qry5);
                        $count1=mysqli_num_rows($qry8);
                       

                    ?>
                    <a href="collaborate_request.php" class="btn"><h6><i class="bi bi-bell-fill"> Requests</i><span style="color:red;"> <?php echo $count; ?></span></h6></a>
                    
                    <a href="" class="btn btn-transparent" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <h6><i class="bi bi-clipboard2-check-fill" > Approved</i><span style="color:red;"> <?php echo $count1; ?></span></h6>
                        </a>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Approved Collaborations</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <?php
                            while($res2=mysqli_fetch_assoc($qry8)){
                                $mob=$res2['cs_mob'];
                                $image=$res2['image'];
                                $qry9=mysqli_query($conn,"SELECT * FROM register WHERE phone=$mob");
                                if($qry9){
                                    $res3=mysqli_fetch_assoc($qry9);
                                    $name=$res3['name'];
                                }
                                ?>
                                 <div class="modal-body" style="background-color:lightblue;">
                                    <h4 style="color:green;"><?php echo $name." has accepted your collaboration." ?></h4>
                                    <img src="<?php echo $image; ?>" alt="colab" style="height:100px; width:300px;">
                                </div>
                            
                                <?php
                            }
                        ?>
                       <div class="modal-footer">
                            
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Ok</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <?php
                        } else {
                            ?>
                            <a href="#" class="btn"><h6><i class="bi bi-bell-fill"> Requests</i></h6></a>
                            <a href="#" class="btn"><h6><i class="bi bi-clipboard2-check-fill"> Approved</i></h6></a>
                            <?php
                        }
                        ?>
                   
                    </div>

                    <div class="profile1">
                    <h4>Events:</h4>
                    <a href="set_event.php" class="btn"><h6><i class="bi bi-clock-fill"> Set Event</i></h6></a>
                    <a href="view_event.php" class="btn" ><h6><i class="bi bi-calendar2-check-fill"> View Events</i></h6></a>
                    <a href="my_event.php" class="btn"><h6><i class="bi bi-calendar2-week-fill"> My Events</i></h6></a>
                    </div>

                    <div class="profile1">
                    <h4>Challenges:</h4>
                    <a href="my_challenge.php" class="btn" style="margin-left:-10px;"><h6><i class="bi bi-hammer"> My Challenge</i></h6></a>
                    <a href="view_challenge.php" class="btn" style="margin-left:-22px;"><h6><i class="bi bi-eye-fill"> View Challenge</i></h6></a>
                    </div>
                    </div>
                    
                </div>
              
            </div>
           
        </div>

  
    
    <script src="../Assets/bootstrap.bundle.min.js"></script>
    <script src="../js_file/animate.js"></script>
    <?php
    // include_once "footer.php";
    ?>
    <!-- Image Preview Modal -->
<div id="imagePreviewModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
    <a id="downloadLink" download>
        <button class="download-btn">Download</button>
    </a>
</div>
</body>
</html>
