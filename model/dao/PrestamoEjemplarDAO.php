<?php


namespace model\dao;
require_once("InterfaceDAO.php");
use model\dao\InterfaceDAO;
require_once("DAO.php");
use model\dao\DAO;
require_once "../model/entities/Prestamo.php";
use model\entities\Libro;


final class PrestamoEjemplarDAO extends DAO implements InterfaceDAO{

    public function __construct($conn){
        parent::__construct($conn);
    }
public function list($filtros){
    $sql = "SELECT  prestamos.id, prestamos.socio,prestamos.fechaInicio, prestamos.fechaVen,prestamos.tipo,prestamos.estado, socios.nombre as socio 
    from prestamos
    INNER JOIN socios on socios.dni=prestamos.socio";
   
      // $sql = "SELECT * FROM usuarios";
          $stmt = $this->conn->prepare($sql);
          if(!$stmt->execute()){
              throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
          }
          return $stmt->fetchAll(\PDO::FETCH_ASSOC);
      }


 public function delete($id){
        
        $sql= "UPDATE libro SET estado=0 WHERE id='$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    public function update($libro){
        $id= $libro->getId();
        $ISBN= $libro->getISBN();
        $titulo= $libro->getTitulo();
        $edicion= $libro->getEdicion();
        $editorial =$libro->getEditorial();
        $autor=$libro->getIdAutor();
        $disciplina= $libro->getIdDis();

        $NEjem=$libro->getCantEjemplares();
        $estado= $libro->getEstado();
        echo"hola estado es",$estado;
      
        $sql= "UPDATE libro SET  ISBN= $ISBN,titulo = '$titulo', edicion = '$edicion',  editorial = '$editorial',autor = '$autor',disciplina = '$disciplina',cantEjemplares = '$NEjem',estado = '$estado' WHERE id= '$id'";
     
         
         $stmt = $this->conn->prepare($sql);
         if(!$stmt->execute()){
             throw new \Exception("No se pudo eliminar");
         }
         return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
     }
public function save($ej){
  //  $this->validateLibro($libro);
  //echo"ola soy daosave el socio id es",$socio->getIdSocio();
 
    $sql = "INSERT INTO `ejemplarprestamo` VALUES(DEFAULT, :idPrestamo,:idEjemplar, :cantRenovaciones,:fechaDev,:obsDevolucion )";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "idPrestamo" => $ej->getIdPrestamo(),
        "idEjemplar" => $ej->getIdEjemplar(),
       "cantRenovaciones" => $ej->getCantidadRenovaciones(),
        "fechaDev"=>$ej->getFechaDev(),
       "obsDevolucion"=>$ej->getObsDev()
    ));




}
public function load($id){

    $sql= "SELECT * FROM libro WHERE id = :id";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
      "id"=> $id)

  );
  if($stm->rowCount() != 1){
      throw new \Exception("No se encontro el usuario con el id");

  }
      $result = $stm->fetch();
     $libro= new Libro();
     $libro->setId($result->id);
     $libro->setEstado($result->estado);       
 
     return $libro;


  //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
  //si lo encontre le hago fetch saco los datos de la consulta
  //crear una entidad nueva, setear los campos y devolver la entidad
}
}