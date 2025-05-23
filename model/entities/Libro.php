<?php
namespace model\entities;


final class Libro{
    private $id, $ISBN,$titulo,$edicion,$cantEjemplares,$editorial, $estado,$idAutor,$idDisciplina;
    function __construct(){
        $this->id=0;
        $this->ISBN=0;
        $this->titulo="";
        $this->edicion=0;
        $this->editorial=0;
        $this->cantEjemplares=0;
        $this->estado=1;
        $this->idAutor=0;
        $this->idDisciplina=0;
    
     }
     function getId():int{
        return $this->id;
    }
    function setId( $id){
        $this->id= $id;
    }
    function getISBN():int{
        return $this->ISBN;
    }
    function getTitulo():string{
         return $this->titulo;
    }
    function getIdAutor():int{
        return $this->idAutor;
    }
    function getIdDis():int{
        return $this->idDisciplina;
    }

    function getEdicion():int{
        return $this->edicion;
    }
    function getCantEjemplares():int{
        return $this->cantEjemplares;
    }
    function getEditorial():int{
        return $this->editorial;
    }
    function getEstado():int{
        return $this->estado;
    }
    function setAutor( int $id){
        $this->idAutor= ($id>=1) ? $id:0;
    }
    function setDis( int $id){
        $this->idDisciplina= ($id>=1) ? $id:0;
    }
    function setISBN($isbn){
        $this->ISBN= $isbn; //VALIDAR ISBN 13
    }
    function setTitulo($titulo){
        $this->titulo= ((is_string($titulo))&&(strlen(trim($titulo)) <= 255)) ? trim($titulo) : "";
    }
    function setEdicion( int $edicion){
    
        $this->edicion= ($edicion>=1) ? $edicion:0;
    }
    function setEditorial( int $editorial){
        $this->editorial= ($editorial>=1) ? $editorial:0;
    }
    function setCantEjem( int $cant){
        $this->cantEjemplares= ($cant>=1) ? $cant:0;
    }
    public function setEstado($estado){
  
        $this->estado=($estado==0 || $estado==1)? trim($estado):0;
      }

      public function toJson(): object{
        $json = json_decode('{}');
        $json->{"ISBN"} = $this->getISBN();
        $json->{"titulo"} = $this->getTitulo();
        $json->{"edicion"} = $this->getEdicion();
        $json->{"editorial"} = $this->getEditorial();
        $json->{"cantEjem"} = $this->getCantEjemplares();
        $json->{"estado"} = $this->getEstado();
        $json->{"disciplina"} = $this->getIdDis();
        $json->{"autor"} = $this->getIdAutor();
        $json->{"id"} = $this->getId();
        return $json;        
    }
    
    
}
