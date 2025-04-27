<?php
namespace controller;
require_once "../model/entities/Socio.php";
require_once "../model/entities/Prestamo.php";
require_once "PrestamoController.php";
require_once "../model/entities/Usuario.php";
require_once "../model/entities/ProfMat.php";
require_once "../model/entities/AlumCar.php";
require_once "../model/entities/BajaSocio.php";
require_once "../model/entities/Reserva.php";
use model\entities\Reserva;

require_once "../model/entities/BajaReserva.php";
use model\entities\BajaReserva;


use model\entities\Prestamo;
require_once "../model/dao/ReservaDAO.php";
use model\dao\ReservaDAO;
require_once "../model/entities/ReservaEjemplar.php";
use model\entities\ReservaEjemplar;
require_once "../model/entities/PrestamoEjemplar.php";
use model\entities\PrestamoEjemplar;
require_once "../model/dao/PrestamoEjemplarDAO.php";
use model\dao\PrestamoEjemplarDAO;
require_once "../controller/UsuarioController.php";
use model\entities\ProfMat;
use model\entities\AlumCar;
use model\entities\Socio;
use model\entities\Usuario;
use model\entities\BajaSocio;
require_once "../model/dao/SocioDAO.php";
use model\dao\SocioDAO;
require_once "../model/dao/EjemplarDAO.php";
use model\dao\EjemplarDAO;
require_once "../model/dao/BajaReservaDAO.php";
use model\dao\BajaReservaDAO;
use DateTime;
require_once "../model/dao/PrestamoDAO.php";
require_once "../model/dao/LibroDAO.php";
use Exception;
use model\dao\PrestamoDAO;
use model\dao\LibroDAO;
require_once "../model/dao/PrestamoDAO.php";
require_once "../model/dao/ReservaEjemplarDAO.php";
use model\dao\ReservaEjemplarDAO;
require_once "../model/dao/ReservaDAO.php";
date_default_timezone_set('America/Argentina/Buenos_Aires'); 



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

final class ReservaController{
    public function index($controller, $action, $data){
        
        require_once("view/reserva/index.php");
   // $_SESSION["xd"]=1;
       

    }
    public function showEjemplaresRes($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
        $ISBN= $data->{"id"};
        
       
        try{
            $conexion = Conexion::establecer();
            $dao = new ReservaEjemplarDAO($conexion);
          
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} =   $dao->buscarEjemsRes($ISBN);;
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
    
        echo json_encode($response);
    }

    public function showHistorico($controller,$action,$data){
        require_once"../public/view/reserva/historico.php";
     }
    public function showSave($controller, $action, $data){
     
        require_once"../public/view/reserva/agregar.php";
    }
    public function showDelete($controller, $action, $data){
        $cl= $this->load($controller,$action,$data);
       
       // require_once("../public/view/cliente/cliente_eliminar.php");
    }
    public function  ejemplaresReserva($controller,$action,$data){
        require_once"../public/view/reserva/ejemplaresReserva.php";
     }
    
