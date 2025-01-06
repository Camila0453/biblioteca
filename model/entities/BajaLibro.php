<?php
namespace model\entities;


final class Prestamo{
private $id,$idLibro,$fechaHora,$idUsuario,$obs;

function __construct(){
    $this->id=0;
    $this->idLibro=0;
    $this->fechaHora="";
    $this->idUsuario=0;
    $this->obs="";
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
function getObs():string{
    return $this->obs;
}
function setFechaHora($fechaHora){
    $this->fechaHora=$fechaHora;
}
function setIdUsuario($idSocio){
    $this->idSocio = (is_integer($idSocio) && ($idSocio > 0)) ? $idSocio : 0; 
}
function setIdLibro($idLibro){
    $this->idLibro= $idLibro; //ES ISBN
}
function setObs($obs){
    $this->obs= ((is_string($obs))&&(strlen(trim($obs)) <= 250)) ? trim($obs) : "";
   
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




