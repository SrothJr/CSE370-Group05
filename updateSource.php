<?php
session_start();
include("database.php");
    // check admin
if ($_SESSION['isadmin']) {
    include 'aheader.html';
} else {
    header("Location: homepage.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rStyle.css">
    <title>Update Resources</title>
</head>
<body>
    <!-- Form to get the course code for lookup -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Update Resource Links</h2>
        <p>Enter the course code to update its resources:</p>
        <br>
        <input type="text" name="lookup_code" required> <br>
        <input type="submit" name="lookup" value="Find Course"> <br>
    </form>

    <?php
    // First step: Find the course
    if (isset($_POST['lookup']) && !empty($_POST['lookup_code'])) {
        $lookup_code = filter_input(INPUT_POST, "lookup_code", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $lookup_sql = "SELECT * FROM resources WHERE course_code='$lookup_code'";
        $result = mysqli_query($conn, $lookup_sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <!-- Display the update form with current values -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Update Resources for <?php echo htmlspecialchars($row['course_code']); ?></h2>
                <input type="hidden" name="course_code" value="<?php echo htmlspecialchars($row['course_code']); ?>">
                
                Course Title: <br>
                <input type="text" name="course_title" value="<?php echo htmlspecialchars($row['course_title']); ?>" placeholder="Leave empty to keep current value"> <br>
                
                Link of Books folder: <br>
                <input type="text" name="books" value="<?php echo htmlspecialchars($row['books']); ?>" placeholder="Leave empty to keep current value"> <br>
                
                Link of Lectures folder: <br>
                <input type="text" name="lectures" value="<?php echo htmlspecialchars($row['lectures']); ?>" placeholder="Leave empty to keep current value"> <br>
                
                Link of Video folder: <br>
                <input type="text" name="videos" value="<?php echo htmlspecialchars($row['videos']); ?>" placeholder="Leave empty to keep current value"><br>
                
                <input type="submit" name="update" value="Update Resources">
                <input type="submit" name="delete" value="Delete Resources"> <br>
            </form>
            <?php
        } else {
            echo '<div class="message error">No course found. Go to <a href="provide.php">Provide Courses</a> to add resources</div>';
        }
    }

    // Second step: Process the update
    if (isset($_POST['delete']) && !empty($_POST['course_code'])) {
        $course_code = filter_input(INPUT_POST, "course_code", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "DELETE FROM resources WHERE course_code = '$course_code'";

        try{
            mysqli_query($conn, $sql);
            echo '<div class="message success">Course resources deleted successfully!</div>';
            }
            catch(mysqli_sql_exception) {
                echo '<div class="message error">Could not delete course resources</div>';
            }
    }
    if (isset($_POST['update']) && !empty($_POST['course_code'])) {
        // Get the course code from the hidden field
        $course_code = filter_input(INPUT_POST, "course_code", FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Build the SQL query dynamically
        $sql = "UPDATE resources SET ";
        $updateParts = array();
        
        // Check each field - only add to update if not empty
        if (!empty($_POST['course_title'])) {
            $course_title = filter_input(INPUT_POST, "course_title", FILTER_SANITIZE_SPECIAL_CHARS);
            $updateParts[] = "course_title='$course_title'";
        }
        
        if (!empty($_POST['books'])) {
            $books = filter_input(INPUT_POST, "books", FILTER_SANITIZE_SPECIAL_CHARS);
            $updateParts[] = "books='$books'";
        }
        
        if (!empty($_POST['lectures'])) {
            $lectures = filter_input(INPUT_POST, "lectures", FILTER_SANITIZE_SPECIAL_CHARS);
            $updateParts[] = "lectures='$lectures'";
        }
        
        if (!empty($_POST['videos'])) {
            $videos = filter_input(INPUT_POST, "videos", FILTER_SANITIZE_SPECIAL_CHARS);
            $updateParts[] = "videos='$videos'";
        }
        
        // Only proceed with update if there are fields to update
        if (count($updateParts) > 0) {
            // Complete the SQL query
            $sql .= implode(", ", $updateParts);
            $sql .= " WHERE course_code='$course_code'";
            
            // Execute the query
            try{
                mysqli_query($conn, $sql);
                echo '<div class="message success">Course resources updated successfully!</div>';
                }
                catch(mysqli_sql_exception) {
                    echo '<div class="message error">Could not update course resources</div>';
                }
        } else {
            echo '<div class="message">No changes were made. All fields were empty.</div>';
        }
    }

    mysqli_close($conn);
    ?>
</body>
</html>