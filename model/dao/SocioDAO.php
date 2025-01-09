<?php

namespace model\dao;

require_once "InterfaceDAO.php";
use model\dao\InterfaceDAO;
require_once "DAO.php";
use model\dao\DAO;
require_once "../model/entities/Socio.php";
use model\entities\Socio;
use PgSql\Lob;

final class SocioDAO extends DAO implements InterfaceDAO{
    public function __construct($conn){
        parent::__construct($conn);
    }
    public function load($id): Socio{
    //consultar para buscar el registro con el id=$id
    $sql= "SELECT * FROM socios  WHERE id= :id";
    //preparar la consulta
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "id"=> $id)
    );
    //cuando haga el select preguntar cuantos registros devolvió la consulta
    if($stm->rowCount() != 1){
        throw new \Exception("No se encontro el socio con el id". $id );
    }
    $result = $stm->fetch();
    $socio= new Socio();
    //hacer todos los setters 
    $socio->setApellido($result->apellido);
    $socio->setNombres($result->nombres);
    $socio->setDni($result->dni);// tiene que coincidir
    $socio->setDomicilio($result->domicilio);
    $socio->setLocalidad($result->localidad);
    $socio->setProvincia($result->provincia);
    $socio->setTelefono($result->telefono);
    $socio->setCorreo($result->correo);
    $socio->setFechaAlta($result->fechaAlta);
    $socio->setEstado($result->estado);
    $socio->setIdUsuario($result->IdUsuario);
    $socio->setTipoSocio($result->tipoSocio);
    $socio->setFrenteDni($result->frenteDni);
    $socio->setDorsoDni($result->dorsoDni);
     return $socio;
    //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
    //si lo encontre le hago fetch saco los datos de la consulta
    //crear una entidad nueva, setear los campos y devolver la entidad
}
    public function save($socio):void{
        $this->validate($socio);
        $this->validateDNI($socio);
        $sql = "INSERT INTO socios VALUES( :apell, :nomb, :dni, :dom, :prov, :loc, :tel, :correo, NOW(),:estado,:tipoSocio,:idUsuario,:frenteDni,:dorsoDni)";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            "apell" => $socio->getApellido(),
            "nomb" => $socio->getNombres(),
            "dni" => $socio->getDni(),
            "dom" => $socio->getDomicilio(),
            "prov" => $socio->getProvincia(),
            "loc" => $socio->getLocalidad(),
            "tel" => $socio->getTelefono(),
            "correo" => $socio->getCorreo(),
            "estado" => $socio->getEstado(),
            "tipoSocio" => $socio->getTipoSocio(),
            "idUsuario" => $socio->getIdUsuario(),
            "frenteDni" => $socio->getFrenteDni(),
            "dorsoDni"=> $socio->getDorsoDni()
        ));
     
    }
    private function validateDNI($socio){
        $sql = "SELECT COUNT(*) AS total FROM socios WHERE dni = :dni";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(
            "dni" => $socio->getDni(),
          
        ));
        $result = $stmt->fetch();
        if(((int)$result->total) > 0){
            throw new \Exception("El DNI " . $socio->getDni() . " ya se encuentra registrado.");
        }
    }
    private function validateCorreo($socio){
        $sql = "SELECT COUNT(*) AS total FROM socios WHERE correo = :correo AND dni <> :dni";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(
            "dni" => $socio->getDni(),
            "correo" => $socio->getCorreo()
        ));
        $result = $stmt->fetch();
        if(((int)$result->total) > 0){
            throw new \Exception("El correo " . $socio->getcorreo() . " ya se encuentra registrado.");
        }
    }
    private function validateTelefono($socio){
        $sql = "SELECT COUNT(*) AS total FROM socios WHERE telefono = :telefono AND dni <> :dni";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(
            "dni" => $socio->getDni(),
            "telefono" => $socio->getTelefono()
        ));
        $result = $stmt->fetch();
        if(((int)$result->total) > 0){
            throw new \Exception("El telefono " . $socio->getTelefono() . " ya se encuentra registrado.");
        }
    }
    private function validateDorsoFrente($socio){
        $sql = "SELECT COUNT(*) AS total FROM socios WHERE (dorsoDni = :dorsoDni or frenteDni= :frenteDni) AND dni <> :dni";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(
            "dni" => $socio->getDni(),
            "frenteDni" => $socio->getFrenteDni(),
            "dorsoDni"=>$socio->getDorsoDni()
        ));
        $result = $stmt->fetch();
        if(((int)$result->total) > 0){
            throw new \Exception("El frente o el dorso del dni ya se encuentra registrado ");
        }
    }
    private function validateIdUsuario($socio){
        $sql = "SELECT COUNT(*) AS total FROM socios WHERE idUsuario = :idUsuario  AND dni <> :dni";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(
            "dni" => $socio->getDni(),
            "idUsuario"=>$socio->getIdUsuario()
        ));
        $result = $stmt->fetch();
        if(((int)$result->total) > 0){
            throw new \Exception("Ya existe un socio con el mismo usuario.");
        }
    }


    private function validate($socio): void{
        if($socio->getApellido() === ""){
        
            throw new \Exception("El apellido es obligatorio?");
        }
        if($socio->getNombres() === ""){
            throw new \Exception("El nombre es obligatorio.");
        }
        if($socio->getDni() === ""){
            throw new \Exception("El DNI es obligatorio.");
        }
        if($socio->getDomicilio() === ""){
            throw new \Exception("El domicilio es obligatorio");
        }
        if($socio->getLocalidad() === ""){
            throw new \Exception("La localidad es obligatorio");
        }
        if($socio->getProvincia() === ""){
            throw new \Exception("La provincia es obligatorio");
        }
        if($socio->getTelefono() === ""){
            throw new \Exception("El telefono es obligatorio");
        }
        if($socio->getCorreo() === ""){
            throw new \Exception("El correo es obligatorio");
        }
        if($socio->getEstado() === 0){
            throw new \Exception("El estado es obligatorio");
        }
        if($socio->getFechaAlta() === ""){
            throw new \Exception("La fecha alta es obligatoria");
        }
        if($socio->getTipoSocio() === 0){
            throw new \Exception("El tipo socio es obligatorio");
        }
        if($socio->getIdUsuario() === 0){
            throw new \Exception("El Usuario es obligatorio");
        }
        if($socio->getFrenteDni() === ""){
            throw new \Exception("El frente del dni es obligatorio.");
        }
        if($socio->getDorsoDni() === ""){
            throw new \Exception("El dorso del dni es obligatorio");
        }
    }
    
    public function delete($id){
        $sql= "DELETE FROM socios WHERE id= '$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    public function update($socio){
       $ap= $socio->getApellido();
       $nom= $socio->getNombres();
       $dni= $socio->getDni();
       $dom= $socio->getDomicilio();
       $localidad=$socio->getLocalidad();
       $prov= $socio->getProvincia();
       $tel=$socio->getTelefono();
       $correo=$socio->getCorreo();
       $id=$socio->getId();
       //$fechaAlta=$socio->getFechaAlta();
       $estado=$socio->getEstado();
       $frenteDni=$socio->getFrenteDni();
       $dorsoDni=$socio->getDorsoDni();
       $tipoSocio=$socio->getTipoSocio();
       $idUsuario=$socio->getIdUsuario();


        $sql= "UPDATE `clientes` SET `frenteDni`='$frenteDni',`dorsoDni`='$dorsoDni',`tipoSocio`='$tipoSocio',`usuario`='$idUsuario,`apellido` = '$ap', `nombres` = '$nom',  `dni` = '$dni',`domicilio` = '$dom',`localidad` = '$localidad',`provincia` = '$prov',`telefono` = '$tel',`correo` = '$correo',`estado`='$estado' WHERE `clientes`.`id` = '$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    public function list($filtros){
      
        $sql = "SELECT * ,DATE_FORMAT(fechaAlta,'%d-%m-%Y') as fechaAltaFormat FROM socios ORDER BY apellido ASC, nombre ASC";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
}