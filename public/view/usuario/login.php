<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    
        require_once "../public/view/includes/head.php";
     //   $pass= "1234";
     //$hash=    password_hash($pass,PASSWORD_DEFAULT) ;
     $_SESSION["claveSecreta"]=2025;
    ?>
    <script defer type="text/javascript" src="view/usuario/js/login.js"></script>    
</head>
<header>
<?php
       require_once "../public/view/includes/headerlogin.php";
   ?>
    </header>
<body>
    <br>
    <br>
   <center> <h2>Autenticación</h2>
   
    <form  class="form-label" id="formLogin" method="POST" action="">
        <div >
            <label for="datoCuenta">Cuenta</label>
            <br>
            <input required type="text" name="datoCuenta" id="datoCuenta">
        </div>
        <div>
            <label for="datoClave">Contraseña</label>
            <br>
            <input  required type="password" name="datoClave" id="datoClave">
        </div>
        <button type="button" class="btn btn-success my-4" onclick="log()">Ingresar al sistema</button>

    </form>





    <br><br><br><br><br><br>
</body>
<footer>
<?php

require_once "../public/view/includes/footer.php";
   ?>
</footer>
</html>