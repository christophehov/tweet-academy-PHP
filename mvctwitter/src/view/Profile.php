<?php
require_once '../../vendor/autoload.php';

use App\Classes\Database;
use App\Classes\Login;

ob_start();
session_start();

if (Login::isConnected() == false) {

} else {
  header('Location: ../view/register/index.login.php');
}

$userid = Login::getUserId();
echo $userid;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/profile.css">

    <!--CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">

    <title>Profile</title>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center">
    <div class="card">

      <div class="upper">
        <img src="https://i.imgur.com/Qtrsrk5.jpg" class="img-fluid">
      </div>

      <div class="user text-center">
        <div class="profile">
        <!--
          <img src="https://i.imgur.com/JgYD2nQ.jpg" class="rounded-circle" width="80">
        -->
        </div>
      </div>


      <div class="mt-5 text-center">
        <h4 class="mb-0"><?php $username = $_SESSION['username']; echo $username; ?></h4>
      <span class="text-muted d-block mb-2">CITY</span>

      <button class="btn btn-primary btn-sm follow">Follow</button>


      <div class="d-flex justify-content-between align-items-center mt-4 px-4">

      <div class="stats">
      <h6 class="mb-0">Followers</h6>
      <span> </span>

      </div>


      <div class="stats">
        <h6 class="mb-0">Projects</h6>
        <span> </span>

      </div>


      <div class="stats">
        <h6 class="mb-0">Ranks</h6>
        <span> </span>
      </div>

      <div class="stats">
        <h6 class="mb-0">Post</h6>
        <span><a href="Post.php">Take a post</a></span>
      </div>

      
      
    </div>
    <div class="stats">
      <a href="logout.php"><input type="submit" name="logout" value="Logout" class="btn btn-primary btn-sm"></a>
     
    </div>
    </div>
  </div>

  </body>
</html>