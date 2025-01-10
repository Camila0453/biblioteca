
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

    if(isset($_SESSION["clave_secreta"]) && ($_SESSION["clave_secreta"] === "lab2023")){
        //Preguntar por el horario
       
      $fechaActual = new DateTime("NOW", new DateTimeZone("America/Argentina/ComodRivadavia"));
       $horaSalida = new DateTime($fechaActual->format("d-m-Y")." ".$_SESSION["horaSalida"], new DateTimeZone("America/Argentina/ComodRivadavia"));
       $horaEntrada = new DateTime($fechaActual->format("d-m-Y")." ".$_SESSION["horaEntrada"], new DateTimeZone("America/Argentina/ComodRivadavia"));
        //falta hora de salida y validar el rango horario
   if(($fechaActual > $horaSalida) || ($fechaActual < $horaEntrada)){
        
            $controller = 'usuario'; 
            $action = 'fueraHorario';
        }
       /* if( $_SESSION["perfil"]!=1 && ($controller=="perfil" || ( ($controller=="usuario" && $action!="logout")) )){
            $controller = 'usuario'; 
            $action = 'fordiben';
            $data = 0;
        }*/
    }
    
   
    
  
    else{
        if(($controller !== "usuario" || $action != "autentication") && ($action!="reseteoClave" && $action!="resetear" ) ){
          
                $controller = 'usuario'; 
                $action = 'login';
                $data = 0;
            
        }
        
            
   
            
        }
    
    


    // #############################
    //require_once("../controller/ClienteController.php");
    //use controller\ClienteController;


    //$controlador = new ClienteController();
    //$controlador->index();
    //#############################

    //Guardamos una copia del controller
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
    //echo"Controller es " .$controller;
    //echo" action es " .$actio 