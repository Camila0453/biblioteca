<!DOCTYPE html>
<html lang="es">
<head>
<?php
      require_once("../public/view/includes/head.php");
    
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/libro/js/historico.js"></script> 
   <link href="../view/css/general.css" rel="stylesheet" />
   <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<header>
<?php
    require_once ("../public/view/includes/header.php");
     ?>
    </header>
<body>
    <br>
    <br><br><br><br>
    <center> <h2>Histórico Socios</h2> 
   <!-- <p> bienvenido <?= $_SESSION["usuario"] ?></p>-->
    <br>
    <div id="botones" >
     <!-- #endregion --> <a href="index">Volver a la página de inicio</a>
    </div>
    </center>
    <br>
    <br>
    <div class="table-responsive">

    <table id= "tablaClientes"  class="table text-dark">
                        <thead>
                        <tr>
                            <th> #</th>                
                            <th>ISBN </th>   
                            <th>Título</th>             
                           <th>Autor </th>  
                           <th>Edición </th> 
                           <th >Editorial</th> 
                           <th >Disciplina</th> 
                           <th >N° Ejemplares</th> 
                           <th >Estado</th> 
                           <th >Usuario Baja</th> 
                           <th >Fecha Baja</th> 
                           <th >Motivo Baja</th> 
                         
                        </tr>
                    </thead>
                     <tbody id="tablaProductos">
                     
                       
                   </tbody>
                    </table>
                    </div>
                    <br>
                 
                    <br>
<div id="liveAlertPlaceholder" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastElim" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">Bootstrap</strong>
       <small>11 mins ago</small>
       <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
   </div>
   <div class="toast-body">
    ¿Está seguro de que desea dar de baja al usuario?
   <div class="mt-2 pt-2 border-top">
     <button type="button" id="btnAceptar" class="btn btn-primary btn-sm">Aceptar</button>
     <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Cancelar</button>
  </div>
 </div>
</div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastPrompt" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">Bootstrap</strong>
       <small>11 mins ago</small>
       <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
   </div>
   <div class="toast-body">
    Ingrese el motivo de la baja
    <form>
     <input id="inputMotivo" type= text>
    </form>
   <div class="mt-2 pt-2 border-top">
     <button type="button" id="btnMotivo" class="btn btn-primary btn-sm">Aceptar</button>
     <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Cancelar</button>
  </div>
 </div>
</div>
</div>

</body>
<footer class="footer py-4" style="background-color: #2a5555; color:white;">
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