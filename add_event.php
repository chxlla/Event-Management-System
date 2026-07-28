<?php

include 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    die("Access denied!");
}

if (isset($_POST['add'])) {
    $title = trim($_POST['title']);
    $desc  = trim($_POST['description']);
    $date  = $_POST['event_date'];
    $loc   = trim($_POST['location']);
    $uid   = (int) $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO events (title, description, event_date, location, created_by) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $title, $desc, $date, $loc, $uid);
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Event</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow p-4">
                <h3 class="text-center mb-3">Create New Event</h3>

                <form method="POST">
                    <input type="text" name="title" class="form-control mb-2"
                           placeholder="Event Title" required>

                    <textarea name="description" class="form-control mb-2"
                              placeholder="Event Description"></textarea>

                    <input type="date" name="event_date" class="form-control mb-2" required>

                    <input type="text" name="location" class="form-control mb-3"
                           placeholder="Location" required>

                    <button type="submit" name="add" class="btn btn-success w-100">
                        Create Event
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>
