<?php


namespace model\dao;

use model\entities\Prestamo;
use PDO;
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

public function renovar($pres,$fechaVen){
    $sql=" UPDATE prestamos SET estado=4, fechaInicio= NOW(), fechaVen= :fechaVen WHERE id= :pres";
  
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array(
        "pres"=> $pres,
        "fechaVen"=> $fechaVen)
    );
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
public function devolver($pres,$estado){
    $sql= "UPDATE prestamos SET estado= $estado WHERE id= $pres";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo devolver el libro");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
public function socioCantPres($id): int{
    $sql="SELECT COUNT(*) FROM PRESTAMOS WHERE socio='$id' and estado=1 and (fechaVen> NOW() or (fechaVen= CURDATE() and hour(fechaVen)>=18))";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
    }
    return $stmt->fetchColumn();
}
public function elSocioTieneyaElEjem($socio,$ejem){
    $sql= "SELECT libro.titulo FROM prestamos 
    INNER JOIN ejemplarprestamo ON ejemplarprestamo.prestamo=prestamos.id
    INNER JOIN ejemplares ON ejemplares.codigo= ejemplarprestamo.ejemplar
    INNER JOIN libro ON libro.id= ejemplares.libro
    WHERE prestamos.socio= :socio AND ejemplares.codigo= :ejem AND prestamos.estado= 1";
        //preparar la consulta
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            "socio"=> $socio,
            "ejem"=> $ejem)
        );

        if($stm->rowCount()>0){
            return true;
        }
        if($stm->rowCount()==0){
            return false;
        }
      
}


public function listVens(){
    $sql = "SELECT  prestamos.id as idPres, prestamos.socio,prestamos.fechaInicio, prestamos.fechaVen,prestamos.tipo,prestamos.estado, socios.apellido as socioApellido,socios.nombre as socioNombre
    , ejemplares.codigo as codigoEjemplar, libro.titulo as libro, ejemplarprestamo.fechaDev as fechaDev,ejemplarprestamo.cantRenovaciones as cantReno, ejemplarprestamo.obsDevolucion as obsDev from prestamos
    INNER JOIN socios on socios.dni=prestamos.socio
     INNER JOIN ejemplarprestamo on ejemplarprestamo.prestamo=prestamos.id
    INNER JOIN ejemplares on ejemplares.codigo=ejemplarprestamo.ejemplar
    INNER JOIN libro on libro.id=ejemplares.libro
    where prestamos.fechaVen < NOW() and prestamos.estado <>0";
   
      // $sql = "SELECT * FROM usuarios";
          $stmt = $this->conn->prepare($sql);
          if(!$stmt->execute()){
              throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
          }
          $resultado= $stmt->fetchAll(\PDO::FETCH_ASSOC);
         
          return $resultado;
}



public function listVensDia($diaven){
    
    $sql = "SELECT  prestamos.id as idPres, prestamos.socio,prestamos.fechaInicio, prestamos.fechaVen,prestamos.tipo,prestamos.estado, socios.apellido as socioApellido,socios.nombre as socioNombre
    , ejemplares.codigo as codigoEjemplar, libro.titulo as libro, ejemplarprestamo.fechaDev as fechaDev,ejemplarprestamo.cantRenovaciones as cantReno, ejemplarprestamo.obsDevolucion as obsDev from prestamos
    INNER JOIN socios on socios.dni=prestamos.socio
     INNER JOIN ejemplarprestamo on ejemplarprestamo.prestamo=prestamos.id
    INNER JOIN ejemplares on ejemplares.codigo=ejemplarprestamo.ejemplar
    INNER JOIN libro on libro.id=ejemplares.libro
    where DATE(prestamos.fechaVen)= '$diaven' and (prestamos.estado=1 or prestamos.estado=4)";
   
      // $sql = "SELECT * FROM usuarios";
          $stmt = $this->conn->prepare($sql);
          if(!$stmt->execute()){
              throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
          }
          $resultado= $stmt->fetchAll(\PDO::FETCH_ASSOC);
         
          return $resultado;
}





