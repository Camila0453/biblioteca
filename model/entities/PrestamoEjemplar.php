<?php
namespace model\entities;
use DateTime;

final class PrestamoEjemplar{
private $id,$idPrestamo,$idEjemplar, $cantRenovaciones, $fechaDev,$obsDevolucion,$ejemplares;

function __construct(){
    $this->id=0;
    $this->idPrestamo=0;
    $this->idEjemplar=0;
    $this->fechaDev= "";
    $this->cantRenovaciones=0;
    $this->obsDevolucion=0;
  //  $this->ejemplares= [];

  }
  function setfechaDev($fecha){
$this->fechaDev= $fecha;

  }
  function setCantidadRenovaciones($cant){
    $this->cantRenovaciones= $cant >0 || $cant <1;
  }
  function getCantidadRenovaciones():int{
   return $this->cantRenovaciones;
  }
  function getId():int{
    return $this->id;
  }
  function getIdPrestamo():int{
    return $this->idPrestamo;
  }
  function getFechaDev():string{
     return $this->fechaDev;
  }
  function getObsDev():string{
    return $this->obsDevolucion;
 }
 function getEjemplares():array{
   return $this->ejemplares;
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

 function setIdPrestamo($idPrestamo){
    $this->idPrestamo =  $idPrestamo;
 }
 function setIdEjemplar($idEje){
    $this->idEjemplar=$idEje;
 }
function getIdEjemplar():int{
    return $this->idEjemplar;
}
 /*function setFechaVen($fecha){
    
    $this->fechaVen = (
        (is_string($fecha))
        &&
        (strlen(trim($fecha)) == 10)
        ) ? trim($fecha) : "";

}*/

 public function toJson(): object{
    $json = json_decode('{}');
    $json->{"id"} = $this->getId();
    $json->{"idEjemplar"} = $this->getIdEjemplar();
    $json->{"idPrestamo"} = $this->getIdPrestamo();
    $json->{"cantRenovaciones"} = $this->getCantidadRenovaciones();
    $json->{"fechaDev"} = $this->getFechaDev();
    $json->{"obsDevolucion"} = $this->getObsDev();
    
    
    return $json;        
}
}