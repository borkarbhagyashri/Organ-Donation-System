<?php
session_start();
include 'includes/auth.php';
include 'includes/db.php';

$user = $_SESSION['user'];
$user_id = $user['id'];

$sql = "SELECT * FROM requests WHERE user_id = '$user_id' ORDER BY request_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Organ Requests</title>
    <link rel="stylesheet" href="css/request.css">
</head>
<body>

<div class="container">
    <h2>My Organ Requests</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Organ Type</th>
                    <th>Blood Group</th>
                    <th>Status</th>
                    <th>Requested At</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['organ_type']; ?></td>
                        <td><?php echo $row['blood_group']; ?></td>
                        <td class="<?php echo strtolower($row['status']); ?>"><?php echo ucfirst($row['status']); ?></td>
                        <td><?php echo date('d M Y, h:i A', strtotime($row['request_date'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">You haven’t submitted any organ requests yet.</p>
    <?php endif; ?>

    <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
</div>

</body>
</html>
