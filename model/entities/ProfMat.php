<?php
namespace model\entities;


final class ProfMat{
    //Atributos
    //Se deben corresponder con los de la tabla 
    private $idSocio, $idMateria;

    /**
     * Constructor de la clase
     */
    function __construct($idSocio,$idMateria){
      $this->idSocio= (is_numeric($idSocio) && (int)$idSocio > 0) ? (int)$idSocio :0 ;
      $this->idMateria= is_integer($idMateria)? $idMateria : 0;

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
    public function setIdMateria($idMateria):void{
        $this->$idMateria= is_integer($idMateria)? $idMateria : 0;        
    }

    public function toJson(): object{
        $json = json_decode('{}');
        
        $json->{"idSocio"} = $this->getIdSocio();
        $json->{"idMateria"} = $this->getIdMateria();
        
        return $json;        
    }
}