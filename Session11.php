<?php

class Session11
{
    //private $pass;
    //private $salt;

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function checkPass($passwordHash)
    {
        $passRandom = $_SESSION['pass'] . $_SESSION['salt'];
        if (md5($passRandom) == $passwordHash) {
            return true;
        }
        return false;
    }

    public function generateSalt()
        
    {
        $charSet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charSetLength = strlen($charSet);
        $randomSalt = '';
        for ($i = 0; $i < 10; $i++) {
            $randomSalt .= $charSet[rand(0, $charSetLength - 1)];
        }
        return $randomSalt; //$this->salt =
    }
}