<!DOCTYPE html>
<html lang="es">
<head>
<?php
      require_once("../public/view/includes/head.php");
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/ejemplar/js/ejemIndex.js"></script> 
   <link href="../view/css/general.css" rel="stylesheet" />
 
</head>
<div>
<header>
<?php
    require_once ("../public/view/includes/header.php");
    require_once "../model/dao/Conexion.php";
    use model\dao\Conexion;
    $conexion = Conexion::establecer();
     ?>
    </header>

    
    <center> <h1>Gestión de Ejemplares</h1> 
   <!-- <p> bienvenido <?= $_SESSION["usuario"] ?></p>-->
   
    <div id="botones" >

    
    <button type="button" class="btn btn-primary ms-3" onclick="showSave()">Agregar Ejemplar </button>
   <br><br>
    <?php  if($_SESSION["perfil"] == 1){ echo '<a href="../usuario/indexAdmin">Volver atrás </a>';}?>
       <?php  if($_SESSION["perfil"] == 2){ echo '<a href="../usuario/indexOp">Volver atrás </a>';}?>
       <?php  if($_SESSION["perfil"] == 5){ echo '<a href="../usuario/indexSo">Volver atrás </a>';}?>
   
    <?php  //if($_SESSION["perfil"] == 1){ echo '<a href="usuario/admin">Volver atrás </a>';}?>
    
    </div>
    </center>
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
                    <center><a href="showHistorico">  Historial de bajas</a> </center>
                    <br>

<div id="liveAlertPlaceholder" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastElim" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">BiblioUni</strong>
       <small>11 mins ago</small>
       <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
   </div>
   <div class="toast-body">
    ¿Está seguro de que desea dar de baja al ejemplar?
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

       <strong class="me-auto">BiblioUni</strong>
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
      <input oninput="validar(this)" pattern="^\d{4}$" required type="text" maxlength="4" minlength="4" class="form-control form-control-sm" id="datoCodigo" name="datoCodigo" placeholder="">
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Libro</label>
     <div class="col-sm-4">
        <select oninput="validar(this)"   disable class="form-control" id="datoLibro" name="datoLibro"  >
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
      <input oninput="validar(this)"   required type="text" maxlength="45" minlength="1" class="form-control form-control-sm" id="datoObservacion" name="datoObservacion" placeholder="">
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
                 </div>
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
</body>
</html>