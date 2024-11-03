<?php

require_once "conexion.php";

class ModeloPlanTratamiento
{

	/*=============================================
	MOSTRAR PLAN TRATAMIENTO
	=============================================*/

	static public function mdlMostrarPlanTratamiento($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	static public function buscarPorId($id)
	{
		$stmt = Conexion::conectar()->prepare(
			"SELECT pt.*, u.nombre as medico, CONCAT(p.nombre, ' ', p.apellidoP, ' ', p.apellidoM) as paciente
		FROM plan_tratamiento pt
		JOIN usuario u ON u.id = pt.id_medico
		JOIN paciente p ON p.id = pt.id_paciente
		WHERE pt.id = :id 
		ORDER BY id ASC"
		);

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		$stmt->execute();
		return $stmt->fetch();

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	REGISTRO DE PLAN TRATAMIENTO
	=============================================*/

	static public function mdlIngresarPlanTratamiento($tabla, $datos)
	{
		$conexion = Conexion::conectar();
		$stmt = $conexion->prepare("INSERT INTO $tabla(fecha, descuento, subtotal, total, estado, id_paciente, id_medico) 
                                            VALUES (NOW(), :descuento, :subtotal, :total, 1, :id_paciente, :id_medico)");
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			// Retornar el ID del plan de tratamiento recién insertado
			return $conexion->lastInsertId();
		} else {
			$error = $stmt->errorInfo();
			return "error";
		}

		$stmt = null;
	}


	static public function listarPlanesPorRazonSocial($idRazonSocial)
	{
		$stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM plan_tratamiento WHERE id_razonsocial = :idRazonSocial");
		$stmt->bindParam(":idRazonSocial", $idRazonSocial, PDO::PARAM_INT);
		$stmt->execute();
		$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		return $resultados;
	}

	static public function listarPorPaciente($idPaciente)
	{
		$stmt = Conexion::conectar()->prepare("SELECT pt.id, pt.id_medico, u.nombre as medico
		FROM plan_tratamiento pt
		JOIN usuario u on u.id = pt.id_medico
		WHERE pt.id_paciente = :idPaciente");
		$stmt->bindParam(":idPaciente", $idPaciente, PDO::PARAM_INT);
		$stmt->execute();
		$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		return $resultados;
	}

	/*=============================================
	 CREAR DETALLE DE PLAN TRATAMIENTO
	=============================================*/

	static public function mdlIngresarDetallePlantratamiento($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_servicio, id_plan_tratamiento, precio, cantidad) 
											   VALUES (:id_servicio, :id_plan_tratamiento, :precio, :cantidad)");
		$stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
		$stmt->bindParam(":id_plan_tratamiento", $datos["id_plan_tratamiento"], PDO::PARAM_INT);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt = null;
	}

	static public function obtenerDetallesPlan($planId)
	{
		$stmt = Conexion::conectar()->prepare("
            SELECT total, 
                   (total - COALESCE(SUM(p.monto), 0)) AS saldo_pendiente
            FROM plan_tratamiento AS pt
            LEFT JOIN pago AS p ON p.id_plan_tratamiento = pt.id
            WHERE pt.id = :planId
        ");

		$stmt->bindParam(":planId", $planId, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetch();
		$stmt = null;

		return $result;
	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_paciente = :id_paciente, id_medico = :id_medico, descuento = :descuento, subtotal = :subtotal,  total= :total WHERE codigo = :codigo");

		$stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	ELIMINAR PLAN TRATAMIENTO
	=============================================*/

	static public function mdlEliminarPlantratamiento($id)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM plan_tratamiento WHERE id = :id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			$error = $stmt->errorInfo();
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEliminarDetallePlantratamiento($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_servicio = :id_servicio");

		$stmt->bindParam(":id_servicio", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
    ACTUALIZAR Cantidad de Producto
    =============================================*/
	static public function mdlActualizarCantidadServicio($tabla, $idProducto, $cantidadComprada)
	{

		$conexion = Conexion::conectar();
		$stmt = $conexion->prepare("UPDATE $tabla SET stock = stock + :cantidad WHERE id = :id");

		$stmt->bindParam(":cantidad", $cantidadComprada, PDO::PARAM_INT);
		$stmt->bindParam(":id", $idProducto, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt = null;
	}



	/*=============================================
	RANGO FECHAS
	=============================================*/

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal)
	{

		if ($fechaInicial == null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt->execute();

			return $stmt->fetchAll();
		} else if ($fechaInicial == $fechaFinal) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' ORDER BY id DESC");

			//$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY id DESC");
			} else {


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");
			}

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}

	/*=============================================
	SUMAR EL TOTAL DE LOS PLAN TRATAMIENTO
	=============================================*/

	static public function mdlSumaSubTotalPlanTratamiento($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT SUM(subtotal) as total FROM $tabla");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	SUMAR EL TOTAL DE LOS PLAN TRATAMIENTO
	=============================================*/

	static public function mdlSumaTotalPlanTratamiento($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}
}
