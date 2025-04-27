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
    <h3>Panel de Administración</h3>
    <br>
     <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                              Libros disponibles</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">  <?= $libros?>     </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               Socios Activos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">  <?= $socios?>  </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> Reservas Pendientes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $prestamos?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> Prestamos en Curso</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $prestamos?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <center>
    <br> 
    <div id="botones" >
    <button type="button" class="btn btn-primary ms-3" style= "width:150px; height: 50px;" onclick="showIndex()"> Usuarios</button>
       <button type="button" class="btn btn-primary ms-3" style= "width:150px; height: 50px;" onclick="showSocios()"> Socios</button>
    </div>
    </center>
    <br> <br> <br>
    <br> <br> <br>
    <br> <br> <br>
    
    <footer class="foot" style="background-color: #2a5555; color:white">
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