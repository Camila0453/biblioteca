<!DOCTYPE html>
<html lang="en">
<head>
   <?php
       require_once "../public/view/includes/head.php";
   ?>
    <script defer type="text/javascript" src="../public/view/socio/js/socio.js"></script>  
      
</head>
<header>
<?php
       require_once "../public/view/includes/header.php";
   ?>
    </header>
<body>
    <br>
    <center> 

     <h1>Alta de clientes</h1>
    <br>
    
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
    </div>
  </div>
  <div class="form-group row">
  <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
    </div>
  </div>
  <div class="form-group row">
  <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
    </div>
    </div>
  </div>

   
    
       
        <button id="guardarCliente"  name="guardarCliente" onclick="sendNewClient()" type="button" class="btn btn-success my-4"  >Registrar </button>
        <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formAlta)" >Limpiar</button>
    </form>
    <a href="cliente/index">Volver a la página de inicio</a>
    <br>
    </center>
</body>
<footer>
<?php

       require_once "../public/view/includes/footer.php";
   ?>
</footer>
</html>