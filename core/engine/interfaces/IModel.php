<?php

namespace core\engine\interfaces;

interface IModel {

    public static function use();

    public function getAllRows();

    public function getRow();

    public function update();

    public function where();

    // ...

}
