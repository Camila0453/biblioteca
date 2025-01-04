<?php
namespace model\entities;


final class Ejemplar{
private $idLibro,$codigo,$observacion, $id;
    function __construct($idLibro){
        $this->idLibro= $idLibro;
        $this->id=0;
        $this->codigo=0;
        $this->observacion="";
  
      }
    
    function getIdLibro():int{
        return $this->idLibro;
    }
    function getId():int{
        return $this->id;
    }
    function getCodigo():int{
        return $this->codigo;
    }
    function getObs():string{
        return $this->observacion;
    }
    
    public function setIdLibro($idLibro):void{
        $this->idLibro = (is_integer($idLibro) && ($idLibro > 0)) ? $idLibro : 0;        
    }
    public function setCodigo($codigo){
        $this->codigo= (is_integer($codigo) && ($codigo >=1 && $codigo<=9999)) ? $codigo: 0;
    }
    public function setObs($obs): void{

        $this->observacion= ((is_string($obs))&&(strlen(trim($obs)) <= 45)) ? trim($obs) : "";
    }
    public function toJson(): object{
        $json = json_decode('{}');
        $json->{"id"} = $this->getId();
        $json->{"idLibro"} = $this->getIdLibro();
        $json->{"codigo"} = $this->getCodigo();
        $json->{"observacion"} = $this->getObs();
        return $json;        
    }
}