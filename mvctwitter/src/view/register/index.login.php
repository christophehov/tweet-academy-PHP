<?php
ob_start();
session_start();

require '../../../vendor/autoload.php';
// Autoload::load();


use App\Classes\Database;
use App\Classes\Login;

// If Session is true -> Go to user's profile page; 
if (Login::isConnected() == false)
{
    header('Location: ../../view/profile.php?username=' .$username);
}

try {
    if (isset($_POST['login'])) 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $login = new Login($username, $password);
        try {
            $login->LoginUser($username, $password);
        } catch (\PDOException $exception) {
            echo "Error->Login: " . $exception->getMessage();
        }
            // $_SESSION['username'] = $username[0]['username'];
    }
} catch (Exception $e) {
    echo "Connection error: " . $e->getMessage();
}

?>


<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../view/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js" defer></script>
    <script src="../view/app.js"></script>
</head>

<body>
    <h2>Login</h2>
    <form action="index.login.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="username" required />
        <label for="psw">Password</label>
        <input type="password" name="password" id="password" placeholder="password" required />
        <button type="submit" name="login"class="btn">Login</button>
        <p>Not a member? <a href="index.register.php">Sign up</a></p>
    </form>
</body>

</html>