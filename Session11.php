<?php

class Session11
{
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function checkPass($passwordHash, $pass, $salt)
    {
        $passRandom = $pass . $salt;
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
        return $randomSalt;
    }
}