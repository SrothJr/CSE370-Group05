<?php

session_start();
include("database.php");
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categorize Complaints</title>
    <style>
        /* --- Reset to avoid homepage CSS interference --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-image: url('https://cdn.prod.website-files.com/5fb24a974499e90dae242d98/634eb632e62276f1e1f120c6_Customer%20complaint%20no%20title.png');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.85);
            padding: 30px;
            border-radius: 12px;
            width: 520px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.25);
        }
        h2 {
            color: #222;
            font-size: 2rem;
            margin-bottom: 10px;
        }
        p {
            font-size: 1rem;
            color: #444;
            margin-bottom: 20px;
        }
        .categories {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .category {
            background: #007bff;
            color: white;
            padding: 15px;
            margin: 10px;
            width: 140px;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.3s, background-color 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        .category:hover {
            transform: scale(1.08);
            background-color: #0056b3;
        }
		.back-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #f76806;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background-color: #feba4f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Categorize Complaints</h2>
        <p>Choose a category to sort complaints</p>
        <div class="categories">
            <a href="complaintPage.php?category=academic" class="category">Academic</a>
            <a href="complaintPage.php?category=facilities" class="category">Facilities</a>
            <a href="complaintPage.php?category=administration" class="category">Administration</a>
            <a href="complaintPage.php?category=student_services" class="category">Student Services</a>
            <a href="complaintPage.php?category=others" class="category">Others</a>
			<a href="homepage.php" class="back-btn">← Back to Homepage</a>
        </div>
    </div>
</body>
</html>




