<?php

namespace models;

class User {

    public function getAll(){
        return [
            [
                "firstname" => "Alex",
                "date_birth" => 29,
            ], [
                "firstname" => "Peater",
                "date_birth" => 29,
            ],
        ];
    }

}