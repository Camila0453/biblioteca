<?php

namespace model\entities;


final class Reserva{
private $id,$idSocio,$fechaInicio,$fechaFin,$fechaRetiro,$estado;


function __construct(){
    $this->id=0;
    $this->idSocio=0;
    $this->fechaRetiro=0;
    $this->fechaInicio="";
    $this->fechaVen="";
    $this->estado=0;
    $this->ejemplares=[];
}
function setfechaInicio($fecha){
    $this->fechaInicio= $fecha;
    
      }
      public function setPrestamo($id){
        $this->prestamo=$id;
      }
      function setfechaFin($fecha){
        $this->fechaFin= $fecha;
        
          }
          function setfechaRetiro($fecha){
            $this->fechaRetiro= $fecha;
            
              }
function getId():int{
    return $this->id;
}
function getEstado():int{
    return $this->estado;
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

 public function setEstado($estado){
    $this->estado= $estado;
 }
 
 
 public function setId($id){
    $this->id= $id;
 }
 function getFechaFin():string{
   return $this->fechaFin;
}
function getFechaRetiro():string{
   return $this->fechaRetiro;
}
function setIdSocio($idSocio){
    $this->idSocio = $idSocio;
}


 public function toJson(): object{
        $json = json_decode('{}');
        $json->{"id"} = $this->getId();
        $json->{"idSocio"} = $this->getIdSocio();
        $json->{"fechaInicio"} = $this->getFechaInicio();
        $json->{"fechaFin"} = $this->getFechaVen();
        $json->{"fechaRetiro"} = $this->getFechaRetiro();
        $json->{"estado"} = $this->getEstado();
        
        return $json;        
    }


}