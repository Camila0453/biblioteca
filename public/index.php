

<?php

    // Controlador principal de la aplicación
    /**
     * Capturar, si existen, los parametros [controlador | accion | data]
     */
   $controller = ''; 
    $action = '';
    $data = 0;
    
    if(isset($_GET["controlador"])){
        $controller = $_GET["controlador"];

    }
    if(isset($_GET["accion"])){
        $action = $_GET["accion"];
    }
    if(isset($_GET["data"])){
        $data = $_GET["data"];
    }

    session_start();

   $sociosAcc=['misPrestamos','misReservas','logout','showPerfilSo','indexSocio','pres','res','ejemplaresPrestamoSocio','showEjemplaresPres','showEjemplaresRes','ejemplaresPres','ejemplaresReservaSocio'];
   $opNoPuede=['delete','save','load','update','index','indexAdmin','indexSocio','pres','res','ejemplaresPrestamoSocio','showEjemplaresPres','showEjemplaresRes','ejemplaresPres','ejemplaresReservaSocio'];
    //Guardamos una copia del controller

    if(isset($_SESSION["clave_secreta"]) && ($_SESSION["clave_secreta"] === "lab2023")){
        $perfil= $_SESSION['perfil'];
    
       if($perfil== 5 && !in_array($action,$sociosAcc)){
        $controller = 'usuario'; 
                $action = 'prohibido';
                $data = 0;
       }
       
       if($perfil== 2 && $controller== 'usuario' && in_array($action,$opNoPuede)){
        $controller = 'usuario'; 
                $action = 'prohibido';
                $data = 0;
       }

       if($perfil==1 && in_array($action,$sociosAcc) && $action !='logout' & $action != 'showPerfil'){
        $controller = 'usuario'; 
                $action = 'prohibido';
                $data = 0;
       }



     


    }
    
   
    
  
    else{
        if(($controller !== "usuario" || $action != "autentication") && ($action!="reseteoClave" && $action!="resetear" ) ){
    
                $controller = 'usuario'; 
                $action = 'login';
                $data = 0;
            
        }
        
            
   
            
        }
    
if(empty($controller) || empty($action)){
    $controller = 'usuario'; 
    $action = 'login';
    $data = 0;
}


   
    $inputController = $controller;
    //Invocar el controlador y accion correspondiente.
    require_once '../controller/'.ucfirst($controller).'Controller.php';
    //Convertir $controller a objeto. String => Object()
    $controller = "\\controller\\".ucfirst($controller).'Controller';
    $controller = new $controller;
    //llamar al metodo que corresponda
    call_user_func_array(
        array($controller, $action), //cliente->delete()
        array($inputController, $action, $data)       //cliente->delete(action, data)
    );
    
  
    //Para el LUNES 08/05 agregar:
    //Peticion asíncrona para el alta de cliente.
    //Replicar las validaciones del lado cliente, en el lado servidor (DAO)