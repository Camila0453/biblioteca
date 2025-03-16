<?php

namespace controller;

require_once "../model/entities/Usuario.php";
use Exception;
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
    public function activar($controller,$action,$data){
    //  echo"SOY USUARIOCONTROLLER",var_dump($data);
      $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
      $response->{"controller"} = $controller;
      $response->{"action"} = $action;
      $data = json_decode(file_get_contents("php://input"));
      $id= $data->id;
     // echo"SOY USUARIOCONTROLLER",var_dump($data);
     
      try{
          $conexion = Conexion::establecer();
          $dao = new UsuarioDAO($conexion);
          $user= $dao->load($id);
        // echo"USER DE LOAD ES",$user->getNombre();
         // $user->setEstado(0);
          $dao->activar($user->getId());
              //Por ahora, si hubieran filtros, vendrían en $data
              $response->{"result"} = $user->toJson();
          }
          catch(PDOException $ex){
              $response->{"error"} = "Error en base de datosxdxd: " . $ex->getMessage();
          }
          catch(\Exception $ex){
              $response->{"error"} = $ex->getMessage();
          }
         echo json_encode($response); 
      }
    public function desactivar($controller,$action,$data){
      //echo"SOY USUARIOCONTROLLER",var_dump($data);
      $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
      $response->{"controller"} = $controller;
      $response->{"action"} = $action;
      //$data = json_decode(file_get_contents("php://input"));
      $id= $data;
      //echo"SOY USUARIOCONTROLLER",var_dump($data);
     
      try{
          $conexion = Conexion::establecer();
          $dao = new UsuarioDAO($conexion);
          $user= $dao->load($id);
          //echo"USER DE LOAD ES",$user->getNombre();
         // $user->setEstado(0);
          $dao->desactivar($user->getId());
              //Por ahora, si hubieran filtros, vendrían en $data
              $response->{"result"} = $user->toJson();
          }
          catch(PDOException $ex){
              $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
          }
          catch(\Exception $ex){
              $response->{"error"} = $ex->getMessage();
          }
        //  echo json_encode($response); 
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
  $data = json_decode(file_get_contents("php://input"),true);
  $id= isset($data['id'])? (int)$data['id']: null;
  if($id== null){
    $response->{"error"}="no se proporciono el id????";
    echo json_encode($response);
    return;

  }
  try{
   
      $conexion = Conexion::establecer();
      $dao = new UsuarioDAO($conexion);
    
      $usuario= $dao->load($id);
      if($usuario->getEstado()==0){
        $response->{"error"}=  throw new Exception(("El usuario ya se encuentra desactivado."));}
      

      $dao->delete($usuario->getId());
      //Por ahora, si hubieran filtros, vendrían en $data
      $response->{"result"} = $usuario->toJson();
      
  }
  catch(PDOException $ex){
      $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
  }
  catch(\Exception $ex){
      $response->{"error"} = $ex->getMessage();
  }

  echo json_encode($response);
  //header("Location:biblioteca/public/view/usuario/index");
  //exit();
}
public function save($controller, $action, $data){
  $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
  $response->{"controller"} = $controller;
  $response->{"action"} = $action;

  $data = json_decode(file_get_contents("php://input"));
 
  $user = new Usuario($data->datoDni,$data->datoCorreo,$data->datoTipoUsuario);
 
  $response->{"result"} = $user->toJson();
  try{
    $user->setNombreC($data->datoNombre);
    $conexion = Conexion::establecer();
    $daoUsuario= new UsuarioDAO($conexion);
    $daoUsuario->save($user);
}
catch(PDOException $ex){
    $response->{"error"} = $ex->getMessage();
}
catch(\Exception $ex){
    $response->{"error"} = $ex->getMessage();
}


echo json_encode($response);
}
  


public function showSave($controller, $action, $data){

        
  require_once("../public/view/usuario/agregar.php");

}
public function update($controller, $action, $data){

  $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
  $response->{"controller"} = $controller;
  $response->{"action"} = $action;
  $data = json_decode(file_get_contents("php://input"));

  $id= (int) $data->{"datoId"};
  
  try{
   
      $conexion = Conexion::establecer();
      $dao = new UsuarioDAO($conexion);
      $user= $dao->load($id);
      $user->setNombreC($data->{"datoNombreC"});
      $user->setNombre($data->{"datoCorreox"});
      $user->setEstado($data->{"datoEstado"});
     
      $user->setDni($data->{"datoDni"});
      $user->setTipoUsuario($data->{"datoTipoUsuario"});
   
     

      $dao->update($user);
      //Por ahora, si hubieran filtros, vendrían en $data
      $response->{"result"} = $user->toJson();
  }
  catch(PDOException $ex){
      $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
  }
  catch(\Exception $ex){
      $response->{"error"} = $ex->getMessage();
  }

  echo json_encode($response);  } 
}