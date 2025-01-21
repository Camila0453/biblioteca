<?php
namespace model\entities;


final class ProfMat{
    //Atributos
    //Se deben corresponder con los de la tabla 
    private $idSocio, $idMateria;

    /**
     * Constructor de la clase
     */
    function __construct($idSocio){
      $this->idSocio= $idSocio;
      $this->idMateria=0;

    }

    function getIdSocio():int{
        return $this->idSocio;
    }
    function getIdMateria():int{
        return $this->idMateria;
    }
 
    public function setIdSocio($idSocio):void{
        $this->idSocio = (is_integer($idSocio) && ($idSocio > 0)) ? $idSocio : 0;        
    }
    public function setIdMateria($idSocio):void{
        $this->idSocio = (is_integer($idSocio) && ($idSocio > 0)) ? $idSocio : 0;        
    }

    public function toJson(): object{
        $json = json_decode('{}');
        
        $json->{"idSocio"} = $this->getIdSocio();
        $json->{"idMateria"} = $this->getIdMateria();
        
        return $json;        
    }
}