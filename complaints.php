<?php
session_start(); // Ensure session starts at the top of the page

include 'database.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

if ($_SESSION['isadmin']) {
    include 'adminHeader.php';
} else {
    include 'globalHeader.html';
}

$user_id = $_SESSION['user_id']; // Retrieve the user's ID from the session

// Handle voting mechanism
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vote_type'])) {
    $complaint_id = $_POST['complaint_id'];
    $vote_type = $_POST['vote_type'];

    // Check if the user has already voted on this complaint
    $check = $conn->prepare("SELECT * FROM votes WHERE complaint_id = ? AND user_id = ?");
    $check->bind_param("ii", $complaint_id, $user_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Update the vote if the user has already voted
        $update = $conn->prepare("UPDATE votes SET vote_type = ? WHERE complaint_id = ? AND user_id = ?");
        $update->bind_param("sii", $vote_type, $complaint_id, $user_id);
        $update->execute();
        $update->close();
    } else {
        // Insert a new vote
        $insert = $conn->prepare("INSERT INTO votes (complaint_id, user_id, vote_type) VALUES (?, ?, ?)");
        $insert->bind_param("iis", $complaint_id, $user_id, $vote_type);
        $insert->execute();
        $insert->close();
    }
}

// Fetch complaints based on category filter
$category_filter = "";
$params = [];
$sql = "
    SELECT c.id, c.title, c.description, c.category, c.created_at,
        SUM(CASE WHEN v.vote_type = 'upvote' THEN 1 ELSE 0 END) AS upvotes,
        SUM(CASE WHEN v.vote_type = 'downvote' THEN 1 ELSE 0 END) AS downvotes,
        c.user_id
    FROM complaints c
    LEFT JOIN votes v ON c.id = v.complaint_id
";

// Check if a category is selected
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category_filter = $_GET['category'];
    $sql .= " WHERE c.category = ?"; // Filter complaints by selected category
    $params[] = $category_filter;
}

$sql .= " GROUP BY c.id ORDER BY c.created_at DESC"; // Sort complaints by creation date

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param("s", $params[0]);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<header class="page-header">
    
    <div class="header-title">Complaints</div>
    <!-- <a href="homepage.php" class="back-home-btn">Back to Homepage</a> -->
</header>

<div style="text-align:center; margin-top: 20px;">
    <strong>Filter by Category:</strong>
    <form method="GET" action="complaints.php" style="display: inline-block; margin-left: 10px;">
        <select name="category" onchange="this.form.submit()">
            <option value="">Select Category</option>
            <?php
                // Define available categories
                $categories = [
                    "academic" => "Academic",
                    "facilities" => "Facilities",
                    "administration" => "Administration",
                    "student_services" => "Student Services",
                    "others" => "Others"
                ];
                
                // Add 'All' category to the dropdown
                echo "<option value='all'" . ($category_filter === "" ? " selected" : "") . ">All</option>";

                // Loop through each category and generate the option elements
                foreach ($categories as $key => $label) {
                    $selected = ($key === $category_filter) ? "selected" : "";
                    echo "<option value=\"$key\" $selected>$label</option>";
                }
            ?>
        </select>
    </form>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
    }
    .complaint-card {
        background: #fff;
        padding: 20px;
        margin: 20px auto;
        max-width: 800px;
        border-radius: 10px;
        box-shadow: 0 0 10px #ccc;
    }
    .vote-form {
        margin-top: 10px;
    }
    .vote-form button {
        padding: 5px 10px;
        margin-right: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }
    .upvote { background-color: #28a745; color: white; }
    .downvote { background-color: #dc3545; color: white; }
    .header-title {
        text-align: center;
        font-size: 2rem;
        margin-top: 20px;
        font-weight: bold;
    }
    .back-home-btn {
        display: block;
        text-align: center;
        margin: 10px auto;
        width: 200px;
        background-color: #F76806;
        color: black;
        padding: 10px;
        text-decoration: none;
        border-radius: 8px;
    }
    .back-home-btn:hover {
        background-color: #FEBA4F;
    }
</style>

<div class="content">
    <h2 style="text-align:center;">
        <?php echo $category_filter && $category_filter !== 'all' ? ucfirst($category_filter) . " Complaints" : "All Complaints"; ?>
    </h2>

    <?php if ($result->num_rows === 0): ?>
        <p style="text-align:center;">No complaints found in this category.</p>
    <?php endif; ?>

    <?php while ($row = $result->fetch_assoc()) : ?>
        <div class="complaint-card">
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
            <p><strong>Submitted:</strong> <?php echo $row['created_at']; ?></p>
            <?php
                if($_SESSION['isadmin']){
                    $user = htmlspecialchars($row['user_id']);
                    $sql2 = "SELECT id, name, email FROM users WHERE id=$user";
                    
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);

                    echo "<p><strong>User ID: </strong>" . htmlspecialchars($row2['id']) . "</p>";
                    echo "<p><strong>User Name: </strong>" . htmlspecialchars($row2['name']) . "</p>";
                    echo "<p><strong>User Email: </strong>" . htmlspecialchars($row2['email']) . "</p>";
                }
            ?>
            <form method="POST" class="vote-form">
                <input type="hidden" name="complaint_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="vote_type" value="upvote" class="upvote">👍 <?php echo $row['upvotes']; ?></button>
                <button type="submit" name="vote_type" value="downvote" class="downvote">👎 <?php echo $row['downvotes']; ?></button>
            </form>
        </div>
    <?php endwhile; ?>
</div>
