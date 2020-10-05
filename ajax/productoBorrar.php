<?php

include_once (__DIR__."/../controllers/controller.php");
include_once (__DIR__."/../models/crud.php");

class productoBorrar{
    
    public function borrarProducto(){
        $respuesta = Controller::eliminarProducto();
		
		echo ($respuesta);
    }  
}

$p = new productoBorrar();
$p->borrarProducto();