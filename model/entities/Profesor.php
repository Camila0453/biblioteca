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

    function setSocio($idSocio){
        $this->idSocio=$idSocio;
    }


}