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
       // echo"ola soy loaddao si se encontro";
    $sql= "SELECT * FROM socios  WHERE dni= :id";
    //preparar la consulta
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "id"=> $id)
    );
    //cuando haga el select preguntar cuantos registros devolvió la consulta


    $result = $stm->fetch();
    $socio= new Socio();
    //hacer todos los setters 
    $socio->setApellido($result->apellido);
    $socio->setNombres($result->nombre);
    $socio->setDni($result->dni);// tiene que coincidir
    $socio->setDomicilio($result->domicilio);
    $socio->setLocalidad($result->localidad);
    $socio->setProvincia($result->provincia);
    $socio->setTelefono($result->telefono);
    $socio->setCorreo($result->correo);
    $socio->setFechaAlta($result->fechaAlta);
    $socio->setEstado($result->estado);
    //var_dump($result->estado);
    $socio->setIdUsuario($result->usuario);
    $socio->setTipoSocio($result->tipoSocio);
    $socio->setFrenteDni($result->frenteDni);
    $socio->setDorsoDni($result->dorsoDni);

     return $socio;
    //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
    //si lo encontre le hago fetch saco los datos de la consulta
    //crear una entidad nueva, setear los campos y devolver la entidad
}
public function loadxMail($id): Socio{
    //consultar para buscar el registro con el id=$id
       // echo"ola soy loaddao si se encontro";
$correo= strval($id) ;
$correo= trim($correo);
    $sql= "SELECT * FROM socios  WHERE correo= :mail";
    //preparar la consulta
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "mail"=> $correo)
    );
    //cuando haga el select preguntar cuantos registros devolvió la consulta


    $result = $stm->fetch();
    $socio= new Socio();
    //hacer todos los setters 
    $socio->setApellido($result->apellido);
    $socio->setNombres($result->nombre);
    $socio->setDni($result->dni);// tiene que coincidir
    $socio->setDomicilio($result->domicilio);
    $socio->setLocalidad($result->localidad);
    $socio->setProvincia($result->provincia);
    $socio->setTelefono($result->telefono);
    $socio->setCorreo($result->correo);
    $socio->setFechaAlta($result->fechaAlta);
    $socio->setEstado($result->estado);
    //var_dump($result->estado);
    $socio->setIdUsuario($result->usuario);
    $socio->setTipoSocio($result->tipoSocio);
    $socio->setFrenteDni($result->frenteDni);
    $socio->setDorsoDni($result->dorsoDni);

     return $socio;
    //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
    //si lo encontre le hago fetch saco los datos de la consulta
    //crear una entidad nueva, setear los campos y devolver la entidad
}
public function sancionar($socio){

    $sql= "UPDATE socios SET estado= 3 WHERE dni= $socio";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo sancionar");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
public function loadx($id){
   
    $sql = "SELECT socios.nombre as nombreSocio, socios.apellido,socios.dni,socios.telefono,socios.correo,socios.domicilio,socios.localidad,socios.provincia,socios.usuario,socios.estado ,socios.dorsoDni,socios.frenteDni, DATE_FORMAT(fechaAlta,'%d-%m-%Y') as fechaAlta, tipossocio.nombre as tsn FROM socios INNER JOIN tipossocio ON socios.tipoSocio=tipossocio.id  WHERE dni= '$id'";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo ejecutar la consulta de buscar socio");
    }
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}
public function loadd($id): bool{
    //consultar para buscar el registro con el id=$id
       // echo"ola soy loaddao si se encontro";
    $sql= "SELECT * FROM socios  WHERE dni= :id";
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
    public function save($socio):void{
   
       /* $this->validate($socio);
        $this->validateDNI($socio);
        $this->validateCorreo($socio);
        $this->validateTelefono($socio);
        $this->validateDorsoFrente($socio);*/
       
        $sql = "INSERT INTO socios VALUES( :dni,:nomb, :apell,  :dom,:loc, :prov,  :tel, :correo,:frenteDni,:dorsoDni, NOW(),:estado,:tipoSocio,:idUsuario)";
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

    public function buscarDni($dni){
        $sql= "SELECT * FROM socios where dni= :dni";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            "dni"=>$dni));

            return $stm->fetchAll(\PDO::FETCH_ASSOC);

    }
    
    public function buscarNom($nom){
      
        $sql= "SELECT * FROM socios where nombre= :nombre or apellido= :nombre";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            "nombre"=>$nom));

            return $stm->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function reactivar($id){
        $sql= "UPDATE socios SET estado=1 WHERE dni='$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo reactivar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

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
       // if($socio->getEstado() === 0){
           // throw new \Exception("El estado es obligatorio");
       // }VER
        if($socio->getTipoSocio() === 0){
            throw new \Exception("El tipo socio es obligatorio");
        }
        /*if($socio->getIdUsuario() === 0){
            throw new \Exception("El Usuario es obligatorio");
        }*/
        if($socio->getFrenteDni() === ""){
            throw new \Exception("El frente del dni es obligatorio.");
        }
        if($socio->getDorsoDni() === ""){
            throw new \Exception("El dorso del dni es obligatorio");
        }
    }
    
    public function delete($id){
        $sql= "UPDATE socios SET estado=0 WHERE dni='$id'";
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
     
       //$fechaAlta=$socio->getFechaAlta();
       $estado=$socio->getEstado();
       $frenteDni=$socio->getFrenteDni();
       $dorsoDni=$socio->getDorsoDni();
       $tipoSocio=$socio->getTipoSocio();
       $idUsuario=$socio->getIdUsuario();


        $sql= "UPDATE `socios` SET `frenteDni`='$frenteDni',`dorsoDni`='$dorsoDni',`tipoSocio`='$tipoSocio',`usuario`='$idUsuario',`apellido` = '$ap', `nombre` = '$nom',  `dni` = '$dni',`domicilio` = '$dom',`localidad` = '$localidad',`provincia` = '$prov',`telefono` = '$tel',`correo` = '$correo',`estado`='$estado' WHERE `socios`.`dni` = '$dni'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);






    }




