<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('config.php'); // Include the database connection file

// Get the user ID from session
$user_id = $_SESSION['user_id'];

// Initialize error message
$error_message = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Basic validation (optional)
    if (empty($name) || empty($email)) {
        $error_message = "Name and Email are required!";
    } else {
        // Update the user profile in the database
        $update_query = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        
        // Prepare the statement
        if ($stmt = $conn->prepare($update_query)) {
            $stmt->bind_param("ssi", $name, $email, $user_id); // Bind the parameters
            $stmt->execute(); // Execute the query

            // Check if password is provided
            if (!empty($password)) {
                // Hash the password before updating
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $update_password_query = "UPDATE users SET password = ? WHERE id = ?";
                
                // Update the password if it's provided
                if ($stmt = $conn->prepare($update_password_query)) {
                    $stmt->bind_param("si", $hashed_password, $user_id); // Bind parameters for password update
                    $stmt->execute(); // Execute password update
                }
            }

            // Update the session variables
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;

            // Redirect back to the profile page
            header("Location: profile.php");
            exit();
        } else {
            $error_message = "Failed to update profile. Please try again.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <header class="page-header">
        <div class="header-title">Update Your Profile</div>
        <a href="homepage.php" class="back-home-btn">Back to Homepage</a>
    </header>

    <div class="profile-container">
        <h2>Update Your Profile Information</h2>

        <!-- Display any error message -->
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Profile Update Form -->
        <form method="POST" action="profile_update.php">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">New Password (optional)</label>
                <input type="password" id="password" name="password" placeholder="Enter a new password">
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
