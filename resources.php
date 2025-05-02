<?php
    include("header.html");
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
        <h1>Resource Hub</h1>
        <p>Welcome to the Resource Hub. Choose an option below to manage your educational resources.</p>
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