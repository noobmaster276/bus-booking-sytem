<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bus Booking System</title>
    <style>
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: linear-gradient(139.06deg, #2b3693 1.86%, #0a0e30 56.22%);
            font-family: Arial, sans-serif;
            color: white;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            text-align: center;
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
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
            text-align: center;
        }

        h1,
        h3 {
            font-family: Arial, sans-serif;
            color: white;
        }

        .seat {
            width: 50px;
            height: 50px;
            background-color: #ccc;
            margin: 5px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
            display: inline-block;
            color: #333;
        }

        .row {
            margin-bottom: 10px;
        }

        .selected {
            background-color: #00ff00;
        }

        .content {
            padding: 20px;
            text-align: center;
            color: #333;
        }

        .routes-table {
            width: 80%;
            margin: 20px auto;
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
        <h1>Select Seats</h1>
        <form method="post">
            <label for="route">
                <h3>Select Route:</h3>
            </label>
            <input type="hidden" id="selected-seat" name="seats" value="">
            <select id="route" name="route">
                <?php
                $con = mysqli_connect("localhost", "root", "", "ids");
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }

                $result = mysqli_query($con, "SELECT * FROM routes");
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['RouteNo']}'>{$row['source']} to {$row['destination']}</option>";
                    }
                } else {
                    echo "Error: " . mysqli_error($con);
                }

                mysqli_close($con);
                ?>
            </select>
            <br><br>

            <!-- Add input field for booking account -->
            <label for="bookingacc">
                <h3>Enter Booking Account:</h3>
            </label>
            <input type="text" id="bookingacc" name="bookingacc" required>
            <br><br>

            <div id="seat-container">
                <!-- Seat elements will be generated here using JavaScript -->
            </div>
            <br>

            <input type="submit" name="book" value="Book">
        </form>

        <script>
            // Example JavaScript for generating and selecting seats
            var seatContainer = document.getElementById("seat-container");
            var selectedSeat = null;

            for (var i = 1; i <= 30; i++) {
                if (i % 6 === 1) {
                    var row = document.createElement("div");
                    row.className = "row";
                    seatContainer.appendChild(row);
                }

                var seat = document.createElement("div");
                seat.className = "seat";
                seat.textContent = i;

                seat.addEventListener("click", function () {
                    if (selectedSeat !== null) {
                        selectedSeat.classList.remove("selected");
                    }

                    this.classList.add("selected");
                    selectedSeat = this;

                    // Set the selected seat value in a hidden input field
                    document.getElementById("selected-seat").value = this.innerText;
                });

                row.appendChild(seat);
            }
        </script>
        <?php
        $con = mysqli_connect("localhost", "root", "", "ids");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["book"])) {
            $route = isset($_POST["route"]) ? $_POST["route"] : '';
            $selectedSeat = isset($_POST["seats"]) ? $_POST["seats"] : '';
            $bookingacc = isset($_POST["bookingacc"]) ? $_POST["bookingacc"] : '';

            if (!empty($selectedSeat) && !empty($bookingacc)) {
                // Fetch additional details from the routes table
                $query = "SELECT * FROM routes WHERE RouteNo = '$route'";
                $result = mysqli_query($con, $query);

                // Check if the query was successful and rows were returned
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    // Extracting values from the fetched row
                    $busNo = $row["BusNo"];
                    $source = $row["source"];
                    $destination = $row["destination"];
                    $duration = $row["Duration"];
                    $fare = $row["Fare"];

                    // Insert booking information into the bookings table
                    $query = "INSERT INTO bookings (bookingacc, RouteNo, BusNo, source, destination, Duration, Fare, seats) 
                          VALUES ('$bookingacc', '$route', '$busNo', '$source', '$destination', '$duration', '$fare', '$selectedSeat')";
                    mysqli_query($con, $query);

                    echo "You have successfully booked seat $selectedSeat from $source to $destination.";
                } else {
                    echo "Error fetching route details. Please try again.";
                }
            } else {
                echo "<br>Please select a seat and enter a booking account.";
            }
        }
        ?>

    </div>
</body>

</html>
