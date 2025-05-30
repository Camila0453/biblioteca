<?php

namespace controller;

require_once "../model/entities/Usuario.php";
use Exception;
use model\dao\SocioDAO;
use model\dao\ReservaDAO;
use model\dao\EjemplarDAO;
use model\entities\Prestamo;
use model\entities\Usuario;
require_once "../model/dao/UsuarioDAO.php";
require_once "../model/dao/EjemplarDAO.php";
require_once "../model/dao/ReservaDAO.php";
require_once "../model/dao/PrestamoDAO.php";
use model\dao\UsuarioDAO;

require_once "../model/dao/SocioDAO.php";

use model\dao\PrestamoDAO;
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;

final class UsuarioController{
    /**
     * Página principal o de inicio del módulo CLIENTE
     */
     public function login($controller, $action, $data){
      require_once("../public/view/usuario/login.php");
     }
     public function showPerfilOp($controller, $action, $data){
      require_once("../public/view/usuario/perfilOp.php");
     }
     public function showPerfilSo($controller, $action, $data){
      require_once("../public/view/usuario/perfilSo.php");
     }
     public function showPerfilAdmin($controller, $action, $data){
      require_once("../public/view/usuario/perfilAdmin.php");
     }
     public function indexSocio($controller, $action, $data){
      require_once("../public/view/usuario/indexSocio.php");
     }

     public function misPrestamos($controller, $action, $data){
      require_once("../public/view/prestamo/prestamosSocio.php");
     }
     public function misReservas($controller, $action, $data){
      require_once("../public/view/reserva/reservasSocio.php");
     }

public function pres($controller,$action,$data){
  
  $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
  $response->{"controller"} = $controller;
  $response->{"action"} = $action;
$id= $_SESSION['idUsuario'];


  try{

      $conexion = Conexion::establecer();
      $dao = new PrestamoDAO($conexion);
      $daoUser= new UsuarioDAO($conexion);
      $daoSocio= new SocioDAO($conexion);


      $correo= $daoUser->load($id)->getNombre();
  
      $dni= $daoSocio->loadxMail($correo)->getDni();

//var_dump($dni);
      //Por ahora, si hubieran filtros, vendrían en $data
      $response->{"result"} = $dao->prestamosSocio($dni);
  }
  catch(\PDOException $ex){
      $response->{"error"} = "Error en base de datosssss: " . $ex->getMessage();
  }
  catch(\Exception $ex){
      $response->{"error"} = $ex->getMessage();
  }

  echo json_encode($response);


}
public function res($controller,$action,$data){
  
  $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
  $response->{"controller"} = $controller;
  $response->{"action"} = $action;
$id= $_SESSION['idUsuario'];


  try{

      $conexion = Conexion::establecer();
      $dao = new ReservaDAO($conexion);
      $daoUser= new UsuarioDAO($conexion);
      $daoSocio= new SocioDAO($conexion);


      $correo= $daoUser->load($id)->getNombre();
  
      $dni= $daoSocio->loadxMail($correo)->getDni();

//var_dump($dni);reservasSocio
      //Por ahora, si hubieran filtros, vendrían en $data
      $response->{"result"} = $dao->reservasSocio($dni);
  }
  catch(\PDOException $ex){
      $response->{"error"} = "Error en base de datosssss: " . $ex->getMessage();
  }
  catch(\Exception $ex){
      $response->{"error"} = $ex->getMessage();
  }

  echo json_encode($response);


}



  public function  ejemplaresPrestamoSocio($controller,$action,$data){
        require_once"../public/view/prestamo/ejemplaresPrestamoSocio.php";
     }
    
     public function  ejemplaresReservaSocio($controller,$action,$data){
      require_once"../public/view/reserva/ejemplaresReservaSocio.php";
   }




















     public function showHistorial($controller, $action, $data){
      require_once("../public/view/usuario/historial.php");
     }

     public function prohibido($controller, $action, $data){
      require_once("../public/view/usuario/prohibido.php");
     }
    
    public function index($controller, $action, $data){
      $headTitle="Sistema";
      require_once("../public/view/usuario/index.php");}
    public function indexAdmin($controller, $action, $data){
        //  $headTitle="Sistema";
          require_once("../public/view/usuario/indexAdmin.php");
         
  
      }
      public function indexOp($controller, $action, $data){
        //  $headTitle="Sistema";
          require_once("../public/view/usuario/indexOp.php");
         
  
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

















































public function listBajas($controller, $action, $data){
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
public function logout($controller, $action, $data){
    session_unset();
    session_destroy();
    require_once("../public/view/usuario/logout.php");
    
    header("refresh:6; URL=http://localhost/biblioteca/public/ ");
}
public function save($controller, $action, $data){
  $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
  $response->{"controller"} = $controller;
  $response->{"action"} = $action;

  $data = json_decode(file_get_contents("php://input"));

  $hashdni= password_hash($data->datoDni,PASSWORD_BCRYPT);
 
  $user = new Usuario($hashdni,$data->datoCorreo,$data->datoTipoUsuario,$data->datoDni);
 
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