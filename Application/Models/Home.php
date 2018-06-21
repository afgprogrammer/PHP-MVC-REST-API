<?php

use MVC\Model;

class ModelsHome extends Model {

    public function getAllUser() {
        // can you connect to database
        // $this->db->query( write your sql syntax: "SELECT * FROM " . DB_PREFIX . "user");

        return [ 
            'name'      => 'Mohammad',
            'family'    => 'Rahmani',
            'age'       => 21,
            'country'   => 'Afghanistan',
            'city'      => 'Herat'
        ];
    }
}
