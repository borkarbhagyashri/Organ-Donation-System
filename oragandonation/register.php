<?php
include 'includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, contact, address) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $pass, $role, $contact, $address);

    if ($stmt->execute()) {
        $message = "Registration successful. <a href='login.php'>Login Now</a>";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Organ Donation System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: linear-gradient(to right, #ff6a00, #ee0979);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        .register-container {
            width: 450px;
            margin: 80px auto;
            padding: 30px;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            text-align: center;
        }
        .register-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"],
        .register-container select,
        .register-container textarea {
            width: 90%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }
        .register-container textarea {
            resize: vertical;
            min-height: 80px;
        }
        .register-container button {
            background-color: #ee0979;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s;
        }
        .register-container button:hover {
            background-color: #cc076a;
        }
        .register-container .message {
            margin-top: 15px;
            color: green;
        }
        .register-container .error {
            color: red;
            margin-top: 10px;
        }
        a {
            color: #ee0979;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="register-container">
    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="donor">Donor</option>
            <option value="recipient">Recipient</option>
        </select><br>
        <input type="text" name="contact" placeholder="Contact Number" required><br>
        <textarea name="address" placeholder="Address" required></textarea><br>
        <button type="submit">Register</button>
    </form>
    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>
</div>
</body>
</html>
