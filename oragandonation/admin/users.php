<?php
include '../includes/db.php';
$res = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users - Organ Donation System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f4f6f9;
            color: #333;
            font-size: 16px;
            padding: 40px 20px;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
        }

        .user-item {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-item span {
            font-weight: 500;
        }

        .user-item a {
            background-color: #3498db;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .user-item a:hover {
            background-color: #2980b9;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .user-item p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>All Users</h2>

    <?php while ($row = $res->fetch_assoc()): ?>
        <div class="user-item">
            <span><strong>Name:</strong> <?= $row['name'] ?></span>
            <span><strong>Role:</strong> <?= $row['role'] ?></span>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
