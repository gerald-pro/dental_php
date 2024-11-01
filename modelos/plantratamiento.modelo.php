<?php

require_once "conexion.php";

class ModeloPlanTratamiento{

	/*=============================================
	MOSTRAR PLAN TRATAMIENTO
	=============================================*/

	static public function mdlMostrarPlanTratamiento($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE PLAN TRATAMIENTO
	=============================================*/

	static public function mdlIngresarPlanTratamiento($tabla, $datos){

		

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_paciente, id_medico, servicios, descuento, subtotal, total) VALUES (:id_paciente, :id_medico, :servicios, :descuento, :subtotal, :total)");

		$stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
		$stmt->bindParam(":servicios", $datos["servicios"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		
		
		if($stmt->execute()){

			return "ok";///revisar codigo ////

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	 CREAR DETALLE DE PLAN TRATAMIENTO
	=============================================*/

	static public function mdlIngresarDetallePlantratamiento($tabla, $datos){

        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO $tabla(id_servicio, id_plan_tratamiento, precio, cantidad) VALUES (:id_servicio, :id_plan_tratamiento, :precio, :cantidad)");

		$stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
		$stmt->bindParam(":id_plan_tratamiento", $datos["id_plan_tratamiento"], PDO::PARAM_INT);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_paciente = :id_paciente, id_medico = :id_medico, servicios = :servicios, descuento = :descuento, subtotal = :subtotal,  total= :total WHERE codigo = :codigo");

		$stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
		$stmt->bindParam(":servicios", $datos["servicios"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR PLAN TRATAMIENTO
	=============================================*/

	static public function mdlEliminarPlantratamiento($tabla, $datos){

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

	static public function mdlEliminarDetallePlantratamiento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_servicio = :id_servicio");

		$stmt -> bindParam(":id_servicio", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

	}

		$stmt -> close();

		$stmt = null;

	}

	  /*=============================================
    ACTUALIZAR Cantidad de Producto
    =============================================*/
    static public function mdlActualizarCantidadServicio($tabla, $idProducto, $cantidadComprada){

        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE $tabla SET stock = stock + :cantidad WHERE id = :id");

        $stmt->bindParam(":cantidad", $cantidadComprada, PDO::PARAM_INT);
        $stmt->bindParam(":id", $idProducto, PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }



	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' ORDER BY id DESC");

			//$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY id DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	SUMAR EL TOTAL DE LOS PLAN TRATAMIENTO
	=============================================*/

	static public function mdlSumaSubTotalPlanTratamiento($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(subtotal) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	SUMAR EL TOTAL DE LOS PLAN TRATAMIENTO
	=============================================*/

	static public function mdlSumaTotalPlanTratamiento($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	
}


	
