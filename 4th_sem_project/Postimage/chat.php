<?php
session_start();
if (!isset($_SESSION['mob_mail'])) {
    header('Location: log-reg.php');
    exit();
}

require_once 'connection.php'; // Ensure you have this file to handle your database connection

$mob_mail = $_SESSION['mob_mail'];
$friend_table = $mob_mail . 'f';

// Fetch friends
$friends = [];
$query = "SELECT frnd_mob FROM $friend_table";
$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $friends[] = $row['frnd_mob'];
    }
}

// Handle new message
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message']) && isset($_POST['receiver'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $receiver = mysqli_real_escape_string($conn, $_POST['receiver']);
    $sender = $mob_mail;

    $query = "INSERT INTO messages (sender, receiver, message, timestamp) VALUES ('$sender', '$receiver', '$message', NOW())";
    mysqli_query($conn, $query);

    // Redirect to the same page to prevent resubmission
    header("Location: chat.php?chat_with=" . $receiver);
    exit();
}

// Fetch messages for a selected friend
$messages = [];
if (isset($_GET['chat_with'])) {
    $chat_with = mysqli_real_escape_string($conn, $_GET['chat_with']);
    
    // Update seen status for messages received by the current user
    $update_seen_query = "UPDATE messages SET seen=1 WHERE sender='$chat_with' AND receiver='$mob_mail' AND seen=0";
    mysqli_query($conn, $update_seen_query);

    $query = "SELECT * FROM messages WHERE (sender='$mob_mail' AND receiver='$chat_with') OR (sender='$chat_with' AND receiver='$mob_mail') ORDER BY timestamp ASC";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css_file/navbar1.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/autotyping@1.2.6/dist/AutoTyping.min.js"></script>
    <style>
        body {
            background: #f8f9fa;
        }
        .chat-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .friends-list {
            background: #fff;
            border-right: 1px solid #ddd;
            overflow-y: auto;
        }
        .friends-list .list-group-item {
            cursor: pointer;
        }
        .chat-box {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .chat-messages {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            background: #e5ddd5;
            display: flex;
            flex-direction: column;
        }
        .message {
            margin-bottom: 15px;
            max-width: 70%;
            padding: 10px;
            border-radius: 10px;
            position: relative;
            clear: both;
        }
        .message.sent {
            background: cyan;
            align-self: flex-end;
            border-bottom-right-radius: 0;
        }
        .message.received {
            background: #fff;
            align-self: flex-start;
            border-bottom-left-radius: 0;
        }
        .message small {
            display: block;
            text-align: right;
            font-size: 0.8em;
            color: #888;
        }
        .message-form {
            display: flex;
            border-top: 1px solid #ddd;
            background: #fff;
            padding: 10px;
        }
        .message-form input {
            flex-grow: 1;
            margin-right: 10px;
            border-radius: 20px;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }
        .message-form button {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            border: none;
            background: #007bff;
            color: white;
        }
        .seen-status {
            font-size: 0.8em;
            color: green;
            text-align: right;
        }
        .date-divider {
            text-align: center;
            margin: 10px 0;
            color: #888;
        }
    </style>
</head>
<body>
    <nav>
        <!-- Your existing navbar code -->
        <?php
        include_once "nav.php";
        ?>
    </nav>
    <div class="container-fluid chat-container" style="background-image: url(./images/peakpx.jpg);">
    <div class="col-md-3 friends-list" style="background-image: url(./images/red-blue.webp);">
    <h2 class="p-3" style="color:white; font-family: 'Courier New', Courier, monospace;">Friends</h2>
    <ul class="list-group">
        <?php foreach ($friends as $friend): ?>
            <li class="list-group-item" style="background-color:aqua">
                <a href="chat.php?chat_with=<?= $friend ?>" class="d-flex align-items-center text-decoration-none">
                    <?php
                    $qry1 = mysqli_query($conn, "SELECT * FROM register WHERE phone=$friend");
                    if ($qry1) {
                        $res1 = mysqli_fetch_assoc($qry1);
                        $name1 = $res1['name'];
                        $img = $res1['image'];
                    ?>
                        <img src="./images/<?= $img ?>" alt="prf" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                        <h6 class="mb-0" style="color: green;"><?= $name1 ?></h6>
                    <?php
                    }
                    ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

        <div class="col-md-9 chat-box">
        <h2 class="p-3" style="font-family: cursive;">Chat <?php if (isset($chat_with)){
            $qry=mysqli_query($conn,"SELECT * FROM register WHERE phone=$chat_with");
            if($qry){
                $res=mysqli_fetch_assoc($qry);
                $name=$res['name'];
            }
            echo "with $name"; 
        }
        ?>
        </h2>
            <div class="chat-messages">
              
                <?php if (isset($_GET['chat_with'])): ?>
                    <?php 
                    $current_date = '';
                    foreach ($messages as $message): 
                        $message_date = date('Y-m-d', strtotime($message['timestamp']));
                        $message_time = date('H:i', strtotime($message['timestamp']));
                        if ($message_date != $current_date): 
                            $current_date = $message_date; 
                    ?>
                        <div class="date-divider"><?= date('F j, Y', strtotime($current_date)) ?></div>
                    <?php endif; ?>
                        <div class="message <?= $message['sender'] == $mob_mail ? 'sent' : 'received' ?>">
                            <p><?= htmlspecialchars($message['message']) ?></p>
                            <small><?= $message_time ?></small>
                            <?php if ($message['sender'] == $mob_mail && $message['seen']): ?>
                                <div class="seen-status">Seen</div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Select a friend to start chatting</p>
                <?php endif; ?>
            </div>
            <?php if (isset($_GET['chat_with'])): ?>
                <form action="chat.php?chat_with=<?= $chat_with ?>" method="post" class="message-form">
                    <input type="text" name="message" placeholder="Type a message" required>
                    <input type="hidden" name="receiver" value="<?= $chat_with ?>">
                    <button type="submit"><i class="bi bi-send"></i></button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <script src="../Assets/bootstrap.bundle.min.js"></script>
    <script src="../js_file/animate.js"></script> <!-- Update with the correct path -->
</body>
</html>
