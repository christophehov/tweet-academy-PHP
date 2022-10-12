<?php
ob_start();
session_start();

require '../../vendor/autoload.php';

use App\Classes\Login;

try {

    if(Login::Logout() && (isset($_POST['logout'])))
    {
        header('Location: ../../index.php');
        return true;
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
    <link rel="stylesheet" href="../assets/profile.css">
    <title>Logout</title>
</head>
<body>
    <form action="logout.php" method="post">
        <input type="submit" name="logout" value="Logout" class="btn btn-primary btn-sm">
    </form>
    
</body>
</html>