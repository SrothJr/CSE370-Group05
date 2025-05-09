<?php
session_start();
include 'database.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// check admin
if ($_SESSION['isadmin']) {
    include 'aheader.html';
} else {
    include 'uheader.html';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rStyle.css">
    <title>Resource Hub</title>
</head>
<body>
    <div class="welcome-section">
        <h1>Resource Vault</h1>
        <p>Welcome to the Resource Vault. Choose an option below to collect or provide educational resources.</p>
    </div>

    <div class="button-container">
        <a href="provide.php" class="resource-button">
            Provide Resources
            <span>Share educational materials for a course</span>
        </a>
        
        <a href="collect.php" class="resource-button">
            Collect Resources
            <span>Find and access available course materials</span>
        </a>
        
        <a href="updateSource.php" class="resource-button">
            Update Resources
            <span>Modify existing resource information</span>
        </a>
    </div>
</body>
</html>