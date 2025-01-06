<?php

namespace model\entities;


final class Prestamo{
private $id,$idSocio,$fechaInicio,$fechaVen,$motivoCan,$fechaCan;


function __construct(){
    $this->id=0;
    $this->idSocio=0;
    $this->fechaInicio="";
    $this->fechaVen="";
    $this->motivoCan="";
    $this->fechaCan="";
}

function getId():int{
    return $this->id;
}
function getIdSocio():int{
    return $this->idSocio;
}
function getFechaInicio():string{
    return $this->fechaInicio;
}
function getFechaVen():string{
    return $this->fechaVen;
}
function getMotivoCan():string{
    return $this->motivoCan;
}

function getFechaCan():string{
    return $this->fechaCan;
}

function setIdSocio($idSocio){
    $this->idSocio = (is_integer($idSocio) && ($idSocio > 0)) ? $idSocio : 0; 
}

function setFechaInicio($fecha){
    
    $this->fechaInicio = (
        (is_string($fecha))
        &&
        (strlen(trim($fecha)) == 10)
        ) ? trim($fecha) : "";

}
function setFechaVen($fecha){

$this->fechaVen = (
    (is_string($fecha))
    &&
    (strlen(trim($fecha)) == 10)
    ) ? trim($fecha) : "";

}
function setMotivoCan($motivo){
     $this->motivo= ((is_string($motivo))&&(strlen(trim($motivo)) <= 250)) ? trim($motivo) : "";
    
}

function setFechaCan($fecha){

    $this->fechaVen = (
        (is_string($fecha))
        &&
        (strlen(trim($fecha)) == 10)
        ) ? trim($fecha) : "";
    
    }
 public function toJson(): object{
        $json = json_decode('{}');
        $json->{"id"} = $this->getId();
        $json->{"idSocio"} = $this->getIdSocio();
        $json->{"fechaInicio"} = $this->getFechaInicio();
        $json->{"fechaVen"} = $this->getFechaVen();
        $json->{"motivoCancelacion"} = $this->getMotivoCan();
        $json->{"fechaCancelacion"} = $this->getFechaCan();
        
        return $json;        
    }


}