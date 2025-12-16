<?php
session_start();
include 'includes/conn.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($uid, $hash);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            $_SESSION['admin_id'] = $uid;
            header("Location: admin/dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TinyToddlers Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(120deg,#7B3FA0 60%,#FFD700 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 8px 32px rgba(123,63,160,0.18);
            padding: 48px 38px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            position: relative;
        }
        .login-logo {
            width: 80px;
            margin-bottom: 18px;
        }
        .login-title {
            font-family: 'Fredoka', sans-serif;
            font-size: 28px;
            color: #7B3FA0;
            margin-bottom: 18px;
            font-weight: 700;
        }
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .login-form input {
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid #F3E9FF;
            font-size: 16px;
            background: #F3E9FF;
            outline: none;
            transition: border 0.2s;
        }
        .login-form input:focus {
            border: 1.5px solid #7B3FA0;
        }
        .login-btn {
            background: #7B3FA0;
            color: #FFD700;
            border: none;
            border-radius: 12px;
            padding: 14px 0;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.2s, color 0.2s;
        }
        .login-btn:hover {
            background: #FFD700;
            color: #7B3FA0;
        }
        .login-error {
            color: #FF6B6B;
            background: #FFF3F3;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 15px;
        }
        .login-footer {
            margin-top: 28px;
            color: #7B3FA0;
            font-size: 14px;
        }
        @media (max-width: 500px) {
            .login-container { padding: 28px 10px; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="assets/img/logo.jpeg" alt="Tiny Techno Toddlers Logo" class="login-logo">
        <div class="login-title"><i class="fas fa-user-shield"></i> Admin Login</div>
        <?php if ($error): ?>
            <div class="login-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" class="login-form" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button class="login-btn" type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>
        <div class="login-footer">
            &copy; <?= date('Y') ?> Tiny Techno Toddlers Admin Panel
        </div>
    </div>
</body>
</html>
