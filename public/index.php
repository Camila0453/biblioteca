


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
    //Guardamos una copia del controller


   /* if(isset($_SESSION["clave_secreta"]) && ($_SESSION["clave_secreta"] === "lab2023")){
        //Preguntar por el horario
       
        //falta hora de salida y validar el rango horario
    }
    else{
        if(($controller !== "usuario" || $action != "autentication") && ($action!="reseteoClave" && $action!="resetear" ) ){
          
                $controller = 'usuario'; 
                $action = 'login';
                $data = 0;
            
        }
            
        }*/















   
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