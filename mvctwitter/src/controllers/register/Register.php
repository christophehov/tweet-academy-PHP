<?php

namespace App\Controllers;

require '../../../vendor/autoload.php';
// Autoload::load();

use App\Model\Register;
use App\Model\AddUser;

require_once ("../../model/Register.php");
require_once ("../../view/register/index.register.php");

class RegisterController 
{ 
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
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
                } catch (\Exception $exception) {
                    echo "Error Register: " . $exception->getMessage();
                } 
            }    
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    
}