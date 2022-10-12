<?php

require '../../../vendor/autoload.php';
// Autoload::load();

use App\Model\Register;
use App\Model\AddUser;

//if submit button is pressed return true
try 
{
    if (isset($_POST['submit'])) 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $birthday = $_POST['birthday'];
        
        
        $register = new Register($username, $email, $password, $birthday);
        try {
            $register->RegisterUser($username, $email, $password, $birthday);
        } catch (Exception $exception) {
            echo "Error Register: " . $exception->getMessage();
        } 
    }    
} catch (Exception $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="index.register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username"*id="username" required>
        <label for="email">Email:</label>
        <input type="text" name="email"  id="email" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <label for="password_confirm">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <label for="birthday">Birthdate:</label>
        <input type="date" name="birthday" id="birthday" required>
        <input type="submit" name="submit" id="submit" value="Register">
        <p>Already have an account? <a href="index.login.php">Sign in</a></p>
    </form>
</body>
</html>