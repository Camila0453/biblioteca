<?php


namespace model\dao;
require_once("InterfaceDAO.php");
use model\dao\InterfaceDAO;
require_once("DAO.php");
use model\dao\DAO;
require_once "../model/entities/Prestamo.php";
use model\entities\Libro;


final class PrestamoDAO extends DAO implements InterfaceDAO{

    public function __construct($conn){
        parent::__construct($conn);
    }
public function socioCantPres($id): int{
    $sql="SELECT COUNT(*) FROM PRESTAMOS WHERE socio='$id' and estado=1 and (fechaVen> NOW() or (fechaVen= CURDATE() and hour(fechaVen)>=18))";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
    }
    return $stmt->fetchColumn();
}

public function list($filtros){
    $sql = "SELECT  prestamos.id, prestamos.socio,prestamos.fechaInicio, prestamos.fechaVen,prestamos.tipo,prestamos.estado, socios.apellido as socioApellido,socios.nombre as socioNombre
    , ejemplares.codigo as codigoEjemplar, libro.titulo as libro, ejemplarprestamo.fechaDev as fechaDev,ejemplarprestamo.cantRenovaciones as cantReno, ejemplarprestamo.obsDevolucion as obsDev from prestamos
    INNER JOIN socios on socios.dni=prestamos.socio
     INNER JOIN ejemplarprestamo on ejemplarprestamo.prestamo=prestamos.id
    INNER JOIN ejemplares on ejemplares.codigo=ejemplarprestamo.ejemplar
    INNER JOIN libro on libro.id=ejemplares.libro";
   
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
public function save($socio){
  //  $this->validateLibro($libro);
  //echo"ola soy daosave el socio id es",$socio->getIdSocio();
  //echo"fechaven es ",$socio->getFechaVen();
    $sql = "INSERT INTO `prestamos` VALUES(DEFAULT, :socio, :fechaInicio,:fechaVen,:tipo,:estado )";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "socio" => $socio->getIdSocio(),
        "fechaInicio" => $socio->getFechaInicio(),
       "fechaVen" => $socio->getFechaVen(),
        "tipo"=>$socio->getTipo(),
       "estado"=>$socio->getEstado()
    ));


$idPress=$this->conn->lastInsertId();
$socio->setId($idPress);

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