<?php

namespace model\entities;


final class Prestamo{
private $id,$idSocio,$fechaHora,$idUsuario,$motivo;


function __construct(){
    $this->id=0;
    $this->idSocio=0;
    $this->fechaHora="";
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

function setIdSocio($idSocio){
    $this->idSocio = (is_integer($idSocio) && ($idSocio > 0)) ? $idSocio : 0; 
}
function setIdUsuario($idUsuario){
    $this->idUsuario= (is_integer($idUsuario) && ($idUsuario> 0)) ? $idUsuario : 0; 
}
function setMotivoCan($motivo){
    $this->motivo= ((is_string($motivo))&&(strlen(trim($motivo)) <= 250)) ? trim($motivo) : "";
   
}

}