<!DOCTYPE html>
<html lang="en">
<head>
   <?php
      // require_once "../public/view/includes/head.php";
   ?>
    <script defer type="text/javascript" src="js/socio.js"></script>  
      
</head>
<header>
<?php
      // require_once "../public/view/includes/header.php";
   ?>
    </header>
<body>
    <br>
    <center> 

     <h1>Alta de clientes</h1>
    <br>
    <form class="form-label" id="formAlta" method="POST" action="cliente/save">
     
    
      
         <div   class=" col-sm-2">
            <label for="">Apellido</label>
            <input maxlength="45" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}" type="text" name="datoApellido" id="datoApellido">
        </div>

        <div  class=" col-sm-2">
            <label for="">Nombres</label>
            <input  minlength="3" maxlength="45" required  required pattern="[a-zA-ZÀ-ÿ\s]{3,45}" type="text" name="datoNombres" id="datoNombres">
        </div>
    
        <div class=" col-sm-2">
            <label for="">Número de documento


            </label>
            <input  maxlength="8" minlength="8" required pattern="\d{8,8}" type="text" name="datoDNI" id="datoDNI">
        </div>
   
        <div class=" col-sm-2">
            <label for="">Domicilio</label>
            <input  maxlength="60" minlength="10" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}"  type="text" name="datoDomicilio" id="datoDomicilio">
        </div>
        <div class=" col-sm-2"> 
            <label for="">Localidad</label>
            <input  maxlength="30" minlength="5" required pattern="[a-zA-ZÀ-ÿ\s]{5,30}" type="text" name="datoLocalidad" id="datoLocalidad">
        </div>
        <div class=" col-sm-2">
            <label for="">Provincia</label>
            <input  maxlength="30" minlength="8" required pattern="[a-zA-ZÀ-ÿ\s]{5,30}" type="text" name="datoProvincia" id="datoProvincia">
        </div>
        <div class=" col-sm-2">
            <label for="">Telefono</label>
            <input  maxlength="45" minlength="13" required  pattern="\d{13,45}" type="text" name="datoTelefono" id="datoTelefono">
        </div>
        <div class=" col-sm-2">
            <label for="">Correo</label>
            <input type="mail" minlength="15" maxlength="255" required type="text" name="datoCorreo" id="datoCorreo">
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

       //require_once "../public/view/includes/footer.php";
   ?>
</footer>
</html>