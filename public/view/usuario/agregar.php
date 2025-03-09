<!DOCTYPE html>
<html lang="en">
<head>
   <?php
       require_once "../public/view/includes/head.php";
      
   ?>
    <script defer type="text/javascript" src="../view/usuario/js/usuario.js"></script>  
      
</head>
<header>
<?php
       require_once "../public/view/includes/header.php";
       require_once "../model/dao/Conexion.php";
       use model\dao\Conexion;
       $conexion = Conexion::establecer();
   ?>
    </header>
<body>
    <br>
    <center> 

     <h1>Alta de socios</h1>
    
    
  <form id="formAlta" class="form-label"  method="POST" action="" enctype="multipart/form-data">
  <div class="form-group row">
       <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Nombre</label>
      <div class="col-sm-4">
      <input required type="password" maxlength="15" minlength="8" class="form-control form-control-sm" id="datoNombre" name="datoNombre" placeholder="">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">DNI (clave provisoria)</label>
      <div class="col-sm-4">
      <input class="form-control form-control-sm" required maxlength="8" minlength="8" type="mail" name="datoDni" id="datoDni">
      </div>
  </div>
  <div class="form-group row">
  <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Correo (usuario)</label>
      <div class="col-sm-4">
      <input class="form-control form-control-sm" required maxlength="255" minlength="15" type="mail" name="datoCorreo" id="datoCorreo">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Tipo Usuario</label>
     <div class="col-sm-4">
        <select required class="form-control" id="datoTipoUsuario" name="datoTipoUsuario"  >
            <option value="">Seleccione el tipo de usuario</option>
                <?php
               
                 $sql= "SELECT id,nombre FROM tiposusuario";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $tiposusuario= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($tiposusuario as $tipo): ?>
                   <option value="<?= $tipo['id']?>"><?= $tipo['nombre']?></option>
                 <?php endforeach; ?>
          </select>
    </div>
      
  </div>

  
  <button id="guardarCliente"  name="guardarCliente" onclick="sendNewUser()" type="button" class="btn btn-success my-4"  >Registrar </button>
  <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formAlta)" >Limpiar</button>
  </form>

  <a href="cliente/index">Volver a la página de inicio</a>
  
  </center>
</body>
<footer>
<?php

       require_once "../public/view/includes/footer.php";
   ?>
</footer>
</html>