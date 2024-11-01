<?php

require_once "conexion.php";

class ModeloPagos{

	/*=============================================
	MOSTRAR PAGOS
	=============================================*/

	static public function mdlMostrarPagos($tabla, $item, $valor){

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
	SUMAR EL TOTAL DE PAGO DE SERVICIO
	=============================================*/

	static public function mdlSumaTotalPagos($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(monto) as monto FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	OBTENER LA MAX VENTAS
	=============================================*/

	static public function mdlMostrarMaxPagos($tabla){


			$stmt = Conexion::conectar()->prepare("SELECT Max(id) FROM pago");

			$stmt -> execute();

			return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

static public function mdlEntreFechasPagos($tabla, $fechaInicial, $fechaFinal){


	$stmt = Conexion::conectar()->prepare("SELECT PS.id, PS.numeroPago, CONCAT(P.nombres,' ', P.apellidos) AS cliente,U.nombre as cajera, M.nombre as trabajador, PS.fecha, PS.total FROM pagoservicio PS INNER JOIN cliente P ON PS.idcliente = P.idcliente INNER JOIN usuarios U ON PS.idcajera= U.id INNER JOIN usuarios M ON PS.idtrabajador = M.id where PS.fecha  BETWEEN '$fechaInicial' and '$fechaFinal' ORDER BY PS.fecha ASC");


	$stmt -> execute();

	return $stmt -> fetchAll();	
	$stmt -> close();

	$stmt = null;

}

static public function mdlRangoFechasPagos($tabla, $fechaInicial, $fechaFinal){

	if($fechaInicial == null){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY num_pago ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();	


	}else if($fechaInicial == $fechaFinal){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_pago like '%$fechaFinal%'");

		$stmt -> bindParam(":fecha_pago", $fechaFinal, PDO::PARAM_STR);

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

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_pago BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

		}else{


			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_pago BETWEEN '$fechaInicial' AND '$fechaFinal'");

		}
	
		$stmt -> execute();

		return $stmt -> fetchAll();

	}

}

	/*=============================================
	REGISTRO DE PAGO
	=============================================*/

	static public function mdlIngresarPagos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_plan_tratamiento, id_razonsocial, id_secretaria, monto, fecha) VALUES (:id_plan_tratamiento, :id_razonsocial, :id_secretaria, :monto, :fecha)");
;
		$stmt->bindParam(":id_plan_tratamiento", $datos["id_plan_tratamiento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_razonsocial", $datos["id_razonsocial"], PDO::PARAM_INT);
		$stmt->bindParam(":id_secretaria", $datos["id_secretaria"], PDO::PARAM_INT);
		$stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR PAGO
	=============================================*/

	static public function mdlEliminarPago($tabla, $datos){

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