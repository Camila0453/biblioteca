<?php
namespace model\dao;
require_once "InterfaceDAO.php";
use model\dao\InterfaceDAO;
require_once "DAO.php";
use model\dao\DAO;
require_once "../model/entities/BajaEjemplar.php";
use model\entities\BajaEjemplar;
use PgSql\Lob;

  // $daoBajaSocio= new BajaSocioDAO($conexion);
final class BajaReservaDAO extends DAO implements InterfaceDAO{
    public function __construct($conn){
        parent::__construct($conn);
    }
    public function load($id): BajaLibroDAO{
    
    $baja= new BajaEjemplarDAO($id,);
    
     return $baja;
    
}
    public function save($baja):void{
       

        $sql = "INSERT INTO bajasreserva VALUES( DEFAULT,:reserva,:motivo,NOW())";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            "motivo" => $baja->getMotivo(),
            "reserva" => $baja->getIdReserva(),
            
           
           
        ));
    
 
    }

    public function delete($id){
        $sql= "DELETE FROM alumcar WHERE id= '$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    public function update( $alum){
       $idSocio= $alum->getIdSocio();
       $idCarrera=$alum->getIdCarrera();
            


        $sql= "UPDATE `alum` SET `alumno`='$idSocio',`carrera`='$idCarrera' WHERE `alumcar`.`alumno` = '$idSocio' AND `alumcar`.`carrera` = '$idCarrera'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo actualizar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    public function list($filtros){
      
        $sql = "SELECT socios.nombre as nombreSocio, socios.apellido,socios.dni,socios.telefono,socios.correo,socios.domicilio,socios.localidad,socios.provincia,socios.usuario,socios.estado ,DATE_FORMAT(fechaAlta,'%d-%m-%Y') as fechaAlta, tipossocio.nombre as tsn FROM socios INNER JOIN tipossocio ON socios.tipoSocio=tipossocio.id ORDER BY socios.apellido ASC, socios.nombre ASC";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
}