<?php
require 'connect.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM custInfo WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        $stored_password = $row["password"];

        // Verify the password (without hashing)
        if ($password == $stored_password) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: home_cust.php"); // Change this to the page you want to redirect to after login
            exit();
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('User not registered');</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glassmorphism Login Form | CodingNepal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="wrapper">
    <form action="index.php" method="post">
        <h2>Login</h2>

        <div class="input-field">
            <input type="text" name="email" required>
            <label for="email">Enter your email</label>
        </div>
        <div class="input-field">
            <input type="password" name="password" required>
            <label for="password">Enter your password</label>
        </div>
        <div class="forget">
            <label for="remember">
                <input type="checkbox" id="remember">
                <p>Remember me</p>
            </label>
            <a href="email.php">Forgot password?</a>
        </div>

        <button type="submit" name="submit">Log In</button>
        <div class="register">
            <p>Don't have an account? <a href="Register.php">Register</a></p>
        </div>
    </form>
</div>

</body>
</html>
