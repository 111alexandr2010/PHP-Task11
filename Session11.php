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
}