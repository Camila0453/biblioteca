<?php
    require_once "../model/dao/Conexion.php";
    use model\dao\Conexion as Conexion;

    try{
        $conexion = Conexion::establecer();
        print_r($conexion);
    }catch(Exception $ex){
 echo"error en la conexion",$ex;
    }
    

   

