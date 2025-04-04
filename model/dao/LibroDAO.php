<?php


namespace model\dao;
require_once("InterfaceDAO.php");
use model\dao\InterfaceDAO;
require_once("DAO.php");
use model\dao\DAO;
require_once "../model/entities/Libro.php";
use model\entities\Libro;


final class LibroDAO extends DAO implements InterfaceDAO{

    public function __construct($conn){
        parent::__construct($conn);
    }
public function list($filtros){
    $sql = "SELECT  libro.id, libro.ISBN,libro.titulo, libro.estado,libro.edicion, libro.cantEjemplares, autores.nombre as autor, editoriales.nombre as editorial, disciplinas.nombre as disciplina 
    from libro 
    INNER JOIN autores on autores.id=libro.autor
    INNER JOIN editoriales on editoriales.id=libro.editorial
    INNER JOIN disciplinas on disciplinas.id=libro.disciplina";
    //   $sql = "SELECT * FROM usuarios";
          $stmt = $this->conn->prepare($sql);
          if(!$stmt->execute()){
              throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
          }
          return $stmt->fetchAll(\PDO::FETCH_ASSOC);
      }


 public function delete($id){
        
        $sql= "UPDATE libro SET estado=0 WHERE id='$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    public function update($libro){
        $id= $libro->getId();
        $ISBN= $libro->getISBN();
        $titulo= $libro->getTitulo();
        $edicion= $libro->getEdicion();
        $editorial =$libro->getEditorial();
        $autor=$libro->getIdAutor();
        $disciplina= $libro->getIdDis();

        $NEjem=$libro->getCantEjemplares();
        $estado= $libro->getEstado();
        echo"hola estado es",$estado;
      
        $sql= "UPDATE libro SET  ISBN= $ISBN,titulo = '$titulo', edicion = '$edicion',  editorial = '$editorial',autor = '$autor',disciplina = '$disciplina',cantEjemplares = '$NEjem',estado = '$estado' WHERE id= '$id'";
     
         
         $stmt = $this->conn->prepare($sql);
         if(!$stmt->execute()){
             throw new \Exception("No se pudo eliminar");
         }
         return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
     }
public function save($libro){
  //  $this->validateLibro($libro);
    $sql = "INSERT INTO `libro` VALUES(:titulo, :edicion, :editorial,:cantEjemplares,:estado,:autor,:disciplina,DEFAULT,:ISBN )";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "ISBN" => $libro->getISBN(),
        "titulo" => $libro->getTitulo(),
       "edicion" => $libro->getEdicion(),
        "editorial"=>$libro->getEditorial(),
        "cantEjemplares"=>$libro->getCantEjemplares(),
       "estado"=>$libro->getEstado(),
       "autor"=>$libro->getIdAutor(),
       "disciplina"=>$libro->getIdDis(),
    ));




}
public function load($id){

    $sql= "SELECT * FROM libro WHERE id = :id";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
      "id"=> $id)

  );
  if($stm->rowCount() != 1){
      throw new \Exception("No se encontro el usuario con el id");

  }
      $result = $stm->fetch();
     $libro= new Libro();
     $libro->setId($result->id);
     $libro->setEstado($result->estado);       
 
     return $libro;


  //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
  //si lo encontre le hago fetch saco los datos de la consulta
  //crear una entidad nueva, setear los campos y devolver la entidad
}
}