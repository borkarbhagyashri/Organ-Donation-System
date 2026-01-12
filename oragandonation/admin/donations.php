<?php 
include '../includes/db.php';

// Handle deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM organs WHERE id=$id");
    echo "<p style='color:red; text-align:center;'>Donation record deleted.</p>";
}

$res = $conn->query("SELECT o.*, u.name FROM organs o JOIN users u ON o.user_id = u.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donations - Organ Donation System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
            padding: 40px 20px;
            font-size: 16px;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        h2 {
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
        }

        .donation-item {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-size: 18px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .donation-item span {
            font-weight: 500;
        }

        .donation-item .actions {
            display: flex;
            gap: 10px;
        }

        .donation-item a {
            background-color: #3498db;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .donation-item a:hover {
            background-color: #2980b9;
        }

        .delete-btn {
            background-color: #e74c3c !important;
        }

        .delete-btn:hover {
            background-color: #c0392b !important;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .donation-item {
                font-size: 16px;
                flex-direction: column;
                align-items: flex-start;
            }

            .donation-item .actions {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Donations</h2>

    <?php while ($row = $res->fetch_assoc()): ?>
        <div class="donation-item">
            <span><strong>Donor:</strong> <?= htmlspecialchars($row['name']) ?></span>
            <span><strong>Organ:</strong> <?= htmlspecialchars($row['organ_type']) ?></span>
            <span><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></span>
            <div class="actions">
                <a href="donations.php?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this organ donation?');">Delete</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
