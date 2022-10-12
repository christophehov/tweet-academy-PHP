<?php 
require 'vendor/autoload.php';

ob_start();
session_start();

use App\Classes\Login;

Login::isConnected();
header('Location: src/view/register/index.login.php');

$showTimeLine = false;


