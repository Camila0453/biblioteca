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
       $usuario= new Usuario($result->clave,$result->nombre,$result->tipoUsuario);
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
        $sql = "INSERT INTO `usuarios` VALUES(DEFAULT, :nomb,  :tipo,:clave,:tipo, 1,:reseteo,:dni)";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            
            "nomb" => $usuario->getNombre(),
            "clave" => $usuario->getClave(),
           "tipo" => $usuario->getIdTipoUsuario(),
            "dni"=>$usuario->getDni(),
            "reseteo"=> $usuario->getReseteo()
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
   /* $ap= $usuario->getApellido();
    $nom= $usuario->getNombre();
    $correo= $usuario->getCorreo();
    $cuenta =$usuario->getCuenta();
    $perfilId= (int) $usuario->getPerfilId();
    $perfil= (int) $perfilId;
    $estado=$usuario->getEstado();
    $horaEntrada=$usuario->getHoraEntrada();
    $horaSalida=$usuario->getHoraSalida();
    $reseteo=$usuario->getReseteoClave();
    $id=$usuario->getId();
    
  
    $sql= "UPDATE usuarios SET apellido = '$ap', nombre = '$nom',  correo = '$correo',cuenta = '$cuenta',perfilId = '$perfil',estado = '$estado',horaEntrada = '$horaEntrada',horaSalida = '$horaSalida',reseteoClave = '$reseteo' WHERE id = '$id'";
 
     
     $stmt = $this->conn->prepare($sql);
     if(!$stmt->execute()){
         throw new \Exception("No se pudo eliminar");
     }
     return $stmt->fetchAll(\PDO::FETCH_ASSOC);*/

 }
   

    public static function login($conn, $cuenta, $clave): void{
        //agarro hora entrada hora de salida en el select
       
        $sql="SELECT id, cuenta, clave FROM usuarios WHERE cuenta= :cuenta";
        
        $stm = $conn->prepare($sql); //le pasamos conn xw es un metodo estatico
        
        $stm->execute(array("cuenta" => $cuenta));

      
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
$_SESSION["clave_secreta"]="lab2023";
$_SESSION["perfil"]=1;}
   
        
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
    $sql = "SELECT usuarios.id, usuarios.nombre as nomUser,usuarios.estado,usuarios.tipoUsuario,tiposusuario.nombre as tipoUsuario, usuarios.reseteoClave FROM usuarios INNER JOIN tiposusuario ON tiposusuario.id = usuarios.tipoUsuario";
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