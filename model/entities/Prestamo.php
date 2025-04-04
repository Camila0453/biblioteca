<?php
namespace model\entities;
use DateTime;

final class Prestamo{
private $id,$idSocio,$fechaInicio,$fechaVen,$tipo,$estado;

function __construct(){
    $this->id=0;
    $this->idSocio=0;
    $this->fechaInicio= date("y-m-d H:i:s");
    $this->fechaVen= $this->calcfechaVen(7);
    $this->tipo=0;
    $this->estado=1; //1 prestamo activo 0 prestamo devuleto 2 prestamo tardio
    $this->ejemplares= [];

  }
  function calcFechaVen($cantDias){
   $fecha= new DateTime();
   $fecha->setTime(18,0);
   $contDias=0;

   while($contDias<$cantDias){
        $fecha->modify('+1 day');
        if($fecha->format('N')<6){
         $contDias++;
        }
        
   }
  // echo "ola fecha ven es",$fecha->format("y-m-d H:i:s");

   return $fecha->format("y-m-d H:i:s");
  }
  function setId($id){
$this->id=$id;
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
 function getEjemplares():array{
   return $this->ejemplares;
}
function getEstado():int{
   return $this->estado;
}
function setEjemplares(int $idEjem):bool{
   if( (count($this->ejemplares)>=3) || $this->existeEjem($idEjem)){
      return false;  
   }
  //VER QUE PASA SI ID ES 0 O MENOS
      
      array_push($this->ejemplares,$idEjem);
      return true;
}
/*private function existeEjem($ejem):bool{
   $i=0;
   $encontrado=false;

   while($i<count($this->ejemplares) && $encontrado==false){
        if($ejem== $this->ejemplares[$i]){
         $encontrado==true;
        }
        $i++;
   }
  return $encontrado;
}*/

 function setIdSocio($idSocio){
    $this->idSocio = ($idSocio) && ($idSocio > 0) ? $idSocio : 0;  
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
 function setCodigo($tipo){
   $this->tipo = (is_integer($tipo && ($tipo> 0)) ? $tipo : 0);  
}
 public function toJson(): object{
    $json = json_decode('{}');
    $json->{"id"} = $this->getId();
    $json->{"idSocio"} = $this->getIdSocio();
    $json->{"fechaInicio"} = $this->getFechaInicio();
    $json->{"fechaVen"} = $this->getFechaVen();
    $json->{"estado"} = $this->getEstado();
    $json->{"tipo"} = $this->getTipo();
    
    
    return $json;        
}
}