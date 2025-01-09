<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?$headTitle?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
   <!-- <link href="view/cliente/css/generic.css" type="text/css" rel="stylesheet">-->
<?php

      // require_once("../public/view/includes/head.php");
      
   ?>
  <!-- <script defer type="text/javascript" src="view/cliente/js/cliente1.js"></script> -->
</head>
<header>
<?php
   //  require_once ("../public/view/includes/header.php");
     ?>
    </header>
<body>
    <br>
    
    <center> <h2>Gestión de Socios</h2> 
   <!-- <p> bienvenido <?= $_SESSION["usuario"] ?></p>-->
    <br>
    <div id="botones" >

    
    <button type="button" class="btn btn-primary ms-3" onclick="showSave()">Agregar Cliente </button>
    <br>
    <br>
    <?php  //if($_SESSION["perfil"] == 1){ echo '<a href="usuario/admin">Volver atrás </a>';}?>
    
    </div>
    </center>
    <br>
    <br>

    <table id= "tablaClientes" style="width: 60%; margin-left: auto; margin-right: auto;" class="table text-dark">
                        <thead>
                        <tr>

                          
                          
                            <th> id</th>                
                           <th>Nombres </th> 
                           <th>Apellido </th> 
                           <th>DNI</th> 
                           <th>Domicilio</th> 
                           <th>Localidad</th> 
                           <th>Provincia</th> 
                           <th>Telefono</th> 
                           <th></th> 
                           <th>Correo</th> 
                           <th>Fecha Alta</th> 
                           <th>Estado</th> 
                           <th>Usuario</th> 
                           <th>Tipo Socio</th> 
                           <th>Materia/Carrera</th> 
                           <th >Frente Dni</th> 
                           <th >Dorso Dni</th> 
                           <th >Opción</th> 
                        </tr>
                    </thead>
                     <tbody id="tablaProductos">
                     
                       
                   </tbody>
                     
                
                
                
                
                
                    </table>
                    <br>
<br>
<br>
<br>
   
</body>
<footer>
<?php
      // require_once ("../public/view/includes/footer.php");
   ?>
</footer>
</html>