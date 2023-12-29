<!DOCTYPE html>
<html>
<head>
    <title>Bus Booking System</title>
    <style>
        body {
            background: linear-gradient(139.06deg, #2b3693 1.86%, #0a0e30 56.22%);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100%;
        }
        div.navbar {
            background-color: #333;
            overflow: hidden;
            text-align: center; /* Center-align the navigation bar */
        }
        div.navbar a {
            display: inline-block; /* Display links as inline-block to control spacing */
            color: white;
            text-align: center;
            padding: 16px 30px;
            text-decoration: none;
        }
        div.navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }
        .content {
            padding: 20px;
            text-align: center; /* Center-align the content */
        }
        h2 {
            color: #ddd;
            padding: 10px;
        }
        form {
            margin-top: 20px;
        }
        select {
            padding: 8px;
        }
        .routes-table {
            width: 80%;
            margin: 20px auto; /* Adjusted margin to include space between the form and table */
            color: #ddd;
            border-collapse: collapse;
        }
        .routes-table th,
        .routes-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .routes th {
            background-color: #333;
            color: white;
            padding: 10px;
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
        <div class="content routes">
            <h2>Welcome To Our Website!</h2>
            <h2>Your Bookings</h2>
            <table class="routes-table">
                <thead>
                    <tr>
                        <th>BookingID</th>
                        <th>RouteNo</th>
                        <th>BusNo</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Duration(hr)</th>
                        <th>Fare(Rs)</th>
                        <th>Seat</th>
                    </tr>
                </thead>
                <tbody>
    <?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['accountName'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

// If logged in, continue with your booking page content

// Connect to your database
$con = mysqli_connect("localhost", "root", "", "ids");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Get the logged-in username
$username = $_SESSION['accountName'];

// Perform a query to get the user details based on the username
$query = "SELECT * FROM login_ids WHERE username = '$username'";
$result = mysqli_query($con, $query);

// Check for errors and if there is a result
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the user details
    $userDetails = mysqli_fetch_assoc($result);

    // Now you can use $userDetails to get user-specific information
    // For example, $userDetails['FirstName'], $userDetails['LastName'], etc.
} else {
    // Redirect to the login page if the user details are not found
    header("Location: login.php");
    exit();
}

    // Get the logged-in username
    $username = $_SESSION['accountName'];

    // Perform a query to get the user details based on the username
    $query = "SELECT * FROM bookings WHERE bookingacc = '$username'";
    $result = mysqli_query($con, $query);

    // Check for errors and if there is a result
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch and display the booking details
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['bookingacc']}</td>";
            echo "<td>{$row['RouteNo']}</td>";
            echo "<td>{$row['BusNo']}</td>";
            echo "<td>{$row['source']}</td>";
            echo "<td>{$row['destination']}</td>";
            echo "<td>{$row['Duration']}</td>";
            echo "<td>{$row['Fare']}</td>";
            echo "<td>{$row['seats']}</td>";
            echo "</tr>";
        }
    } else {
        // Display a message if no bookings are found
        echo "<tr><td colspan='8'>No bookings found.</td></tr>";
    }

    // Close the database connection
    mysqli_close($con);
    ?>
</tbody>
            </table>
        </div>
    </div>
    <!-- Your JavaScript Code -->
</body>
</html>
