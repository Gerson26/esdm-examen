<?php

include_once (__DIR__."/../controllers/controller.php");
include_once (__DIR__."/../models/crud.php");

class productoAgregar{
    
    public function agregarProducto(){
        $respuesta = Controller::registroProducto();
		
		echo ($respuesta);
    }  
}

$p = new productoAgregar();
$p->agregarProducto();