<?php
namespace model\dao;
require_once "InterfaceDAO.php";
use model\dao\InterfaceDAO;
require_once "DAO.php";
use model\dao\DAO;
require_once "../model/entities/ProfMat.php";
use model\entities\ProfMat;
use PgSql\Lob;



final class ProfMatDAO extends DAO implements InterfaceDAO{
    public function __construct($conn){
        parent::__construct($conn);
    }
    public function load($id): ProfMat{
    
    $profMat= new ProfMat($id);
    
     return $profMat;
    
}
    public function save($profe):void{
      
        $sql = "INSERT INTO profmat VALUES( DEFAULT,:materia, :profesor)";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            "profesor" => $profe->getIdSocio(),
            "materia" => $profe->getIdMateria(),
            
        ));
     
    }

    public function delete($id){
        $sql= "DELETE FROM profmat WHERE id= '$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    public function update( $profmat){
       $idSocio= $profmat->getIdSocio();
       $idMateria=$profmat->getIdMateria();
            


        $sql= "UPDATE `profmat` SET `profesor`='$idSocio',`materia`='$idMateria' WHERE `profmat`.`profesor` = '$idSocio' AND `profmat`.`materia` = '$idMateria'";
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