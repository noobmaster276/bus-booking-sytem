<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(139.06deg, #2b3693 1.86%, #0a0e30 56.22%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .form {
            display: flex;
            flex-direction: column;
            width: 250px;
            margin: 10px;
        }

        h2 {
            text-align: center;
            margin: 10px 0;
        }

        input {
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
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

    <div class="container">
        <form class="form" method="post">
            <h2>Sign Up</h2>
            <input type="text" name="signupUsername" placeholder="Username" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="signupPassword1" placeholder="Password" required>
            <input type="password" name="signupPassword" placeholder="Confirm Password" required>
            <button type="submit" name="submit">Sign Up</button>
            <div class="login">
                <a href="login.php">Already have an account? Log in</a>
            </div>
        </form>
    </div>

    <?php
    $con = mysqli_connect("localhost", "root", "", "ids");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($con, $_POST['signupUsername']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['signupPassword1']);


        $query = "INSERT INTO login_ids (username, email_id, password) VALUES ('$username', '$email', '$password')";

        if (mysqli_query($con, $query)) {
            $message = "Registration Successful!";
            echo "<script>alert('$message');</script>";
            header("Location: login.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }

    mysqli_close($con);
    ?>

</body>

</html>
