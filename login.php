<?php
include 'config.php';
session_start();

$error = '';

if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res->num_rows == 1){
        $row = $res->fetch_assoc();
        if(password_verify($pass, $row['password'])){
            // Regenerate the session ID on login to prevent session fixation
            session_regenerate_id(true);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $row['user_type'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 mx-auto" style="max-width:400px">
<h3 class="text-center">Login</h3>

<?php if($error): ?>
<div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST">
<input class="form-control mb-2" name="email" placeholder="Email" required>
<input class="form-control mb-2" name="password" type="password" placeholder="Password" required>
<button class="btn btn-success w-100" name="login">Login</button>
<a href="register.php">register here</a>
</form>
</div>
</div>
</body>
</html>