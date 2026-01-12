<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Organ Donation System</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            position: relative;
            height: 100vh;
            background: url('images/organs/donation.png') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .hero-content {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 700px;
        }

        .hero-content h1 {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .tagline {
            font-size: 18px;
            margin-bottom: 25px;
        }

        .btn-group {
            margin-top: 20px;
        }

        .btn {
            text-decoration: none;
            padding: 12px 30px;
            margin: 0 10px;
            background-color: #ff6f61;
            color: white;
            border-radius: 25px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: white;
            color: #ff6f61;
            transform: scale(1.05);
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #222;
            color: #fff;
            position: absolute;
            width: 100%;
            bottom: 0;
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 28px;
            }

            .tagline {
                font-size: 16px;
            }

            .btn {
                display: block;
                margin: 10px auto;
            }
        }
    </style>
</head>
<body>

    <!-- Hero Section with Info and Buttons -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>Welcome to the Organ Donation System</h1>
            <p class="tagline">Help save lives through organ donation. One organ donor can save up to 8 lives!</p>
            <div class="btn-group">
                <a href="login.php" class="btn">Login</a>
                <a href="register.php" class="btn">Register</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2025 Organ Donation System. All rights reserved.</p>
    </footer>

</body>
</html>
