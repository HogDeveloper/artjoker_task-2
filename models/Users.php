<?php

namespace models;

use core\engine\Model;

class Users extends Model
{
    protected string $table = "users_custom";

    public function getTable()
    {
        return $this->table;
    }
}