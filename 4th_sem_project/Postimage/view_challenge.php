<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['mob_mail'])) {
    header('Location: log-reg.php');
    exit();
}
$user = $_SESSION['mob_mail'];
$current_time = date('Y-m-d H:i:s');

// Fetch ongoing challenges
$query = "SELECT * FROM challenges WHERE status='accepted' AND support_upload_time IS NOT NULL AND TIMESTAMPDIFF(MINUTE, support_upload_time, '$current_time') < 5";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Challenges</title>
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .challenge {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            background-image: url(./images/cartoon.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .image-container {
            flex: 1;
            text-align: center;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
        }
        .vote-button {
            margin-top: 10px;
        }
        .winner {
            border: 2px solid gold;
        }
    </style>
</head>
<body style="background-image: url(./images/simple.jpg)">
    <?php include_once "nav.php"; ?>
    <div class="container mt-4">
        <h2 style="color:white">Ongoing Challenges</h2>
        <div id="challenges">
            <?php if (mysqli_num_rows($result) == 0) { ?>
                <p style="color:white">No ongoing challenges found.</p>
            <?php } else { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    $post_id = $row['post_id'];
                    $receiver_id = $row['receiver_id'];
                    $sender_id = $row['sender_id'];
                    $challenge_id = $row['id'];
                    $support_upload_time = $row['support_upload_time'];

                    // Calculate remaining time
                    $end_time = strtotime($support_upload_time . ' + 5 minutes');
                    $remaining_time = $end_time - time();

                    // Fetch challenged image
                    $post_query = "SELECT * FROM `$receiver_id` WHERE sl='$post_id'";
                    $post_result = mysqli_query($conn, $post_query);
                    $post = mysqli_fetch_assoc($post_result);

                    $challenged_image = $post['img_vdo'];

                    // Fetch support image
                    $support_query = "SELECT * FROM support_photos WHERE receiver_id='$receiver_id'";
                    $support_result = mysqli_query($conn, $support_query);
                    $support = mysqli_fetch_assoc($support_result);

                    $support_image = $support['photo2'];

                    // Fetch user data
                    $sender_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM register WHERE phone='$sender_id'"));
                    $receiver_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM register WHERE phone='$receiver_id'"));

                    $sender_name = $sender_data['name'];
                    $sender_img = $sender_data['image'];
                    $rec_name = $receiver_data['name'];
                    $rec_img = $receiver_data['image'];

                    $photo1_vote = $support['photo1_vote'];
                    $photo2_vote = $support['photo2_vote'];
                    $id = $support['id'];

                    $vote_table = $user . "vote";
                    $vote_check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM $vote_table WHERE post_id='$post_id'"));
                    $is_voted = $vote_check ? $vote_check['vote'] : 0;
                    $voted_to = $vote_check ? $vote_check['voted_to'] : 0;
                    ?>
                    <div class="challenge" id="challenge_<?php echo $challenge_id; ?>">
                        <div class="image-container">
                            <h4 style="color:yellow;">Challenged Image</h4>
                            <div class="d-flex profile" style="margin-left:34%; margin-bottom:10px;">
                                <img src="./images/<?php echo $sender_img; ?>" alt="pic1" style="height:50px; width:50px; border-radius:50%;">
                                <div style="margin-top:11px; margin-left:5px;">
                                    <h5 style="color:white;"><?php echo $sender_name; ?></h5>
                                </div>
                            </div>
                            <img src="./images/<?php echo $challenged_image; ?>" alt="Challenged Image" style="width=400px; height:300px;"><br>
                            <?php if ($is_voted == 1 && $voted_to == 1) { ?>
                                <button class="btn btn-warning vote-button" disabled><?php echo "Voted " . $photo1_vote; ?></button>
                            <?php } else if ($is_voted == 0) { ?>
                                <button class="btn btn-primary vote-button" onclick="vote(1, '<?php echo $id; ?>', '<?php echo $challenge_id; ?>')">Vote</button>
                                <button class="btn btn-warning vote-button" disabled><?php echo "Votes " . $photo1_vote; ?></button>
                            <?php } ?>
                        </div>

                        <div class="image-container">
                            <h4 style="color:red;">Support Image</h4>
                            <div class="d-flex profile" style="margin-left:34%; margin-bottom:10px;">
                                <img src="./images/<?php echo $rec_img; ?>" alt="pic2" style="height:50px; width:50px; border-radius:50%;">
                                <div style="margin-top:11px; margin-left:5px;">
                                    <h5 style="color:white;"><?php echo $rec_name; ?></h5>
                                </div>
                            </div>
                            <img src="./images/<?php echo $support_image; ?>" alt="Support Image" style="width=400px; height:300px;"><br>
                            <?php if ($is_voted == 1 && $voted_to == 2) { ?>
                                <button class="btn btn-danger vote-button" disabled><?php echo "Voted " . $photo2_vote; ?></button>
                            <?php } else if ($is_voted == 0) { ?>
                                <button class="btn btn-primary vote-button" onclick="vote(2, '<?php echo $id; ?>', '<?php echo $challenge_id; ?>')">Vote</button>
                                <button class="btn btn-danger vote-button" disabled><?php echo "Votes " . $photo2_vote; ?></button>
                            <?php } ?>
                        </div>

                        <div>
                            <h5>Time Left</h5>
                            <span id="timer_<?php echo $challenge_id; ?>"></span>
                        </div>
                    </div>

                    <script>
                        var endTime = <?php echo $end_time * 1000; ?>;
                        var timerId = "timer_<?php echo $challenge_id; ?>";

                        function updateTimer() {
                            var now = new Date().getTime();
                            var distance = endTime - now;

                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            document.getElementById(timerId).innerHTML = hours + "h " +
                                minutes + "m " + seconds + "s ";

                            if (distance < 0) {
                                clearInterval(x);
                                document.getElementById(timerId).innerHTML = "EXPIRED";
                                disableVoting('<?php echo $challenge_id; ?>');
                                highlightWinner('<?php echo $challenge_id; ?>', '<?php echo $photo1_vote; ?>', '<?php echo $photo2_vote; ?>');
                            }
                        }

                        updateTimer(); // initial call
                        var x = setInterval(updateTimer, 1000);

                        function vote(voteType, postId, challengeId) {
                            $.ajax({
                                url: 'vote.php',
                                type: 'POST',
                                data: {
                                    voteType: voteType,
                                    postId: postId,
                                    challengeId: challengeId
                                },
                                success: function(response) {
                                    location.reload();
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error('AJAX error:', textStatus, errorThrown);
                                    alert('There was an error processing your request.');
                                }
                            });
                        }

                        function disableVoting(challengeId) {
                            $("#challenge_" + challengeId + " .vote-button").attr("disabled", true);
                        }

                        function highlightWinner(challengeId, photo1Vote, photo2Vote) {
                            if (photo1Vote > photo2Vote) {
                                $("#challenge_" + challengeId + " .image-container").first().addClass("winner");
                            } else if (photo2Vote > photo1Vote) {
                                $("#challenge_" + challengeId + " .image-container").last().addClass("winner");
                            }
                        }
                    </script>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</body>
</html>
