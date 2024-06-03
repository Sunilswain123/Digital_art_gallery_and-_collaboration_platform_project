<?php
session_start();
require_once "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <title>Document</title>
    <style>
        #request {
            background-color: aquamarine;
            border: 1px;
            display: flex;
            width: 50%;
        }
        #heading {
            background-color: pink;
            display: flex;
            border: 1px;
        }
        #sent {
            background-color: red;
            border: 1px;
            display: flex;
            width: 50%;
        }
        #con:hover {
            background-color: green;
            color: white;
        }
        #add:hover {
            background-color: blue;
            color: white;
        }
        #rej:hover {
            background-color: red;
            color: white;
        }
        .profile {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px 0;
            display: flex;
            align-items: center;
        }
        .profile img {
            padding: 3px;
        }
        .profile div {
            margin-left: 15px;
        }
        .profile span {
            display: block;
            font-size: 16px;
            color: #333;
        }
        .profile .ml-auto button {
            margin: 0 5px;
        }
        .profile button {
            padding: 5px 10px;
            border: 1px solid;
            border-radius: 5px;
            cursor: pointer;
            background-color: transparent;
        }
        #maindiv{
          background-image: url(./images/bg1.jpg);
          
        }
    </style>
</head>
<body id="maindiv">
  <?php 
  require_once "nav.php";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['con'])) {
          $req_mob = $_POST['req_mob'];
          $mob = $_SESSION['mob_mail'];
          $conmob = $mob . "r";

          $rm = $req_mob . "s";
          $table1 = $mob . "f";
          $table2 = $req_mob . "f";
          $qry2 = mysqli_query($conn, "INSERT INTO $table2 VALUES (0, '$mob')");
          $qry3 = mysqli_query($conn, "INSERT INTO $table1 VALUES (0, '$req_mob')");
          $qry7 = mysqli_query($conn, "DELETE FROM $rm WHERE sent_mob='$mob'");
          
          // Update database to confirm friend request
          $update_qry = mysqli_query($conn, "DELETE FROM $conmob WHERE req_mob='$req_mob'");
          if ($update_qry) {
              echo "<div class='alert alert-success'>Friend request confirmed!</div>";
          } else {
              echo "<div class='alert alert-danger'>Error confirming friend request.</div>";
          }
      } elseif (isset($_POST['rej'])) {
          $req_mob = $_POST['req_mob'];
          $mob = $_SESSION['mob_mail'];
          $conmob = $mob . "r";
          $rm = $req_mob . "s";

          // Update database to reject friend request
          $update_qry = mysqli_query($conn, "DELETE FROM $conmob WHERE req_mob='$req_mob'");
          $qry7 = mysqli_query($conn, "DELETE FROM $rm WHERE sent_mob='$mob'");
          if ($update_qry) {
              echo "<div class='alert alert-danger'>Friend request rejected!</div>";
          } else {
              echo "<div class='alert alert-danger'>Error rejecting friend request.</div>";
          }
      } elseif (isset($_POST['add'])) {
          $req_mob = $_POST['req_mob'];
          $mob = $_SESSION['mob_mail'];
          $tn = $_POST['tn'];
          $conmob2 = $mob . "s";
          $conmob3 = $tn . "r";
          $qry5 = mysqli_query($conn, "INSERT INTO $conmob2 VALUES (0, '$tn', 1)");
          $qry6 = mysqli_query($conn, "INSERT INTO $conmob3 VALUES (0, '$mob', 1)");
          if ($qry5 && $qry6) {
              echo "<div class='alert alert-success'>Sent Friend Request!</div>";
          } else {
              echo "<div class='alert alert-danger'>Error sending friend request.</div>";
          }
      }
  }
  ?>
<div class="container">
  <div class="row">
    <div class="col-sm-6 mb-3 mb-sm-0">
      <div class="card" style="margin-top: 5px;">
        <div class="card-body" style="background-color:paleturquoise">
          <h5 class="card-title">Friend Requests</h5>
          <?php
          $mob = $_SESSION['mob_mail'];
          $conmob = $mob . "r";
          $qry = mysqli_query($conn, "SELECT * FROM $conmob WHERE req_status=1");

          if (mysqli_num_rows($qry) > 0) {
              while ($row = mysqli_fetch_assoc($qry)) {
                  $req_mob = $row['req_mob'];
                  $qry1 = mysqli_query($conn, "SELECT * FROM register WHERE phone='$req_mob'");
                  if ($qry1) {
                      while ($row1 = mysqli_fetch_assoc($qry1)) {
                          $name = $row1['name'];
                          $cat = $row1['skill'];
                          $img = $row1['image'];
                          ?>
                          <div class="container">
                            <div class="profile">
                              <div>
                                <img src="./images/<?php echo $img; ?>" alt="pic" class="rounded-circle" style="width:100px; height:100px">
                              </div>
                              <div>
                                <span class="fw-semibold fs-5"><?php echo $name; ?></span>
                                <span class="fw-light fs-6"><?php echo $cat; ?></span>
                              </div>
                              <div class="ml-auto">
                                <form method="POST" action="">
                                  <input type="hidden" name="req_mob" value="<?php echo $req_mob; ?>">
                                  <button type="submit" id="con" name="con"> <i class="bi bi-check-square"> Confirm</i></button>
                                  <button type="submit" id="rej" name="rej"><i class="bi bi-x-square"> Reject</i></button>
                                </form>
                              </div>
                            </div>
                          </div>
                          <?php
                      }
                  }
              }
          } else {
              echo "<p>No request found.</p>";
          }
          ?> 
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card" style="margin-top: 5px;">
        <div class="card-body" style="background-color:lightpink">
          <h5 class="card-title">Add Friends</h5>
          <?php
          $conmob1 = $mob . "f";
          $conmob4 = $mob. "s";
          
          $qry4 = mysqli_query($conn, "SELECT * FROM info WHERE table_name NOT IN (SELECT frnd_mob FROM $conmob1) AND table_name NOT IN (SELECT req_mob FROM $conmob) AND table_name != '$mob' AND table_name NOT IN(SELECT sent_mob FROM $conmob4) ORDER BY rand() LIMIT 5");

          if (mysqli_num_rows($qry4) <= 0) {
              $qry4 = mysqli_query($conn, "SELECT * FROM info WHERE table_name != '$mob' ORDER BY rand() LIMIT 5");
          }
          while ($row4 = mysqli_fetch_assoc($qry4)) {
              $tn = $row4['table_name'];
              $qry1 = mysqli_query($conn, "SELECT * FROM register WHERE phone='$tn'");
              if ($qry1) {
                  while ($row1 = mysqli_fetch_assoc($qry1)) {
                      $name = $row1['name'];
                      $cat = $row1['skill'];
                      $img = $row1['image'];
                      ?>
                      <div class="container">
                        <div class="profile">
                          <div>
                            <img src="./images/<?php echo $img; ?>" alt="pic" class="rounded-circle" style="width:100px; height:100px">
                          </div>
                          <div>
                            <span class="fw-semibold fs-5"><?php echo $name; ?></span>
                            <span class="fw-light fs-6"><?php echo $cat; ?></span>
                          </div>
                          <div class="ml-auto">
                            <form method="POST" action="">
                              <input type="hidden" name="req_mob" value="<?php echo $tn; ?>">
                              <input type="hidden" name="tn" value="<?php echo $tn; ?>">
                              <button type="submit" id="add" name="add"> <i class="bi bi-person-add"> Add</i></button>
                            </form>
                          </div>
                        </div>
                      </div>
                      <?php
                  }
              }
          }
          ?> 
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../Assets/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
