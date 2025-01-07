<?php
namespace model\entities;


final class Ejemplar{
private $idLibro,$codigo,$observacion, $id,$estado; //estado es obs??
    function __construct($idLibro){
        $this->idLibro= $idLibro;
        $this->id=0;
        $this->codigo=0;
        $this->observacion="";
        $this->estado=1;
  
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
    function getEstado():int{
        return $this->estado;
    }
    public function setEstado($estado){
  
        $this->estado=($estado===0 || $estado===1)? trim($estado):0;
      }

    public function setIdLibro($idLibro):void{
        $this->idLibro = $idLibro; //ES ISBN        
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
        $json->{"estado"} = $this->getEstado();
        return $json;        
    }
}