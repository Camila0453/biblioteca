<?php

namespace model\dao;

class DAO{

    protected $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

}