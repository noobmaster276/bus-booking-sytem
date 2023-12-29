<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
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

    .login{
      position: relative;
      left: 20px;
      color:white;
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
      <h2>Log in</h2>
      <input type="text" name="signupUsername" placeholder="Username" required>
      <input type="password" name="signupPassword" placeholder="Password" required>
      <button type="submit">Log in</button>
      <a href="signup.php">Don't have an account? Sign up</a>
    </form>
  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = mysqli_connect("localhost", "root", "", "ids");

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
    mysqli_query($con,"use ids");
    $username = mysqli_real_escape_string($con, $_POST['signupUsername']);
    $password = mysqli_real_escape_string($con, $_POST['signupPassword']);
    session_start();
    $_SESSION['accountName'] = $username;
    $query = "SELECT * FROM login_ids WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      header("Location: home_page.php");
      exit;
      // Redirect to another page or perform further actions as needed
    } else {
      $message = "Wrong id or ,password";
      echo "<script>alert('$message');</script>";
    }

    mysqli_close($con);
  }
  ?>

</body>
</html>
