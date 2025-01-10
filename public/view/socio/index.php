<!DOCTYPE html>
<html lang="es">
<head>
<?php
      require_once("../includes/head.php");
      
   ?>
  <!-- <script defer type="text/javascript" src="view/cliente/js/cliente1.js"></script> -->
</head>
<header>
<?php
    require_once ("../includes/header.php");
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
       require_once ("../includes/footer.php");
   ?>
</footer>
</html>