<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['accountName'])) {
    header("Location: login.php");
    exit();
}

// Simulated database connection (replace with your actual database connection)
$con = mysqli_connect("localhost", "root", "", "ids");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieve user data from the database
$accountName = $_SESSION['accountName'];
$query = "SELECT * FROM login_ids WHERE username = '$accountName'";
$result = mysqli_query($con, $query);

// Check for errors
if (!$result) {
    die('Query failed: ' . mysqli_error($con));
}

// Fetch user data
$userData = mysqli_fetch_assoc($result);

// Handle updating email
if (isset($_POST['updateEmail'])) {
    $newEmail = mysqli_real_escape_string($con, $_POST['newEmail']);
    $updateEmailQuery = "UPDATE login_ids SET email_id = '$newEmail' WHERE username = '$accountName'";
    if (mysqli_query($con, $updateEmailQuery)) {
        echo "<script>alert('Email updated successfully.');</script>";
        // Refresh user data after update
        $result = mysqli_query($con, $query);
        $userData = mysqli_fetch_assoc($result);
    } else {
        echo "Error updating email: " . mysqli_error($con);
    }
}

// Handle updating password
if (isset($_POST['updatePassword'])) {
    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
    $updatePasswordQuery = "UPDATE login_ids SET password = '$newPassword' WHERE username = '$accountName'";
    if (mysqli_query($con, $updatePasswordQuery)) {
        echo "<script>alert('Password updated successfully.');</script>";
    } else {
        echo "Error updating password: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile Page</title>
    <style>
        body {
            width: 100vw;
            height: 100vh;
            background: linear-gradient(139.06deg, #2b3693 1.86%, #0a0e30 56.22%);
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            text-align: center;
            width: 100%;
        }

        .navbar a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 16px 30px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            width: 100%;
            text-align: justify;
            margin-top: 20px;
        }

        h1, h2 {
            color: #333;
        }

        h2 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-top: 20px;
        }

        p {
            line-height: 1.6;
        }

        form {
            margin-top: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="home_page.php">HOME</a>
        <a href="routes.php">ROUTES</a>
        <a href="bus_booking.php">BOOK</a>
        <a href="bookings.php">BOOKINGS</a>
        <a href="help.php">HELP</a>
        <a href="profile.php">PROFILE</a>
    </div>
    <div class="container">
        <h1>Welcome, <?php echo $userData['username']; ?>!</h1>

        <h2>Your Profile</h2>
        <p>Email: <?php echo $userData['email_id']; ?></p>

        <h2>Update Profile</h2>
        <form action="#" method="post">
            <label for="newEmail">New Email:</label>
            <input type="text" id="newEmail" name="newEmail" required>
            <button type="submit" name="updateEmail">Update Email</button>
        </form>

        <form action="#" method="post">
            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required>
            <button type="submit" name="updatePassword">Update Password</button>
        </form>
    </div>
</body>
</html>
