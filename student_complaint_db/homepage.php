<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Default content
$page = isset($_GET['page']) ? $_GET['page'] : 'home'; // Default to 'home' if no page is specified

// Include content based on the 'page' parameter
switch ($page) {
    case 'create_complaint':
        include 'create_complaint.php';  // Include Create Complaint page
        break;
    case 'complaints':
        include 'complaints.php';  // Include Complaints page
        break;
    case 'course_reviews':
        include 'course_reviews.php';  // Include Course Reviews page
        break;
    case 'updates':
        include 'updates.php';  // Include Updates page
        break;
    case 'faqs':
        include 'faqs.php';  // Include FAQs page
        break;
    default:
        // Default content (e.g., Welcome message)
        echo '<h1>Welcome to the Student Complaint System</h1>';
        echo '<p>Choose an option from the sidebar to get started.</p>';
        break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Student Complaint System</title>
    <style>
        /* Consistent with Login/Register Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

       body {
            background: url('https://plus.unsplash.com/premium_photo-1661456342021-faa4a2ac84f1?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8ZWR1Y2F0aW9uJTIwYmFja2dyb3VuZHxlbnwwfHwwfHx8MA%3D%3D') no-repeat center center/cover;
            min-height: 100vh;
            position: relative;
            z-index: -1; /* Ensures that content is on top of the blurred background */
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit; /* Use the same background image */
            filter: blur(2.5px); /* Apply blur to the background */
            z-index: -1; /* Ensures that the blur effect doesn't overlap with content */
        }
			

        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - Pink Theme */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #ff758c, #ff7eb3);
            color: white;
            padding: 30px 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 22px;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.3);
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar li {
            margin-bottom: 15px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s;
            font-weight: 500;
        }

       .sidebar a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }

        /* Main Content Area - Less Transparency */
        .content {
             flex: 1;
             padding: 40px;
             background: #FFFFFF00; /* white */
             box-shadow: -5px 0 15px rgba(0,0,0,0.05);
        }

        .welcome-section {
            background:url('https://plus.unsplash.com/premium_photo-1661456342021-faa4a2ac84f1?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8ZWR1Y2F0aW9uJTIwYmFja2dyb3VuZHxlbnwwfHwwfHx8MA%3D%3D') no-repeat right center/cover;
			padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            color: white;
        }

        .welcome-section h1 {
            color: white; 
            margin-bottom: 20px;
        }

        /* Cards for Complaints/Reviews */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background: #FFF388; /* Yellow */
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            border-top: 4px solid #ff7eb3; /* Pink accent */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .card h3 {
            color: #333
            margin-bottom: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.5);
            padding-bottom: 10px;
        }

        .card p {
            color: #333;
            line-height: 1.6;
        }

        .logout-btn {
            display: inline-block;
            background: linear-gradient(135deg, #ff758c, #ff7eb3);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 20px;
            transition: all 0.3s;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #ff5f6d, #ff758c);
            box-shadow: 0 4px 12px rgba(255, 94, 100, 0.3);
        }
    </style>  
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h2>Student Complaint System</h2>
            <ul>
                <li><a href="homepage.php?page=create_complaint">Create Complaints</a></li>
                <li><a href="homepage.php?page=complaints">Complaints</a></li>
                <li><a href="homepage.php?page=course_reviews">Course Reviews</a></li>
                <li><a href="homepage.php?page=updates">Updates</a></li>
                <li><a href="homepage.php?page=faqs">FAQs</a></li>
                <li><a href="logout.php" class="logout-btn">Logout</a></li>
            </ul>
        </nav>
        
        <div class="content">
		     
            <div class="welcome-section">
                <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
                <p>Here's what's happening in your account.</p>
            </div>

            <!-- Recent Complaints Section -->
            <div class="card">
                <h3>Your Complaints</h3>
                <?php
                // Sample data - replace with actual database queries
                $recent_complaints = [
                    ["Library Wifi is too slow", "Submitted 3 days ago"],
                    ["Cafeteria food quality declined", "Submitted 1 week ago"]
                ];
                
                foreach ($recent_complaints as $complaint) {
                    echo "<p><strong>{$complaint[0]}</strong><br><small>{$complaint[1]}</small></p><hr>";
                }
                ?>
                <a href="#" class="logout-btn">View All Complaints</a>
            </div>

            <!-- Course Reviews Section -->
            <div class="card">
                <h3>Your Course Reviews</h3>
                <?php
                // Sample data - replace with actual database queries
                $course_reviews = [
                    ["CSE101 - Excellent content", "Reviewed 2 days ago"],
                    ["MAT120 - Tough but fair", "Reviewed 2 weeks ago"]
                ];
                
                foreach ($course_reviews as $review) {
                    echo "<p><strong>{$review[0]}</strong><br><small>{$review[1]}</small></p><hr>";
                }
                ?>
                <a href="#" class="logout-btn">Review Another Course</a>
            </div>
        </div>
    </div>
</body>
</html>
