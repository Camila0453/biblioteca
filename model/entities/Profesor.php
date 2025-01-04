<?php
namespace model\entities;


final class Profesor{
    //Atributos
    //Se deben corresponder con los de la tabla 
    private $idSocio,$id, $materias;

    /**
     * Constructor de la clase
     */
    function __construct($idSocio){
      $this->idSocio= $idSocio;
      $this->id=0;
      $this->materias=[];

    }

    function getIdSocio():int{
        return $this->idSocio;
    }
    function getId():int{
        return $this->id;
    }
    function getMaterias():array{
        return $this->materias;
    }
 
    public function setSocio($idSocio):void{
        $this->idSocio = (is_integer($idSocio) && ($idSocio > 0)) ? $idSocio : 0;        
    }
    function aggMateria($materia){
        array_push($this->materias,$materia);
    }

    public function toJson(): object{
        $json = json_decode('{}');
        $json->{"id"} = $this->getId();
        $json->{"idSocio"} = $this->getIdSocio();
        $json->{"materias"} = $this->getMaterias();
        
        return $json;        
    }
}