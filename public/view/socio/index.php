<!DOCTYPE html>
<html lang="es">
<head>
<?php
      require_once("../public/view/includes/head.php");
    
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/socio/js/socio1.js"></script> 
   <link href="../view/css/general.css" rel="stylesheet" />
      <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<header>
<?php
       require_once "../public/view/includes/header.php";
       require_once "../model/dao/Conexion.php";
       use model\dao\Conexion;
       $conexion = Conexion::establecer();
   ?>
    </header>
<body>
     <center> <h1>Gestión de Socios</h1> 
     <button type="button" class="btn btn-primary ms-3" onclick="showSave()">Agregar Socio</button>
     <br> <br>
     <?php  if($_SESSION["perfil"] == 1){ echo '<a href="../usuario/indexAdmin">Volver atrás </a>';}?>
       <?php  if($_SESSION["perfil"] == 2){ echo '<a href="../usuario/indexOp">Volver atrás </a>';}?>
       <?php  if($_SESSION["perfil"] == 5){ echo '<a href="../usuario/indexSo">Volver atrás </a>';}?>
     <br>
    <div class="row" class="col-md-4" style="margin-bottom: 20px;margin-bottom: 20px;">
        <br>
    </div>
    <div  id="buscador" class="col-md-4"style="margin-bottom: 20px;margin-bottom: 20px;">
    <form  id="formBus" class="d-flex mt-3" role="search" >
          <input oninput="buscarSocio()"class="form-control me-2" type="search" id="datoBus" placeholder="Buscar por DNI o Nombre/Apellido" aria-label="Search">
        
        </form>
        <small id="errSocio" class="form-text text-danger" style="display:none; font-size: 0.90rem;">kh</small>
    </div>
    

  
    <div >

    <table id= "tablaClientes" style="width: 60%; margin-left: auto; margin-right: auto;"  class="table text-dark">
                        <thead>
                        <tr>
                            <th> #</th>                
                           <th>Nombres </th> 
                           <th>Apellido </th> 
                           <th>DNI</th> 
                           <th>Domicilio</th> 
                           <th>Localidad</th> 
                           <th>Provincia</th> 
                           <th>Telefono</th> 
                           <th>Correo(Usuario)</th> 
                           <th>Fecha Alta</th> 
                           <th>Estado</th> 
                           <th>Tipo Socio</th> 
                           <th>Materia/Carrera</th> 
                           <th >Frente Dni</th> 
                           <th >Dorso Dni</th> 
                           <th >Opción</th>  
                        </tr>
                    </thead>
                     <tbody id="tablaProductos">
                     
                       
                   </tbody>
                    </table>
                    </div>
                    <br>
                    <center><a href="../socio/showHistoricoSocios">  Histórico de Socios</a> </center>
                    <br>
                    <br>
<br>
<br>
<br>
<div id="liveAlertPlaceholder" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>


<div id="liveAlertPlaceholderR" class="toast-container position-fixed bottom-0 end-0 p-3">
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
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modificar Socio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
     
      <form id="formAct" class="form-label"  method="POST" action="" enctype="multipart/form-data">


      <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Nombre</label>
      <div class="col-sm-4">
          <input oninput="validar(this)" required type="text" pattern="[a-zA-ZÀ-ÿ\s]{5,45}" class="form-control form-control-sm" id="datoNombre" name="datoNombre" placeholder="Juan">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Apellido</label>
      <div class="col-sm-4">
           <input  oninput="validar(this)" required type="text" pattern="[a-zA-ZÀ-ÿ\s]{5,45}" class="form-control form-control-sm" id="datoApellido" name="datoApellido" placeholder="Perez">
      </div>
  </div>
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">DNI (Sin puntos) </label>
      <div class="col-sm-4">
          <input   oninput="validar(this)" required type="text" minlength="8" max="8"class="form-control form-control-sm" id="datoDni" name="datoDni" placeholder="42711312">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Correo</label>
      <div class="col-sm-4">
           <input  oninput="validar(this)" required type="email" minlength="10" max="255" class="form-control form-control-sm" id="datoCorreo" name="datoCorreo" placeholder="aballaycamila4@gmail.com">
      </div>
  </div>

  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Telefono</label>
      <div class="col-sm-4">
          <input oninput="validar(this)"  maxlength="13" minlength="13" pattern="\d{13,45}"  required type="text" class="form-control form-control-sm" id="datoTelefono" name="datoTelefono" placeholder="5492975165695">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Domicilio</label>
      <div class="col-sm-4">
          <input  oninput="validar(this)" maxlength="45" minlength="5" required type="text" class="form-control form-control-sm" id="datoDomicilio" name="datoDomicilio" placeholder="Koluel kaike 1276">
      </div>
      
  </div>
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Localidad</label>
      <div class="col-sm-4">
          <input  oninput="validar(this)"  maxlength="45" minlength="5"required type="text" class="form-control form-control-sm" id="datoLocalidad" name="datoLocalidad" placeholder="Caleta Olivia">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Provincia</label>
      <div class="col-sm-4">
          <input  oninput="validar(this)" maxlength="45" minlength="5" required type="text" class="form-control form-control-sm" id="datoProvincia" name="datoProvincia" placeholder="Santa Cruz">
      </div>
    
    
 </div>
 <div class="form-group row">
     <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Tipo Socio</label>
     <div class="col-sm-4">
        <select required class="form-control" id="datoTipoSocio" name="datoTipoSocio" onchange="materiaOcarrera()" >
            <option value="">Seleccione el tipo de socio</option>
                <?php
               
                 $sql= "SELECT id,nombre FROM tipossocio";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $tipossocios= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($tipossocios as $tipo): ?>
                   <option value="<?= $tipo['id']?>"><?= $tipo['nombre']?></option>
                 <?php endforeach; ?>
          </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Frente DNI</label>
     <div class="col-sm-4">
        <input  required type="file" class="form-control form-control-sm" id="datoFrenteDni" name="datoFrenteDni" placeholder="col-form-label-sm">
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Dorso DNI</label>
    <div class="col-sm-4">
        <input required type="file" class="form-control form-control-sm" id="datoDorsoDni" name="datoDorsoDni" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Materias/carreras</label>
    <div class="col-sm-4">
    <select multiple required class="form-control" id="datoMateriaCarrera" name="datoMateriaCarrera" >
        <option value="">Seleccione materia o carrera según corrresponda</option>
    </select>
    </div>
  </div>
  <div class="form-group row">
  <labe for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Estado</labe>
      <div class="col-sm-4">
         <select required class="form-control col-sm-10" id="selectEstado" name="selectEstado">
         <option value="">Seleccione el estado</option>
                 <option value="1">Activo </option>
                 <option value="0">Inactivo</option>
         </select>
      </div>
                 </div>









  </form>




      </div>
      <div class="modal-footer">
      <button id="btnAct"  name="btnAct" onclick="modificar()" type="button" class="btn btn-success my-4"  >Registrar </button>
      <button id="limp" type="button" class="btn btn-success my-4" onclick="" >Limpiar</button>
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