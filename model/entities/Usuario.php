<?php
namespace model\entities;


final class Ejemplar{
    private $id,$nombre,$clave,$idTipoUsuario,$estado;
    function __construct($clave,$usuario,$tipo){
        $this->id=0;
        $this->nombre="";
        $this->clave=$clave;
        $this->idTipoUsuario=$tipo;
        $this->estado=1;
  
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
    return $this->getIdTipoUsuario();
}
function getEstado():int{
    return $this->estado;
}
public function setEstado($estado){
  
    $this->estado=($estado===0 || $estado===1)? trim($estado):0;
  }

  function setNombre($nombre){
    $this->nombre= ((is_string($nombre))&&(strlen(trim($nombre)) <= 45)) ? trim($nombre) : "";
}

function setTipoUsuario( int $id){
    $this->idTipoUsuario= ($id>=1) ? $id:0;
}
public function setClave($clave): void{
    $this->clave= ((is_string($clave)&&(strlen(trim($clave)) <= 64)) ? trim($clave) : "");
}


public function toJson(): object{
    $json = json_decode('{}');
    $json->{"id"} = $this->getId();
    $json->{"nombre"} = $this->getNombre();
    $json->{"clave"} = $this->getClave();
    $json->{"TipoUsuario"} = $this->getIdTipoUsuario();
    $json->{"estado"} = $this->getEstado();
    return $json;        
}



}