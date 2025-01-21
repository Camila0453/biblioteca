<!DOCTYPE html>
<html lang="en">
<head>
   <?php
       require_once "../public/view/includes/head.php";
      
   ?>
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
    
    
  <form id="formAlta" class="form-label" id="formAltaU" method="POST" action="usuario/save">
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Nombre</label>
      <div class="col-sm-4">
          <input required type="text" class="form-control form-control-sm" id="datoNombre" name="datoNombre" placeholder="Juan">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Apellido</label>
      <div class="col-sm-4">
           <input required type="text" class="form-control form-control-sm" id="datoApellido" name="datoApellido" placeholder="Perez">
      </div>
  </div>
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">DNI</label>
      <div class="col-sm-4">
          <input required type="text" class="form-control form-control-sm" id="datoDni" name="datoDni" placeholder="42711312">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Correo</label>
      <div class="col-sm-4">
           <input required type="email" class="form-control form-control-sm" id="datoCorreo" name="datoCorreo" placeholder="aballaycamila4@gmail.com">
      </div>
  </div>

  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Telefono</label>
      <div class="col-sm-4">
          <input  required type="text" class="form-control form-control-sm" id="datoTelefono" name="datoTelefono" placeholder="2975165695">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Domicilio</label>
      <div class="col-sm-4">
          <input required type="text" class="form-control form-control-sm" id="datoDomicilio" name="datoDomicilio" placeholder="Koluel kaike 1276">
      </div>
      
  </div>
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Localidad</label>
      <div class="col-sm-4">
          <input required type="text" class="form-control form-control-sm" id="datoLocalidad" name="datoLocalidad" placeholder="Caleta Olivia">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Provincia</label>
      <div class="col-sm-4">
          <input required type="text" class="form-control form-control-sm" id="datoProvincia" name="datoProvincia" placeholder="Santa Cruz">
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
        <input required type="file" class="form-control form-control-sm" id="datoFrenteDni" name="datoFrenteDni" placeholder="col-form-label-sm">
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Dorso DNI</label>
    <div class="col-sm-4">
        <input required type="file" class="form-control form-control-sm" id="datoDorsoDni" name="datoDorsoDni" placeholder="col-form-label-sm">
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

  <a href="cliente/index">Volver a la página de inicio</a>
  
  </center>
</body>
<footer>
<?php

       require_once "../public/view/includes/footer.php";
   ?>
</footer>
</html>