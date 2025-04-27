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


      private function validateISBN($libro){
        $sql = "SELECT COUNT(*) AS total FROM libro WHERE ISBN= :isbn";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(
            "isbn" => $libro->getISBN(),
          
        ));
        $result = $stmt->fetch();
        if(((int)$result->total) > 0){
            throw new \Exception("El ISBN " . $libro->getISBN() . " ya se encuentra registrado.");
        }
    }
public function tieneEjemsPrestados($libro){
    $sql="SELECT COUNT(*) AS cantidad from ejemplarprestamo ep INNER JOIN ejemplares e on ep.ejemplar= e.codigo INNER JOIN prestamos p on ep.prestamo= p.id where e.libro= :idLibro AND (p.estado=1 ) ";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "idLibro"=> $libro));
        $resultado = $stm->fetch(\PDO::FETCH_ASSOC);

        return $resultado['cantidad'] > 0;}

        public function tieneEjemsReservados($libro){
            $sql="SELECT COUNT(*) AS cantidad from ejemplarreserva ep INNER JOIN ejemplares e on ep.ejemplar= e.codigo INNER JOIN reservas p on ep.reserva= p.id where e.libro= :idLibro AND (p.estado=1 ) ";
            $stm = $this->conn->prepare($sql);
            $stm->execute(array(
                "idLibro"=> $libro));
                $resultado = $stm->fetch(\PDO::FETCH_ASSOC);
        
                return $resultado['cantidad'] > 0;}
public function buscarIsbn($isbn){


$sql= "SELECT  libro.id, libro.ISBN,libro.titulo, libro.estado,libro.edicion, libro.cantEjemplares, autores.nombre as autor, editoriales.nombre as editorial, disciplinas.nombre as disciplina 
    from libro 
    INNER JOIN autores on autores.id=libro.autor
    INNER JOIN editoriales on editoriales.id=libro.editorial
    INNER JOIN disciplinas on disciplinas.id=libro.disciplina
    where isbn= :isbn";
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
      "isbn"=> $isbn));
  if($stm->rowCount() < 1){
      throw new \Exception("No se encontro el libro con el ISBN ingresado.");

  }
      
      return $stm->fetchAll(\PDO::FETCH_ASSOC);
}
public function buscarIsbnAntiguo($isbn){


    $sql= "SELECT  libro.id, libro.ISBN,libro.titulo, libro.estado,libro.edicion, libro.cantEjemplares, autores.nombre as autor, editoriales.nombre as editorial, disciplinas.nombre as disciplina 
        from libro 
        INNER JOIN autores on autores.id=libro.autor
        INNER JOIN editoriales on editoriales.id=libro.editorial
        INNER JOIN disciplinas on disciplinas.id=libro.disciplina
        where isbn= :isbn";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
          "isbn"=> $isbn));
          $result = $stm->fetch();
          $libro= new Libro();
          $libro->setId($result->id);
          $libro->setEstado($result->estado);       
      
          return $libro;
    }

public function buscarTitulo($titulo){
    $sql= "SELECT  libro.id, libro.ISBN,libro.titulo, libro.estado,libro.edicion, libro.cantEjemplares, autores.nombre as autor, editoriales.nombre as editorial, disciplinas.nombre as disciplina 
    from libro 
    INNER JOIN autores on autores.id=libro.autor
    INNER JOIN editoriales on editoriales.id=libro.editorial
    INNER JOIN disciplinas on disciplinas.id=libro.disciplina
    WHERE libro.titulo= :titulo or autores.nombre= :titulo";

    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
      "titulo"=> $titulo));
  if($stm->rowCount() < 1){
      throw new \Exception("No se encontro el libro con el título ingresado.");

  }
  return $stm->fetchAll(\PDO::FETCH_ASSOC);
}
public function buscarTituloAntiguo($titulo){
    $sql= "SELECT  libro.id, libro.ISBN,libro.titulo, libro.estado,libro.edicion, libro.cantEjemplares, autores.nombre as autor, editoriales.nombre as editorial, disciplinas.nombre as disciplina 
    from libro 
    INNER JOIN autores on autores.id=libro.autor
    INNER JOIN editoriales on editoriales.id=libro.editorial
    INNER JOIN disciplinas on disciplinas.id=libro.disciplina
    WHERE libro.titulo= :titulo ";

    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
      "titulo"=> $titulo));
  $result = $stm->fetch();
     $libro= new Libro();
     $libro->setId($result->id);
     $libro->setEstado($result->estado);       
 
     return $libro;

  
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

      
        $sql= "UPDATE libro SET  ISBN= $ISBN,titulo = '$titulo', edicion = '$edicion',  editorial = '$editorial',autor = '$autor',disciplina = '$disciplina',cantEjemplares = '$NEjem',estado = '$estado' WHERE id= '$id'";
     
         
         $stmt = $this->conn->prepare($sql);
         if(!$stmt->execute()){
             throw new \Exception("No se pudo eliminar");
         }
         return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
     }
public function save($libro){
   $this->validateISBN($libro);
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

public function listBajas($filtros){
    
    $sql = "SELECT 
    b.motivo,
    b.fechaHora,
    b.usuario AS usuarioBaja,
    usuarios.nombre AS nombreUsuario, 
    libro.isbn as isbnx, 
    libro.titulo, 
    libro.edicion, 
    libro.estado,
    editoriales.nombre AS editorialNombre, 
    libro.cantEjemplares, 
    autores.nombre AS autorNombre, 
    disciplinas.nombre AS disciplinaNombre, 
    libro.id
FROM bajaslibro b 
INNER JOIN libro ON b.libro = libro.id
INNER JOIN usuarios ON b.usuario = usuarios.id
INNER JOIN editoriales ON libro.editorial = editoriales.id
INNER JOIN autores ON libro.autor = autores.id
INNER JOIN disciplinas ON libro.disciplina = disciplinas.id";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

}