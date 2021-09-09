<?php


namespace core\engine;


use core\engine\interfaces\IDB;

class DB implements IDB
{
    private string $driver;
    private string $userName;
    private string $userPassword;
    private string $dbName;
    private int $port;

    public function __construct($userName, $userPassword, $dbName, $port = 3306, $driver = "mysqli")
    {
        $this->userName = $userName;
        $this->userPassword = $userPassword;
        $this->dbName = $dbName;
        $this->port = $port;
        $this->driver = $driver;
    }

    public function connect($userName, $userPassword, $dbName, $port = 3306, $driver = "mysqli")
    {
        // ... connect to db
        // return descriptor
        return true;
    }

    public function query()
    {
        return [
            'column_1' => 'value 1',
            'column_2' => 'value 2',
            'column_3' => 'value 3',
            'column_4' => 'value 4',
        ];
    }

    // some methods
}