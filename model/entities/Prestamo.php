<?php
namespace model\entities;


final class Prestamo{
private $id,$idSocio,$fechaInicio,$fechaVen,$tipo;

function __construct($idSocio){
    $this->id=0;
    $this->idSocio=0;
    $this->fechaInicio="";
    $this->fechaVen="";
    $this->tipo=0;

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
 function getTipo():int{
    return $this->tipo;
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
function setTipo($tipo){
    $this->tipo = (is_integer($tipo && ($tipo> 0)) ? $tipo : 0);  
 }
 public function toJson(): object{
    $json = json_decode('{}');
    $json->{"id"} = $this->getId();
    $json->{"idSocio"} = $this->getIdSocio();
    $json->{"fechaInicio"} = $this->getFechaInicio();
    $json->{"fechaVen"} = $this->getFechaVen();
    $json->{"tipo"} = $this->getTipo();
    
    
    return $json;        
}
}