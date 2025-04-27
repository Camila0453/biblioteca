<!DOCTYPE html>
<html lang="en">
<head>
<?php
      require_once("../public/view/includes/head.php");
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/ejemplar/js/ejemIndex.js"></script>  
   <link href="../view/css/general.css" rel="stylesheet" />
      
</head>
<body>
<header>
<?php
    require_once ("../public/view/includes/header.php");
    require_once "../model/dao/Conexion.php";
    use model\dao\Conexion;
    $conexion = Conexion::establecer();
     ?>
    </header>

    <br>
    <center> 

     <h1>Alta de Ejemplares</h1>
    
     <form id="formAlta" class="form-label"  method="POST" action="" enctype="multipart/form-data">
      <div class="form-group row">
       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Código</label>
      <div class="col-sm-4">
      <input oninput="validar(this)" pattern="^\d{4}$" required type="text" maxlength="4" minlength="4" class="form-control form-control-sm" id="datoCodigo" name="datoCodigo" placeholder="">
      </div>
    
     <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Libro</label>
     <div class="col-sm-4">
        <select class="form-control" id="datoLibro" name="datoLibro"  >
            <option value="">Seleccione el libro</option>
                <?php
               
                 $sql= "SELECT id,titulo,ISBN FROM libro";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $libros= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($libros as $lib): ?>
                   <option value="<?= $lib['id']?>">     <?= trim( $lib['titulo'])?>  </option>
                 <?php endforeach; ?>
          </select>
    </div>
     </div>
    <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Observación</label>
      <div class="col-sm-4">
      <input oninput="validar(this)" required type="text" maxlength="45" minlength="1" class="form-control form-control-sm" id="datoObservacion" name="datoObservacion" placeholder="">
      </div>
      <input oninput="validar(this)" required type="text"  class="form-control form-control-sm" id="datoLibro" name="datoLibro" hidden value="<?= $data=trim($data,'*')?>" placeholder="">
    </div>
  <button id="guardarEjem"  name="guarEjem" onclick=" sendNewEjem()" type="button" class="btn btn-success my-4" > Registrar </button>
  <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formAlta)" >Limpiar</button>
  </form>

  <a href="index">Volver a la página de inicio</a>
  
  </center>
  <div id="liveAlertPlaceholder2" class="toast-container position-fixed bottom-0 end-0 p-3"></div>
<br><br><br><br>
<br><br><br><br><br><br>
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