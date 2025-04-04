<?php

namespace controller;
require_once "../model/entities/BajaLibro.php";
use model\entities\BajaLibro;
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
public function socioCantPrestamo($controller, $action, $data):int{
    
    $data = json_decode(file_get_contents("php://input"));
    $id=$data->{"id"};
    $conexion = Conexion::establecer();
    $dao= new PrestamoDAO($conexion);

return $dao->socioCantPres($id);
}
    public function save($controller, $action, $data){
       // echo"ola soy savecontroller";
        $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        $data = json_decode(file_get_contents("php://input"));
        $ej1=$data->{"datoEjems"};
          $ej2=$data->{"datoEjems1"};
          $ej3=$data->{"datoEjems2"};
        
        try{
            $conexion = Conexion::establecer();
          $arrayEjems= [];
          array_push($arrayEjems,$ej1);
          array_push( $arrayEjems,$ej2);
         array_push($arrayEjems,$ej3);

          $daopres= new PrestamoDAO($conexion);
          $presEjemDao= new PrestamoEjemplarDAO($conexion);

         
    
          foreach($arrayEjems as $ejem){
            if($ejem!=null){
                $pres = new Prestamo();
                $pres->setIdSocio($data->{"datoSocio"});
                $pres->setTipo($data->{"datoTipo"});
                $daopres->save($pres);
                $EjemPres= new PrestamoEjemplar();
                $EjemPres->setIdEjemplar($ejem);
                $EjemPres->setIdPrestamo($pres->getId());
                $presEjemDao->save($EjemPres);

            }

          }
          
         
          $response->{"result"} = "";
      }
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
      
}