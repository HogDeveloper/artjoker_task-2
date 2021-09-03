<?php


namespace core\libs;


class DB
{
    private static $settings = [];

    public static function init($settings = null)
    {
        if(isset($settings)){
            self::$settings = $settings;
        }
        return self::testConnect();
    }

    public static function testConnect()
    {
        // ... mysqli_connect(..., ..., ..., ..);
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