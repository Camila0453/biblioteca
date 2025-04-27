<!DOCTYPE html>
<html lang="en">
<head>
<?php
       require_once "../public/view/includes/head.php";
       
   ?>
      <link rel="icon" type="image/x-icon" href="../view/assets/favicon.ico" />
     
    <script defer type="text/javascript" src="../view/usuario/js/usuario.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="../view/css/general.css" rel="stylesheet" />
</head>
<header>
<?php
     require_once ("../public/view/includes/header.php");
     require_once "../model/dao/Conexion.php";
     use model\dao\Conexion;
     $conexion = Conexion::establecer();
               
                 $sql= "SELECT COUNT(*) as totalL FROM libro";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $resultado= $stmt->fetch(PDO::FETCH_ASSOC);
                 $libros= $resultado['totalL'];

                 $sql= "SELECT COUNT(*) as totalS FROM socios";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $resultado1= $stmt->fetch(PDO::FETCH_ASSOC);
                 $socios= $resultado1['totalS'];

                 $sql= "SELECT COUNT(*) as totalP FROM socios WHERE estado= 1";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $resultado2= $stmt->fetch(PDO::FETCH_ASSOC);
                 $prestamos= $resultado2['totalP'];
            
     ?>
    </header>
<body>
  
    <center> <h1>Bienvenido,<i><?= $_SESSION["nombre"]?> </i> </h1> 
    <br>
    
    <br>  <br>  <br>  <br>  <br> 
    <div id="botones" >
    <button type="button" class="btn btn-primary ms-3" style= "width:150px; height: 50px;" onclick="misPrestamos()"> Mis prestamos </button>
       <button type="button" class="btn btn-primary ms-3" style= "width:150px; height: 50px;" onclick="misReservas()"> Mis reservas</button>
       
    </div>
    </center>
    <div>








    </div>
    
    
    <br> <br> <br> <br> <br> <br> <br> <br> <br><br> <br> 
    <footer class="footer py-4" style="background-color: #2a5555; color:white">
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
</body>
 
</html>