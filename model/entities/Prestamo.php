<?php
namespace model\entities;
use DateTime;

final class Prestamo{
private $id,$idSocio,$fechaInicio,$fechaVen,$tipo,$estado,$ejemplar;

function __construct(){
    $this->id=0;
    $this->idSocio=0;
    $this->fechaInicio= date("y-m-d H:i:s");
    $this->fechaVen= $this->calcfechaVen(7);
    $this->tipo=0;
    $this->estado=1; //1 prestamo activo 0 prestamo devuleto 2 prestamo tardio
    $this->ejemplar=0;

  }
 
  Private function calcFechaVen($cantDias){
   $fecha= new DateTime();
   $fecha->setTime(18,0);
   $contDias=0;

   while($contDias<$cantDias){
       
        if($fecha->format('N')<6){
         $contDias++;
        }
        if($contDias<$cantDias){
           $fecha->modify('+1 day');
        }
        //VER FERIADOS
   }
  // echo "ola fecha ven es",$fecha->format("y-m-d H:i:s");


  
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

function getEstado():int{
   return $this->estado;
}
function setEstado($estado){
   $this->estado=$estado;
}

 function setIdSocio($idSocio){
    $this->idSocio = $idSocio;  
 }
 function setFechaInicio($fecha){
    
        $this->fechaInicio = $fecha;
    
 }
 function setEjemplar($ejem){
   $this->ejem= $ejem;
 }
 function getEjemplar():int {
   return $this->ejemplar;
 }
 function setFechaVen($fecha){
    
 $this->fechaVen= $fecha;
}
function setTipo($tipo){
    $this->tipo = $tipo;  
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