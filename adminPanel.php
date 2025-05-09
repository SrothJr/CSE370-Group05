<?php
session_start();
include("database.php");
// check admin
if ($_SESSION['isadmin']) {
    include('adminHeader.php');
} else {
    header("Location: homepage.php");
}


// Handle status update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_status'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];

        $updateQuery = "UPDATE complaints SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Handle delete complaint
    if (isset($_POST['delete_complaint'])) {
        $id = $_POST['id'];

        $deleteQuery = "DELETE FROM complaints WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch all complaints
$result = $conn->query("SELECT * FROM complaints ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="./css/headerStyles.css">   -->
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

        form.inline {
            display: inline;
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
            <th>Actions</th>
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
                    <!-- Update form -->
                    <form method="POST" class="inline">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <select name="status">
                            <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Resolved" <?= $row['status'] === 'Resolved' ? 'selected' : '' ?>>Resolved</option>
                            <option value="Rejected" <?= $row['status'] === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                        </select>
                        <button type="submit" name="update_status">Update</button>
                    </form>

                    <!-- Delete form -->
                    <form method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this complaint?');">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <button type="submit" name="delete_complaint" style="background-color: #ff4d4d; color: white;">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