    public function load($controller, $action, $data){
        echo"ola soy load";
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

    public function listBajas($controller, $action, $data){
    
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        try{
            $conexion = Conexion::establecer();
            $dao = new ReservaDAO($conexion);
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
    
    public function list($controller, $action, $data){

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        try{
            $conexion = Conexion::establecer();
            $dao = new ReservaDAO($conexion);
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
    public function resHoy($controller, $action, $data){

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        try{
            $conexion = Conexion::establecer();
            $dao = new ReservaDAO($conexion);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $dao->listHoy($data);
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
          
            $socio= $dao->load($id);
           
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

    public function buscar($controller, $action, $data){

    }
    public function delete($controller, $action, $data){
   

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
        $id= $data->id;
     
        $motivo= $data->motivo;
      /*echo"id",$id;
      echo"motivo",$motivo;*/
      
        try{
            $conexion = Conexion::establecer();
            $dao = new ReservaDAO($conexion);
            $res= $dao->load($id);
            //echo"RES GET ID ES". $res->getId();
            $bajaRes= new BajaReserva();
            $bajaRes->setIdSocio($res->getId());
            $bajaRes->setMotivoCan($motivo);
            $bajaRes->setIdReserva( $res->getId());
           // echo"id es ".$id;
            $daoBajaRes= new BajaReservaDAO($conexion);
            $daoBajaRes->save($bajaRes);


            $daoReserva=new ReservaDAO($conexion);
            $daoReserva->delete($res->getId());
           /*$user= new UsuarioController();
           //echo"HOLA SOY SOCIOCONTROLLER SOCIO USUARIO ES", var_dump($socio->getIdUsuario());
            $user->desactivar("Usuario","desactivar",$socio->getIdUsuario());*/
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $res->toJson();
            
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
       Private function calcFechaVen($cantDias){
        $fecha= new DateTime();
        $fecha->setTime(18,0);
        $contDias=0;
     
        while($contDias<$cantDias){
            
             if($fecha->format('N')<6){
              $contDias++;
             }
             if($contDias<$cantDias){
                $fecha->modify('+1 day');
             }
             
        }
       // echo "ola fecha ven es",$fecha->format("y-m-d H:i:s");
     
        return $fecha->format("y-m-d H:i:s");
       }
public function save($controller, $action, $data){
        $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        $data = json_decode(file_get_contents("php://input"));
       
        $reserva = new Reserva();
        $ReservaEjemplar= new ReservaEjemplar();
     
       
        $response->{"result"} = $reserva->toJson();
        try{
            $conexion = Conexion::establecer();
            $EjemplarDao= new EjemplarDAO( $conexion);
            $PrestamoDao= new PrestamoDAO($conexion);
            $SocioDao= new SocioDAO($conexion);
            $ReservaDao= new ReservaDAO($conexion);
            $LibroDao= new LibroDAO($conexion);
            $ReservaEjemplarDao= new ReservaEjemplarDAO( $conexion);
            
          
            //LLENO EL PRESTAMO A GUARDAR 
            $reserva->setIdSocio($data->{'datoSocio'});
            $reserva->setFechaInicio($data->{'datofechaInicio'}); 
            $reserva->setEstado(1);
            $reserva->setfechaFin($this->calcFechaVen(7));

            
    
    
            //VEO QUE ONDA EL SOCIO SI PUEDE HACER PRESTAMO
            
            $socio= $SocioDao->load($data->{'datoSocio'});
    
            if($socio->getEstado()==3){
                    throw new Exception("El socio está sancionado no puede solicitar reservas.");
                }
            // 1) EL SOCIO YA TIENE 3 LIBROS PRESTADOS?}
          
         
           if( $ReservaEjemplarDao->socioCantPres($data->{'datoSocio'})==3){
            throw new Exception("El socio ya tiene 3 libros y reservas en total");
           }
    
    
            // VEO LOS EJEMPLARES
            $libro1= $data->{'datoEjems1'};
            $libro2= $data->{'datoEjems2'};
            $libro= $data->{'datoEjems'};
            
            //VEO SI NO SE MANDAN EJEMPLARES
            if(!$libro1 && !$libro2 && !$libro){
                throw new Exception("Ingrese al menos un ejemplar");
            }
            /*if($libro1 &&ej2 &&ej){
                if( ej!= ej1 && ej1!=ej2 && ej2!=ej){
                resul= true
                }
              }
              else if((ej && !ej1 && !ej2) ){
                resul= true;}
                
              else if((!ej && ej1 && !ej2) ){
                  resul= true;
                  }
              
                else if((!ej && !ej1 && ej2) ){
                    resul= true;
                    }
              
              if(ej && ej1 && !ej2){
                  if(ej!=ej1){
                    resul= true;
                 }}
               if(ej && !ej1 && ej2){
                  if(ej!=ej2){
                    resul= true;
                 }}
               if(!ej && ej1 && ej2){
                  if(ej1!=ej2){
                    resul= true;
                 }}*/
            
            //GUARDO LOS EJEMS  EN UN ARRAY PARA RECORRERLO 
            $arrayEjems= [];
           array_push($arrayEjems,$libro1);
           array_push( $arrayEjems,$libro2);
           array_push($arrayEjems,$libro);
            // VEO QUE PASA SI HAY MAS DE 3 LIBROS
           if(count($arrayEjems)>3){
           
            throw new Exception("El máximo de ejemplares por reserva es 3. ");
             }
             $ReservaDao->save($reserva);
             $idres= $reserva->getId();

            //AHORA RECORREMOS EL ARRAY DE EJEMPLARES ASÍ VEMOS QUE ONDA
            foreach($arrayEjems as $ejem){
                if($ejem!=null){
                  //  echo"ola ejem es". $ejem;
                  $ejemLibro=$EjemplarDao->loadPORCodigo($ejem)->getIdLibro();
                  //echo"ola ejemLibro es".$ejemLibro;//LIBRO ES 8

                   //BUSCO EL LIBRO 
                    $tieneElEjemPres= $PrestamoDao->elSocioTieneyaElLibro($data->{'datoSocio'},$ejemLibro);
                    $tieneElEjemRes= $ReservaDao->elSocioTieneyaElLibro($data->{'datoSocio'},$ejemLibro);
                    //EL SOCIO LO TIENE AL EJEM?
                    if($tieneElEjemPres==true ){
                        throw new Exception("El socio ya tiene el libro ". $ejem."  prestado");
                    }
           

                    if( $tieneElEjemRes== true){
                        throw new Exception("El socio ya tiene el libro ". $ejem."  reservado");
                    }
    
    
    
                    //ELSOCIO TIENE UN EJEM DE ESE LIBRO?
    
              
                    $ResEjem= new ReservaEjemplar();
                    $ResEjem->setIdEjemplar($ejem);
                    $ResEjem->setIdReserva($idres);
                    echo"EL EJEM ES ".$ResEjem->getIdEjemplar();
                    $ReservaEjemplarDao->save($ResEjem);
                    $EjemplarDao->dejarloComoReservado($ejem);
    
                
                }}}
    
        
         
           //GUARDO PRESTAMO
         
      
      catch(PDOException $ex){
          $response->{"error"} = $ex->getMessage();
      }
      catch(\Exception $ex){
          $response->{"error"} = $ex->getMessage();
      }
      
      
      echo json_encode($response);
      }

public function retirar($controller,$action,$data){
    $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
  
    $data = json_decode(file_get_contents("php://input"));
   $id= $data->{"id"};
  

   
   
    try{
        $conexion = Conexion::establecer();

    $ReservaDao= new ReservaDAO($conexion);
    $EjemplarDao= new EjemplarDAO( $conexion);
    $PrestamoDao= new PrestamoDAO($conexion);
    $SocioDao= new SocioDAO($conexion);
    $ReservaEjemplarDao= new ReservaEjemplarDAO($conexion);
    $LibroDao= new LibroDAO($conexion);
    $PrestamoEjemplarDao= new PrestamoEjemplarDAO( $conexion);

  
    $reserva= $ReservaDao->load($id);

    $ReservaDao->retirar($reserva->getId());//GUARDA FECHA DE RETIRO Y PONE RESERVA EN 3 RETIRADA
  
    //$PrestamoController= new PrestamoController();
    $response->{"result"} = $reserva->toJson();
    //CREO NUEVO PRESTAMO
   
    

  
    //LLENO EL PRESTAMO A GUARDAR 
    $prestamo = new Prestamo();
    $prestamo->setIdSocio($reserva->getIdSocio());
    $prestamo->setFechaInicio($reserva->getFechaInicio());
    $prestamo->setFechaVen($reserva->getFechaVen());
    $prestamo->setFechaInicio($reserva->getFechaInicio());
    $prestamo->setTipo(1);
    $prestamo->setEstado(1);

  
    


    //VEO QUE ONDA EL SOCIO SI PUEDE HACER PRESTAMO
    
    $socio= $SocioDao->load($reserva->getIdSocio());

    if($socio->getEstado()==3){
            throw new Exception("El socio está sancionado no puede solicitar prestamos.");
        }
    // 1) EL SOCIO YA TIENE 3 LIBROS PRESTADOS?}
  
 
   

    // VEO LOS EJEMPLARES
   $arrayEjems= $ReservaEjemplarDao->traerReservas($reserva->getId());
   
    /*if($libro1 &&ej2 &&ej){
        if( ej!= ej1 && ej1!=ej2 && ej2!=ej){
        resul= true
        }
      }
      else if((ej && !ej1 && !ej2) ){
        resul= true;}
        
      else if((!ej && ej1 && !ej2) ){
          resul= true;
          }
      
        else if((!ej && !ej1 && ej2) ){
            resul= true;
            }
      
      if(ej && ej1 && !ej2){
          if(ej!=ej1){
            resul= true;
         }}
       if(ej && !ej1 && ej2){
          if(ej!=ej2){
            resul= true;
         }}
       if(!ej && ej1 && ej2){
          if(ej1!=ej2){
            resul= true;
         }}*/
    
    //GUARDO LOS EJEMS  EN UN ARRAY PARA RECORRERLO 
   /* $arrayEjems= [];
   array_push($arrayEjems,$libro1);
   array_push( $arrayEjems,$libro2);
   array_push($arrayEjems,$libro);
    // VEO QUE PASA SI HAY MAS DE 3 LIBROS
   if(count($arrayEjems)>3){
   
    throw new Exception("El máximo de ejemplares por prestamo es 3. ");
     }
     $PrestamoDao->save($prestamo);*/

    //AHORA RECORREMOS EL ARRAY DE EJEMPLARES ASÍ VEMOS QUE ONDA
    $PrestamoDao->save($prestamo);
    foreach($arrayEjems as $ejem){
        if($ejem!=null){
      
           //BUSCO EL LIBRO 
            //$tieneElEjem= $PrestamoDao->elSocioTieneyaElEjem($reserva->getIdSocio(),$ejem);
            //EL SOCIO LO TIENE AL EJEM?
           /* if($tieneElEjem==true){
                throw new Exception("El socio ya tiene el libro". $ejem);
            }*/


            //ELSOCIO TIENE UN EJEM DE ESE LIBRO?

      
            $PresEjem= new PrestamoEjemplar();
            $PresEjem->setIdEjemplar($ejem);
           
            $PresEjem->setIdPrestamo($prestamo->getId());
            //var_dump($prestamo->getId());
            $PrestamoEjemplarDao->save($PresEjem);
            $EjemplarDao->dejarloComoReservado($ejem);

        
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






}

