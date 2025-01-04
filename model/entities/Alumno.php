<?php
namespace model\entities;


final class Alumno{
 private $idSocio,$id,  $carreras;


 function __construct($idSocio){
    $this->idSocio= $idSocio;
    $this->id=0;
    $this->carreras=[];

 }

 function getIdSocio():int{
    return $this->idSocio;
}
function getId():int{
    return $this->id;
}
function getCarreras():array{
    return $this->carreras;
}

public function setSocio($idSocio):void{
    $this->idSocio = (is_integer($idSocio) && ($idSocio > 0)) ? $idSocio : 0;        
}
function aggCarreras($materia){
    array_push($this->carreras,$materia);
}

public function toJson(): object{
    $json = json_decode('{}');
    $json->{"id"} = $this->getId();
    $json->{"idSocio"} = $this->getIdSocio();
    $json->{"carreras"} = $this->getCarreras();
    
    return $json;        
}


}