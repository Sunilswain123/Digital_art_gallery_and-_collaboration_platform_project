<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['mob_mail'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$user = $_SESSION['mob_mail'];
$vote_type = $_POST['voteType'];
$post_id = $_POST['postId'];
$challenge_id = $_POST['challengeId'];

// Get current votes and user vote status
$support_query = "SELECT * FROM support_photos WHERE id='$post_id'";
$support_result = mysqli_query($conn, $support_query);
$support = mysqli_fetch_assoc($support_result);

$photo1_vote = $support['photo1_vote'];
$photo2_vote = $support['photo2_vote'];

$vote_table = $user . "vote";
$vote_check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM $vote_table WHERE post_id='$post_id'"));

if ($vote_check) {
    echo json_encode(['status' => 'error', 'message' => 'Already voted']);
    exit();
}

// Update votes and record user vote
if ($vote_type == 1) {
    $new_vote_count = $photo1_vote + 1;
    $update_votes = mysqli_query($conn, "UPDATE support_photos SET photo1_vote='$new_vote_count' WHERE id='$post_id'");
    $record_vote = mysqli_query($conn, "INSERT INTO $vote_table (post_id, vote, voted_to) VALUES ('$post_id', 1, 1)");
} else if ($vote_type == 2) {
    $new_vote_count = $photo2_vote + 1;
    $update_votes = mysqli_query($conn, "UPDATE support_photos SET photo2_vote='$new_vote_count' WHERE id='$post_id'");
    $record_vote = mysqli_query($conn, "INSERT INTO $vote_table (post_id, vote, voted_to) VALUES ('$post_id', 1, 2)");
}

if ($update_votes && $record_vote) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Database update failed']);
}
?>
