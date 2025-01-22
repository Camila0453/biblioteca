<?php
namespace controller;
require_once "../model/entities/Socio.php";
require_once "../model/entities/ProfMat.php";
require_once "../model/entities/AlumCar.php";
use model\entities\ProfMat;
use model\entities\AlumCar;
use model\entities\Socio;
require_once "../model/dao/SocioDAO.php";
use model\dao\SocioDAO;
require_once "../model/dao/AlumCarDAO.php";
use model\dao\AlumCarDAO;
require_once "../model/dao/ProfMatDAO.php";
use model\dao\ProfMatDAO;
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;
use PDO;
use PDOException;

final class SocioController{
    public function index($controller, $action, $data){
        
        require_once("view/socio/index.php");
   // $_SESSION["xd"]=1;
       

    }
    public function showSave($controller, $action, $data){
     
        require_once"../public/view/socio/agregar.php";
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
        catch(PDOException $ex){
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
        $socio->setNombres($data->{"datoNombres"});
        $socio->setDni($data->{"datoDNI"});
        $socio->setDomicilio($data->{"datoDomicilio"});
        $socio->setProvincia($data->{"datoProvincia"});
        $socio->setLocalidad($data->{"datoLocalidad"});
        $socio->setTipoSocio($data->{"datoTipoSocio"});
        $socio->setTelefono($data->{"datoTelefono"});
        $socio->setCorreo($data->{"datoCorreo"});
       // $socio->setIdUsuario($data->{"idUsuario"});
        $socio->setFrenteDni($data->{"datoFrenteDni"});
        $socio->setDorsoDni($data->{"datoDorsoDni"});
    
        try{

            $conexion = Conexion::establecer();

            $daoSocio = new SocioDAO($conexion);
            $daoSocio->save($socio);
            $response->{"result"} = $socio->toJson();

             if ($socio->getTipoSocio()==1){
                    $materias= $data->{"datoMateriaCarrera"};
                    $daoProfe = new ProfMatDAO($conexion);
                    foreach($materias as $mat){
                        $profe= new ProfMat($socio->getDni(),$mat);
                        echo"GET DNISOCIO ES",$socio->getDni() ;
                        echo"idsocio en profmat es",$profe->getIdSocio() ;
                        $daoProfe->save($profe);
                        echo"ñaja";
        
                    }} 
    
            if ($socio->getTipoSocio()==2){
                $carreras= $data->{"datoMateriaCarrera"};
                $daoAlum = new AlumCarDAO($conexion);
                foreach($carreras as $car){
                    $alum= new AlumCar($socio->getDni());
                    $alum->setIdCarrera($car);
                    $daoAlum->save($alum);
    
                }} 
        }
        catch(PDOException $ex){
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
        catch(PDOException $ex){
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
        catch(PDOException $ex){
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
        catch(PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

        echo json_encode($response);
    }


public function obtenerCarreras($controller,$action,$data){
    $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
  
    try{
        $conexion = Conexion::establecer();
        $sql= "SELECT codigo,nombre FROM carreras";
        $stmt=$conexion->prepare($sql);
        $stmt->execute();
        $carreras=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $response->result=$carreras;
    }
    catch(PDOException $ex){
        $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
    }
    catch(\Exception $ex){
        $response->{"error"} = $ex->getMessage();
    }

    echo json_encode($response);

}
public function obtenerMaterias($controller,$action,$data){
    $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
  
    try{
        $conexion = Conexion::establecer();
        $sql= "SELECT codigo,nombre FROM materias";
        $stmt=$conexion->prepare($sql);
        $stmt->execute();
        $materias=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $response->result=$materias;
    }
    catch(PDOException $ex){
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

