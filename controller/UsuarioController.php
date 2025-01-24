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
        require_once("../public/view/usuario/index.php");
       

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
  public function list($controller, $action, $data){
    $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
  
    try{
        $conexion = Conexion::establecer();
        $dao = new UsuarioDAO($conexion);
        //Por ahora, si hubieran filtros, vendrían en $data
        $response->{"result"} = $dao->list($data);
    }
    catch(\PDOException $ex){
        $response->{"error"} = "Error en base de datosssss: " . $ex->getMessage();
    }
    catch(\Exception $ex){
        $response->{"error"} = $ex->getMessage();
    }

    echo json_encode($response);
}

public function delete($controller, $action, $data){
   

  $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
  $response->{"controller"} = $controller;
  $response->{"action"} = $action;
  $data = json_decode(file_get_contents("php://input"));

  $id=(int ) $data;
  try{
     
      $conexion = Conexion::establecer();
      $dao = new UsuarioDAO($conexion);
    
      $socio= $dao->load($id);

      $dao->delete($id);
      $socio->setEstado(0);
      //Por ahora, si hubieran filtros, vendrían en $data
      $response->{"result"} = $socio->toJson();
      
  }
  catch(PDOException $ex){
      $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
  }
  catch(\Exception $ex){
      $response->{"error"} = $ex->getMessage();
  }

  echo json_encode($response);
}
}