function socioTienePres($socio){
 $sql="SELECT * FROM PRESTAMOS WHERE socio= :socio";
 $stmt = $this->conn->prepare($sql);
 $stmt->execute(array(
    "socio" => $socio));

    return $stmt->rowCount() >0 ;   
}
    public function list($filtros){
      
        $sql = "SELECT socios.nombre as nombreSocio, socios.apellido,socios.dni,socios.telefono,socios.correo,socios.domicilio,socios.localidad,socios.provincia,socios.usuario,socios.estado ,socios.dorsoDni, socios.frenteDni, DATE_FORMAT(fechaAlta,'%d-%m-%Y') as fechaAlta, tipossocio.nombre as tsn FROM socios INNER JOIN tipossocio ON socios.tipoSocio=tipossocio.id ORDER BY socios.apellido ASC, socios.nombre ASC";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
   
    public function listCarsAlum($alum){
      
        $sql = "SELECT m.nombre AS carrera
            FROM alumcar ac 
            INNER JOIN carreras m ON ac.carrera = m.codigo 
            WHERE ac.alumno = $alum";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function  listMatsProfs($alum){
      
        $sql = "SELECT m.nombre AS materia
            FROM profmat ac 
            INNER JOIN materias m ON ac.materia= m.codigo 
            WHERE ac.profesor= $alum";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function listBajas($filtros){
        $sql= "SELECT 
        b.motivo,
        b.fechaHora,
        b.usuario AS usuarioBaja,
        socios.nombre AS nombreSocio, 
        socios.apellido, 
        socios.dni, 
        socios.telefono, 
        socios.correo,
        socios.domicilio, 
        socios.localidad, 
        socios.provincia,
        socios.usuario, 
        socios.estado,
        socios.dorsoDni, 
        socios.frenteDni, 
        DATE_FORMAT(socios.fechaAlta,'%d-%m-%Y') AS fechaAlta, 
        tipossocio.nombre AS tsn 
    FROM bajassocios b 
    INNER JOIN socios ON b.socioBaja = socios.dni 
    INNER JOIN tipossocio ON socios.tipoSocio = tipossocio.id 

    ORDER BY socios.apellido ASC, socios.nombre ASC;";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    
} 