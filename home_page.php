<!DOCTYPE html>
<html>

<head>
    <title>Bus Booking System</title>
    <style>
        body {
            width: 100vw;
            height: 100%;
            background: linear-gradient(139.06deg, #2b3693 1.86%, #0a0e30 56.22%);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        div.content {
            padding: 20px;
            text-align: center; /* Center-align the content */
        }

        h1 {
            color: white;
            font-family: monospace;

        }

        h2{
            text-align: center;
            color: white;
            font-family: monospace;
        }

        form {
            margin-top: 20px;
        }

        select {
            padding: 8px;
        }
        .container{
            display : flex;
        }
        .intro{
            text-align: center;
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
    <div class="content">
        <br>
        <h1>Welcome To Our Website, Blue Bus!</h1>
        <br>
    </div>
    <div class="intro">
        <h2>Navigate Your Journey with Ease: Book Your Bus Adventure Today!</h2>
        <img src="bus.jpeg" alt="bus picture" width="400" height="400">
    </div>
    
    <script type="text/javascript">

    </script>
    <?php
    $con = mysqli_connect("localhost", "root");
    if (mysqli_connect_errno()) {
        echo "" . mysqli_connect_error();
    }
    mysqli_query($con, "create database if not exists Booking");
    if (mysqli_errno($con)) {
        echo "";
    }
    ?>
</body>

</html>
