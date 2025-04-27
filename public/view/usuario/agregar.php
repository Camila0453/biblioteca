<!DOCTYPE html>
<html lang="en">
<head>
   <?php
       require_once "../public/view/includes/head.php";
      
   ?>
    <script defer type="text/javascript" src="../view/usuario/js/usuario.js"></script>  
    <link href="../view/css/general.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
      
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

     <h1>Alta de Usuarios</h1>
    
    
  <form id="formAlta" class="form-label"  method="POST" action="" enctype="multipart/form-data">
  <div class="form-group row">
       <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Nombre</label>
      <div class="col-sm-4">
      <input oninput="validar(this)"  minlength="10" max="45" required type="text" maxlength="45" minlength="8" class="form-control form-control-sm" id="datoNombre" name="datoNombre" placeholder="">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">DNI (clave provisoria)</label>
      <div class="col-sm-4">
      <input oninput="validar(this)"  minlength="8" max="8" class="form-control form-control-sm" required maxlength="8" minlength="8" type="mail" name="datoDni" id="datoDni">
      </div>
  </div>
  <div class="form-group row">
  <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Correo (usuario)</label>
      <div class="col-sm-4">
      <input oninput="validar(this)"  minlength="10" max="255" class="form-control form-control-sm" required maxlength="255" minlength="15" type="mail" name="datoCorreo" id="datoCorreo">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Tipo Usuario</label>
     <div class="col-sm-4">
        <select required class="form-control" id="datoTipoUsuario" name="datoTipoUsuario"  >
            <option value="">Seleccione el tipo de usuario</option>
                <?php
               
                 $sql= "SELECT id,nombre FROM tiposusuario where nombre <> 'Socio'";
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

  <a href="index">Volver a la página de inicio</a>
  
  </center>
  <div id="liveAlertPlaceholder2" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
</body>
<br><br><br><br>
<br><br><br><br>

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
</html>