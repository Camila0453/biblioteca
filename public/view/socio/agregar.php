<!DOCTYPE html>
<html lang="en">
<head>
   <?php
       require_once "../public/view/includes/head.php";
      
   ?>
 
    <link href="../view/css/general.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script defer type="text/javascript" src="../view/socio/js/socio1.js"></script>  
      
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
    
    
  <form id="formAlta" name="formAlta" class="form-label"  method="POST" enctype="multipart/form-data">
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Nombre</label>
      <div class="col-sm-4">
          <input oninput="validar(this)" required type="text" pattern="[a-zA-ZÀ-ÿ\s]{5,45}" class="form-control form-control-sm" id="datoNombre" name="datoNombre" placeholder="Juan">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Apellido</label>
      <div class="col-sm-4">
           <input  oninput="validar(this)" required type="text" pattern="[a-zA-ZÀ-ÿ\s]{5,45}" class="form-control form-control-sm" id="datoApellido" name="datoApellido" placeholder="Perez">
      </div>
  </div>
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">DNI (Sin puntos) </label>
      <div class="col-sm-4">
          <input   oninput="validar(this)" required type="text" minlength="8" max="8"class="form-control form-control-sm" id="datoDni" name="datoDni" placeholder="42711312">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Correo</label>
      <div class="col-sm-4">
           <input  oninput="validar(this)" required type="email" minlength="10" max="255" class="form-control form-control-sm" id="datoCorreo" name="datoCorreo" placeholder="aballaycamila4@gmail.com">
      </div>
  </div>

  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Telefono</label>
      <div class="col-sm-4">
          <input oninput="validar(this)"  maxlength="13" minlength="13" pattern="\d{13,45}"  required type="text" class="form-control form-control-sm" id="datoTelefono" name="datoTelefono" placeholder="5492975165695">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Domicilio</label>
      <div class="col-sm-4">
          <input  oninput="validar(this)" maxlength="45" minlength="5" required type="text" class="form-control form-control-sm" id="datoDomicilio" name="datoDomicilio" placeholder="Koluel kaike 1276">
      </div>
      
  </div>
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Localidad</label>
      <div class="col-sm-4">
          <input  oninput="validar(this)"  maxlength="45" minlength="5"required type="text" class="form-control form-control-sm" id="datoLocalidad" name="datoLocalidad" placeholder="Caleta Olivia">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Provincia</label>
      <div class="col-sm-4">
          <input  oninput="validar(this)" maxlength="45" minlength="5" required type="text" class="form-control form-control-sm" id="datoProvincia" name="datoProvincia" placeholder="Santa Cruz">
      </div>
    
    
 </div>
 <div class="form-group row">
     <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Tipo Socio</label>
     <div class="col-sm-4">
        <select required class="form-control" id="datoTipoSocio" name="datoTipoSocio" onchange="materiaOcarrera()" >
            <option value="">Seleccione el tipo de socio</option>
                <?php
               
                 $sql= "SELECT id,nombre FROM tipossocio";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $tipossocios= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($tipossocios as $tipo): ?>
                   <option value="<?= $tipo['id']?>"><?= $tipo['nombre']?></option>
                 <?php endforeach; ?>
          </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Frente DNI</label>
     <div class="col-sm-4">
        <input  required type="file" class="form-control form-control-sm" id="datoFrenteDni" name="datoFrenteDni" >
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Dorso DNI</label>
    <div class="col-sm-4">
        <input required type="file" class="form-control form-control-sm" id="datoDorsoDni" name="datoDorsoDni" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Materias/carreras</label>
    <div class="col-sm-4">
    <select multiple required class="form-control" id="datoMateriaCarrera" name="datoMateriaCarrera" >
        <option value="">Seleccione materia o carrera según corrresponda</option>
    </select>
    </div>
  </div>
  <button id="guardarCliente"  name="guardarCliente" onclick="sendNewClient()" type="button" class="btn btn-success my-4"  >Registrar </button>
  <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formAlta)" >Limpiar</button>
  </form>

  <a href="index">Volver a la página de inicio</a>
  
  </center>


  <div id="liveAlertPlaceholder6" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
</body>
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