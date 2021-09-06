<?php


namespace core\engine;


class DB
{
    private static $settings = [];

    public static function testConnect()
    {
        // ... $this->connect(..., ..., ..., ..);
        // return stream;
        return true;
    }

    public function __construct()
    {
        // some initial process
    }

    public function connect(array $settings)
    {
        if(isset($settings)){
            self::$settings = $settings;
        }
        return self::testConnect();
    }

    public function query()
    {
        return [
            "result" => "some result"
        ];
    }
}