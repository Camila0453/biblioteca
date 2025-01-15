<?php

namespace controller;

require_once "../model/entities/Usuario.php";
use model\entities\Usuario;
require_once "../model/dao/UsuarioDAO.php";
use model\dao\UsuarioDAO;
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;

final class UsuarioController{
    /**
     * Página principal o de inicio del módulo CLIENTE
     */
    public function index($controller, $action, $data){
      //  $headTitle="Sistema";
        require_once("../public/view/usuario/login.php");
       

    }
    public function autentication($controller,$action,$data){
    
        //require_once("../public/view/usuario/login.php");
        $response = json_decode('{"controller":"", "action":"","error":"","perfil":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
      $cuenta= $data->{"datoCuenta"};
      $clave= $data->{"datoClave"};
        try{
            $conexion = Conexion::establecer();
            UsuarioDAO::login($conexion, $cuenta, $clave);
            $response->{"perfil"} = $_SESSION["perfil"];
           
            //redireccionar a inicio/index
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
       
        echo json_encode($response);
    
  }
}