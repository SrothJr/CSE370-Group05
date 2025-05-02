<?php
    include("header.html");
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rStyle.css">
    <title>Provide Resources</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h2>Provide your sauces</h2>
        Course Code: <br>
        <input type="text" name="course_code"> <br>
        Course Title: <br>
        <input type="text" name="course_title"> <br>
        Link of Books folder: <br>
        <input type="text" name="books"> <br>
        Link of Lectures folder: <br>
        <input type="text" name="lectures"> <br>
        Link of Video folder: <br>
        <input type="text" name="videos"><br>
        <input type="submit" name="submit" value="submit"> <br>


    </form>
</body>
</html>




<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_code = filter_input(INPUT_POST, "course_code", FILTER_SANITIZE_SPECIAL_CHARS);
        $course_title = filter_input(INPUT_POST, "course_title", FILTER_SANITIZE_SPECIAL_CHARS);
        $books = filter_input(INPUT_POST, "books", FILTER_SANITIZE_SPECIAL_CHARS);
        $lectures = filter_input(INPUT_POST, "lectures", FILTER_SANITIZE_SPECIAL_CHARS);
        $videos = filter_input(INPUT_POST, "videos", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "INSERT INTO resources (course_code, course_title, books, lectures, videos) VALUES ('$course_code', '$course_title','$books', '$lectures', '$videos')";

        try{
            mysqli_query($conn, $sql);
            echo '<div class="message success">Successfully Provided</div>';
            }
            catch(mysqli_sql_exception) {
                echo '<div class="message error">Could not provide</div>';
            }


    }


    mysqli_close($conn);
?>