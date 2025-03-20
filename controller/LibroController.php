<?php

namespace controller;

require_once "../model/entities/Libro.php";
use Exception;
use model\entities\Libro;
require_once "../model/dao/LibroDAO.php";
use model\dao\LibroDAO;
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;

final class LibroController{
    /**
     * Página principal o de inicio del módulo CLIENTE
     */
     public function index($controller,$action,$data){
        require_once"../public/view/libro/index.php";

     }

     public function list($controller,$action,$data){



     }
}