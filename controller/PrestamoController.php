<?php

namespace controller;
require_once "../model/entities/BajaLibro.php";
use model\dao\EjemplarDAO;
require_once "../model/dao/EjemplarDAO.php";
use model\entities\BajaLibro;
require_once "../model/dao/SocioDAO.php";
require_once "../model/dao/ReservaEjemplarDAO.php";
require_once "../model/dao/LibroDAO.php";
use model\dao\LibroDAO;
use model\dao\reser;
use model\entities\Socio;
require_once "../model/entities/Prestamo.php";
require_once "../model/entities/PrestamoEjemplar.php";
use model\entities\PrestamoEjemplar;
require_once "../model/dao/PrestamoDAO.php";
use model\dao\PrestamoDAO;
use model\entities\Prestamo;
require_once "../model/dao/BajaLibroDAO.php";
use model\dao\BajaLibroDAO;
require_once "../model/dao/PrestamoEjemplarDAO.php";
use model\dao\PrestamoEjemplarDAO;
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;
use Exception;
use DateTime;
use model\dao\SocioDAO;

final class PrestamoController{
    /**
     * Página principal o de inicio del módulo CLIENTE
     */
     public function index($controller,$action,$data){
        require_once"../public/view/prestamo/index.php";

     }
     public function showSave($controller,$action,$data){
        require_once"../public/view/prestamo/agregar.php";
     }
     public function showEjemplaresPres($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
        $ISBN= $data->{"id"};
       
        try{
            $conexion = Conexion::establecer();
            $dao = new PrestamoEjemplarDAO($conexion);
          
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} =   $dao->buscarEjemsPres($ISBN);;
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datosssss: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
    
        echo json_encode($response);
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
            $response->{"result"} =   $dao->buscarEjemsPres($ISBN);;
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datosssss: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
    
        echo json_encode($response);
    }
    public function showHistorico($controller,$action,$data){
        require_once"../public/view/libro/historico.php";
     }


     public function  ejemplaresPrestamo($controller,$action,$data){
        require_once"../public/view/prestamo/ejemplaresPrestamo.php";
     }
   
