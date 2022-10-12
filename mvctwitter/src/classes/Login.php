<?php 

namespace App\Classes;

use App\Classes\Database;


class Login
{    
    /**
     * LoginUser
     *
     * @param  string $username
     * @param  string $password
     * @return void
     */
    public function LoginUser(string $username, string $password)
    {
        try {
            if (isset($_POST['login'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                if (Login::UsernameVerify($username) && Login::PasswordVerify($password)) {
                   
                    try {
                        $token = Login::GenerateToken();
                    } catch (\Exception $exception) {echo "Error Token: " . $exception->getMessage(); }
                    
                    $user_id = Database::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
                    Database::query('INSERT INTO login_tokens VALUES (NULL, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));

                    echo "Login Successful";

                    session_start();
                    $_SESSION['username'] = $username;
                    header('Location: ../profile.php?username=' . $username);
                } else {
                    echo "Login Failed";
                }
            }
        } catch (\PDOException $exception) {
            echo "Error Login: " . $exception->getMessage();
        }
    }


    /**
     * PasswordVerify
     *
     * @param  string $password
     * @return void
     */
    public static function PasswordVerify(string $password)
    {
        try {
            //Verify password with hash in database and return true or false if correct or not respectively
            if (password_verify($password, Database::query('SELECT password FROM users WHERE username=:username', array(':username'=>$_POST['username']))[0]['password'])) {
                echo "Password is correct";
                return true;
            } else {
                echo "Password is incorrect";
                return false;
            }
        } catch (\PDOException $exception) {
            echo "Error PasswordVerify: " . $exception->getMessage();
        }
    }

    /**
     * UsernameVerify
     *
     * @param  string $username
     * @return void
     */
    public static function UsernameVerify(string $username)
    {
        try {
            if (Database::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
                echo "Username is correct";
                return true;
            } else {
                echo "Username is incorrect";
                return false;
            }
        } catch (\PDOException $exception) {
            echo "Error UsernameVerify: " . $exception->getMessage();
        }
    }

    /**
     * EmailVerify
     *
     * @param  string $email
     * @return void
     */
    public static function EmailVerify(string $email)
    {
        try {
            if (Database::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $exception) {
            echo "Error EmailVerify: " . $exception->getMessage();
        }
    }


    /**
     * isConnected
     *
     * @return boolean true if user is logged in, false if not
     * 
     */

    public static function isConnected()
    {
        try {
            if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
                // redirect to your login page
                // header('Location: src/view/register/index.login.php');
                return true;
            } else {
                $username = $_SESSION['username'];
                echo '<p>Welcome ' . $username. '</p>';
                return false;
            }
        }
        catch (\PDOException $exception) {
            echo "Error isConnected: " . $exception->getMessage();
        }
    }

    /**
     * Check
     *
     * @return void
     */
    public static function Check()
    {
        try {
            if (isset($_SESSION['username']) || ($_SESSION['username'])) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $exception) {
            echo "Error Check: " . $exception->getMessage();
        }
    }
    
    /**
     * Logout
     *
     * @return void
     */
    public static function Logout()
    {
        try {
            if (isset($_POST['logout'])) 
            {
                session_destroy();
                echo "You have been logged out";

                unset($_SESSION['username']);
                unset($_SESSION['userid']);
                // header('location: ../view/register/index.login.php');
                return true;
            }
        } catch (\PDOException $exception) {
            echo "Error Logout: " . $exception->getMessage();
        }  
    }
    
    /**
     * getUserId
     *
     * @return string $user_id
     */
    public static function getUserId()
    {
        if ($_SESSION['username'])
        {
            $user_id = Database::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_SESSION['username']))[0]['id'];
            return $user_id;
        }   
    }
    
    /**
     * GenerateToken
     *
     * @return string
     */
    public static function GenerateToken() : string
    {
        $cstrong = True;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
        return $token;
    }

}
