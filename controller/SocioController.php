<?php
namespace controller;
require_once "../model/entities/Socio.php";
require_once "../model/entities/Usuario.php";
require_once "../model/entities/ProfMat.php";
require_once "../model/entities/AlumCar.php";
require_once "../model/entities/BajaSocio.php";
require_once "../controller/UsuarioController.php";
use Exception;
use model\entities\ProfMat;
use model\entities\AlumCar;
use model\entities\Socio;
use model\entities\Usuario;
use model\entities\BajaSocio;
require_once "../model/dao/SocioDAO.php";
use model\dao\SocioDAO;
require_once "../model/dao/PrestamoDAO.php";
use model\dao\PrestamoDAO;
require_once "../model/dao/BajaSocioDAO.php";
use model\dao\BajaSocioDAO;
require_once "../model/dao/UsuarioDAO.php";
use model\dao\UsuarioDAO;
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
   public function showHistoricoSocios($controller, $action, $data){
    require_once"../public/view/socio/historico.php";

   }

   public function listBajas($controller, $action, $data){
    
    $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
  
    try{
        $conexion = Conexion::establecer();
        $dao = new SocioDAO($conexion);
        //Por ahora, si hubieran filtros, vendrían en $data
        $response->{"result"} = $dao->listBajas($data);
    }
    catch(PDOException $ex){
        $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
    }
    catch(\Exception $ex){
        $response->{"error"} = $ex->getMessage();
    }

    echo json_encode($response);
   }
    public function load($controller, $action, $data){

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $id=(int ) $data;
        echo"ola el id hhhhhes",$id;
        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
            $s= $dao->load($id);
            $response->{"result"} = $s->toJson();
            
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
    public function socioCantPrestamo($controller, $action, $data):void {
       
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
        $id=(int ) $data->{"id"};
        
       try{

        $conexion = Conexion::establecer();
       $dao= new PrestamoDAO($conexion);
      $cant= $dao->socioCantPres($id);

    
    if($cant==null){
        $response->{"error"}= "no sepudo";
        exit();

    }
    else{
        $response->{"result"}=$cant;
    }
    
}catch(PDOException $ex){
    $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
    exit();
}
catch(\Exception $ex){
    $response->{"error"} = $ex->getMessage();
    exit();}

    echo json_encode($response);
   
    }
    public function loadd($controller, $action, $data){
       // echo"ola soy load";
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
        $id=(int ) $data->{"dni"};
      
        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $dao->loadx($id);
        }
        catch(PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
    
        echo json_encode($response);
    }
    public function save($controller, $action, $data){
      
        $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
       
        $data = $_POST;
        $materiasCarreras = $_POST['datoMateriaCarrera'];
        
        
        $socio = new Socio();
        $socio->setApellido($_POST["datoApellido"]);
        $socio->setNombres($_POST["datoNombre"]);
        $socio->setDni($_POST["datoDni"]);
        $socio->setDomicilio($_POST["datoDomicilio"]);
        $socio->setProvincia($_POST["datoProvincia"]);
        $socio->setLocalidad($_POST["datoLocalidad"]);
        $socio->setTipoSocio($_POST["datoTipoSocio"]);
        $socio->setTelefono($_POST["datoTelefono"]);
        $socio->setCorreo($_POST["datoCorreo"]);
      
$hashedDni= password_hash($socio->getDni(),PASSWORD_BCRYPT);
        $usuario= new Usuario($hashedDni,$socio->getCorreo(),5,$socio->getDni());
    
        try{

            $conexion = Conexion::establecer();
            $daoUsuario= new UsuarioDAO($conexion);
            $daoUsuario->save($usuario);

            $idUser= $conexion->lastInsertId();
            $usuario->setId($idUser);
            $socio->setIdUsuario( $usuario->getId());
            $daoSocio = new SocioDAO($conexion);

            $carpeta = 'C:\\xampp\\htdocs\\biblioteca\\public\\view\\socio\\img';
            $urlRelativa = "img/";
            
            if (isset($_FILES['datoFrenteDni']) && $_FILES['datoFrenteDni']['error'] === UPLOAD_ERR_OK) {
                $nombreFrente = "frente_" . $_POST['datoDni'] . "_" . time() . ".jpg";
                $moved = move_uploaded_file($_FILES['datoFrenteDni']['tmp_name'], $carpeta . DIRECTORY_SEPARATOR . $nombreFrente);
                if ($moved) {
                    $socio->setFrenteDni($urlRelativa . $nombreFrente);
                } else {
                    $response->{"error"} = "Error al mover el archivo frenteDni.";
                    echo json_encode($response);
                    exit();
                }
            }
            
            if (isset($_FILES['datoDorsoDni']) && $_FILES['datoDorsoDni']['error'] === UPLOAD_ERR_OK) {
                $nombreDorso = "dorso_" . $_POST['datoDni'] . "_" . time() . ".jpg";
                $moved = move_uploaded_file($_FILES['datoDorsoDni']['tmp_name'], $carpeta . DIRECTORY_SEPARATOR . $nombreDorso);
                if ($moved) {
                    $socio->setDorsoDni($urlRelativa . $nombreDorso);
                } else {
                    $response->{"error"} = "Error al mover el archivo dorsoDni.";
                    echo json_encode($response);
                    exit();
                }
            }
            
           
            $daoSocio->save($socio);

          
       

             if ($socio->getTipoSocio()==1){
                    $materias= $materiasCarreras;
                    $daoProfe = new ProfMatDAO($conexion);
                    foreach($materias as $mat){
                      
                        $profe= new ProfMat($socio->getDni(),$mat);
                       $daoProfe->save($profe);
                     
        
                    }} 
    
            if ($socio->getTipoSocio()==2){
                $carreras= $materiasCarreras;
                $daoAlum = new AlumCarDAO($conexion);
                foreach($carreras as $car){
                    echo"ola car es".$car;
                    $alum= new AlumCar($socio->getDni(),$car);
                    $daoAlum->save($alum);
    
                }} 
        }
        catch(PDOException $ex){
            $response->{"error"} = $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
       
        $response->{"result"} = $socio->toJson();
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

    public function carreras($controller, $action, $data){

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
      $id=  (int) $data->{"dni"};

        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $dao->listCarsAlum($id);
            
        }
        catch(PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
    
        echo json_encode($response);
    }
    public function materias ($controller, $action, $data){

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
      $id=  (int) $data->{"dni"};

        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $dao->listMatsProfs($id);
            
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

        $id= $_POST["datoDni"];
        
        $data = $_POST;
        $materiasCarreras = $_POST['datoMateriaCarrera'];
        
        
     
       
        try{
           
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
          
            $socio= $dao->load($id);
               
        $socio->setApellido($_POST["datoApellido"]);
        $socio->setNombres($_POST["datoNombre"]);
        $socio->setDni($_POST["datoDni"]);
        $socio->setDomicilio($_POST["datoDomicilio"]);
        $socio->setProvincia($_POST["datoProvincia"]);
        $socio->setLocalidad($_POST["datoLocalidad"]);
        $socio->setTipoSocio($_POST["datoTipoSocio"]);
        $socio->setTelefono($_POST["datoTelefono"]);
        $socio->setCorreo($_POST["datoCorreo"]);
        $carpeta = 'C:\\xampp\\htdocs\\biblioteca\\public\\view\\socio\\img';
        $urlRelativa = "img/";
        
        if (isset($_FILES['datoFrenteDni']) && $_FILES['datoFrenteDni']['error'] === UPLOAD_ERR_OK) {
            $nombreFrente = "frente_" . $_POST['datoDni'] . "_" . time() . ".jpg";
            $moved = move_uploaded_file($_FILES['datoFrenteDni']['tmp_name'], $carpeta . DIRECTORY_SEPARATOR . $nombreFrente);
            if ($moved) {
                $socio->setFrenteDni($urlRelativa . $nombreFrente);
            } else {
                $response->{"error"} = "Error al mover el archivo frenteDni.";
                echo json_encode($response);
                exit();
            }
        }
        
        if (isset($_FILES['datoDorsoDni']) && $_FILES['datoDorsoDni']['error'] === UPLOAD_ERR_OK) {
            $nombreDorso = "dorso_" . $_POST['datoDni'] . "_" . time() . ".jpg";
            $moved = move_uploaded_file($_FILES['datoDorsoDni']['tmp_name'], $carpeta . DIRECTORY_SEPARATOR . $nombreDorso);
            if ($moved) {
                $socio->setDorsoDni($urlRelativa . $nombreDorso);
            } else {
                $response->{"error"} = "Error al mover el archivo dorsoDni.";
                echo json_encode($response);
                exit();
            }
        }
          
         
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
        
        $id= $data->id;
     
        $motivo= $data->motivo;
      /*echo"id",$id;
      echo"motivo",$motivo;
      */
        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);




             if($dao->socioTienePres($id)==true){
               throw new Exception("El socio no se puede dar de baja, tiene libros prestados.");
             }
            $socio= $dao->load($id);
            $bajaSocio= new BajaSocio();
            $bajaSocio->setIdSocio($socio->getDni());
            $bajaSocio->setIdUsuario($socio->getIdUsuario());
            $bajaSocio->setMotivoCan($motivo);
            $daoBajaSocio= new BajaSocioDAO($conexion);
            $daoBajaSocio->save($bajaSocio);
            $daoSocio=new SocioDAO($conexion);
            $daoSocio->delete($socio->getDni());
           $user= new UsuarioController();
           //echo"HOLA SOY SOCIOCONTROLLER SOCIO USUARIO ES", var_dump($socio->getIdUsuario());
            $user->desactivar("Usuario","desactivar",$socio->getIdUsuario());
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
public function reactivar($controller,$action,$data){
    $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
    $data = json_decode(file_get_contents("php://input"));
    $id= $data->id;
    try{
        $conexion = Conexion::establecer();
        $dao = new SocioDAO($conexion);
        $socio= $dao->load($id);
        $socio->setEstado(1);
        $dao->reactivar($socio->getDni());
        $user= new UsuarioController();
        //echo"HOLA SOY SOCIOCONTROLLER SOCIO USUARIO ES", var_dump($socio->getIdUsuario());
         $user->activar("Usuario","activar",$socio->getIdUsuario());


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

public function obtenerCarrerasxSocio($controller,$action,$data){
    $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
    $data = json_decode(file_get_contents("php://input"));
    $id= $data->{'id'};



   /* $sql= "SELECT libro.titulo FROM prestamos 
    INNER JOIN ejemplarprestamo ON ejemplarprestamo.prestamo=prestamos.id
    INNER JOIN ejemplares ON ejemplares.codigo= ejemplarprestamo.ejemplar
    INNER JOIN libro ON libro.id= ejemplares.libro
    WHERE prestamos.socio= :socio AND ejemplares.codigo= :ejem AND prestamos.estado= 1";*/
    try{
        $conexion = Conexion::establecer();
        $sql= "SELECT carreras.codigo,carreras.nombre, alumcar.carrera, alumcar.alumno  FROM carreras
        INNER JOIN  alumcar on  alumcar.carrera= carreras.codigo
        where alumcar.alumno= $id";

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
public function obtenerMateriasxSocio($controller,$action,$data){
    $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
    $data = json_decode(file_get_contents("php://input"));
    $id= $data->{'id'};

    try{
        $conexion = Conexion::establecer();
        $sql= "SELECT materias.codigo,materias.nombre, profmat.materia, profesor FROM materias INNER JOIN profmat on profmat.materia= materias.codigo where profesor= $id";
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



 public function buscar($controller,$action,$data,){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
    
        $dniOnom= $data->{'datoBus'};
        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
            //Por ahora, si hubieran filtros, vendrían en $data
           
            if(is_numeric($dniOnom)){
     
                $response->{"result"} = $dao->buscarDni($dniOnom);
            }
            
            else{
               
                $response->{"result"} = $dao->buscarNom($dniOnom); 
            }
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