<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['mob_mail'])) {
    header("Location: log-reg.php");
    exit();
}

$username = $_SESSION['mob_mail'];
$currentDate = date('Y-m-d'); // Get the current date in Y-m-d format

$query = "SELECT * FROM events WHERE event_date <= ? AND follow_up_date >= ? AND created_by != ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $currentDate, $currentDate, $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing Events</title>
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
</head>
<body style="background-image: url(./images/wallp.jpg);">
    <?php include_once 'nav.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Ongoing Events</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Event Name</th>
                    <th scope="col">Event Date</th>
                    <th scope="col">Follow-up Date</th>
                    <th scope="col">Event Description</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['event_name']}</td>
                            <td>{$row['event_date']}</td>
                            <td>{$row['follow_up_date']}</td>
                            <td>{$row['event_description']}</td>
                            <td>{$row['created_by']}</td>
                            <td><a href='support_event.php?event_id={$row['id']}' class='btn btn-primary'>Support Event</a></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No ongoing events found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="../Assets/bootstrap.bundle.min.js"></script>
</body>
</html>