     public function list($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        try{
            $conexion = Conexion::establecer();
            $dao = new PrestamoDAO($conexion);
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
    
        $id= $data->id;
    

        $motivo= $data->motivo;
        try{
            $conexion = Conexion::establecer();
            $dao = new LibroDAO($conexion);
            $libro= $dao->load($id);
            $bajaLibro= new BajaLibro();
            $bajaLibro->setIdLibro($libro->getId());
            $bajaLibro->setIdUsuario($_SESSION["idUsuario"]);
            $bajaLibro->setMotivo($motivo);
            $daoBajaLibro= new BajaLibroDAO($conexion);

            $daoBajaLibro->save($bajaLibro);
            $daoLibro=new LibroDAO($conexion);
            $daoLibro->delete($libro->getId());
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $libro->toJson();
            
        }
        catch(PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

        echo json_encode($response);
    }






function vens($controller,$action,$data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        try{
            $conexion = Conexion::establecer();
            $dao = new PrestamoDAO($conexion);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $dao->listVens($data);
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datosssss: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
    
        echo json_encode($response);
}
function vensDias($controller,$action,$data){
    $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
    $data = json_decode(file_get_contents("php://input"));
    
   
    $diaVen= $data->fecha;
   

    try{
        $conexion = Conexion::establecer();
        $dao = new PrestamoDAO($conexion);
        //Por ahora, si hubieran filtros, vendrían en $data
        $response->{"result"} = $dao->listVensDia($diaVen);
    }
    catch(\PDOException $ex){
        $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
    }
    catch(\Exception $ex){
        $response->{"error"} = $ex->getMessage();
    }

    echo json_encode($response);
}
















    
public function socioCantPrestamo($controller, $action, $data):int{
    
    $data = json_decode(file_get_contents("php://input"));
    $id=$data->{"id"};
    $conexion = Conexion::establecer();
    $dao= new PrestamoDAO($conexion);

return $dao->socioCantPres($id);
}

public function socioTieneEjem($controller, $action, $data){
 
        $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));

        $socio= $data->{"socio"};
        $ejem= $data->{"datoEjems"};
        try{
            $conexion = Conexion::establecer();
            $dao= new Prestamo($conexion);
            $result= $dao->socioTieneEjem($socio,$ejem);
            

            if(!empty($result)){
                $response->result=true;
            }}
            catch (Exception $ex){
                $response->error=$ex->getMessage();
            }
    
            echo json_encode($response);
}



/*public function buscar($controller,$action,$data,){
    $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
    $data = json_decode(file_get_contents("php://input"));

    $isbnOTitulo= $data->{'dato'};
    try{
        $conexion = Conexion::establecer();
        $dao = new LibroDAO($conexion);
        //Por ahora, si hubieran filtros, vendrían en $data
       
        if(is_numeric($isbnOTitulo)){
 
            $response->{"result"} = $dao->buscarIsbn($isbnOTitulo);
        }
        
        else{
           
            $response->{"result"} = $dao->buscarTitulo($isbnOTitulo); 
        }
    }
    catch(\PDOException $ex){
        $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
    }
    catch(\Exception $ex){
        $response->{"error"} = $ex->getMessage();
    }

    echo json_encode($response);
 }*/


public function save($controller, $action, $data){
    $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
  
    $data = json_decode(file_get_contents("php://input"));
   
    $prestamo = new Prestamo();
    $PrestamoEjemplar= new PrestamoEjemplar();
 
   
    $response->{"result"} = $prestamo->toJson();
    try{
        $conexion = Conexion::establecer();
        $EjemplarDao= new EjemplarDAO( $conexion);
        $PrestamoDao= new PrestamoDAO($conexion);
        $SocioDao= new SocioDAO($conexion);
        $LibroDao= new LibroDAO($conexion);
        $PrestamoEjemplarDao= new PrestamoEjemplarDAO( $conexion);
  
      
        //LLENO EL PRESTAMO A GUARDAR 
        $prestamo->setIdSocio($data->{'datoSocio'});
        $prestamo->setFechaInicio($data->{'datofechaInicio'});
        if($data->{'datoTipo'}==1  ){
            $prestamo->setFechaVen($this->calcFechaVen(7));
        }
        else{
            $prestamo->setFechaVen($data->{'datofechaInicio'});
        }
 
      
        $prestamo->setEstado(1);
        $prestamo->setTipo($data->{'datoTipo'});


        //VEO QUE ONDA EL SOCIO SI PUEDE HACER PRESTAMO
        
        $socio= $SocioDao->load($data->{'datoSocio'});

        if($socio->getEstado()==3){
                throw new Exception("El socio está sancionado no puede solicitar prestamos.");
            }
        // 1) EL SOCIO YA TIENE 3 LIBROS PRESTADOS?}
      
     
       if( $PrestamoEjemplarDao->socioCantPres($data->{'datoSocio'})==3){
        throw new Exception("El socio ya tiene 3 libros prestados ctivos");
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
       
        throw new Exception("El máximo de ejemplares por prestamo es 3. ");
         }
         $PrestamoDao->save($prestamo);

        //AHORA RECORREMOS EL ARRAY DE EJEMPLARES ASÍ VEMOS QUE ONDA
        foreach($arrayEjems as $ejem){
            if($ejem!=null){
          
               //BUSCO EL LIBRO 
                $tieneElEjem= $PrestamoDao->elSocioTieneyaElEjem($data->{'datoSocio'},$ejem);
                //EL SOCIO LO TIENE AL EJEM?
                if($tieneElEjem==true){
                    throw new Exception("El socio ya tiene el libro". $ejem);
                }

 //EL SOCIO LO TIENE AL EJEM?
 $tieneElLibro= $PrestamoDao->elSocioTieneyaElLibro($data->{'datoSocio'},$ejem);
 //EL SOCIO LO TIENE AL EJEM?
 if($tieneElLibro==true){
    throw new Exception("El socio ya tiene el libro". $ejem);
}
                //ELSOCIO TIENE UN EJEM DE ESE LIBRO?

          
                $PresEjem= new PrestamoEjemplar();
                $PresEjem->setIdEjemplar($ejem);
                $PresEjem->setIdPrestamo($prestamo->getId());
                $PrestamoEjemplarDao->save($PresEjem);
                $EjemplarDao->dejarloComoPrestado($ejem);

            
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































    
      public function update($controller, $action, $data){

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
      
        $id=  $data->{"datoId"};
        
        try{
         
            $conexion = Conexion::establecer();
            $dao = new LibroDAO($conexion);
            $libro= $dao->load($id);
            $libro->setISBN($data->{"datoISBN"});
            $libro->setTitulo($data->{"datoTitulo"});
           // echo"hola dato edicion es", $data->{"datoEdicion"};
            $libro->setEdicion($data->{"datoEdicion"});
            $libro->setEstado($data->{"datoEstado"});
            echo"hola dato estado es",$data->{"datoEstado"} ;
            $libro->setEditorial($data->{"datoEditorial"});
            $libro->setCantEjem($data->{"datoNEjem"});
            $libro->setAutor($data->{"datoAutor"});
            $libro->setDis($data->{"datoDisciplina"});
           
      
            $dao->update($libro);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $libro->toJson();
        }
        catch(PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
      
        echo json_encode($response);  } 
        public function listBajas($controller, $action, $data){
    
            $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
            $response->{"controller"} = $controller;
            $response->{"action"} = $action;
          
            try{
                $conexion = Conexion::establecer();
                $dao = new PrestamoDAO($conexion);
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
    
    
function devolver($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
        $pres=  $data->{"prestamo"};
       
        $ejem=  $data->{"ejem"};
        $obs= $data->{"obs"};
        $socio= $data->{"socio"};
       // var_dump($obs);
       $conexion = Conexion::establecer();
       $dao = new PrestamoDAO($conexion);
            $daoEjem= new EjemplarDAO($conexion);
            $daoEjemPres= new PrestamoEjemplarDAO($conexion);
            $daoSocio= new SocioDAO($conexion);
        try{
            date_default_timezone_set('America/Argentina/Buenos_Aires'); 
            $prestamo= $dao->load($pres);
            $fechaActual= date('Y-m-d ');
            $fechaVen= date($prestamo->getFechaVen());  
            if($fechaActual> $fechaVen){
                $daoSocio->sancionar($socio);
                $estado= 3;
                //echo"OLA SE PASO LA FECHA DE VEN SANCIONADO 3";
               
            }
            if($fechaActual< $fechaVen){
            //  echo"ola la fecha actual es antes del vencimiento 2";
                $estado= 2;
               
            }
            if($fechaActual == $fechaVen){
              //  echo"OLa la fecha de vencimiento es hoy no pasa nada";
                $estado=2;
            }
          //  var_dump($prestamo);
            if($prestamo->getEstado()== 5){
                throw new Exception("Este prestamo ya fue renovado y extendido, por ello no se puede devolver");
            }
            if($prestamo->getEstado()== 5){
                throw new Exception("Este prestamo ya fue renovado y extendido, por ello no se puede devolver");
            }
          if($prestamo->getEstado()== 2){
            throw new Exception("El prestámo ya ha sido devuelto.");
          }
              
             $dao->devolver($pres,$estado);
            $ponerDispoAlEjem= $daoEjem->dejarloDisponible($ejem);
            $daoEjemPres->registrarDevolucion($ejem,$obs);

             //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $ponerDispoAlEjem;
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datosssss: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
    
        echo json_encode($response);
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
public function renovar($controller, $action, $data){
    $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
    $response->{"controller"} = $controller;
    $response->{"action"} = $action;
    $data = json_decode(file_get_contents("php://input"));
    $pres=  $data->{"prestamo"};
    $ejem= $data->{"ejem"};
    $socio=$data->{"socio"};
   
    //var_dump($socio);
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    try{
        $conexion = Conexion::establecer();
        $dao = new PrestamoDAO($conexion);
        $sociodao= new SocioDAO($conexion);
        $prestamoDao= new PrestamoDAO($conexion);
        $sociox= $sociodao->load($socio);
        $prestamo= $dao->load($pres);
    
        $tipo= $prestamo->getTipo();
        if($tipo!=1){
            throw new Exception("No se puede renovar un prestamo en sala, se deberá solicitar un nuevo prestamo a domicilio");
        }

        if($prestamo->getEstado()==2){
            throw new Exception("No se puede renovar, el prestamo ha sido devuelto");
        }
        if($sociox->getEstado()==3){
            throw new Exception("El socio está sancionado no puede realizar, prestámos, ni renovaciones");
        }
        if($prestamo->getEstado()==0){
            throw new Exception("El prestamo no está activo, no puede renovarse");

        }
        $fechaActual= new DateTime();
        $fechaVen= new DateTime($prestamo->getFechaVen());  

        if($prestamo->getEstado()==3){
            throw new Exception("El prestámo ya ha vencido, no puede renovarse");
        }
      
        $fechaUndiantes= clone $fechaVen;
        $fechaUndiantes-> modify('-1 day');
        $fechaUndiantes->setTime(0,0,0);
        $fechaLim= clone $fechaVen;
        $fechaLim-> setTime(18,0,0);
       $fechaActual->setTime(0,0,0);
       //var_dump($fechaUndiantes);
       //var_dump($fechaActual);
        if($fechaActual < $fechaUndiantes ){
            throw new Exception("El prestámo no es renovable antes de un día antes de la fecha de vencimiento");
        }
         
        if($fechaActual>$fechaLim){
            throw new Exception("El prestámo ya ha vencido, no puede renovarse");
        }
        if($prestamo->getEstado()==5){
            throw new Exception("El prestámo ya ha sido renovado una vez y por lo tanto extendido.");
        }
        if($prestamo->getEstado()==4){
            // 4 ES PARA EL QUE YA SE RENOVÓ UNA VEZ
           // throw new Exception("El prestamo ya ha sido renovado 1 vez.");
           $prestamo->setFechaInicio(date("y-m-d H:i:s"));
           $prestamo->setFechaVen($this->calcFechaVen(7));
           $prestamo->setEstado(1);
           //ACA LO QUE HAGO ES MARCAR QUE SE EXTIENDE
           $dao->renovadoXex($pres);
            //var_dump($prestamo);
            $dao->save($prestamo);
            $EjemPres= new PrestamoEjemplar();
            $presEjemDao= new PrestamoEjemplarDAO($conexion);
            $EjemPres->setIdEjemplar($ejem);
            //echo"ola ejempres  ejem es", $ejem;
            $EjemPres->setIdPrestamo($prestamo->getId());
            $presEjemDao->save($EjemPres);
         
                        }
        else{
     
            $fechaVenNueva= $this->calcFechaVen(7);
            $dao->renovar($pres,$fechaVenNueva);
            $daoEjemPres= new PrestamoEjemplarDAO($conexion); 
            $daoEjemPres->renovar($pres);
            $dao->renovadoUnaVez($prestamo->getId());
          
        }
        

        $response->{"result"} = $pres;
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
      
