<?php
// Check if a session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs</title>
    <style> 
        .faq-container {
            margin-top: 20px;
        }

        .faq {
            background: #FFF388; /* Yellow background */
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        
		
        .faq h3 {
            color: #ff758c; /* Pink heading */
            margin-bottom: 5px;
        }

        .faq p {
            color: #000;
        }

    </style>
</head>
<body>

<h2 style="color: white;">Frequently Asked Questions (FAQs)</h2>

<div class="faq-container">
    <div class="faq">
        <h3>How do I submit a complaint?</h3>
        <p>You can submit a complaint by clicking on the "Create Complaints" option in the sidebar and filling out the complaint form.</p>
    </div>

    <div class="faq">
        <h3>Can I edit my complaint after submission?</h3>
        <p>No, currently, complaints cannot be edited after submission. Please make sure to review your complaint before submitting.</p>
    </div>

    <div class="faq">
        <h3>How does the voting system work?</h3>
        <p>Users can upvote or downvote complaints. This helps in prioritizing issues that require urgent attention.</p>
    </div>

    <div class="faq">
        <h3>How do I know my complaint has been resolved?</h3>
        <p>Check Updates for any improvements, a mail will be sent to the user of the complaint. </p>
    </div>

    <div class="faq">
        <h3>Is my complaint anonymous?</h3>
        <p>No, complaints are linked to your student ID. However, your identity is only visible to the administrative staff.</p>
    </div>
	
</div>

</body>
</html>