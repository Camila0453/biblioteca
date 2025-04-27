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

 public function socioCantPres($socio): int{
    
        $sql="SELECT COUNT(*) FROM ejemplarprestamo ep JOIN prestamos p on ep.prestamo=p.id WHERE p.socio='$socio' and p.estado=1 ";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchColumn();
    
}
public function registrarDevolucion($id,$obs){
   $sql= "UPDATE ejemplarprestamo SET  fechaDev= NOW(),obsDevolucion= :obs WHERE ejemplar= :id ";
   $stmt = $this->conn->prepare($sql);
   $stmt->execute(array(
    "id"=> $id,
    "obs"=>$obs));
    return true;

}

public function buscarEjemXLibroISBN($titulo): bool{
    //consultar para buscar el registro con el id=$id
       // echo"ola soy loaddao si se encontro";
    $sql= "SELECT ep.* ROM ejemplarprestamo ep
            JOIN prestamo p ON ep.id_prestamo = p.id_prestamo
            JOIN ejemplar e ON ep.id_ejemplar = e.id_ejemplar
            JOIN libros l ON e.libro = l.isbn
            WHERE l.titulo = :titulo AND p.estado = 1";
    //preparar la consulta
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "titulo"=> $titulo)
    );
  //  var_dump("ola resultado", $stm->rowCount() === 1);
     return $stm->rowCount() === 1;
}

public function socioTieneEjem($socio,$ejem){
    $sql="SELECT * from ejemplarprestamo JOIN prestamos ON ejemplarprestamo.prestamo=prestamos.id WHERE prestamos.socio= '$socio' AND ejemplarprestamo.ejemplar='$ejem' AND ejemplarprestamo.fechadev='' ";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);


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
public function buscarEjemsPres($id){    
    $sql = "SELECT 
                ejemplarprestamo.*, 
                ejemplares.codigo, 
                ejemplares.estado, 
                   ejemplares.observación, 
                libro.titulo AS libro
            FROM ejemplarprestamo
            INNER JOIN ejemplares ON ejemplarprestamo.ejemplar = ejemplares.codigo
            INNER JOIN libro ON ejemplares.libro = libro.id
            WHERE ejemplarprestamo.prestamo = :idPrestamo";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute(array(
            "idPrestamo"=> $id));
          return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function renovar($pres){
    $sql= "UPDATE ejemplarprestamo SET cantRenovaciones= 1 WHERE prestamo= :pres";
    $stmt = $this->conn->prepare($sql);
   $stmt->execute(array(
    "pres"=> $pres));
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);

}
}