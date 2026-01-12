<?php
session_start();
include 'includes/auth.php'; // checks login session
include 'includes/db.php';

$user = $_SESSION['user'];
$user_id = $user['id'];
$sql = "SELECT * FROM requests WHERE user_id = '$user_id' ORDER BY request_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<div class="container">
    <aside class="sidebar">
        <h2>Hello, <?php echo htmlspecialchars($user['name']); ?> 👋</h2>
        <ul>
            <?php if ($user['role'] == 'donor'): ?>
                <li><a href="donate.php">Donate Organ</a></li>
            <?php elseif ($user['role'] == 'recipient'): ?>
                <li><a href="recipient.php">Request Organ</a></li>
            <?php endif; ?>
            <li><a href="logout.php" class="logout">Logout</a></li>
            <?php if ($user['role'] === 'admin'): ?>
                <li><a href="admin/dashboard.php" class="admin-btn">Admin Panel</a></li>
            <?php endif; ?>
        </ul>
    </aside>

    <main class="content">
        

        <h1>Welcome to the Organ Donation System</h1>
        <p>You are logged in as a <strong><?php echo ucfirst($user['role']); ?></strong>.</p>

        <h2>My Organ Requests</h2>

        <?php if ($result && $result->num_rows > 0): ?>
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
                            <td><?php echo htmlspecialchars($row['organ_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                            <td class="<?php echo strtolower($row['status']); ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </td>
                            <td><?php echo date('d M Y, h:i A', strtotime($row['request_date'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">You haven’t submitted any organ requests yet.</p>
        <?php endif; ?>

        <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
    </main>
</div>

</body>
</html>
