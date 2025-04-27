<?php


namespace model\dao;

use model\entities\Prestamo;
use model\entities\Reserva;
use PDO;
require_once("InterfaceDAO.php");
use model\dao\InterfaceDAO;
require_once("DAO.php");
use model\dao\DAO;
require_once "../model/entities/Prestamo.php";
use model\entities\Libro;


final class ReservaDAO extends DAO implements InterfaceDAO{

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
public function elSocioTieneyaElLibro($socio,$libro){
    $sql= "SELECT libro.titulo FROM reservas
    INNER JOIN ejemplarreserva ON ejemplarreserva.reserva=reservas.id
    INNER JOIN ejemplares ON ejemplares.codigo= ejemplarreserva.ejemplar
    INNER JOIN libro ON libro.id= ejemplares.libro
    WHERE reservas.socio= :socio AND ejemplares.libro= :libro AND reservas.estado= 1";
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
    $sql = " SELECT reservas.id as idRes,
                reservas.socio as idSo,
                reservas.fechaInicio,
                reservas.fechaFin,
                reservas.estado as estadoRes, ejemplares.codigo as ejem, libro.titulo
                
                from reservas
                inner join ejemplarreserva on reservas.id= ejemplarreserva.reserva
                inner join ejemplares on ejemplares.codigo= ejemplarreserva.ejemplar
                inner join libro on libro.id= ejemplares.libro
                where reservas.estado= 1 or reservas.estado= 2
                order by reservas.id";
   
      // $sql = "SELECT * FROM usuarios";
          $stmt = $this->conn->prepare($sql);
          if(!$stmt->execute()){
              throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
          }
          $resultado= $stmt->fetchAll(\PDO::FETCH_ASSOC);
         
          return $resultado;
      }

      public function listHoy($filtros){
        $hoy= date("Y-m-d H:i:s");
        $sql = " SELECT reservas.id as idRes,
                    reservas.socio as idSo,
                    reservas.fechaInicio ,
                    reservas.fechaFin ,
                    reservas.estado as estadoRes, ejemplares.codigo as ejem, libro.titulo
                    
                    from reservas
                    inner join ejemplarreserva on reservas.id= ejemplarreserva.reserva
                    inner join ejemplares on ejemplares.codigo= ejemplarreserva.ejemplar
                    inner join libro on libro.id= ejemplares.libro
                    where reservas.estado= 1 and reservas.fechaInicio <= :hoy and reservas.fechaFin > :hoy
                    order by reservas.id";
      
          // $sql = "SELECT * FROM usuarios";
              $stmt = $this->conn->prepare($sql);
              $stmt->bindParam(':hoy', $hoy, PDO::PARAM_STR);
              if(!$stmt->execute()){
                  throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
              }
              $resultado= $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
              return $resultado;
          }
 public function delete($id){
        
        $sql= "UPDATE reservas SET estado=0 WHERE id='$id'";
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
           
        $sql= "UPDATE libro SET  ISBN= $ISBN,titulo = '$titulo', edicion = '$edicion',  editorial = '$editorial',autor = '$autor',disciplina = '$disciplina',cantEjemplares = '$NEjem',estado = '$estado' WHERE id= '$id'";
     
         
         $stmt = $this->conn->prepare($sql);
         if(!$stmt->execute()){
             throw new \Exception("No se pudo eliminar");
         }
         return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
     }
public function renovadoUnaVez($pres){
    $sql="UPDATE prestamos SET estado= 5 WHERE id= :pres";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array(
        "pres"=> $pres));
        
}
public function save($socio){
  //  $this->validateLibro($libro);
  //echo"ola soy daosave el socio id es",$socio->getIdSocio();
  //echo"fechaven es ",$socio->getFechaVen();
  
    $sql = "INSERT INTO `reservas` VALUES(DEFAULT, :socio, :fechaInicio,:fechaFin,:estado,:fechaRetiro )";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "socio" => $socio->getIdSocio(),
        "fechaInicio" => $socio->getFechaInicio(),
       "fechaFin" => $socio->getFechaFin(),
       "estado"=>$socio->getEstado(),
       "fechaRetiro"=>$socio->getFechaRetiro()
    ));


$idRess=$this->conn->lastInsertId();
$socio->setId($idRess);

}

public function retirar($id){
    $sql="UPDATE reservas SET fechaRetiro= NOW(), estado= 2 WHERE id= :id";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "id"=> $id)
  
    );
    
    return $stm->fetchAll(\PDO::FETCH_ASSOC);
}
public function load($id){

    $sql= "SELECT * FROM reservas WHERE id = :id";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
      "id"=> $id)

  );
  if($stm->rowCount() != 1){
      throw new \Exception("No se encontro el prestamo");

  }
      $result = $stm->fetch();
     $prestamo= new Reserva();
     $prestamo->setId($result->id);
     $prestamo->setFechaInicio($result->fechaInicio);
     $prestamo->setFechaFin($result->fechaFin);
     //echo"ola fecha ven es", $prestamo->getFechaVen();
     $prestamo->setEstado($result->estado);
     $prestamo->setIdSocio($result->socio);
    
     
     

      
 
     return $prestamo;


  //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
  //si lo encontre le hago fetch saco los datos de la consulta
  //crear una entidad nueva, setear los campos y devolver la entidad
}
public function reservasSocio($dni){
   
    $sql = "SELECT  reservas.id as idRes, reservas.socio,reservas.fechaInicio, reservas.fechaFin,reservas.estado, socios.apellido as socioApellido,socios.nombre as socioNombre
    , ejemplares.codigo as codigoEjemplar, libro.titulo as libro, ejemplarreserva.ejemplar as ejemplar,ejemplarreserva.reserva as reserva, reservas.fechaRetiro as fechaRetiro  from reservas
    INNER JOIN socios on socios.dni=reservas.socio
     INNER JOIN ejemplarreserva on ejemplarreserva.reserva=reservas.id
    INNER JOIN ejemplares on ejemplares.codigo=ejemplarreserva.ejemplar
    INNER JOIN libro on libro.id=ejemplares.libro
    where reservas.socio= $dni";
   
      // $sql = "SELECT * FROM usuarios";
          $stmt = $this->conn->prepare($sql);
          if(!$stmt->execute()){
              throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
          }
          $resultado= $stmt->fetchAll(\PDO::FETCH_ASSOC);
         
          return $resultado;
      }


public function listBajas($filtros){
    
    $sql = "SELECT 
    b.motivo,
    b.fechaHora,
    
    reservas.id, 
    reservas.socio, 
   reservas.fechaInicio, 
    reservas.fechaFin, 
    reservas.fechaRetiro,
    reservas.estado
FROM bajasreserva b 
INNER JOIN reservas ON b.reserva = reservas.id";
//INNER JOIN usuarios ON b.usuario = usuarios.id

    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
}