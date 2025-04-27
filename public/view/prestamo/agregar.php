<!DOCTYPE html>
<html lang="en">
<head>
<?php
      require_once("../public/view/includes/head.php");
      
   ?>
  <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/prestamo/js/prestamo.js"></script> 
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
    <center> 

     <h1>Alta de Prestámos</h1>
      <form id="formAlta" class="form-label"  method="POST" action="" enctype="multipart/form-data">
  <div class="form-group row">
       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">DNI Socio</label>
      <div class="col-sm-4">
      <input required  oninput="buscarSocio()"type="text" maxlength="45" minlength="8" class="form-control form-control-sm" id="datoSocio" name="datoSocio" placeholder="">
      <small id="errSocio" class="form-text text-danger" style="display:none; font-size: 0.90rem;"></small>
      </div>



      
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Ejemplar 1</label>
      <div class="col-sm-4">




     <input placeholder="Buscar por ISBN o Título" oninput="buscarLibro('datoEjems','resultadoBusqueda','')" class="form-control form-control-sm"  maxlength="255" type="text" name="datoEjems" id="datoEjems">
      <small id="datoEjems" class="form-text text-danger" style="display:none; font-size: 0.90rem;"></small>
      <div id="resultadoBusqueda" style="display:none;">
   <ul id="listaLibros" style="background-color:white"></ul>
   </div>
   <br>



<small id="datoEjems" class="form-text text-danger" style="display:none; font-size: 0.90rem;"></small>
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Ejemplar 2</label>
      <div class="col-sm-4">
      
     <input placeholder="Buscar por ISBN o Título" oninput="buscarLibro('datoEjems1','resultadoBusqueda1',1)" class="form-control form-control-sm"  maxlength="255" type="text" name="datoEjems1" id="datoEjems1">
      <small id="datoEjems" class="form-text text-danger" style="display:none; font-size: 0.90rem;"></small>
      <div id="resultadoBusqueda1" style="display:none;">
   <ul id="listaLibros1"></ul>
   </div>
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Ejemplar 3</label>
      <div class="col-sm-4">
    
      <input placeholder="Buscar por ISBN o Título" oninput="buscarLibro('datoEjems2','resultadoBusqueda2',2)" class="form-control form-control-sm"  maxlength="255" type="text" name="datoEjems2" id="datoEjems2">
      <small id="datoEjems" class="form-text text-danger" style="display:none; font-size: 0.90rem;"></small>
      <div id="resultadoBusqueda2" style="display:none;">
   <ul id="listaLibros2"></ul>
   </div>
      </div>
      <br>
  </div>
  <br>
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
    <br>
    <div class="form-group row">
  <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Fecha Inicio</label>
      <div class="col-sm-4">
         <input required class="form-control col-sm-10" id="datoFechaInicio"  name="datoFechaInicio" type="date">
        
      </div>
      
    </div>
    <br>
   
  </form>
     
      <div class="">
      <button id="btnGuardar"  name="btnGuardar" onclick="sendNewPres()" type="button" class="btn btn-success my-4"  >Registrar </button>
      <button id="limp" type="button" class="btn btn-success my-4" onclick="" >Limpiar</button>
      </div>
   
   
  
  <div id="liveAlertPlaceholder1" class="toast-container position-fixed bottom-0 end-0 p-3">
 
</div><br><br><br><br><br>
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