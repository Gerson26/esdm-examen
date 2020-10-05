<?php

include_once (__DIR__."/../controllers/controller.php");
include_once (__DIR__."/../models/crud.php");

class productosBuscar{

    public function buscarProductos(){
        $respuesta = Controller::buscarProductos();
		
		echo ($respuesta);
    }   
}
$p = new productosBuscar();
$p -> buscarProductos();