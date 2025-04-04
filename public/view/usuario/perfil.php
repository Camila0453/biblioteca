<!DOCTYPE html>
<html lang="es">
<head>
<?php
      require_once("../public/view/includes/head.php");
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/usuario/js/usuario.js"></script> 
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
<br><br><br>
  <div class="row">
    <div class="col-sm-4">
    
    </div>
    <div class="col-sm-8">
  <h1><?= $_SESSION["nombre"] ?></h1>
    </div>
  </div>
</div>

  
<footer>
<?php
       require_once ("../public/view/includes/footer.php");
   ?>
</footer>
</html>