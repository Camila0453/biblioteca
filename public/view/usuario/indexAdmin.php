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
     require_once ("../public/view/includes/header.php");
     ?>
    </header>
<body>
    <br>
    <br>
    <br>
   
   
    <center> <h1>Bienvenido <?= $_SESSION["nombre"]?></h1>
  
    <br>
    </center>
    <center>
    <div id="botones" >
    <button type="button" class="btn btn-primary ms-3" onclick="showIndex()"> Usuarios</button>
       <br>
       <br>
       <button type="button" class="btn btn-primary ms-3" onclick="showSocios()"> Socios</button>
       <br>
       <br>
    <button type="button" class="btn btn-primary ms-3" onclick="showLibros()"> Libros</button>
   <br>
   <br>
   <button type="button" class="btn btn-primary ms-3" onclick="showEjemplares()">Ejemplares</button>
   <br>
   <br>
   <button type="button" class="btn btn-primary ms-3" onclick="showPrestamos()"> Préstamos</button>
   <br>
   <br>
   <button type="button" class="btn btn-primary ms-3" onclick="showReservas()"> Reservas</button>
    </div>
    </center>
    <div>








    </div>
    
    
    <br>
    <br>
    <br>
    <br>
    <br>
</body>
<footer>
<?php
       require_once ("../public/view/includes/footer.php");
   ?>
</footer>
</html>