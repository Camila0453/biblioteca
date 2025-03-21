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
final class LibroController{
    /**
     * Página principal o de inicio del módulo CLIENTE
     */
     public function index($controller,$action,$data){
        require_once"../public/view/libro/index.php";

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
        $id= $data->isbn;
        $motivo= $data->motivo;
        try{
            $conexion = Conexion::establecer();
            $dao = new LibroDAO($conexion);
            $libro= $dao->load($id);
            $bajaLibro= new BajaLibro();
            $bajaLibro->setIdLibro($libro->getISBN());
            $bajaLibro->setIdUsuario($_SESSION["idUsuario"]);
            $bajaLibro->setMotivo($motivo);
            $daoBajaLibro= new BajaLibroDAO($conexion);

            $daoBajaLibro->save($bajaLibro);
            $daoLibro=new LibroDAO($conexion);
            $daoLibro->delete($libro->getISBN());
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
    
}