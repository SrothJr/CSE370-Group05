<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize session variables
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; 
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="css/profile.css"> <!-- Linking the CSS file -->
</head>
<body>
    <header class="page-header">
        <div class="header-title">Update Your Profile</div>
        <a href="homepage.php" class="back-home-btn">Back to Homepage</a>
    </header>

    <div class="profile-container">
        <h2>Update Your Profile Information</h2>

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
                <input type="password" id="password" name="password" placeholder="Enter a new password (optional)">
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
