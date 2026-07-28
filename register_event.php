<?php
include 'config.php';
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$uid = (int) $_SESSION['user_id'];
$eid = (int) ($_GET['id'] ?? 0);

if($eid > 0){
    // Prevent duplicate registration for the same event
    $check = $conn->prepare("SELECT id FROM registrations WHERE user_id = ? AND event_id = ?");
    $check->bind_param("ii", $uid, $eid);
    $check->execute();
    $check->store_result();

    if($check->num_rows == 0){
        $check->close();
        $stmt = $conn->prepare("INSERT INTO registrations (user_id, event_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $uid, $eid);
        $stmt->execute();
        $stmt->close();
    } else {
        $check->close();
    }
}

header("Location: dashboard.php");
exit();
