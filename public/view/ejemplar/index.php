<!DOCTYPE html>
<html lang="es">
<head>
<?php
      require_once("../public/view/includes/head.php");
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/ejemplar/js/ejemIndex.js"></script> 
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
    <br>
    
    <center> <h2>Gestión de Ejemplares</h2> 
   <!-- <p> bienvenido <?= $_SESSION["usuario"] ?></p>-->
    <br>
    <div id="botones" >

    
    <button type="button" class="btn btn-primary ms-3" onclick="showSave()">Agregar Libro </button>
    <br>
    <br>
    <?php  //if($_SESSION["perfil"] == 1){ echo '<a href="usuario/admin">Volver atrás </a>';}?>
    
    </div>
    </center>
    <br>
    <br>
    <div class="">

    <table id= "tablaClientes" style="width: 60%; margin-left: auto; margin-right: auto;" class="table text-dark">
                        <thead>
                        <tr>
                        <th> #</th>    
                            <th>Código </th>   
                            <th>Libro </th>   
                            <th>Obersvaciones</th>        
                            <th>Estado</th>          
                           <th >Opcion</th> 
                        </tr>
                    </thead>
                     <tbody id="tablaProductos">
                     
                       
                   </tbody>
                    </table>
                    </div>
                    <br>
<br>
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



<div id="myModal" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modificar Ejemplar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="formAct" class="form-label"  method="POST" action="" enctype="multipart/form-data">
      <div class="form-group row">
       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Código</label>
      <div class="col-sm-4">
      <input required type="text" maxlength="45" minlength="8" class="form-control form-control-sm" id="datoCodigo" name="datoCodigo" placeholder="">
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Libro</label>
     <div class="col-sm-4">
        <select disable class="form-control" id="datoLibro" name="datoLibro"  >
            <option value="">Seleccione el libro</option>
                <?php
               
                 $sql= "SELECT id,titulo FROM libro";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $libros= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($libros as $lib): ?>
                   <option value="<?= $lib['id']?>"><?= trim( $lib['titulo'])?>   </option>
                 <?php endforeach; ?>
          </select>
    </div>

      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Observación</label>
      <div class="col-sm-4">
      <input required type="text" maxlength="45" minlength="8" class="form-control form-control-sm" id="datoObservacion" name="datoObservacion" placeholder="">
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Estado</label>
      <div class="col-sm-4">
         <select required class="form-control col-sm-10" id="datoEstado" name="datoEstado">
         <option value="">Seleccione el estado</option>
                 <option value="1">Activo </option>
                 <option value="0">Inactivo</option>
         </select>
      </div>
  </div>
  <div class="form-group row">
      
  </form>
      </div>
      <div class="modal-footer">
      <button id="btnAct"  name="btnAct" onclick="" type="button" class="btn btn-success my-4"  >Registrar </button>
      <button id="limp" type="button" class="btn btn-success my-4" onclick="" >Limpiar</button>
      </div>
    </div>
  </div>
</div>
