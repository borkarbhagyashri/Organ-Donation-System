<?php
session_start();
include 'includes/auth.php';
include 'includes/db.php';

$user = $_SESSION['user'];
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $organ_type = htmlspecialchars($_POST['organ_type']);
    $blood_group = htmlspecialchars($_POST['blood_group']);
    $user_id = $user['id'];

    $sql = "INSERT INTO organs (user_id, organ_type, blood_group, status) 
            VALUES ('$user_id', '$organ_type', '$blood_group', 'available')";

    if ($conn->query($sql)) {
        $message = "<div class='success'>Organ donation submitted successfully!</div>";
    } else {
        $message = "<div class='error'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donate Organ</title>
    <link rel="stylesheet" href="css/donate.css">
</head>
<body>

<div class="form-container">
    <h2>Donate an Organ</h2>
    <?php echo $message; ?>
    <form method="POST">
        <label for="organ_type">Organ Type</label>
        <select name="organ_type" required>
            <option value="">Select Organ</option>
            <option value="Kidney">Kidney</option>
            <option value="Liver">Liver</option>
            <option value="Heart">Heart</option>
            <option value="Lung">Lung</option>
            <option value="Pancreas">Pancreas</option>
        </select>

        <label for="blood_group">Blood Group</label>
        <select name="blood_group" required>
            <option value="">Select Blood Group</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select>

        <button type="submit">Submit Donation</button>
    </form>
    <br>
    <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
</div>

</body>
</html>
