<?php
include '../includes/db.php';

// Approve request
if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    $conn->query("UPDATE requests SET status='approved' WHERE id=$id");
    echo "<p style='color:green;'>Request approved.</p>";
}

// Delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM requests WHERE id=$id");
    echo "<p style='color:red;'>Request deleted.</p>";
}

$res = $conn->query("SELECT r.*, u.name FROM requests r JOIN users u ON r.user_id = u.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Requests - Organ Donation System</title>
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

        .request-item {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-size: 18px;
        }

        .request-item p {
            color: #7f8c8d;
            margin-bottom: 10px;
        }

        .request-item a {
            background-color: #27ae60;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
            margin-right: 10px;
            display: inline-block;
        }

        .request-item a:hover {
            background-color: #2ecc71;
        }

        .delete-btn {
            background-color: #e74c3c !important;
        }

        .approved {
            color: #27ae60;
            font-weight: bold;
        }

        .pending {
            color: #f39c12;
            font-weight: bold;
        }

        .rejected {
            color: #e74c3c;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .request-item p {
                font-size: 16px;
            }

            .request-item a {
                font-size: 14px;
                padding: 6px 12px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Requests</h2>

    <?php while ($row = $res->fetch_assoc()): ?>
        <div class="request-item">
            <p><strong>Recipient:</strong> <?= htmlspecialchars($row['name']) ?></p>
            <p><strong>Organ:</strong> <?= htmlspecialchars($row['organ_type']) ?></p>
            <p><strong>Status:</strong> 
                <?php if ($row['status'] == 'approved'): ?>
                    <span class="approved">Approved</span>
                <?php elseif ($row['status'] == 'pending'): ?>
                    <span class="pending">Pending</span>
                    <br>
                    <a href="requests.php?approve=<?= $row['id'] ?>">Approve</a>
                    <a href="requests.php?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this request?');">Delete</a>
                <?php else: ?>
                    <span class="rejected">Rejected</span>
                <?php endif; ?>
            </p>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
