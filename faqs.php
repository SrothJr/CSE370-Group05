<?php
// Check if a session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'database.php';

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
<?php
    if ($_SESSION['isadmin']) {

?>

<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" style="margin-top: 30px;">
        <h2>Add Frequently Asked Questions</h2>
        Question: <br>
        <input type="text" name="question" required> <br>
        Answer: <br>
        <input type="text" name="answer" required> <br>
        <input type="submit" name="submit" value="submit"> <br>


    </form>
<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = filter_input(INPUT_POST, "question", FILTER_SANITIZE_SPECIAL_CHARS);
    $answer = filter_input(INPUT_POST, "answer", FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "INSERT INTO faqs (question, answer) VALUES ('$question', '$answer')";
    
    try{
        mysqli_query($conn, $sql);
        echo '<div class="message success">Successfully Added FAQ</div>';
        }
        catch(mysqli_sql_exception) {
            echo '<div class="message error">Could not Add FAQ</div>';
        }
}
    }
?>


<?php

    $all = "SELECT * FROM faqs";
    $result = mysqli_query($conn, $all);
    
    echo '<div class="faq-page-container">
    <h1 class="faq-page-title">Frequently Asked Questions</h1>
    <div class="faq-container">';
    
    while ($row = mysqli_fetch_assoc($result)){
        echo '<div class="faq">
            <h3>' . htmlspecialchars($row['question']) . '</h3>
            <p>' . htmlspecialchars($row['answer']) . '</p>
        </div>';
    }
    echo '</div></div>';

?>

</body>
</html>