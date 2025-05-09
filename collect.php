<?php
session_start();
include("database.php");
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

    <title>Collect Resources</title>
</head>
<body>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h2>Collect Resources</h2>
        Course Code: <br>
        <input type="text" name="course_code" required> <br>
        <input type="submit" name="submit" value="submit"><br>
</body>
</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $course_code = filter_input(INPUT_POST, "course_code", FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "SELECT * FROM resources WHERE course_code='$course_code'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="resource-links">';
        $row = mysqli_fetch_assoc($result);
        echo "<h2>" . strtoupper(htmlspecialchars($row['course_code'])) . " : " . htmlspecialchars($row['course_title']) . "</h2>" . "<br>";
        echo '<a href="' . htmlspecialchars($row['books']) . '">Books</a>' . '<br>';
        echo '<a href="' . htmlspecialchars($row['lectures']) . '">Lectures</a>' . "<br>";
        echo '<a href="' . htmlspecialchars($row['videos']) . '">Videos</a>'. "<br>";
        echo '</div>';
    }
    else {
        echo '<div class="message error">NO RESOURCES FOUND</div>';
    }
}



    mysqli_close($conn)
?>