<?php
include 'config.php';
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    die("Access denied");
}

$res = $conn->query("
SELECT users.username, events.title
FROM registrations
JOIN users ON users.id = registrations.user_id
JOIN events ON events.id = registrations.event_id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Event Registrations</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Event Registrations</h3>

<table class="table table-bordered">
<tr><th>User</th><th>Event</th></tr>
<?php while($r=$res->fetch_assoc()): ?>
<tr>
<td><?= htmlspecialchars($r['username']) ?></td>
<td><?= htmlspecialchars($r['title']) ?></td>
</tr>
<?php endwhile; ?>
</table>

<a href="admin_dashboard.php">Back to Admin Dashboard</a>
</body>
</html>
