<?php

class DB
{
    protected static $_pdo = null;

    protected static $dbHost = '127.0.0.1:3307';
    protected static $dbName = 'clinic11';
    protected static $dbUser = 'root';
    protected static $dbPass = '';

    protected function __construct()
    {
        echo 'Running the constructor .<br/>';
    }

    protected function __clone()  { }

    protected function __wakeup() { }

    public static function pdo()
    {
        if (is_null(self::$_pdo)) {
            //echo 'Creating new connection.<br/>';
            self::$_pdo = new PDO ('mysql:dbname=' . DB::$dbName . ';host=' . DB::$dbHost, DB::$dbUser, DB::$dbPass);
        };
        return self::$_pdo;
    }
}