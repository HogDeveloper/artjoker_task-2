<?php


namespace core\engine;

use core\engine\interfaces\IModel;
use core\libs\DB;

class Model implements IModel
{
    private static $instance = null;

    protected $table = null;
    protected $db = null;

    public function __construct()
    {
        $tableName = explode("\\", get_class($this));
        if(!isset($this->table)){
            $this->table = strtolower($tableName[count($tableName) - 1]);
        }
        $this->db = new DB();
    }

    public static function use()
    {
        if(!isset(self::$instance)){
            return new static;
        }
        return self::$instance;
    }

    public function connectDB($settings)
    {
        if(DB::init($settings)){
            $this->db = new DB();
        }
        return self::use();
    }

    public function getAllRows()
    {
        return self::use()->db->query();
    }

    public function getRow()
    {
        return self::use()->db->query();
    }

    public function update()
    {

    }

    public function where()
    {

    }
}