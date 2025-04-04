<?php

namespace controller;
require_once "../model/entities/Ejemplar.php";
use model\entities\Ejemplar;
use model\dao\BajaEjemplarDAO;
require_once "../model/entities/BajaEjemplar.php";
require_once "../model/dao/EjemplarDAO.php";
require_once "../model/dao/BajaEjemplarDAO.php";
use model\dao\EjemplarDAO;
use model\entities\BajaEjemplar;
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;
use Exception;

final class EjemplarController{
    /**
     * Página principal o de inicio del módulo CLIENTE
     */
     public function index($controller,$action,$data){
        require_once"../public/view/ejemplar/index.php";

     }
     public function loadd($controller, $action, $data){
       

         $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
         $response->{"controller"} = $controller;
         $response->{"action"} = $action;
         $data = json_decode(file_get_contents("php://input"));
         $id=(int ) $data->{"datoEjems"};
    
         try{
             $conexion = Conexion::establecer();
             $dao = new EjemplarDAO($conexion);
             $s= $dao->loadd($id);
              
             $response->{"result"}=$s;
         }
         catch(PDOException $ex){
             $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
         }
         catch(\Exception $ex){
             $response->{"error"} = $ex->getMessage();
         }
      echo json_encode($response);
     }
     public function ejemplar($controller,$action,$data){
        require_once"../public/view/ejemplar/ejemplar.php";

     }
     public function showSave($controller,$action,$data){
        require_once"../public/view/ejemplar/agregar.php";
     }
     public function showSaveEjemplares($controller,$action,$data){
        require_once"../public/view/ejemplar/agregarEjemplar.php";

     }
     public function save($controller, $action, $data){
        $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
     
        $libro=$data->datoLibro;
        $ejem = new Ejemplar($libro);
        echo"hola soy save controller data libro es",$data->datoLibro;;
        $response->{"result"} = $ejem->toJson();
        try{
          $ejem->setCodigo($data->datoCodigo);
          $ejem->setObs($data->datoObservacion);
          $ejem->setIdLibro($data->datoLibro);
          echo"hola soy save controller ejem idlibro es", $ejem->getIdLibro();
          $ejem->setEstado(1);
          $conexion = Conexion::establecer();
          $daoEjem= new EjemplarDAO($conexion);
          $daoEjem->save($ejem);
      }
      catch(PDOException $ex){
          $response->{"error"} = $ex->getMessage();
      }
      catch(\Exception $ex){
          $response->{"error"} = $ex->getMessage();
      }
      
      
      echo json_encode($response);
      }
      public function listGeneral($controller, $action, $data){
     
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        try{
            $conexion = Conexion::establecer();
            $dao = new EjemplarDAO($conexion);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $dao->listGeneral($data);
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datosssss: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
    
        echo json_encode($response);
    }
     public function list($controller, $action, $data){
        echo"ñao soy list controller";
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        try{
            $conexion = Conexion::establecer();
            $dao = new EjemplarDAO($conexion);
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
    public function showEjemplaresLibro($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
        $ISBN= $data->{"id"};
       
        try{
            $conexion = Conexion::establecer();
            $dao = new EjemplarDAO($conexion);
          
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} =   $dao->buscarEjems($ISBN);;
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
            $dao = new EjemplarDAO($conexion);
            $ejem= $dao->load($id);
            $baja= new BajaEjemplar();
            $baja->setIdEjemplar($ejem->getId());
            $baja-> setIdUsuario($_SESSION["idUsuario"]);
            $baja->setMotivo($motivo);
            $daoBaja= new BajaEjemplarDAO($conexion);
            $daoBaja->save($baja);
           
           // $daoEjem=new EjemplarDAO($conexion);
            $dao->delete($ejem->getId());

            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $ejem->toJson();
            
        }
        catch(PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
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
            $dao = new EjemplarDAO($conexion);
            $ejem= $dao->load($id);
            $ejem->setCodigo($data->{"datoCodigo"});
            $ejem->setObs($data->{"datoObservacion"});
           // echo"hola dato edicion es", $data->{"datoEdicion"};
            $ejem->setEstado($data->{"datoEstado"});
            $ejem->setIdLibro($data->{"datoLibro"});
            $dao->update($ejem);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $ejem->toJson();
        }
        catch(PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
      
        echo json_encode($response);  } 
      


    }