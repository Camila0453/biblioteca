<?php
namespace model\entities;


final class AlumCar{
 private $idSocio, $idCarrera;


 function __construct($idSocio,$idCarrera){
    $this->idSocio= $idSocio;
    $this->idCarrera=$idCarrera;

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
public function setCarrera($idSocio):void{
    $this->idSocio = (is_integer($idSocio) && ($idSocio > 0)) ? $idSocio : 0;        
}

public function toJson(): object{
    $json = json_decode('{}');
    $json->{"idSocio"} = $this->getIdSocio();
    $json->{"idCarrera"} = $this->getIdCarrera();
    
    return $json;        
}


}