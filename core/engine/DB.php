<?php


namespace core\engine;


class DB
{
    private static $settings = [];

    public static function init(array $settings)
    {
        if(isset($settings)){
            self::$settings = $settings;
        }
        return self::testConnect();
    }

    public static function testConnect()
    {
        // ... $this->connect(..., ..., ..., ..);
        return true;
    }

    public function connect()
    {
        // ... self::$settings;
    }

    public function query()
    {
        return [
            "result" => "some result"
        ];
    }
}