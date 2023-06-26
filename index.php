<!-- login form -->
<?php
session_start();
include("connections.php");


$email = $password = "";
$emailErr = $passwordErr = "";

if (isset($_POST["btnLogin"])) {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    if ($email && $password) {
        $check_email = mysqli_query($connections, "SELECT * FROM db_users WHERE email='$email'");
        $check_row = mysqli_num_rows($check_email);

        if ($check_row == 1) {
            $fetch = mysqli_fetch_assoc($check_email);
            $db_password = $fetch["password"];

            if ($db_password == $password) {
                $_SESSION["email"] = $email;
                mysqli_query($connections, "UPDATE db_users SET attempt='', log_time='' WHERE email='$email'");
                header("Location: home.php");
                exit;
            } else {
                $passwordErr = "Incorrect password!";
            }
        } else {
            $emailErr = "Email is not registered!";
        }
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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
    <div class="log-form">
        <h2>Login to your account</h2>
        <form method="POST" action="index.php">
            <input type="text" name="email" title="email" placeholder="Enter Email" required>
            <input type="password" name="password" title="password" placeholder="Enter Password" required>
            <button type="submit" name="btnLogin" class="btn">Login</button>
            <button class="btn" onclick="window.location.href='register.php'">Register</button>
        </form>
    </div>
</body>

</html>