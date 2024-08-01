<?php

require 'C:\xampp\htdocs\git repo\simple_rest.php';
require 'C:\xampp\htdocs\git repo\controllers\UserController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userController = new UserController();
    if ($userController->register($name, $email, $password)) {
        $statusCode = 201; // Created
        $statusMessage = getHttpStatusMessage($statusCode);
        echo "Registration successful! ($statusMessage)";
    } else {
        $statusCode = 400; // Bad Request
        $statusMessage = getHttpStatusMessage($statusCode);
        echo "Registration failed. ($statusMessage)";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>