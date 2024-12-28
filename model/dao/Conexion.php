<?php

namespace model\dao;

final class Conexion{

    public static function establecer(): object{
        //Data Source Name
        $dsn = "mysql:dbname=biblioteca;host=127.0.0.1;port=3306";
        $user = "root";
        $pass = "";
        $conexion = new \PDO(
            $dsn,
            $user,
            $pass,
            array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            )
        );
        return $conexion;
    }

}