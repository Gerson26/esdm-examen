<?php 

	class Conexion{
		
		static public function conectar(){	
			
			try{
				$link = new PDO("mysql:host=localhost;dbname=examen_esdm","root","");						
				return $link;

			}catch(PDOException $e){
				echo 'Error al conectarse con la base de datos: ' . $e->getMessage();
    			exit;
			}			
		}
	}
	
?>
