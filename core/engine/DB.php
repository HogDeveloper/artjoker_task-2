<?php

namespace core\engine;

use core\engine\interfaces\IDB;

class DB implements IDB
{
    private static string $driver;
    private static string $userName;
    private static string $userPassword;
    private static string $dbName;
    private static int $port;
    private $descriptor; // type resource

    public function __construct()
    {
        $this->descriptor = $this->connect();
    }

    public static function setSettingsConnect($userName, $userPassword, $dbName, $port = 3306, $driver = "mysqli")
    {
        self::$userName = $userName;
        self::$userPassword = $userPassword;
        self::$dbName = $dbName;
        self::$port = $port;
        self::$driver = $driver;
    }

    public function connect()
    {
        // ... connect to db
        // return descriptor
        return true;
    }

    public function connectClose()
    {
        // get descriptor & close connect
        return true;
    }

    public function query()
    {
        // some sql code
        $this->connectClose();
        return [
            'column_1' => 'value 1',
            'column_2' => 'value 2',
            'column_3' => 'value 3',
            'column_4' => 'value 4',
        ];
    }

    // some methods
}