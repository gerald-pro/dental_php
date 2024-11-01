<?php

require_once "conexion.php";

class ModeloPacientes{


	/*=============================================
	MOSTRAR CATEGORIA
	=============================================*/

	static public function mdlMostrarPacientes($tabla, $item, $valor){
		if ($item != null) {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			$resultados = $stmt->fetch();
			$stmt = null; 
			return $resultados;
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			$resultados = $stmt->fetchAll();
			$stmt = null; 
			return $resultados;
		}
	}

	
	/*=============================================
	MOSTRAR PACIENTE POR FECHA
	=============================================*/
	public static function mdlMostrarPacientesPorFecha($tabla, $item, $rangoFechas) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item BETWEEN :fechaInicio AND :fechaFin ORDER BY fechaNacimiento ASC");

        $stmt->bindParam(":fechaInicio", $rangoFechas[0], PDO::PARAM_STR);
        $stmt->bindParam(":fechaFin", $rangoFechas[1], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(); // Devolverá todos los pacientes encontrados
    }

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarPacientes($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,apellidoP,apellidoM,documento,sexo,telefono,email,fechaNacimiento,direccion) VALUES (:nombre, :apellidoP, :apellidoM,:documento, :sexo, :telefono, :email, :fechaNacimiento,  :direccion)");
	
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoP", $datos["apellidoP"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoM", $datos["apellidoM"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);

		if($stmt->execute()){
			
			return "ok";

		}else{

			
			return "error";
		
		}

		
		$stmt = null;

	}
	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarPacientes($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellidoP = :apellidoP, 
		apellidoM = :apellidoM, documento = :documento, sexo = :sexo, telefono = :telefono, email = :email,
		fechaNacimiento = :fechaNacimiento, direccion = :direccion WHERE id = :id");
       
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoP", $datos["apellidoP"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoM", $datos["apellidoM"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarPacientes($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
}