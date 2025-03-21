<?php
namespace model\entities;


final class BajaLibro{
private $id,$idLibro,$fechaHora,$idUsuario,$motivo;

function __construct(){
    $this->id=0;
    $this->idLibro=0;
    $this->fechaHora="";
    $this->idUsuario=0;
    $this->motivo="";
}

function getId():int{
    return $this->id;
}
function getIdLibro():int{
    return $this->idLibro;
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
function setIdUsuario($idSocio){
    $this->idUsuario = (is_integer($idSocio) && ($idSocio > 0)) ? $idSocio : 0; 
}
function setIdLibro($idLibro){
    $this->idLibro= $idLibro; //ES ISBN
}
function setMotivo($obs){
    $this->motivo= ((is_string($obs))&&(strlen(trim($obs)) <= 250)) ? trim($obs) : "";
   
}
public function toJson(): object{
    $json = json_decode('{}');
    $json->{"id"} = $this->getId();
    $json->{"idLibro"} = $this->getIdLibro();
    $json->{"fechaHora"} = $this->getFechaHora();
    $json->{"idUsuario"} = $this->getIdUsuario();
    $json->{"obs"} = $this->getObs();

    
    return $json;        
}



}




