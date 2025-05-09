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
    <link rel="stylesheet" href="./css/faqStyles.css">
    <title>FAQs - Student Complaint System</title>
</head>
<body>

<div class="faq-page-container">
    <h1 class="faq-page-title">Frequently Asked Questions</h1>

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
            <p>Check Updates for any improvements, a mail will be sent to the user of the complaint.</p>
        </div>

        <div class="faq">
            <h3>Is my complaint anonymous?</h3>
            <p>No, complaints are linked to your student ID. However, your identity is only visible to the administrative staff.</p>
        </div>
    </div>
</div>

</body>
</html>