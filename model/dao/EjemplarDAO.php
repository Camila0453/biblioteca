<?php


namespace model\dao;

use model\entities\Ejemplar;
require_once("InterfaceDAO.php");
use model\dao\InterfaceDAO;
require_once("DAO.php");
use model\dao\DAO;
require_once "../model/entities/Ejemplar.php";


final class EjemplarDAO extends DAO implements InterfaceDAO{

    public function __construct($conn){
        parent::__construct($conn);
    }
    public function list($filtros){
        $sql = "SELECT ejemplares.id,ejemplares.codigo,ejemplares.estado, ejemplares.observación,libro.titulo as libro
        from ejemplares
        INNER JOIN libro on libro.ISBN=ejemplares.libro";
              $stmt = $this->conn->prepare($sql);
              if(!$stmt->execute()){
                  throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
              }
              return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function listGeneral($filtros){
        $sql = "SELECT ejemplares.id,ejemplares.codigo,ejemplares.estado, ejemplares.observación,libro.titulo as libro
        from ejemplares
        INNER JOIN libro on libro.id=ejemplares.libro";
              $stmt = $this->conn->prepare($sql);
              if(!$stmt->execute()){
                  throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
              }
              return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function buscarEjems($ISBN){
        
        $sql = "SELECT ejemplares.id,ejemplares.codigo,ejemplares.estado, ejemplares.observación,ejemplares.libro 
        from ejemplares
       WHERE ejemplares.libro= '$ISBN'";
              $stmt = $this->conn->prepare($sql);
              if(!$stmt->execute()){
                  throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
              }
              return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    
    public function load($id){

        $sql= "SELECT * FROM ejemplares WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
          "id"=> $id)
    
      );
      if($stm->rowCount() != 1){
          throw new \Exception("No se encontro el usuario con el id");
    
      }
          $result = $stm->fetch();
         $ejem= new Ejemplar($result->libro);
         $ejem->setId($result->id);
         $ejem->setIdLibro($result->libro);
         $ejem->setEstado($result->estado);       
     
         return $ejem;
    
    
      //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
      //si lo encontre le hago fetch saco los datos de la consulta
      //crear una entidad nueva, setear los campos y devolver la entidad
    }
    public function loadd($id): bool{
        //consultar para buscar el registro con el id=$id
           // echo"ola soy loaddao si se encontro";
        $sql= "SELECT * FROM ejemplares WHERE codigo= :id";
        //preparar la consulta
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            "id"=> $id)
        );
      //  var_dump("ola resultado", $stm->rowCount() === 1);
         return $stm->rowCount() === 1;
        //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
        //si lo encontre le hago fetch saco los datos de la consulta
        //crear una entidad nueva, setear los campos y devolver la entidad
    }
    public function update($ejem){
        $id= $ejem->getId();
        $codigo= $ejem->getCodigo();
        $libro= $ejem->getIdLibro();
        $obs= $ejem->getObs();
        $estado= $ejem->getEstado();
        $sql= "UPDATE ejemplares SET  codigo= '$codigo',observación = '$obs', estado = '$estado',  libro = '$libro' WHERE id= '$id'";
     
         
         $stmt = $this->conn->prepare($sql);
         if(!$stmt->execute()){
             throw new \Exception("No se pudo eliminar");
         }
         return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function save($ejemplar){
        $sql = "INSERT INTO `ejemplares` VALUES(DEFAULT, :codigo, :obs,:estado,:libro )";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "codigo" => $ejemplar->getCodigo(),
        "obs" => $ejemplar->getObs(),
       "estado"=>$ejemplar->getEstado(),
       "libro"=>$ejemplar->getIdLibro(),
       
    ));
    }
    public function delete($id){ 
            $sql= "UPDATE ejemplares SET estado=0 WHERE id='$id'";
            $stmt = $this->conn->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("No se pudo eliminar");
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        
    }

}