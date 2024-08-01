<?php

require 'C:\xampp\htdocs\git repo\simple_rest.php';
require 'C:\xampp\htdocs\git repo\controllers\UserController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userController = new UserController();
    if ($userController->login($email, $password)) {
        $statusCode = 200; // OK
        $statusMessage = getHttpStatusMessage($statusCode);
        echo "Login successful! ($statusMessage)";
    } else {
        $statusCode = 401; // Unauthorized
        $statusMessage = getHttpStatusMessage($statusCode);
        echo "Invalid email or password. ($statusMessage)";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form method="post" action="">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>