public function elSocioTieneyaElLibro($socio,$libro){
    $sql= "SELECT libro.titulo FROM prestamos
    INNER JOIN ejemplarprestamo ON ejemplarprestamo.prestamo=prestamos.id
    INNER JOIN ejemplares ON ejemplares.codigo= ejemplarprestamo.ejemplar
    INNER JOIN libro ON libro.id= ejemplares.libro
    WHERE prestamos.socio= :socio AND ejemplares.libro= :libro ";
        //preparar la consulta
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            "socio"=> $socio,
            "libro"=> $libro)
        );
      //  var_dump("ola resultado", $stm->rowCount() === 1);
      return $stm->rowCount() >0 ;
}
public function list($filtros){
    $sql = "SELECT  prestamos.id as idPres, prestamos.socio,prestamos.fechaInicio, prestamos.fechaVen,prestamos.tipo,prestamos.estado, socios.apellido as socioApellido,socios.nombre as socioNombre
    , ejemplares.codigo as codigoEjemplar, libro.titulo as libro, ejemplarprestamo.fechaDev as fechaDev,ejemplarprestamo.cantRenovaciones as cantReno, ejemplarprestamo.obsDevolucion as obsDev from prestamos
    INNER JOIN socios on socios.dni=prestamos.socio
     INNER JOIN ejemplarprestamo on ejemplarprestamo.prestamo=prestamos.id
    INNER JOIN ejemplares on ejemplares.codigo=ejemplarprestamo.ejemplar
    INNER JOIN libro on libro.id=ejemplares.libro
    where ejemplarprestamo.obsDevolucion= 0 or ejemplarprestamo.obsDevolucion=''";
   
      // $sql = "SELECT * FROM usuarios";
          $stmt = $this->conn->prepare($sql);
          if(!$stmt->execute()){
              throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
          }
          $resultado= $stmt->fetchAll(\PDO::FETCH_ASSOC);
         
          return $resultado;
      }








      public function prestamosSocio($dni){
  
        $sql = "SELECT  prestamos.id as idPres, prestamos.socio,prestamos.fechaInicio, prestamos.fechaVen,prestamos.tipo,prestamos.estado, socios.apellido as socioApellido,socios.nombre as socioNombre
        , ejemplares.codigo as codigoEjemplar, libro.titulo as libro, ejemplarprestamo.fechaDev as fechaDev,ejemplarprestamo.cantRenovaciones as cantReno, ejemplarprestamo.obsDevolucion as obsDev from prestamos
        INNER JOIN socios on socios.dni=prestamos.socio
         INNER JOIN ejemplarprestamo on ejemplarprestamo.prestamo=prestamos.id
        INNER JOIN ejemplares on ejemplares.codigo=ejemplarprestamo.ejemplar
        INNER JOIN libro on libro.id=ejemplares.libro
        where prestamos.socio= $dni";
       
          // $sql = "SELECT * FROM usuarios";
              $stmt = $this->conn->prepare($sql);
              if(!$stmt->execute()){
                  throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
              }
              $resultado= $stmt->fetchAll(\PDO::FETCH_ASSOC);
             
              return $resultado;
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
public function renovadoUnaVez($pres){
    $sql="UPDATE prestamos SET estado= 4 WHERE id= :pres";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array(
        "pres"=> $pres));
        
}
public function renovadoXex($pres){
    $sql="UPDATE prestamos SET estado= 5 WHERE id= :pres";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array(
        "pres"=> $pres));
        
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

    $sql= "SELECT * FROM prestamos WHERE id = :id";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
      "id"=> $id)

  );
  if($stm->rowCount() != 1){
      throw new \Exception("No se encontro el prestamo");

  }
      $result = $stm->fetch();
     $prestamo= new Prestamo();
     $prestamo->setId($result->id);
     $prestamo->setFechaInicio($result->fechaInicio);
     $prestamo->setFechaVen($result->fechaVen);
     //echo"ola fecha ven es", $prestamo->getFechaVen();
     $prestamo->setEstado($result->estado);
     $prestamo->setIdSocio($result->socio);
     $prestamo->setTipo($result->tipo);
     

      
 
     return $prestamo;


  //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
  //si lo encontre le hago fetch saco los datos de la consulta
  //crear una entidad nueva, setear los campos y devolver la entidad
}

public function listBajas($filtros){
    
    $sql = "SELECT 
    b.motivo,
    b.fechaHora,
    b.usuario AS usuarioBaja,
    usuarios.nombre AS nombreUsuario, 
    prestamos.id, 
    prestamsos.socio, 
    prestamos.fechaInicio, 
    prestamos.fechaVen, 
    prestamos.tipo,
    prestamos.estado
FROM bajasprestamo
INNER JOIN prestamos ON b.prestamo = prestamo.id
INNER JOIN usuarios ON b.usuario = usuarios.id";

    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
}