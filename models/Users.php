<?php

namespace models;

use core\engine\Model;

class Users extends Model
{
    protected $table = "usersis";

    public function getTable()
    {
        return $this->table;
    }
}