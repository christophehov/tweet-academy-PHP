<?php

namespace App\Model;

/**
 * User
 */
class User 
{
    public ?string $username = null;
    public ?string $email = null;
    protected ?string $password = null;
    public ?string $birthday = null;

    
    /**
     * __construct
     *
     * @param  mixed $username string
     * @param  mixed $email string
     * @param  mixed $password string
     * @param  mixed $birthday string
     * @return void
     */
    
    public function __construct(string $username, string $email, string $password, string $birthday)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->birthday = $birthday;
    }

    //Getters and Setters 
    
    /**
     * getUsername
     *
     * @return void
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * setUsername
     *
     * @param  mixed $username
     * @return string
     */
    public function setUsername(string $username): string
    {
        return $this->username = $username;
    }
        
    /**
     * getEmail
     *
     * @return void
     */
    public function getEmail()
    {
        return $this->email;
    }
        
    /**
     * setEmail
     *
     * @param  mixed $email
     * @return string
     */
    public function setEmail(string $email): string
    {
        return $this->email = $email;
    }
        
    /**
     * getPassword
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    
    /**
     * setPassword
     *
     * @param  mixed $password
     * @return string
     */
    public function setPassword(string $password): string
    {
        return $this->password = $password;
    }

    /**
     * getBirthday
     *
     * @return int
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * setBirthday
     *
     * @param int $birthday
     * @return int
     */
    public function setBirthday(string $birthday): string
    {
        return $this->birthday = $birthday;
    }
}