<?php 
namespace App\Controller;

require '../../../vendor/autoload.php';
// Autoload::load();

use App\Classes\Database;
use App\Classes\Login;

// use App\Classes\Login;

class LoginController
{
    public function index()
    {
        Login::isConnected();
    }
}



