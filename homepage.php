<?php
session_start();
include 'config.php'; 


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Default content
$page = isset($_GET['page']) ? $_GET['page'] : 'home'; // Default to 'home' if no page is specified

// Include content based on the 'page' parameter
switch ($page) {
    case 'categorizeComplaints':
        include 'categorizeComplaints.php';  // Include Create Complaint page
        break;
    case 'complaints':
        include 'complaints.php';  // Include Complaints page
        break;
    case 'course_reviews':
        include 'course_reviews.php';  // Include Course Reviews page
        break;
	case 'resources':
        include 'resources.php';  // Include Complaints page
        break;
    case 'updates':
        include 'updates.php';  // Include Updates page
        break;
    case 'faqs':
        include 'faqs.php';  // Include FAQs page
        break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/homepage.css">      
    
</head>
<body>
    <header>
	    <div class="header-text">
        <h1>Welcome to the Student Complaint System</h1>
        <p>Choose an option from the sidebar to get started.</p>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search..." id="search-bar">
            <button>🔍</button>
        </div>

        <div class="profile-container">
            <a href="profile.php" class="profile-link">Profile</a>
        </div>
    </header>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h2>Student Complaint System</h2>
            <ul>
			    
                <li><a href="homepage.php?page=categorizeComplaints">Create Complaints</a></li>
                <li><a href="homepage.php?page=complaints">Complaints</a></li>
                <li><a href="homepage.php?page=course_reviews">Course Reviews</a></li>
				<li><a href="homepage.php?page=resources">Resources</a></li>
                <li><a href="homepage.php?page=updates">Updates</a></li>
                <li><a href="homepage.php?page=faqs">FAQs</a></li>
                <li><a href="logout.php" class="logout-btn">Logout</a></li>
				

            </ul>
        </nav>
		
        
        <div class="content">
		     
            <div class="welcome-section">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
                <p>Here's what's happening in your account.</p>
            </div>
			
            
        </div>
    </div>
</body>
</html>
