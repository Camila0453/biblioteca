<!DOCTYPE html>
<html lang="en">
<head>
<?php
      require_once("../public/view/includes/head.php");
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/libro/js/libro.js"></script>  
   <link href="../view/css/general.css" rel="stylesheet" />
      
</head>
<header>
<?php
    require_once ("../public/view/includes/header.php");
    require_once "../model/dao/Conexion.php";
    use model\dao\Conexion;
    $conexion = Conexion::establecer();
     ?>
    </header>
<body>
    <br>
    <center> 

     <h1>Alta de Libros</h1>
    
    
  <form id="formAlta" class="form-label"  method="POST" action="" enctype="multipart/form-data">
  <div class="form-group row">
       <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">ISBN (sin guiones)</label>
      <div class="col-sm-4">
      <input  oninput="validar(this)"  pattern="^\d{13}$"required type="text" maxlength="13" minlength="13" class="form-control form-control-sm" id="datoISBN" name="datoISBN" placeholder="">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Título</label>
      <div class="col-sm-4">
      <input  oninput="validar(this)" class="form-control form-control-sm" required maxlength="45" minlength="1" type="text" name="datoTitulo" id="datoTitulo">
      </div>
      </div>
  </div>
  <div class="form-group row">
  <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">N° de ejemplares</label>
      <div class="col-sm-4">
      <input  oninput="validar(this)" class="form-control form-control-sm" required maxlength="100" minlength="1" type="text" name="datoNEjem" id="datoNEjem">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Autor</label>
     <div class="col-sm-4">
        <select required class="form-control" id="datoAutor" name="datoAutor"  >
            <option value="">Seleccione el autor</option>
                <?php
               
                 $sql= "SELECT id,nombre FROM autores";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $autores= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($autores as $autor): ?>
                   <option value="<?= $autor['id']?>"><?= $autor['nombre']?></option>
                 <?php endforeach; ?>
          </select>
    </div>
      
  </div>
  <div class="form-group row">
  <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Disciplina</label>
  <div class="col-sm-4">
  
        <select required class="form-control" id="datoDisciplina" name="datoDisciplina"  >
            <option value="">Seleccione la disciplina</option>
                <?php
               
                 $sql= "SELECT id,nombre FROM disciplinas";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $disciplinas= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($disciplinas as $dis): ?>
                   <option value="<?= $dis['id']?>"><?= $dis['nombre']?></option>
                 <?php endforeach; ?>
          </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Editorial</label>
  <div class="col-sm-4">
  
        <select required class="form-control" id="datoEditorial" name="datoEditorial"  >
            <option value="">Seleccione la Editorial</option>
                <?php
               
                 $sql= "SELECT id,nombre FROM editoriales";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $editoriales= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($editoriales as $edis): ?>
                   <option value="<?= $edis['id']?>"><?= $edis['nombre']?></option>
                 <?php endforeach; ?>
          </select>
    </div>

  </div>
  <div class="form-group row">
  <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">N° Edición</label>
      <div class="col-sm-4">
      <input   oninput="validar(this)" pattern="^[1-9]\d*$" class="form-control form-control-sm" required maxlength="100" minlength="1" type="text" name="datoEdicion" id="datoEdicion">
      </div>
  </div>

  
  <button id="guardarLibro"  name="guardarLibro" onclick="sendNewBook()" type="button" class="btn btn-success my-4" > Registrar </button>
  <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formAlta)" >Limpiar</button>
  </form>

  <a href="index">Volver a la página de inicio</a>
  
  </center>
  <div id="liveAlertPlaceholder2" class="toast-container position-fixed bottom-0 end-0 p-3">
</div><br><br><br><br>
<footer class="footer py-4" style="background-color: #2a5555; color:white;">
            <div class="container">
                <div class="row align-items-center" >
                    <div class="col-lg-4 text-lg-start">Universidad Nacional de la Patagonia Austral</div>
                    <div class="col-lg-4 my-3 my-lg-0 text-center">
                        <a class="btn btn-dark btn-social mx-2" href="https://x.com/UNPA_C_Olivia" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/people/Unidad-Acad%C3%A9mica-Caleta-Olivia-UNPA/100064834562211/" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark m-3" href="https://www.instagram.com/unpa_uaco/?hl=es-la"><i class="fab fa-instagram"></i></a>
                    </div>
                    
                    <div class="col-lg-4 text-lg-end" >              
                    <div >Unidad Académica Caleta Olivia</div>
                </div>
            </div>
        </footer>
</body>


</html>