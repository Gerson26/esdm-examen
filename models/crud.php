<?php	
require_once "conexion.php";
    class Datos extends Conexion{

	#Todos los productos
    static public function listaProductosModel($tabla){
        
        $stmt = Conexion::conectar()->prepare("SELECT * from $tabla");
        $stmt->execute();        
        return $stmt->fetchAll();
        $stmt->close();
    }

	#Buscador de productos
    static public function buscarProductosModel($table,$search){	

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE nombre LIKE '$search%'");
        $stmt->execute();
        return $stmt->fetchAll();
		$stmt->close();			

	}

	#Buscador global de productos
	static public function buscarGlobalProductosModel($table,$search){	

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE nombre LIKE '%$search%' OR descripcion LIKE '%$search%' OR cantidad LIKE '%$search%' OR id LIKE '%$search%'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();			

	}
	
	#Guardar Producto
    static public function registrarProductoModel($table, $datos){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $table(nombre, descripcion, cantidad) VALUES (:nombre, :descripcion, :cantidad)");		

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);	

		if($stmt->execute()){
			return "Producto agregado correctamente";
		}else{
			print_r(Conexion::conectar()->errorInfo());
        }
        $stmt->close();
	}
	
    #Eliminar Producto
    static public function eliminarProductoModel($table, $id){
	
		$stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE id = $id");	
		if($stmt->execute()){
			return "Producto Eliminado correctamente";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;	

	}

	#Buscar Producto por id
	static public function buscarProductoIdModel($table, $id){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = $id");
        $stmt->execute();
        return $stmt->fetch();
		$stmt->close();	
		$stmt = null;
	}

	#Actualizar Producto
	static public function actualizarProductoModel($table, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $table SET nombre = :nombre, descripcion=:descripcion, cantidad=:cantidad WHERE id = :id");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);		
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "Actualizado Correctamente";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;	

	}
}