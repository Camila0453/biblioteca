<!DOCTYPE html>
<html lang="es">
<head>
<?php
      require_once("../public/view/includes/head.php");
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/usuario/js/usuario.js"></script> 
   <link href="../view/css/general.css" rel="stylesheet" />
   <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<header>
<?php
    require_once ("../public/view/includes/header.php");
    require_once "../model/dao/Conexion.php";
    use model\dao\Conexion;
    $conexion = Conexion::establecer();
$id=  $_SESSION["idUsuario"];              
                $sql= "SELECT  * from usuarios where id= :idUsuario  ";
                $stmt= $conexion->prepare($sql);
                $stmt->bindParam(':idUsuario',$id,PDO::PARAM_INT);
                $stmt->execute();
                $resultado= $stmt->fetch(PDO::FETCH_ASSOC);

$tipoU=$resultado['tipoUsuario'];
if($resultado['tipoUsuario'] ==1){
  $tipoU='Administrador';
}

if($resultado['tipoUsuario'] ==2){
  $tipoU='Operador';
}
if($resultado['tipoUsuario'] ==5){
  $tipoU='Socio';
}

$sql= "SELECT  * from socios where usuario= :idUsuariox  ";
$stmt= $conexion->prepare($sql);
$stmt->bindParam(':idUsuariox',$id,PDO::PARAM_INT);
$stmt->execute();
$resultado1= $stmt->fetch(PDO::FETCH_ASSOC);



if($resultado['tipoSocio']==1){
$tipoSo= 'Profesor';

}
else{
    $tipoSo= 'Alumno';
}





     ?>
    </header>
<body>
<center><h1>Mi Perfil</h1></center>
  <div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <div class="card p-3 py-4">
                <div class="text-center">
                    <img src="https://definicion.de/wp-content/uploads/2019/07/perfil-de-usuario.png" width="100" class="rounded-circle">
                </div>
                
                <div class="text-center mt-3">
               
                  
                    <h5 class="mt-2 mb-0"><i><?= $resultado['nombreCompleto']?> </i></h5>
                    <br>
                    
                    <span class="bg-secondary p-1 px-4 rounded text-white"><?= $tipoU ?>-> <?= $tipoSo ?></span>
                    <br>
                    <br>
                    <span><strong>Nombre Completo: </strong> <?= $resultado1['nombre']  ?></span>
                    <br>
                    <span><strong>DNI:  </strong><?= $resultado1['dni']  ?></span>
                    <br>
                    <span><strong>Telefono:  </strong><?= $resultado1['telefono']  ?></span>
                    <br>
                    <span><strong>Correo:  </strong><?= $resultado1['correo']  ?></span>
                    <br>
                    <span><strong>Domicilio:  </strong><?= $resultado1['domicilio']  ?></span>
                    <br>
                    <span><strong>Localidad:  </strong><?= $resultado1['localidad']  ?></span>
                    <br>
                    <span><strong>Provincia:  </strong><?= $resultado1['provincia']  ?></span>
                    <br>
                    <span><strong>Frente DNI:  </strong><a href="../view/socio/<?= $resultado1['frenteDni']  ?>">Ver</a></span>
                    <br>
                    <span><strong>Dorso DNI:  </strong><a href="../view/socio/<?= $resultado1['dorsoDni']  ?>" >  Ver</a></span>
                    
                </div>
                
               
                
                
            </div>
            
        </div>
        
    </div>
    
</div>

















</div>
<br><br><br> <br>
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
</html>