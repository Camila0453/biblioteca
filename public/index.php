
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

   
          
                $controller = 'socio'; 
                $action = 'index';
                $data = 0;
            
       
    
    


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