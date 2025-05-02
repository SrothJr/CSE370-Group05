<?php
// --- Database connection (change credentials as needed) ---
$host = "localhost";
$username = "root";
$password = "";
$database = "student_complaint_db";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Handle form submission ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $category = $_POST["category"];

    $stmt = $conn->prepare("INSERT INTO complaints (title, description, category) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $category);

    if ($stmt->execute()) {
        $success = "✅ Complaint submitted successfully!";
    } else {
        $error = "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!-- Complaint Page HTML -->
<div class="complaint-form-wrapper">
    <a href="categorizeComplaints.php" class="back-button">← Back</a>

    <div class="complaint-form-container">
        <h2>Submit a Complaint</h2>
        <p>Category: <span id="category-name"></span></p>

        <form id="complaintForm" method="POST">
            <input type="text" id="title" name="title" placeholder="Complaint Title" required>
            <textarea id="description" name="description" placeholder="Describe the issue" required></textarea>
            <input type="hidden" id="category" name="category">
            <button type="submit">Submit</button>
        </form>

        <?php if (isset($success)) echo "<div class='message'>$success</div>"; ?>
        <?php if (isset($error)) echo "<div class='message error'>$error</div>"; ?>

    </div>
</div>
<style>
    .complaint-form-wrapper {
        background-image: url('https://previews.123rf.com/images/houbacze/houbacze1709/houbacze170900791/86616831-vector-illustration-background-complaint.jpg');
        background-size: cover;
        background-position: center;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        min-height: 100vh;
        width: 100%;
    }
    .complaint-form-container {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        width: 500px;
        text-align: center;
    }
    .complaint-form-container h2 {
        color: #333;
        font-size: 2rem;
        margin-bottom: 20px;
    }
    .complaint-form-container input,
    .complaint-form-container textarea {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .complaint-form-container button {
        background: #007bff;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    .complaint-form-container button:hover {
        background: #0056b3;
    }
    .complaint-form-container .message {
        margin-top: 15px;
        font-weight: bold;
        color: green;
    }
    .complaint-form-container .error {
        color: red;
    }
	.back-button {
        display: inline-block;
		margin-bottom: 20px;
		text-decoration: none;
		color: #fff;
		background-color: #F76806;
		padding: 8px 16px;
		border-radius: 6px;
		font-weight: bold;
		transition: background-color 0.3s;
    }

	.back-button:hover {
		background-color: #FEBA4F;
		color: black;
	}
</style>

<script>
    // Set category from URL
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category') || "General";
    document.getElementById('category').value = category;
    document.getElementById('category-name').textContent = category.charAt(0).toUpperCase() + category.slice(1);
</script>
