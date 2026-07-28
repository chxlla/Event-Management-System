<?php
include 'config.php';
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    die("Access denied");
}

$events = $conn->query("SELECT * FROM events");
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h3>Admin Dashboard</h3>
        <table border="1">
            <tr><th>Event</th><th>Action</th></tr>
            <?php while($e=$events->fetch_assoc()): ?>
            <tr>
            <td><?= htmlspecialchars($e['title']) ?></td>
            <td><a href="delete_event.php?id=<?= (int)$e['id'] ?>" onclick="return confirm('Delete this event?')">Delete</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="view_registrations.php">View Registrations</a>
    </body>
</html>