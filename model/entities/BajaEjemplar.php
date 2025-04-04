<?php
namespace model\entities;


final class BajaEjemplar{
private $id,$idEjemplar,$fechaHora,$idUsuario,$motivo;

function __construct(){
    $this->id=0;
    $this->idEjemplar=0;
    $this->fechaHora="";
    $this->idUsuario=0;
    $this->motivo="";
}

function getId():int{
    return $this->id;
}
function setId($id){
    $this->id = (is_integer($id) && ($id > 0)) ? $id : 0; 
}

function getIdEjemplar():int{
    return $this->idEjemplar;
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
    $this->fechaHora=$fechaHora;//VALIDAR
}
function setIdUsuario($idSocio){
    $this->idUsuario = (is_integer($idSocio) && ($idSocio > 0)) ? $idSocio : 0; 
}
function setIdEjemplar($idEjemplar){
    $this->idEjemplar= $idEjemplar; //
}
function setMotivo($motivo){
    $this->motivo= ((is_string($motivo))&&(strlen(trim($motivo)) <= 250)) ? trim($motivo) : "";
   
}
public function toJson(): object{
    $json = json_decode('{}');
    $json->{"id"} = $this->getId();
    $json->{"idEjemplar"} = $this->getIdEjemplar();
    $json->{"fechaHora"} = $this->getFechaHora();
    $json->{"idUsuario"} = $this->getIdUsuario();
    $json->{"motivo"} = $this->getMotivo();

    
    return $json;        
}}
