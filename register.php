<?php
session_start();
include("connections.php");


if (isset($_POST['register'])) {
  if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $query = "SELECT * FROM db_users WHERE username='$username'";
      $result = mysqli_query($connections, $query);
      $count = mysqli_num_rows($result);
      if ($count == 1) {
        echo "Username already taken";
      } else {
        $query = "INSERT INTO db_users (username, password, email) VALUES ('$username', '$password', '$email')";
        $result = mysqli_query($connections, $query);
        if ($result) {
          echo "User created";
        } else {
          echo "Error creating user";
        }
      }
    } else {
      echo "Please fill out all fields";
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">


</head>

<body>
  <div class="nav">
    <div class="logo">
      <header>MiniBlog</header>
    </div>
  </div>
  <h1>Register</h1>
  <div class="log-form">
    <h2>See the Registration Rules</h2>
    <form action="register.php" method="POST">
      <input type="text" name="username" placeholder="Username">
      <input type="email" name="email" placeholder="Email">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" class="btnReg" name="register" value="Register">
      <div class="return-link-container">
        Return to the <a href="index.php" class="return-link">LOGIN PAGE</a>
      </div>
    </form>
  </div>
</body>

</html>