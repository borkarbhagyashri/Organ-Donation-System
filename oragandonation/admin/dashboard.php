<?php
session_start();
include '../includes/auth.php';
$user = $_SESSION['user'];
if ($user['role'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Organ Donation System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f0f4f8;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 20px;
            color: #333;
        }

        .wrapper {
            width: 100%;
            max-width: 1000px;
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .wrapper h1 {
            font-size: 36px;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .card {
            background: #ffffff;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .card h3 {
            font-size: 20px;
            color: #34495e;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 40px;
        }

        .card:hover {
            transform: translateY(-5px);
            background-color: #f5faff;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
        }

        .links {
            margin-top: 20px;
        }

        .links a {
            text-decoration: none;
            font-weight: 600;
            padding: 12px 25px;
            background-color: #ff6f61;
            color: white;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        .links a:hover {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Admin Dashboard</h1>

        <div class="cards">
            <div class="card" onclick="location.href='users.php'">
                <h3>Manage Users</h3>
                <p>👤</p>
            </div>
            <div class="card" onclick="location.href='donations.php'">
                <h3>Manage Donations</h3>
                <p>💉</p>
            </div>
            <div class="card" onclick="location.href='requests.php'">
                <h3>Manage Requests</h3>
                <p>📄</p>
            </div>
            <div class="card" onclick="location.href='match.php'">
                <h3>Match Organs</h3>
                <p>🧬</p>
            </div>
        </div>

        <div class="links">
            <a href="../logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
