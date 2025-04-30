<?php
// Database connection settings
$servername = "localhost"; // Server name, usually "localhost"
$username = "root";        // Your MySQL username (default for XAMPP is "root")
$password = "";            // Your MySQL password (default for XAMPP is empty "")
$dbname = "student_complaint_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Connection successful
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Complaint Management System</title>
    <style>
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
            height: 100vh;
            background: url('https://plus.unsplash.com/premium_photo-1661456342021-faa4a2ac84f1?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8ZWR1Y2F0aW9uJTIwYmFja2dyb3VuZHxlbnwwfHwwfHx8MA%3D%3D') no-repeat center center/cover;
        }
        /* Login Page Styles */
        .login-container, .dashboard-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }

        .login-form {
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
            position: relative;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            color: #666;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 5px;
            transition: border 0.3s;
        }

        .input-group input:focus {
            border-color: #ff758c;
            outline: none;
        }

        .eye-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #ff758c, #ff7eb3);
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #ff5f6d, #ff758c);
            transform: translateY(-2px);
        }

        .register-link {
            margin-top: 10px;
            font-size: 14px;
        }

        .register-link a {
            color: #ff5f6d;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: #ff3b5a;
            text-decoration: underline;
        }

        /* Dashboard Styles */
        .dashboard-container {
            width: 100%;
            display: flex;
        }

        .sidebar {
            background-color: #343a40;
            color: white;
            padding: 30px;
            width: 200px;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #ff758c;
            padding: 8px;
            border-radius: 5px;
        }

        .content {
            padding: 30px;
            width: calc(100% - 200px);
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .content h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 18px;
        }
    </style>
</head>
<body>

<!-- Login Page -->
<div class="login-container">
    <form class="login-form">
        <h2>Login</h2>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Enter your email" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter your password" required>
            <span class="eye-icon" onclick="togglePassword()">👁️</span>
        </div>
        <button type="submit" class="login-btn">Login</button>
        <p class="register-link">Don't have an account? <a href="#">Sign up</a></p>
    </form>
</div>

<!-- Dashboard Page -->
<div class="dashboard-container">
    <nav class="sidebar">
        <h2>Student Complaint System</h2>
        <ul>
        <li><a href="categorizeComplaints.php">Complaint Category</a></li>

    

	<li><a href="adminPanel.html">Admin Panel</a></li>

        </ul>
    </nav>
    <div class="content">
        <h1>Welcome to the Student Complaint System</h1>
        <p>Select a feature from the sidebar to get started.</p>
    </div>
</div>

<script>
    // Toggle password visibility
    function togglePassword() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>

</body>
</html>
