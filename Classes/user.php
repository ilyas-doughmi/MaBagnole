<?php

class user{
    protected $userId;
    protected $fullname;
    protected $email;
    protected $password;
    protected $role;
    protected $createdAt;
    protected $isActive;

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function login()
    {

    }
    
    public function logout()
    {

    }
}