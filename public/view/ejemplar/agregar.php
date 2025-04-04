<!DOCTYPE html>
<html lang="en">
<head>
<?php
      require_once("../public/view/includes/head.php");
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../../view/ejemplar/js/ejemplar.js"></script>  
      
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
<?php 
    require_once "../model/dao/Conexion.php";
    $conexion = Conexion::establecer();
               $sql= "SELECT id,titulo FROM libro WHERE id= '$data=trim($data,*)'";
               $stmt= $conexion->prepare($sql);
               $stmt->execute();
               $libro= $stmt->fetch(PDO::FETCH_ASSOC); ?>
    <br>
    <center> 

     <h1>Alta de Ejemplares <?= $libro['titulo']?></h1>
     <br> <br><br>
    
     <form id="formAlta" class="form-label"  method="POST" action="" enctype="multipart/form-data">
      <div class="form-group row">
       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Código</label>
      <div class="col-sm-4">
      <input required type="text" maxlength="45" minlength="1" class="form-control form-control-sm" id="datoCodigo" name="datoCodigo" placeholder="">
      </div>
    <!-- <div class="col-sm-4">
        <select disable class="form-control" id="datoLibro" name="datoLibro"  >
            <option value="">Seleccione el libro</option>
                <?php
               
                 $sql= "SELECT id,titulo FROM libro";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $libros= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($libros as $lib): ?>
                   <option value="<?= $lib['id']?>"><?= trim( $lib['titulo'])?>   </option>
                 <?php endforeach; ?>
          </select>
    </div>-->

      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Observación</label>
      <div class="col-sm-4">
      <input required type="text" maxlength="45" minlength="1" class="form-control form-control-sm" id="datoObservacion" name="datoObservacion" placeholder="">
      </div>
      <input required type="text"  class="form-control form-control-sm" id="datoLibro" name="datoLibro" hidden value="<?= $data=trim($data,'*')?>" placeholder="">
     <!-- <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Estado</label>
      <div class="col-sm-4">
         <select required class="form-control col-sm-10" id="datoEstado" name="datoEstado">
         <option value="">Seleccione el estado</option>
                 <option value="1">Activo </option>
                 <option value="0">Inactivo</option>
         </select>
      </div>-->
  </div>
  <button id="guardarLibro"  name="guardarLibro" onclick="sendNewEjem()" type="button" class="btn btn-success my-4" > Registrar </button>
  <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formAlta)" >Limpiar</button>
  </form>

  <a href="index">Volver a la página de inicio</a>
  
  </center>
  <div id="liveAlertPlaceholder2" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
</body>
<footer>
<?php

       require_once "../public/view/includes/footer.php";
   ?>
</footer>
</html>