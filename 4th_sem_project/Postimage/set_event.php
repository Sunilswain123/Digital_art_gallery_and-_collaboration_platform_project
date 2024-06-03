<?php
require 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_description = $_POST['event_description'];
    $follow_up_date = $_POST['follow_up_date'];
    $created_by = $_SESSION['mob_mail'];

    $qry = "INSERT INTO events (event_name, event_date, event_description, follow_up_date, created_by) VALUES ('$event_name', '$event_date', '$event_description', '$follow_up_date', '$created_by')";
    if ($conn->query($qry)) {
        echo "<script>alert('Event created successfully');</script>";
    } else {
        echo "<script>alert('Error creating event: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Event</title>
    <link rel="stylesheet" href="../Assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body style="background-image: url(./images/simple.jpg);">
    <?php include_once 'nav.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center" style="color:white;">Set Event</h2>
        <form method="post" onsubmit="enableFollowUpDate()">
            <div class="mb-3">
                <label for="event_name" class="form-label" style="color:white;">Event Name</label>
                <input type="text" class="form-control" id="event_name" name="event_name" required>
            </div>
            <div class="mb-3">
                <label for="event_date" class="form-label" style="color:white;">Event Date</label>
                <input type="date" class="form-control" id="event_date" name="event_date" required min="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="mb-3">
                <label for="follow_up_date" class="form-label" style="color:white;">Follow-up Date</label>
                <input type="date" class="form-control" id="follow_up_date" name="follow_up_date" disabled>
            </div>
            <div class="mb-3">
                <label for="event_description" class="form-label" style="color:white;">Event Description</label>
                <textarea class="form-control" id="event_description" name="event_description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-left:45%;">Create Event</button>
        </form>
    </div>

    <script>
        document.getElementById('event_date').addEventListener('change', function() {
            var eventDate = new Date(this.value);
            var followUpDate = new Date(eventDate);
            followUpDate.setDate(followUpDate.getDate() + 15);
            
            var followUpDateString = followUpDate.toISOString().split('T')[0];
            document.getElementById('follow_up_date').value = followUpDateString;
        });

        function enableFollowUpDate() {
            document.getElementById('follow_up_date').disabled = false;
        }
    </script>

    <script src="../Assets/bootstrap.bundle.min.js"></script>
</body>
</html>
