<?php

include_once (__DIR__."/../controllers/controller.php");
include_once (__DIR__."/../models/crud.php");

class productoBuscarId{

    public function buscarProductoById(){
        $respuesta = Controller::buscarProductoId();
		
		echo ($respuesta);
    }   
}
$p = new productoBuscarId();
$p -> buscarProductoById();