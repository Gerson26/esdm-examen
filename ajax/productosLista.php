<?php

include_once (__DIR__."/../controllers/controller.php");
include_once (__DIR__."/../models/crud.php");

class productosLista{

    public function listarProductos(){
        $respuesta = Controller::listarProductos();
		
		echo ($respuesta);
    }   
}
$p = new productosLista();
$p -> listarProductos();




	

