<?php
include 'config.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$events = $conn->query("SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container mt-4">
<h3>Event Dashboard</h3>

<?php if($_SESSION['user_type']=='admin'): ?>
<a href="add_event.php" class="btn btn-primary mb-3">Add Event</a>
<a href="admin_dashboard.php" class="btn btn-dark mb-3">Admin Panel</a>
<?php endif; ?>

<table class="table table-bordered">
<tr>
<th>Title</th><th>Date</th><th>Location</th><th>Action</th>
</tr>

<?php while($e = $events->fetch_assoc()): ?>
<tr>
<td><?= htmlspecialchars($e['title']) ?></td>
<td><?= htmlspecialchars($e['event_date']) ?></td>
<td><?= htmlspecialchars($e['location']) ?></td>
<td>
<a href="register_event.php?id=<?= (int)$e['id'] ?>" class="btn btn-success btn-sm">
Register
</a>
</td>
</tr>
<?php endwhile; ?>

</table>
<a href="logout.php">Logout</a>
</div>
</body>
</html>
