<?php
class Database{

    private static $connection;

    private function __construct() {
        
    }

    public static function getConnection()
    {
        if(self::$connection === null){
            self::$connection = new mysqli("localhost", "root", "", "tcc");
        }
        return self::$connection;        
    }
}