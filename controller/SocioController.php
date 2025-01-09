<?php
namespace controller;
require_once "../model/entities/Socio.php";
use model\entities\Socio;
require_once "../model/dao/SocioDAO.php";
use model\dao\SocioDAO;
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;
final class SocioController{
    public function index($controller, $action, $data){
        
        //require_once("../public/view/cliente/index.php");
       echo"hola";

    }
    public function showSave($controller, $action, $data){

        $headTitle="Alta de clientes";
       // require_once("../public/view/cliente/cliente_alta.php");
    }
    public function showDelete($controller, $action, $data){
        $cl= $this->load($controller,$action,$data);
       
       // require_once("../public/view/cliente/cliente_eliminar.php");
    }
    public function load($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $id=(int ) $data;
        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
            $s= $dao->load($id);
            $response->{"result"} = $c->toJson();
            
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
     //echo json_encode($response);

     return $response;
    
    }
    public function save($controller, $action, $data){
      
        $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;

        $data = json_decode(file_get_contents("php://input"));
        
        $socio = new Socio();
        $socio->setApellido($data->{"datoApellido"});
        $socio->setNombres($data->{"datoNombre"});
        $socio->setDni($data->{"datoDNI"});
        $socio->setDomicilio($data->{"datoDomicilio"});
        $socio->setProvincia($data->{"datoProvincia"});
        $socio->setLocalidad($data->{"datoLocalidad"});
        $socio->setTipoSocio($data->{"tipoSocio"});
        $socio->setTelefono($data->{"datoTelefono"});
        $socio->setCorreo($data->{"datoCorreo"});
        $socio->setIdUsuario($data->{"idUsuario"});
        $socio->setFrenteDni($data->{"frenteDni"});
        $socio->setDorsoDni($data->{"dorsoDni"});
       
    
        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
            $dao->save($socio);
            $response->{"result"} = $socio->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = $ex->getMessage();
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
            $dao = new SocioDAO($conexion);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $dao->list($data);
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

        echo json_encode($response);
    }
    /**
     * Muestra el formulario de Actualización para un cliente existente
     */
    public function showUpdate($controller, $action, $data){
       
        $conexion = Conexion::establecer();
        $dao = new SocioDAO($conexion);
        $cliente = $dao->load((int)$data);
       // require_once("../public/view/cliente/cliente_modificar.php");

    }
    /**
     * Actualiza el cliente
     */
    public function update($controller, $action, $data){

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));

        $id= (int) $data->{"x"};
  
        try{
           
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
          
            $cliente= $dao->load($id);
           
            $socio->setApellido($data->{"datoApellido"});
            $socio->setNombres($data->{"datoNombre"});
            $socio->setDni($data->{"datoDNI"});
            $socio->setDomicilio($data->{"datoDomicilio"});
            $socio->setProvincia($data->{"datoProvincia"});
            $socio->setLocalidad($data->{"datoLocalidad"});
            $socio->setTipoSocio($data->{"tipoSocio"});
            $socio->setTelefono($data->{"datoTelefono"});
            $socio->setCorreo($data->{"datoCorreo"});
            $socio->setIdUsuario($data->{"idUsuario"});
            $socio->setFrenteDni($data->{"frenteDni"});
            $socio->setDorsoDni($data->{"dorsoDni"});

            $dao->update($socio);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $socio->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datosxdxd: " . $ex->getMessage();
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
            $dao = new SocioDAO($conexion);
          
            $cliente= $dao->load($id);
    
            $dao->delete($id);
            $Socio->setId(0);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $socio->toJson();
            
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

        echo json_encode($response);
    }
 public function report($controller,$action,$data){
        //require_once("../report/clientes.php");
       
       }

}

