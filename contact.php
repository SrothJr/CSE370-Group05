<?php
session_start();
// check admin
if (isset($_SESSION['isadmin']) && $_SESSION['isadmin']) {
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
    <link rel="stylesheet" href="css/contactStyle.css">
    <link rel="stylesheet" href="css/rStyle.css">
    <title>Contact Us</title>
</head>
<body>
    <div class="contact-container">
        <h2>Contact Us</h2>
        <p>Need additional resources for your course? Contact our University Resource Center using the information below.</p>
        
        <div class="university-info">
            <h3>University Resource Center</h3>
            
            <div class="contact-info">
                <div class="contact-item">
                    <strong>Email:</strong>
                    <p>resources@university.edu</p>
                    <p>resource.requests@university.edu</p>
                </div>
                
                <div class="contact-item">
                    <strong>Phone:</strong>
                    <p>Main Office: (123) 456-7890</p>
                    <p>Resource Helpdesk: (123) 456-7891</p>
                </div>
                
                <div class="contact-item">
                    <strong>Address:</strong>
                    <p>University Library, Room 201<br>
                    123 University Avenue<br>
                    Campus, State 12345</p>
                </div>
                
                <div class="contact-item">
                    <strong>Office Hours:</strong>
                    <p>Monday - Friday: 9:00 AM - 5:00 PM</p>
                    <p>Saturday: 10:00 AM - 2:00 PM</p>
                    <p>Sunday: Closed</p>
                </div>
            </div>
            
            <div class="resource-request-info">
                <h3>Requesting New Resources</h3>
                <p>To request new resources for a course, please email us with the following information:</p>
                <ul>
                    <li>Your full name and student ID</li>
                    <li>Course code and title</li>
                    <li>Type of resource needed (books, lectures, videos, etc.)</li>
                    <li>Brief description of the resources you're requesting</li>
                </ul>
                <p>Our team will review your request and update the resource database accordingly.</p>
            </div>
        </div>
    </div>
</body>
</html>