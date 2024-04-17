<?php

$hostname = "localhost";
$username = "root";
$password = "root123";
$dbname = "test";
$port = 4306;
$conn = mysqli_connect($hostname, $username, $password, $dbname,$port);
if(!$conn) {
	die("Unable to connect");
}
session_start();

if ($_POST) {
    // $username = mysqli_real_escape_string($conn, $_POST['username']);
    // $password = mysqli_real_escape_string($conn, $_POST['password']);
    $username =  $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("location: dashboard.php");
    } else
        $msg = "Invalid Username/Password";
} else {
    $msg = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .my-container {
    width: 50%;
    padding: 8%;
    margin: 4% auto;
    background-color: rgba(209, 227, 255, 0.5); /* White with transparency */
    border-radius: 10px;
    backdrop-filter: blur(10px) brightness(80%) contrast(120%); /* Glass morphism effect */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.titletext {
    margin: 5% auto;
    color: rgb(3, 85, 204);
}

/* Optional: Adjust input and button styles */
.form-control {
    background-color: rgba(255, 255, 255, 0.8); /* White with transparency */
    border: none;
    border-radius: 5px;
    margin-bottom: 10px;
}

.btn {
    background-color: rgb(255,138,29,0.8); /* Grey button with transparency */
    color: #fff;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: rgb(255,138,29,1) /* Darker grey on hover */
}

/* Optional: Adjust link styles */
.text-center a {
    color: rgba(0, 0, 0, 0.6); /* Grey text color */
}

    </style>
</head>

<body>
    <div class="my-container">
    <h2 class="titletext">NexusPro</h2>
        <form action method="POST">
            <input class="form-control" type="text" placeholder="username" name="username" required /><br />
            <input class="form-control" type="password" placeholder="password" name="password" required /><br />
            <p class="text-danger small"><?php echo $msg; ?></p>
            <button class="btn btn-secondary w-100">Login</button>
            <p class="mt-3 small text-center">Don't have an account? <a href="signup.php">Signup</a></p>
        </form>
    </div>
</body>

</html>