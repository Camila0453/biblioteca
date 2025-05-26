<!DOCTYPE html>
<html lang="es">
<head>
<?php
      require_once("../public/view/includes/head.php");
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/reserva/js/reserva.js"></script> 
   <link href="../view/css/general.css" rel="stylesheet" />

</head>
<header>
<?php
    require_once ("../public/view/includes/header.php");
    require_once "../model/dao/Conexion.php";
    use model\dao\Conexion;
    $conexion = Conexion::establecer();
     ?>
    </header>
<body>
   
    <center> <h1>Gestión de Reservas</h1> 
    <div id="botones" >
   
    
    <button type="button" class="btn btn-primary ms-3" onclick="resAct()">Reservas activas de hoy</button><br>
    
    <a href="../../public/view/reserva/reservaGenPDF.php">Generar Pdf</a>
    <br>
    <br>
    <button type="button" class="btn btn-primary ms-3" onclick="showSave()">Registrar Reserva </button>
    <br>
    <?php  //if($_SESSION["perfil"] == 1){ echo '<a href="usuario/admin">Volver atrás </a>';}?>
    <br>
    <?php  if($_SESSION["perfil"] == 1){ echo '<a href="../usuario/indexAdmin">Volver atrás </a>';}?>
       <?php  if($_SESSION["perfil"] == 2){ echo '<a href="../usuario/indexOp">Volver atrás </a>';}?>
       <?php  if($_SESSION["perfil"] == 5){ echo '<a href="../usuario/indexSo">Volver atrás </a>';}?>
    </div>
    </center>
   
    <div class="">

    <table id= "tablaClientes" style="width: 60%; margin-left: auto; margin-right: auto;" class="table text-dark">
                        <thead>
                        <tr>
                            <th> #</th>    
                            <th>Socio</th>   
                            <th>Fecha Inicio</th>        
                            <th>Fecha Fin</th>   
                            <th>Fecha Devolución</th>  
                            <th>Motivo Cancelación</th>  
                            <th>Fecha Cancelación</th>  
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
                    <center><a href="showHistorico">  Histórico de Reservas</a> </center>

<div id="liveAlertPlaceholder" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
<div id="liveAlertPlaceholderRETIRAR" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
<div id="liveAlertPlaceholderNoHay" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
<div id="liveAlertPlaceholder1" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
<div id="liveAlertPlaceholder4" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:1052;">
</div>
<div id="liveAlertPlaceholder6" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:1052;">
</div>
<div id="liveAlertPlaceholderdev" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:1052;">
</div>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastElim" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">BiblioUni</strong>
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

       <strong class="me-auto">BiblioUni</strong>

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

       <strong class="me-auto">BiblioUni</strong>

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

       <strong class="me-auto">BiblioUni</strong>

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

       <strong class="me-auto">BiblioUni</strong>

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

       <strong class="me-auto">BiblioUni</strong>
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

       <strong class="me-auto">BiblioUni</strong>
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

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastPrompt" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">BiblioUni</strong>
       <small>11 mins ago</small>
       <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
   </div>
   <div class="toast-body">
    Ingrese el motivo de la bajas
    <form>
     <input id="inputMotivo100" type= text>
    </form>
   <div class="mt-2 pt-2 border-top">
     <button type="button" id="btnMotivo100" class="btn btn-primary btn-sm">Aceptar</button>
     <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Cancelar</button>
  </div>
 </div>
</div>
</div>




<div id="myModalAgg" class="modal" tabindex="-1">
  <div class="modal-dialog " >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registrar Préstamo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="formAlta" class="form-label"  method="POST" action="" enctype="multipart/form-data">
  <div class="form-group row">
       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">DNI Socio</label>
      <div class="col-sm-4">
      <input required  oninput="buscarSocio()"type="text" maxlength="45" minlength="8" class="form-control form-control-sm" id="datoSocio" name="datoSocio" placeholder="">
      <small id="errSocio" class="form-text text-danger" style="display:none; font-size: 0.90rem;"></small>
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Ejemplar 1</label>
      <div class="col-sm-4">
      <input oninput="buscarEjems('datoEjems')" class="form-control form-control-sm"  maxlength="255" type="text" name="datoEjems" id="datoEjems">
      <small id="datoEjems" class="form-text text-danger" style="display:none; font-size: 0.90rem;"></small>
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Ejemplar 2</label>
      <div class="col-sm-4">
      <input  oninput="buscarEjems('datoEjems1')" class="form-control form-control-sm" maxlength="255"type="text"name="datoEjems1" id="datoEjems1">
      <small id="datoEjems1" class="form-text text-danger" style="display:none; font-size: 0.90rem;"></small>
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Ejemplar 3</label>
      <div class="col-sm-4">
      <input  oninput="buscarEjems('datoEjems2')" class="form-control form-control-sm" maxlength="255" type="text" name="datoEjems2" id="datoEjems2">
      <small id="datoEjems2" class="form-text text-danger" style="display:none; font-size: 0.90rem;"></small>
      </div>
  </div>
  <div class="form-group row">
  <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tipo</label>
      <div class="col-sm-4">
         <select required class="form-control col-sm-10" id="datoTipo" name="datoTipo">
         <option value="">Seleccione el tipo de prestamo</option>
                 <option value="1"> A domicilio </option>
                 <option value="0">En sala</option>
         </select>
      </div>
      
    </div> 
   </div>
   
  </form>
     
      <div class="modal-footer">
      <button id="btnGuardar"  name="btnGuardar" onclick="sendNewPres()" type="button" class="btn btn-success my-4"  >Registrar </button>
      <button id="limp" type="button" class="btn btn-success my-4" onclick="" >Limpiar</button>
      </div>
      </div>
    </div>
  </div>







  </div>
<br><br><br><br><br>
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
           
        </footer>
        
</body>
</html>