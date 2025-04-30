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
    <title>Categorize Complaints</title>
    <style>
        body {
            background-image: url('https://cdn.prod.website-files.com/5fb24a974499e90dae242d98/634eb632e62276f1e1f120c6_Customer%20complaint%20no%20title.png');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 500px;
            text-align: center;
        }
        h2 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .categories {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }
        .category {
            background: #007bff;
            color: white;
            padding: 20px;
            margin: 15px;
            width: 120px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
        }
        .category:hover {
            transform: scale(1.1);
            background-color: #0056b3;
        }
        .category span {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Category Complaints</h2>
        <p>Choose a category to sort complaints</p>
        
        <div class="categories">
            <!-- Category links, dynamically pass category in URL -->
            <a href="complaintPage.php?category=academic" class="category">
                <span>Academic</span>
            </a>
            <a href="complaintPage.php?category=facilities" class="category">
                <span>Facilities</span>
            </a>
            <a href="complaintPage.php?category=administration" class="category">
                <span>Administration</span>
            </a>
            <a href="complaintPage.php?category=student_services" class="category">
                <span>Student Services</span>
            </a>
            <a href="complaintPage.php?category=others" class="category">
                <span>Others</span>
            </a>
        </div>
    </div>
</body>
</html>


