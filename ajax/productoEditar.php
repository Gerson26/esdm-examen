<?php

include_once (__DIR__."/../controllers/controller.php");
include_once (__DIR__."/../models/crud.php");

class productoEditar{
    
    public function editarProducto(){
        $respuesta = Controller::actualizarProducto();
		
		echo ($respuesta);
    }  
}

$p = new productoEditar();
$p->editarProducto();