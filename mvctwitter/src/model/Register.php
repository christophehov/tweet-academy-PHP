<?php

namespace App\Model;

use App\{Classes\Database};
use App\Model\User;
use Exception;
use PDOException;

//variables for Regiter Class



/**
 * Register
 */
class Register 
{
    
    /**
     * Note : 
     * Variables
     *
     * @var string
     */

    public $username ;
    public $email ;
    protected $password ;
    public $birthday ;

    // public $usernameRegex = "'/^[a-zA-Z0-9]{3,32}$/'";
    // public $emailRegex = "'/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/'";
    // public $passwordRegex = "'/^[a-zA-Z0-9]{6,60}$/'";
    // public $birthdayRegex = "'/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/'";


    /**
     * __construct
     *
     * @return 
     */
    public function __construct(string $username, string $email, string $password, string $birthday)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->birthday = $birthday;
    }


    /**
     * @param $username
     * @param $email
     * @param $password
     * @param $birthday
     * @return 
     */

    public function RegisterUser()
    {
        try {
            if (isset($_POST['submit'] )) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $password_confirmation = $_POST['password_confirmation'];
                $birthday = $_POST['birthday'];
                                
                if(Register::CheckUsername($username) && Register::CheckEmail($email) && Register::CheckPassword($password, $password_confirmation) && Register::CheckBirthday($birthday))
                { 
                    Database::query("INSERT INTO users VALUES (NULL, :username, :password, :email, :birthday, NULL, NULL,NULL,NULL,NULL,NULL)",
                    [
                        ':username'=>$username,
                        ':password'=>password_hash($password, PASSWORD_BCRYPT),
                        ':email' => $email,
                        ':birthday'=>$birthday
                    ]);
                    echo 'User Created!';
                    header('Location: /index.php');
                }
            } else {
                echo 'Error Occurred';
            }
        } catch (\PDOException $exception) {
            echo "Error Register: " . $exception->getMessage();
        } 
    }

    /**
     * CheckUsername
     *
     * @param $username
     * @return 
     */
    public static function CheckUsername($username)
    {
        try 
        {
            if(!Database::query("SELECT username FROM users WHERE username = :username",
                [':username' => $_POST['username']]))
            {
                if (strlen($username) >= 3 && strlen($username) <= 32) {
                    if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
                        echo 'Username is valid';
                        return true;
                    } else {
                        echo "Numbers and Characters only";
                    }
                } else {
                    echo "Username must be between 3 and 32 characters";
                }
            } else {
                echo "Username already exists"; 
            } 
        } catch (PDOException $exception) {
            echo "CheckUsername Error: " . $exception->getMessage();
        } 
    }

    /**
     * CheckEmail
     *
     * @param $email
     * @return bool
     */
    public static function CheckEmail($email)
    {
        try {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (!Database::query("SELECT email FROM users WHERE email = :email", [':email' => $_POST['email']]))
                {
                    echo "Email available";
                    return true;
                } else {
                    echo "Email not available";
                }
            }
        } catch (PDOException $exception) {
            echo "CheckEmail Error: " . $exception->getMessage();
        } 
    }
    
    /**
     * CheckPassword
     *
     * @return bool
     */
    public static function CheckPassword($password, $password_confirmation)
    {
        try {
            if (strlen($password) >= 6 && strlen($password) <= 60) {
                if (preg_match('/[a-zA-Z0-9]+/', $password)) 
                {
                    if ($password == $password_confirmation) 
                    {
                        echo "Password confirmed";
                        return true;
                    } else {
                        echo "Password not confirmed";
                    }
                    
                } else {
                    echo "Numbers and Characters only";
                }
            } else {
                echo "Password must be between 6 and 60 characters";
            }
        } catch (PDOException $exception) {
            echo "CheckPassword Error: " . $exception->getMessage();
        } 
    }

    /**
    * CheckBirthday
    *
    * @return 
    */
    public static function CheckBirthday($birthday)
    {
        //check if birthday is > 18 years old
        $birthday = $_POST['birthday'];
        $today = date("Y-m-d");
        $diff = date_diff(date_create($birthday), date_create($today));
        $age = $diff->format('%y');
        if ($age >= 18) {
            echo "Birthday is valid";
            return true;
        } else {
            echo "Birthday is not valid";
            return false;
        }

    }
    
    // /**
    //  * CheckPasswordConfirmation
    //  *
    //  * @return void
    //  */
    // public static function CheckPasswordConfirmation()
    // {
    //     if ($_POST['password'] == $_POST['password_confirmation']) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

}
