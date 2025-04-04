<?php

namespace controller;
require_once "../model/entities/BajaLibro.php";
use model\entities\BajaLibro;
require_once "../model/entities/Libro.php";
require_once "../model/dao/LibroDAO.php";
use model\dao\LibroDAO;
require_once "../model/dao/BajaLibroDAO.php";
use model\dao\BajaLibroDAO;
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;
use Exception;
use model\entities\Libro;
final class LibroController{
    /**
     * Página principal o de inicio del módulo CLIENTE
     */
     public function index($controller,$action,$data){
        require_once"../public/view/libro/index.php";

     }
     public function showSave($controller,$action,$data){
        require_once"../public/view/libro/agregar.php";
     }

     public function list($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        try{
            $conexion = Conexion::establecer();
            $dao = new LibroDAO($conexion);
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

    public function save($controller, $action, $data){
        $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        $data = json_decode(file_get_contents("php://input"));
       
        $libro = new Libro();
       
        $response->{"result"} = $libro->toJson();
        try{
          $libro->setISBN($data->datoISBN);
          $libro->setTitulo($data->datoTitulo);
          $libro->setEdicion($data->datoEdicion);

          $libro->setAutor($data->datoAutor);
          $libro->setDis($data->datoDisciplina);
          $libro->setEditorial($data->datoEditorial);
          $libro->setCantEjem($data->datoNEjem);
          $conexion = Conexion::establecer();
          $daoLibro= new LibroDAO($conexion);
          $daoLibro->save($libro);
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