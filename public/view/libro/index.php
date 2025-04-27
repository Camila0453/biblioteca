<!DOCTYPE html>
<html lang="es">
<head>
<?php
      require_once("../public/view/includes/head.php");
      
   ?>
   <link  rel="stylesheet"href="/biblioteca/public/view/socio/css/style.css"> 
   <script defer type="text/javascript" src="../view/libro/js/libro.js"></script> 
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
   
<center> <h1>Gestión de Libros</h1> 
     <button type="button" class="btn btn-primary ms-3" onclick="showSave()">Agregar Libro</button>
     
     <?php  //if($_SESSION["perfil"] == 1){ echo '<a href="usuario/admin">Volver atrás </a>';}?>
     <br>
    <div class="row" class="col-md-4" style="margin-bottom: 20px;margin-bottom: 20px;">
        <br>
    <a href="../">Volver a la página de inicio</a> 
    </div>
    <div  id="buscador" class="col-md-4"style="margin-bottom: 20px;margin-bottom: 20px;">
    <form  id="formBus" class="d-flex mt-3" role="search" >
          <input oninput="buscarLibro()"class="form-control me-2" type="search" id="datoBus" placeholder="Buscar por ISBN, Título o Autor" aria-label="Search">
        
        </form>
        <small id="errSocio" class="form-text text-danger" style="display:none; font-size: 0.90rem;">kh</small>
    </div>

    <div class="">
    <table id= "tablaClientes" style="width: 60%; margin-left: auto; margin-right: auto;" class="table text-dark">
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
                    <center><a href="showHistorico">  Historial de bajas </a> </center>
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
        <h5 class="modal-title">Modificar libro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="formAct" class="form-label"  method="POST" action="" enctype="multipart/form-data">
  <div class="form-group row">
       <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">ISBN</label>
      <div class="col-sm-4">
      <input oninput="validar(this)" pattern="^\d{13}$" required type="text" maxlength="45" minlength="8" class="form-control form-control-sm" id="datoISBN" name="datoISBN" placeholder="">
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Título</label>
      <div class="col-sm-4">
      <input oninput="validar(this)" class="form-control form-control-sm" required maxlength="255"  type="mail" name="datoTitulo" id="datoTitulo">
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">N° Ejemplares</label>
      <div class="col-sm-4">
      <input oninput="validar(this)" class="form-control form-control-sm" required maxlength="1" minlength="255" type="mail" name="datoNEjem" id="datoNEjem">
      </div>
  </div>
  <div class="form-group row">
  <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Edición</label>
      <div class="col-sm-4">
      <input oninput="validar(this)" pattern="^[1-9]\d*$" class="form-control form-control-sm" required maxlength="255" minlength="1" type="text" name="datoEdicion" id="datoEdicion">
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Autor</label>
     <div class="col-sm-4">
        <select required class="form-control" id="datoAutor" name="datoAutor"  >
            <option value="">Seleccione el autor</option>
                <?php
               
                 $sql= "SELECT id,nombre FROM autores";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $autores= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($autores as $autor): ?>
                   <option value="<?= $autor['id']?>"><?= trim( $autor['nombre'])?>   </option>
                 <?php endforeach; ?>
          </select>
    </div> 
  </div>
  <div class="form-group row">
  <labe for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Estado</labe>
      <div class="col-sm-4">
         <select required class="form-control col-sm-10" id="datoEstado" name="datoEstado">
         <option value="">Seleccione el estado</option>
                 <option value="1">Activo </option>
                 <option value="0">Inactivo</option>
         </select>
      </div>
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Editorial</label>
     <div class="col-sm-4">
        <select required class="form-control" id="datoEditorial" name="datoEditorial"  >
            <option value="">Seleccione la editorial</option>
                <?php
               
                 $sql= "SELECT id,nombre FROM editoriales";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $editoriales= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($editoriales as $edi): ?>
                   <option value="<?= $edi['id']?>"><?= trim( $edi['nombre'])?>   </option>
                 <?php endforeach; ?>
          </select>
    </div> 
    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Disciplina</label>
     <div class="col-sm-4">
        <select required class="form-control" id="datoDisciplina" name="datoDisciplina"  >
            <option value="">Seleccione la disciplina</option>
                <?php
               
                 $sql= "SELECT id,nombre FROM disciplinas";
                 $stmt= $conexion->prepare($sql);
                 $stmt->execute();
                 $disciplinas= $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($disciplinas as $dis): ?>
                   <option value="<?= $dis['id']?>"><?= trim( $dis['nombre'])?>   </option>
                 <?php endforeach; ?>
          </select>
    </div> 
   </div>
  </form>
      </div>
      <div class="modal-footer">
      <button id="btnAct"  name="btnAct" onclick="" type="button" class="btn btn-success my-4"  >Registrar </button>
      <button id="limp" type="button" class="btn btn-success my-4" onclick="" >Limpiar</button>
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