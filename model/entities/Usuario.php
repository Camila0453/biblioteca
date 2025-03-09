<?php
namespace model\entities;


final class Usuario{
    private $id,$nombre,$clave,$idTipoUsuario,$estado,$dni,$reseteo;
    function __construct($clave,$usuario,$tipo){
        $this->id=0;
        $this->nombre=$usuario;
        $this->clave=$clave;
        $this->idTipoUsuario=$tipo;
        $this->estado=1;
        $this->dni=0;
        $this->reseteo=0;
  
      }

function getId():int{
    return $this->id;
}
function getNombre():string{
    return $this->nombre;
}
function getClave():string{
    return $this->clave;
}
function getIdTipoUsuario():int{
    return $this->idTipoUsuario;
}
function getEstado():int{
    return $this->estado;
}
public function setEstado($estado){
  
    $this->estado=($estado===0 || $estado===1)? trim($estado):0;
  }
 public function setId($id){
  
    $this->id=$id;
  }

  function setNombre($nombre){
    $this->nombre= ((is_string($nombre))&&(strlen(trim($nombre)) <= 255)) ? trim($nombre) : "m";
}
public function getDni(): string{
    return $this->dni;
}
public function setDni($dni): void{
    $dni= trim($dni);
    $this->dni =  is_numeric($dni) &&  strlen($dni)==8 && ctype_digit((string) $dni) ?(int)$dni:0;
}
function setTipoUsuario( int $id){
    $this->idTipoUsuario= ($id>=1) ? $id:0;
}
public function setClave($clave): void{
    $this->clave= ((is_string($clave)&&(strlen(trim($clave)) <= 64)) ? trim($clave) : "");
}
public function setReseteo($reseteo){
    $this->reseteo= $reseteo;
}
public function getReseteo():int{
    return $this->getReseteo();
}

public function toJson(): object{
    $json = json_decode('{}');
    $json->{"id"} = $this->getId();
    $json->{"nombre"} = $this->getNombre();
    $json->{"clave"} = $this->getClave();
    $json->{"TipoUsuario"} = $this->getIdTipoUsuario();
    $json->{"estado"} = $this->getEstado();
    $json->{"dni"} = $this->getDni();
    $json->{"reseteo"} = $this->getReseteo();
    return $json;        
}



}