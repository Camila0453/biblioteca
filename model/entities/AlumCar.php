<?php
namespace model\entities;


final class AlumCar{
 private $idSocio, $idCarrera;


 function __construct($idSocio,$idCarrera){
    $this->idSocio= (is_numeric($idSocio) && (int)$idSocio > 0) ? (int)$idSocio :0 ;
    $this->idCarrera=is_integer($idCarrera)? $idCarrera : 0;

 }

 function getIdSocio():int{
    return $this->idSocio;
}
function getIdCarrera():int{
    return $this->idCarrera;
}

public function setSocio($idSocio):void{
    $this->idSocio = (is_integer($idSocio) && ($idSocio > 0)) ? $idSocio : 0;        
}
public function setIdCarrera($idCarrera):void{
    $this->idCarrera = (is_integer($idCarrera) && ($idCarrera > 0)) ? $idCarrera : 0;        
}

public function toJson(): object{
    $json = json_decode('{}');
    $json->{"idSocio"} = $this->getIdSocio();
    $json->{"idCarrera"} = $this->getIdCarrera();
    
    return $json;        
}


}