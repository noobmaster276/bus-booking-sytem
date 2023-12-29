<?php
session_start();

// Simulated database connection (replace with your actual database connection)
$con = mysqli_connect("localhost", "root", "", "ids");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $complaintMessage = mysqli_real_escape_string($con, $_POST['complaintMessage']);

    // Insert data into the 'help' table
    $insertQuery = "INSERT INTO help (name, phone, email, complaint_message) VALUES ('$name', '$phone', '$email', '$complaintMessage')";
    if (mysqli_query($con, $insertQuery)) {
        echo "<script>alert('Complaint submitted successfully.');</script>";
    } else {
        echo "Error submitting complaint: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Help Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(139.06deg, #2b3693 1.86%, #0a0e30 56.22%);
            color: #fff;
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
            margin: 20px auto;
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        h2 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #333;
        }

        input, textarea {
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
        <h1>Help Center</h1>

        <h2>Submit a Complaint</h2>
        <form action="#" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="complaintMessage">Complaint Message:</label>
            <textarea id="complaintMessage" name="complaintMessage" rows="4" required></textarea>

            <button type="submit">Submit Complaint</button>
        </form>
    </div>
</body>
</html>
