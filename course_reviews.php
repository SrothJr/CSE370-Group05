<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('database.php');

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['isadmin']) {
    include 'adminHeader.php';
} else {
    include 'globalHeader.html';
}

$user_id = $_SESSION['user_id'];

// Fetch all courses from the database
$courses = [];
$result = $conn->query("SELECT course_code FROM courses ORDER BY course_code ASC");
while ($row = $result->fetch_assoc()) {
    $courses[] = $row['course_code'];
}

// Handle search and reset
$search_course = strtoupper(trim($_GET['search'] ?? ''));
if (isset($_GET['reset'])) {
    $search_course = '';
}
$filtered_courses = $search_course && in_array($search_course, $courses) ? [$search_course] : $courses;

$messages = [];

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_code = $_POST['course_code'] ?? '';
    $rating = intval($_POST['rating'] ?? 0);
    $comment = trim($_POST['comment'] ?? '');

    if (in_array($course_code, $courses) && $rating >= 1 && $rating <= 5 && !empty($comment)) {
        $stmt = $conn->prepare("INSERT INTO course_reviews (user_id, course_code, rating, comment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $user_id, $course_code, $rating, $comment);
        if ($stmt->execute()) {
            $messages[$course_code] = "✅ Review for $course_code submitted successfully.";
        } else {
            $messages[$course_code] = "❌ Error submitting review for $course_code.";
        }
        $stmt->close();

        // After submit, show only that course
        $filtered_courses = [$course_code];
    } else {
        $messages[$course_code] = "⚠️ Invalid input for $course_code.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/headerStyles.css">  
    <title>Course Reviews</title>
    <style>
        body {
            background-color: #FFC0C0;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            color: #000;
        }
        .course-box {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 15px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        }
        textarea, select, input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
        }
        button {
            background-color: #FEBA4F;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background-color: #F76806;
            color: white;
        }
        .review {
            background-color: #f1f1f1;
            padding: 10px;
            margin: 10px 0;
            border-left: 5px solid #F76806;
            border-radius: 5px;
        }
        .message {
            padding: 10px;
            background-color: yellow;
            margin-bottom: 10px;
            border-radius: 8px;
        }
        .search-form {
            margin-bottom: 30px;
        }
    </style>
</head>
<!-- <a href="homepage.php">
    <button style="background-color: #FEBA4F; color: black; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer;">
        ⬅️ Back to Homepage
    </button>
</a> -->

<body>

<?php
// Admin access to add courses for review
if($_SESSION['isadmin']) {
    echo '<form action="course_reviews.php" method="post">
        <h2>Add Courses to review</h2>
        Course Code: <br>
        <input type="text" name="course_code" required> <br>
        Course Title: <br>
        <input type="text" name="course_title" required> <br>
        <input type="submit" name="submit" value="submit"> <br>
        </form>';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_code_a = strtoupper(filter_input(INPUT_POST, "course_code", FILTER_SANITIZE_SPECIAL_CHARS));
        $course_title_a = filter_input(INPUT_POST, "course_title", FILTER_SANITIZE_SPECIAL_CHARS);

        $sqla = "INSERT INTO courses (course_code, course_title) VALUES ('$course_code_a', '$course_title_a')";

        try{
            mysqli_query($conn, $sqla);
            echo '<div class="message">Course Added Successfully</div>';
        } 
        catch (mysqli_sql_exception) {
            echo '<div class="message">Could not add course</div>';
        }
    }
}

?>

<h2>Review Your Courses</h2>

<!-- Search Form -->
<form method="get" action="course_reviews.php" class="search-form">
    <label for="search">Search Course by Code:</label>
    <input type="text" id="search" name="search" placeholder="e.g., CSE220" value="<?php echo htmlspecialchars($search_course); ?>">
    <button type="submit">Search</button>
    <button type="submit" name="reset" value="1">Reset</button>
</form>

<?php
if ($search_course && !in_array($search_course, $courses)) {
    echo '<div class="message">No such course found in database</div>';
}
?>

<?php foreach ($filtered_courses as $course_code): ?>
    <div class="course-box">
        <h3><?php echo $course_code; ?></h3>

        <?php if (isset($messages[$course_code])): ?>
            <div class="message"><?php echo htmlspecialchars($messages[$course_code]); ?></div>
        <?php endif; ?>

        <!-- Review Form -->
        <form method="post">
            <input type="hidden" name="course_code" value="<?php echo $course_code; ?>">
            <label for="rating_<?php echo $course_code; ?>">Rating:</label>
            <select name="rating" id="rating_<?php echo $course_code; ?>" required>
                <option value="">-- Select Rating --</option>
                <option value="1">1 - Very Poor</option>
                <option value="2">2 - Poor</option>
                <option value="3">3 - Average</option>
                <option value="4">4 - Good</option>
                <option value="5">5 - Excellent</option>
            </select>

            <label for="comment_<?php echo $course_code; ?>">Comment:</label>
            <textarea name="comment" id="comment_<?php echo $course_code; ?>" placeholder="Write your review..." required></textarea>

            <button type="submit">Submit Review</button>
        </form>

        <!-- Show existing reviews -->
        <?php
        $stmt = $conn->prepare("SELECT rating, comment, review_date FROM course_reviews WHERE course_code = ? ORDER BY review_date DESC LIMIT 3");
        $stmt->bind_param("s", $course_code);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<h4>Recent Reviews:</h4>";
        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
            <div class="review">
                <strong>Rating: <?php echo $row['rating']; ?>/5</strong><br>
                <p><?php echo htmlspecialchars($row['comment']); ?></p>
                <em>Reviewed on: <?php echo $row['review_date']; ?></em>
            </div>
        <?php
            endwhile;
        else:
            echo "<p>No reviews yet.</p>";
        endif;
        $stmt->close();
        ?>
    </div>
<?php endforeach; ?>

</body>
</html>
