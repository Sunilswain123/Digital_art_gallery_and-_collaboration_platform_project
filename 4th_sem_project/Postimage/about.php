<?php
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
        .about-section {
            padding: 50px;
            background: #f2f2f2;
        }
        .about-section h2 {
            text-align: center;
            margin-bottom: 40px;
        }
        .team {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .team-member {
            margin: 20px;
            text-align: center;
        }
        .team-member img {
            width: 150px;
            border-radius: 50%;
        }
        .team-member h5 {
            margin-top: 15px;
        }
        .team-member p {
            font-style: italic;
            color: gray;
        }
    </style>
</head>
<body style="  background-image: url(./images/wallp.jpg);">
    <!-- Navbar -->
    <?php include 'nav.php'; ?>

    <!-- About Section -->
    <div class="about-section" style="  background-image: url(./images/wallp.jpg);">
        <h2>About Us</h2>
        <p class="text-center" style="color:blue;">Welcome to our Digital Art Gallery. We are dedicated to showcasing the best digital art from around the world.</p>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Our Mission</h3>
                    <p style="color:blue;">To provide a platform for digital artists to share their work and connect with art enthusiasts. We believe in the power of digital art to inspire and transform communities.</p>
                </div>
                <div class="col-md-6">
                    <h3>Our Vision</h3>
                    <p style="color:blue;">To be the leading digital art gallery, known for our commitment to artists and the art community. We aim to create a space where art is accessible to everyone, everywhere.</p>
                </div>
            </div>
            <h3 class="text-center mt-5">Meet Our Team</h3>
            <div class="team">
                <div class="team-member">
                <img src="./images/DSC_8401.jpg" alt="Team Member" style="height:150px;">
                    <h5 style="color:brown;">Bismaya Patra</h5>
                    <p style="color:grey;">Founder & CEO</p>
                </div>
                <div class="team-member">
                    <img src="./images/abhi.jpg" alt="Team Member" style="height:150px;">
                    <h5 style="color:brown;">Abhisek Kumar</h5>
                    <p style="color:grey;">Art Director</p>
                </div>
                <div class="team-member">
                    <img src="./images/sunil.png" alt="Team Member" style="height:150px;">
                    <h5 style="color:brown;">Sunil Kumar</h5>
                    <p style="color:grey;">Community Manager</p>
                </div>
            </div>
        </div>
        <h6><i class="bi bi-c-circle">Copyright 2024 by Digital Art Gallery</i></h6>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
