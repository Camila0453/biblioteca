<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><Biblioteca></title>
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    
    <?php
    
       
     //   $pass= "1234";
     //$hash=    password_hash($pass,PASSWORD_DEFAULT) ;
     $_SESSION["claveSecreta"]=2025;
    ?>
    <script defer type="text/javascript" src="view/usuario/js/login.js"></script>    
</head>
<header>
<?php
require_once "../public/view/includes/headerlogin.php";
      // require_once "../public/view/includes/headerlogin.php";
   ?>
    </header>
<body>
    <br>
    <br>
   <center> <h2>Autenticación</h2>
  <div class="card" style="width: 27rem;">
  <div class="card-body">
  <form id="formLogin" name="formLogin" class="form-label"  method="POST" action="" enctype="multipart/form-data">
  <div class="form-group">
       <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nombre</label>
      <div class="col-sm-6">
      <input required type="text" maxlength="45" minlength="8" class="form-control form-control-sm" id="datoUsuario" name="datoUsuario" placeholder="">
      </div>
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Clave</label>
      <div class="col-sm-6">
      <input class="form-control form-control-sm" required maxlength="8" minlength="8" type="password" name="datoClave" id="datoClave">
      </div>
  </div>
  <button id="btnLogin"  name="btnLogin" onclick="log1()" type="button" class="btn btn-success my-4"  >Ingresar </button>
  <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formAlta)" >Limpiar</button>
  </form>
  </div>
</div>
</body>
<footer>
<?php

require_once "../public/view/includes/footer.php";
   ?>
</footer>
</html>