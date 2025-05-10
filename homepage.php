<?php
session_start();
include 'database.php'; 



// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// check admin
if ($_SESSION['isadmin']) {
    include 'adminHeader.php';
} else {
    include 'globalHeader.html';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/hStyle.css">      
    <title>Home Page</title>
</head>
<body>
	    <div class="header-text" style="width: 500px; margin: 10px auto;">
        <h2>Welcome to the Student Help Desk</h2>
        <p>Navigate through website to find use features!</p>
        </div>
        <div class="search-container" style="width: 500px; margin: 0 auto;">
            <input type="text" placeholder="Search..." id="search-bar">
            <button>🔍</button>
        </div>

        <div class="profile-container">
            <a href="profile.php" class="profile-link">Profile</a>
        </div>
		
        
        <div class="content">
		     
            <div class="welcome-section">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
                <p>Here's what's happening in your account.</p>
            </div>
			
            
        </div>
    </div>
</body>
</html>
