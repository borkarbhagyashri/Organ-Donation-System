<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email' AND role='admin'");
    if ($res->num_rows > 0) {
        $admin = $res->fetch_assoc();
        if (password_verify($pass, $admin['password'])) {
            $_SESSION['user'] = $admin;
            header("Location: dashboard.php");
        } else {
            echo "Wrong password.";
        }
    } else {
        echo "Admin not found.";
    }
}
?>
<head>
     <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="css/login.css">

    <title>Organ Donation System</title>
</head>
<body>
<form method="POST">
    <input type="email" name="email" required placeholder="Admin Email">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Login</button>
</form>
</body>