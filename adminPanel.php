<?php
// Database connection settings
$host = "localhost";
$user = "root";
$password = "";
$database = "student_complaint_db"; // Make sure this database exists!

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle status update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'], $_POST['status'], $_POST['id'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    // Update complaints table
    $updateQuery = "UPDATE complaints SET status = '$status' WHERE id = $id";
    $conn->query($updateQuery);

    // Try to update adminsee
    $updateAdmin = $conn->query("UPDATE adminsee SET status = '$status' WHERE id = $id");

    // If no row was updated in adminsee, insert it
    if ($conn->affected_rows === 0) {
        // Get complaint info
        $result = $conn->query("SELECT * FROM complaints WHERE id = $id");
        if ($result && $row = $result->fetch_assoc()) {
            $title = $conn->real_escape_string($row['title']);
            $desc = $conn->real_escape_string($row['description']);
            $cat = $conn->real_escape_string($row['category']);
            $created = $row['created_at'];

            // Insert into adminsee if no corresponding row exists
            $conn->query("INSERT INTO adminsee (id, title, description, category, status, created_at) 
                          VALUES ($id, '$title', '$desc', '$cat', '$status', '$created')");
        }
    }
}

// Fetch all complaints
$result = $conn->query("SELECT * FROM complaints ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Complaint Management</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?fit=crop&w=1950&q=80') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 40px;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            font-size: 2.5em;
            color: #00ffc8;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: rgba(0, 0, 0, 0.6);
            color: #00ffc8;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        tr:hover {
            background-color: rgba(0, 255, 200, 0.15);
        }

        select, button {
            padding: 5px 10px;
            border-radius: 4px;
            border: none;
            margin-right: 5px;
        }

        select {
            background-color: #ffffff;
            color: #333;
        }

        button {
            background-color: #00ffc8;
            color: #000;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #00e6b0;
        }

        @media (max-width: 768px) {
            th, td {
                font-size: 0.9em;
                padding: 10px;
            }

            h2 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
<div class="overlay">
    <h2>Admin Panel - View & Manage Complaints</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td><?= htmlspecialchars($row['category']); ?></td>
                <td><?= $row['status']; ?></td>
                <td><?= $row['created_at']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <select name="status">
                            <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Resolved" <?= $row['status'] === 'Resolved' ? 'selected' : '' ?>>Resolved</option>
                            <option value="Rejected" <?= $row['status'] === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                        </select>
                        <button type="submit" name="update_status">Update</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
