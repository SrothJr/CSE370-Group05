<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// check admin
if ($_SESSION['isadmin']) {
    include 'adminHeader.php';
} else {
    include 'globalHeader.html';
}

// Initialize session variables
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; 
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = trim($_POST['password']);

    $new_hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE name = ? AND email = ?");
    $stmt->bind_param("sss", $new_hashed_password, $user_name, $user_email);

    if ($stmt->execute()) {
        header("Location: logout.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="css/hStyle.css"> <!-- Linking the CSS file -->
</head>
<body>

    <div class="profile-container">
        <h2>Change your password</h2>

        <!-- Profile Update Form -->
        <form method="POST" action="profile_update.php">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_name); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_email); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter a new password" required>
            </div>

            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>
