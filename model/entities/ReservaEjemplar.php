<?php
namespace model\entities;
use DateTime;

final class ReservaEjemplar{
private $id,$idReserva,$idEjemplar;

function __construct(){
    $this->id=0;
    $this->idReserva=0;
    $this->idEjemplar=0;
    

    $this->ejemplar=0;
  //  $this->ejemplares= [];

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
  function getIdReserva():int{
    return $this->idReserva;
  }
  
 
 function getEjemplar(){
   return $this->idEjemplar;
}


 function setIdReserva($idPrestamo){
    $this->idReserva =  $idPrestamo;
 }
 function setIdEjemplar($idEje){
    $this->idEjemplar=$idEje;
 }
function getIdEjemplar():int{
    return $this->idEjemplar;
}



 public function toJson(): object{
    $json = json_decode('{}');
    $json->{"id"} = $this->getId();
    $json->{"idEjemplar"} = $this->getIdEjemplar();
    $json->{"idReserva"} = $this->getIdReserva();
    
   
    
    
    return $json;        
}
}