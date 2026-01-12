<?php
session_start();
include '../includes/db.php';
include '../includes/auth.php';

// Admin check
if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Match form submitted
if (isset($_POST['request_id'], $_POST['organ_id'])) {
    $request_id = intval($_POST['request_id']);
    $organ_id = intval($_POST['organ_id']);

    // Update request as matched
    $conn->query("UPDATE requests SET matched_organ_id = $organ_id, status = 'matched' WHERE id = $request_id");

    // Update organ as matched
    $conn->query("UPDATE organs SET status = 'matched' WHERE id = $organ_id");

    $success = "Organ matched successfully!";
}

// Get unmatched recipient requests
$requests = $conn->query("SELECT * FROM requests WHERE status = 'pending'");

// Get available organs
$organs = $conn->query("SELECT * FROM organs WHERE status = 'available'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Organ Matching</title>
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
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
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

        .card {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            font-size: 24px;
            color: #34495e;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 18px;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .card form {
            display: flex;
            flex-direction: column;
        }

        .card form label {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card form select {
            padding: 12px;
            font-size: 16px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
        }

        .card form button {
            padding: 12px 20px;
            background-color: #ff6f61;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            transition: 0.3s;
            cursor: pointer;
        }

        .card form button:hover {
            background-color: #e74c3c;
        }

        .success {
            color: #2ecc71;
            font-size: 18px;
            text-align: center;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .card h3 {
                font-size: 20px;
            }

            .card p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Match Donated Organs with Recipients</h2>
    <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>

    <?php while ($req = $requests->fetch_assoc()): ?>
        <div class="card">
            <h3>Request ID #<?= $req['id'] ?></h3>
            <p><strong>Organ:</strong> <?= $req['organ_type'] ?></p>
            <p><strong>Blood Group:</strong> <?= $req['blood_group'] ?></p>

            <form method="post">
                <input type="hidden" name="request_id" value="<?= $req['id'] ?>">
                <label>Select Available Organ:</label>
                <select name="organ_id" required>
                    <option value="">-- Select --</option>
                    <?php
                    $organs->data_seek(0); // reset pointer
                    while ($organ = $organs->fetch_assoc()):
                        if (
                            $organ['organ_type'] === $req['organ_type'] &&
                            $organ['blood_group'] === $req['blood_group']
                        ):
                    ?>
                        <option value="<?= $organ['id'] ?>">
                            Organ ID #<?= $organ['id'] ?> - <?= $organ['organ_type'] ?> (<?= $organ['blood_group'] ?>)
                        </option>
                    <?php endif; endwhile; ?>
                </select>
                <button type="submit">Match</button>
            </form>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>
