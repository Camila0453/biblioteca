<?php

namespace model\entities;
use DateTime;


final class BajaSocio{
private $id,$idSocio,$fechaHora,$idUsuario,$motivo;


function __construct(){
    $this->id=0;
    $this->idSocio=0;
    $this->fechaHora= new DateTime();
    $this->idUsuario=0;
    $this->motivo="";
}

function getId():int{
    return $this->id;
}
function getIdSocio():int{
    return $this->idSocio;
}
function getFechaHora():string{
    return $this->fechaHora;
}
function getIdUsuario():int{
    return $this->idUsuario;
}
function getMotivo():string{
    return $this->motivo;
}
function setFechaHora($fechaHora){
    $this->fechaHora=$fechaHora;
}
public function setIdSocio($dni): void{
    $dni= trim($dni);
    $this->idSocio =  is_numeric($dni) &&  strlen($dni)==8 && ctype_digit((string) $dni) ?(int)$dni:0;
}
function setIdUsuario($idUsuario){
    $this->idUsuario= (is_integer($idUsuario) && ($idUsuario> 0)) ? $idUsuario : 0; 
}
function setMotivoCan($motivo){
    $this->motivo= ((is_string($motivo))&&(strlen(trim($motivo)) <= 250)) ? trim($motivo) : "";
   
}
public function toJson(): object{
    $json = json_decode('{}');
    $json->{"id"} = $this->getId();
    $json->{"idSocio"} = $this->getIdSocio();
    $json->{"fechaHora"} = $this->getFechaHora();
    $json->{"idUsuario"} = $this->getIdUsuario();
    $json->{"motivo"} = $this->getMotivo();

    
    return $json;        
}
}