<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $error = "Passwords don't match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['user_name'] = $name;
            header("Location: homepage.php");
            exit();
        } else {
            $error = "Registration failed: " . $conn->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Complaint System - Register</title>
    <style>
        /* Consistent with Login Page Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('https://plus.unsplash.com/premium_photo-1661456342021-faa4a2ac84f1?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8ZWR1Y2F0aW9uJTIwYmFja2dyb3VuZHxlbnwwfHwwfHx8MA%3D%3D') no-repeat center center/cover;
        }

        .register-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .register-form {
            background: rgba(255, 255, 255, 0.85);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
            text-align: center;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.7);
            transition: all 0.3s;
        }

        .input-group input:focus {
            border-color: #ff758c;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 117, 140, 0.2);
        }

        .eye-icon {
            position: absolute;
            right: 15px;
            top: 38px;
            cursor: pointer;
            color: #777;
            user-select: none;
        }

        .register-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #ff758c, #ff7eb3);
            border: none;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .register-btn:hover {
            background: linear-gradient(135deg, #ff5f6d, #ff758c);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 94, 108, 0.3);
        }

        .login-link {
            margin-top: 20px;
            text-align: center;
            color: #666;
        }

        .login-link a {
            color: #ff758c;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #ff5f6d;
            text-align: center;
            margin-bottom: 15px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <form class="register-form" method="POST" action="register.php">
            <h2>Create Account</h2>
            
            <?php if (!empty($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create password" required>
                <span class="eye-icon" onclick="togglePassword('password')">👁️</span>
            </div>

            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
                <span class="eye-icon" onclick="togglePassword('confirm_password')">👁️</span>
            </div>

            <button type="submit" class="register-btn">Register</button>

            <p class="login-link">
                Already have an account? <a href="login.php">Login here</a>
            </p>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
