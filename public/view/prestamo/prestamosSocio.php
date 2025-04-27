<!DOCTYPE html>
<html lang="es">
<head>
<?php
      require_once("../public/view/includes/head.php");
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/prestamo/js/prestamosSocio.js"></script> 
   <link href="../view/css/general.css" rel="stylesheet" />
</head>
<body>
<header>
<?php
    require_once ("../public/view/includes/header.php");
    require_once "../model/dao/Conexion.php";
    use model\dao\Conexion;
    $conexion = Conexion::establecer();
     ?>
    </header>
    <center> <h1>Mis Prestamos</h1> 
    <br>
    <div id="botones" >

    
   
  
    <?php  //if($_SESSION["perfil"] == 1){ echo '<a href="usuario/admin">Volver atrás </a>';}?>
    <a href="../usuario/indexSocio">Volver a la página de inicio</a>
    </div>
    </center>
    <br>
    <br>
    <div class="">

    <table id= "tablaClientes" style="width: 60%; margin-left: auto; margin-right: auto;" class="table text-dark">
                        <thead>
                        <tr>
                            <th> #</th>    
                            <th>Socio</th>     
                            <th>Fecha Inicio</th>        
                            <th>Fecha Fin</th>   
                            <th>Fecha Devolución</th>  
                            <th>Cant. Renovaciones</th>  
                            <th>Observaciones</th> 
                           <th>Tipo </th> 
                           <th >Estado</th> 
                           <th >Ejemplares</th> 
                           <th >Opcion</th> 
                           <th ></th> 
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
<div id="liveAlertPlaceholderNoHay" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
<div id="liveAlertPlaceholder1" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
<div id="liveAlertPlaceholder4" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:1052;">
</div>
<div id="liveAlertPlaceholderdev" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:1052;">
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
    <div id="toastSancion" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">Bootstrap</strong>

   </div>
   <div class="toast-body">
El socio se encuentra sancionado no puede realizar prestamos hasta nuevo aviso.
   <div class="mt-2 pt-2 border-top">
     <button type="button" id="btnAceptar"  onclick=" window.location.href='index' "class="btn btn-primary btn-sm">Aceptar</button>
  </div>
 </div>
</div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastSocioNotFound" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">Bootstrap</strong>

   </div>
   <div class="toast-body">
   No se ha encontrado el socio.
   <div class="mt-2 pt-2 border-top">
     <button type="button" id="btnAceptar"  class="btn btn-primary btn-sm">Aceptar</button>
  </div>
 </div>
</div>
</div>



<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastTiene3" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">Bootstrap</strong>

   </div>
   <div class="toast-body">
El socio tiene 3 libros prestados, no puede realizar más prestamos.
   <div class="mt-2 pt-2 border-top">
     <button type="button" id="btnAceptar"  onclick=" window.location.href='index' "class="btn btn-primary btn-sm">Aceptar</button>
  </div>
 </div>
</div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastObsDev" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">Bootstrap</strong>

   </div>
   <div class="toast-body">
 <form>
  <label> Ingrese observaciones de la devolución</label>
  <input type=" text" required id="obsDev" name="obsDev">
 </form>
   <div class="mt-2 pt-2 border-top">
     <button type="button" id="btnAceptar15" class="btn btn-primary btn-sm">Aceptar</button>
  </div>
 </div>
</div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastEjemIncorrecto" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">Bootstrap</strong>
       <small>11 mins ago</small>
       <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
   </div>
   <div class="toast-body">
   No existe el ejemplar.
   <div class="mt-2 pt-2 border-top">
     <button type="button" id="btnMotivo" class="btn btn-primary btn-sm">Aceptar</button>
  </div>
 </div>
</div>
</div>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastRepetido" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">Bootstrap</strong>
       <small>11 mins ago</small>
       <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
   </div>
   <div class="toast-body">
  Un socio no puede tener libros repetidos
   <div class="mt-2 pt-2 border-top">
     <button type="button" id="btnMotivo" class="btn btn-primary btn-sm">Aceptar</button>
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
            </div>
        </footer>
  </body>

</html>