<?php
// --- Database connection (change credentials as needed) ---
$host = "localhost";
$username = "root";
$password = "";
$database = "student_complaint_db"; // 🔁 Change this

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Complaint</title>
    <style>
        body {
            background-image: url('https://previews.123rf.com/images/houbacze/houbacze1709/houbacze170900791/86616831-vector-illustration-background-complaint.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 500px;
            text-align: center;
        }
        h2 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #0056b3;
        }
        .message {
            margin-top: 15px;
            font-weight: bold;
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
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

    <script>
        // Get the category from URL
        const urlParams = new URLSearchParams(window.location.search);
        const category = urlParams.get('category') || "General";
        document.getElementById('category').value = category;
        document.getElementById('category-name').textContent = category.charAt(0).toUpperCase() + category.slice(1);
    </script>
</body>
</html>
