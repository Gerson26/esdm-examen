<?php

class Controller{

    public function pagina(){        
        
        if(Conexion::conectar()){
            include "views/plantilla.php";
        }               
        
    }

    #Listar Productos
    static public function listarProductos(){
		
		$respuesta = Datos::listaProductosModel("inventario");
        $json = array();

		foreach($respuesta as $row){
            $json[] = array(
                'nombre' => $row['nombre'],
                'descripcion' => $row['descripcion'],
                'cantidad' => $row['cantidad'],
                'id' => $row['id']
            );	
        }
        
        $jsonString = json_encode($json);
        echo $jsonString;
    }
    
    #Buscador de productos
    static public function buscarProductos(){		
        $search = $_POST['search'];
        $respuesta = Datos::buscarProductosModel("inventario",$search);
        $json = array();

        foreach($respuesta as $row){
            $json[] = array(
                'nombre' => $row['nombre'],
                'descripcion' => $row['descripcion'],
                'cantidad' => $row['cantidad'],
                'id' => $row['id']
            );	
        }
		$jsonString = json_encode($json);
        echo $jsonString;
    }

    #Buscador global de productos
    static public function buscarGlobalProductos(){		
        $search = $_POST['search'];
        $respuesta = Datos::buscarGlobalProductosModel("inventario",$search);
        $json = array();

        foreach($respuesta as $row){
            $json[] = array(
                'nombre' => $row['nombre'],
                'descripcion' => $row['descripcion'],
                'cantidad' => $row['cantidad'],
                'id' => $row['id']
            );	
        }
        $jsonString = json_encode($json);
        echo $jsonString;
    }
    
    #Guardar producto
    static public function registroProducto(){

		if(isset($_POST['nombre']) && $_POST['descripcion'] && $_POST['cantidad']) {	

            $table = "inventario";			

            $datos = array("nombre" => $_POST['nombre'],
                            "descripcion" => $_POST['descripcion'],
                            "cantidad" => $_POST['cantidad']);

            $respuesta = Datos::registrarProductoModel($table, $datos);

            return $respuesta;
        }
    }
    
    #Borrar producto
    static public function eliminarProducto(){

		if(isset($_POST['id'])){

			$table = "inventario";
			$id = $_POST['id'];
			$respuesta = Datos::eliminarProductoModel($table, $id);

			if($respuesta){				
                echo "Producto Borrado";
			}
		}

    }

    #Actualizar producto
    static public function actualizarProducto(){

		if(isset($_POST['id'])){

            $table = "inventario";        
            $datos = array( "id" => $_POST['id'],
                            "nombre" => $_POST['nombre'],
                            "descripcion" => $_POST['descripcion'],
                            "cantidad" => $_POST['cantidad']
                        );

			$respuesta = Datos::actualizarProductoModel($table, $datos);

			return $respuesta;
		}
	}
    
    #Buscar producto por id
    static public function buscarProductoId(){
		if(isset($_POST['id'])){

			$table = "inventario";
			$id = $_POST['id'];
			$respuesta = Datos::buscarProductoIdModel($table, $id);
			$json = array();

            if($respuesta){

                $json[] = array(
                    'id' => $respuesta[0],
                    'nombre' => $respuesta[1],
                    'descripcion' => $respuesta[2],
                    'cantidad' => $respuesta[3]
                );
            }
            $jsonString = json_encode($json);
            echo $jsonString;
        }
	}
    
}