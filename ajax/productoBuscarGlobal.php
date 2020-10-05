<?php

include_once (__DIR__."/../controllers/controller.php");
include_once (__DIR__."/../models/crud.php");

class productoBuscarGlobal{

    public function buscarProductosGlobal(){
        $respuesta = Controller::buscarGlobalProductos();
		
		echo ($respuesta);
    }   
}
$p = new productoBuscarGlobal();
$p -> buscarProductosGlobal();