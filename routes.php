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
            font-size: 14px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: white;
        }

        form {
            margin-top: 20px;
        }

        select {
            padding: 8px;
        }

        .routes-table {
            width: 80%;
            margin: 20px auto;
            /* Adjusted margin to include space between the form and table */
            color: #ddd;
            border-collapse: collapse;
        }

        .routes-table th,
        .routes-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: medium;
        }

        .routes th {
            background-color: #333;
            color: white;
            padding: 10px;
        }

        div.navbar {
            background-color: #333;
            overflow: hidden;
            text-align: center;
            /* Center-align the navigation bar */
        }

        div.navbar a {
            display: inline-block;
            /* Display links as inline-block to control spacing */
            color: white;
            text-align: center;
            padding: 16px 30px;
            text-decoration: none;
        }

        div.navbar a:hover {
            background-color: #ddd;
            color: black;
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
        <h1>Routes</h1>
        <table class="routes-table">
            <tr>
                <th>RouteNo</th>
                <th>BusNo</th>
                <th>From</th>
                <th>To</th>
                <th>Duration(hr)</th>
                <th>Fare(Rs)</th>
            </tr>
            <?php
            $con = mysqli_connect("localhost", "root", "", "ids");
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }

            $result = mysqli_query($con, "SELECT * FROM routes");
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['RouteNo']}</td>";
                    echo "<td>{$row['BusNo']}</td>";
                    echo "<td>{$row['source']}</td>";
                    echo "<td>{$row['destination']}</td>";
                    echo "<td>{$row['Duration']}</td>";
                    echo "<td>{$row['Fare']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "Error: " . mysqli_error($con);
            }

            mysqli_close($con);
            ?>
        </table>
    </div>
</body>

</html>
