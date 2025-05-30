<?php

namespace model\dao;

require_once("InterfaceDAO.php");
use model\dao\InterfaceDAO;
require_once("DAO.php");
use model\dao\DAO;
require_once "../model/entities/Usuario.php";
use model\entities\Usuario;

final class UsuarioDAO extends DAO implements InterfaceDAO{

    public function __construct($conn){
        parent::__construct($conn);
    }

    public function load($id){

      $sql= "SELECT * FROM usuarios WHERE id = :id";
      $stm = $this->conn->prepare($sql);
      $stm->execute(array(
        "id"=> $id)

    );
    if($stm->rowCount() != 1){
        throw new \Exception("No se encontro el usuario con el id");

    }
        $result = $stm->fetch();
       $usuario= new Usuario($result->clave,$result->nombre,$result->tipoUsuario,$result->dni);
       $usuario->setId($result->id);
       $usuario->setEstado($result->estado);       
   
       return $usuario;


    //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
    //si lo encontre le hago fetch saco los datos de la consulta
    //crear una entidad nueva, setear los campos y devolver la entidad
}
    
public function loadCuenta($id){
    
    //consultar para buscar el registro con el id=$id
   /* $sql= "SELECT * FROM usuarios WHERE cuenta= :cuenta";
    //preparar la consulta
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "cuenta"=> $id)

    );
        

    //cuando haga el select preguntar cuantos registros devolvió la consulta
    if($stm->rowCount() != 1){
        throw new \Exception("No se encontro la cuenta con la cuenta". $id );

    }
   
        $result = $stm->fetch();
       $usuario= new Usuario();
       //hacer todos los setters 
       $usuario->setId($result->id);
       $usuario->setApellido($result->apellido);
       $usuario->setNombre($result->nombre);
       $usuario->setCorreo($result->correo);// tiene que coincidir
       $usuario->setCuenta($result->cuenta);
       $usuario->setclave($result->clave);
       $usuario->setPerfilId($result->perfilId);
       $usuario->setEstado($result->estado);
       $usuario->setHoraEntrada($result->horaEntrada);
       $usuario->setHoraSalida($result->horaSalida);
       $usuario->setFechaAlta($result->fechaAlta);
       $usuario->setReseteoClave($result->reseteoClave);
   
       return $usuario;*/


    //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
    //si lo encontre le hago fetch saco los datos de la consulta
    //crear una entidad nueva, setear los campos y devolver la entidad
}
    
    public function save($usuario){
        $this->validateUser($usuario);
        $sql = "INSERT INTO `usuarios` VALUES(DEFAULT, :nomb, :clave, :tipo, 1,0,:dni,:nombreC)";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            
            "nomb" => $usuario->getNombre(),
            "clave" => $usuario->getClave(),
           "tipo" => $usuario->getIdTipoUsuario(),
            "dni"=>$usuario->getDni(),
            "nombreC"=>$usuario->getNombreC()
           
        ));
    }
    private function validateUser($usuario){
        $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE nombre = :nombre";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(
            "nombre" => $usuario->getNombre()
        ));
        $result = $stmt->fetch();
        if(((int)$result->total) > 0){
            throw new \Exception("El socio ya se encuentra registrado.");
        }
    }
    /**
     * Verifica si el DNI del cliente actual o nuevo, existe para otro cliente.
     */
    private function validateCuenta($cliente){
        //aca vamos a tener 
    }
    private function validateCorreo($cliente){
        //aca vamos a tener 
    
   }
   public function reseteo($cliente){
   /* $clavenueva= $cliente->getClave();
    $id= $cliente->getId();
    $sql= "UPDATE usuarios SET clave = '$clavenueva', reseteoClave= 0 WHERE id = '$id'";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo resetear clave");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);*/
}

    public function listarPerfiles($filtros){
       /* $sql = "SELECT *  FROM usuarios_perfiles ";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);*/
    


}
   

   public function update($usuario){
    $nom= $usuario->getNombre();
    $nomC= $usuario->getNombreC();
    $dni= $usuario->getDni();
    $tipo =$usuario->getIdTipoUsuario();
    $id=$usuario->getId();
    $estado= $usuario->getEstado();
    
  
    $sql= "UPDATE usuarios SET estado= $estado,nombre = '$nom', nombreCompleto = '$nomC',  dni = '$dni',tipoUsuario = '$tipo' WHERE id = '$id'";
 
     
     $stmt = $this->conn->prepare($sql);
     if(!$stmt->execute()){
         throw new \Exception("No se pudo eliminar");
     }
     return $stmt->fetchAll(\PDO::FETCH_ASSOC);

 }
   

    public static function login($conn, $cuenta, $clave): void{
        //agarro hora entrada hora de salida en el select
       
        $sql="SELECT id, nombre, clave,estado,reseteoClave,nombreCompleto,tipoUsuario FROM usuarios WHERE nombre= :nombre";
        
        $stm = $conn->prepare($sql); //le pasamos conn xw es un metodo estatico
        
        $stm->execute(array("nombre" => $cuenta));

      
        if($stm->rowCount() != 1){
            throw new \Exception("No existe la cuenta => " . $cuenta);
        }
        $result = $stm->fetch();
        
        if(!password_verify($clave, $result->clave)){
            throw new \Exception("La cuenta o clave es incorrecta");
        }
        if(((int)$result->estado) === 0){
            throw new \Exception("Su cuenta se encuentra inhabilitada");
        }
        if(((int)$result->reseteoClave) === 1){
         
            throw new \Exception("Debe resetear su clave");}
           // $_SESSION["id"]=$result->id;//USAR ID O NOMBRE
      
 /*$_SESSION["estado"]=0;;//USAR ID O NOMBRE*
//crear la info de estado de la session*/
$_SESSION["nombre"]=$result->nombreCompleto;
$_SESSION["idUsuario"]=$result->id;
$_SESSION["clave_secreta"]="lab2023";
$_SESSION["perfil"]=$result->tipoUsuario;}
   
        
    public static function logout(): void{
        //borrar variables de sesión
        //eliminar la sesión 
    }
    private function validate($cliente): void{
        
        
    }
        

    public function delete($id){
        
        $sql= "UPDATE usuarios SET estado=0 WHERE id='$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
public function buscarPerfil($id){
    $sql = "SELECT *  FROM usuarios_perfiles WHERE id ='$id'";
     //  $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
    public function list($filtros){
    $sql = "SELECT usuarios.id, usuarios.nombre as nomUser,usuarios.estado,usuarios.nombreCompleto,usuarios.dni, usuarios.tipoUsuario AS idTipoUsuario,TRIM(tiposusuario.nombre)  as tipoUsuario, usuarios.reseteoClave FROM usuarios INNER JOIN tiposusuario ON tiposusuario.id = usuarios.tipoUsuario";
  //   $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
public function activar($id){
    $sql= "UPDATE `usuarios` SET `estado` =  1 WHERE `usuarios`.`id` = '$id'";

    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo activar la cuenta");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);

}
public function desactivar($id){
   // echo"HOLAA soy desactivar del dao id es",$id;
    $sql= "UPDATE `usuarios` SET `estado` = 0 WHERE `usuarios`.`id` = '$id'";

    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo desactivar la cuenta");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);

}

}