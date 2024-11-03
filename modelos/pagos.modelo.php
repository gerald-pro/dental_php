<?php

require_once "conexion.php";

class ModeloPagos
{
	/*=============================================
    MOSTRAR PAGOS
    =============================================*/
	static public function mdlMostrarPagos()
	{
		$conexion = Conexion::conectar();

		$stmt = $conexion->prepare("SELECT p.*, CONCAT(pc.nombre, ' ', apellidoP,' ', apellidoM) as paciente, rs.nombre as razon_social, u.nombre as secretaria
		FROM pago p
		JOIN paciente pc on pc.id = p.id_paciente
		JOIN usuario u on u.id = p.id_secretaria
		LEFT JOIN razonsocial rs on rs.id = p.id_razonsocial
		ORDER BY id ASC");

		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	static public function buscarPorId($idPago)
	{
		$conexion = Conexion::conectar();

		$stmt = Conexion::conectar()->prepare("SELECT pago.id, pago.monto, pago.fecha, pago.id_plan_tratamiento,
                                                  concat(paciente.nombre, ' ', paciente.apellidoP, ' ', paciente.apellidoM) AS paciente,
                                                  razonsocial.nombre AS razon_social,
                                                  usuario.nombre AS secretaria
                                           FROM pago
                                           JOIN paciente ON pago.id_paciente = paciente.id
                                           LEFT JOIN razonsocial ON pago.id_razonsocial = razonsocial.id
                                           JOIN usuario ON pago.id_secretaria = usuario.id
                                           WHERE pago.id = :id");

		$stmt->bindParam(":id", $idPago, PDO::PARAM_INT);
		$stmt->execute();
		return  $stmt->fetch(PDO::FETCH_ASSOC);
	}

	static public function listarPorPlanTratamiento($idPlan)
	{
		$conexion = Conexion::conectar();

		$stmt = $conexion->prepare("SELECT * FROM pago WHERE id_plan_tratamiento = :id ORDER BY id ASC");
		$stmt->bindParam(":id", $idPlan, PDO::PARAM_STR);

		$stmt->execute();
		return  $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/*=============================================
    SUMAR EL TOTAL DE PAGO
    =============================================*/
	static public function mdlSumaTotalPagos()
	{
		$stmt = Conexion::conectar()->prepare("SELECT SUM(monto) AS total FROM pago");
		$stmt->execute();
		return $stmt->fetch();
	}

	/*=============================================
    OBTENER LA MAX VENTAS
    =============================================*/
	static public function mdlMostrarMaxPagos()
	{
		$stmt = Conexion::conectar()->prepare("SELECT MAX(id) AS max_id FROM pago");
		$stmt->execute();
		return $stmt->fetch();
	}

	/*=============================================
    RANGO FECHAS
    =============================================*/
	static public function mdlEntreFechasPagos($fechaInicial, $fechaFinal)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM pago WHERE fecha BETWEEN :fechaInicial AND :fechaFinal ORDER BY fecha ASC");
		$stmt->bindParam(":fechaInicial", $fechaInicial);
		$stmt->bindParam(":fechaFinal", $fechaFinal);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/*=============================================
    REGISTRO DE PAGO
    =============================================*/
	static public function mdlIngresarPagos($datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO pago(id_plan_tratamiento, id_paciente, id_razonsocial, id_secretaria, monto, fecha) VALUES (:id_plan_tratamiento, :id_paciente, :id_razonsocial, :id_secretaria, :monto, :fecha)");

		$stmt->bindParam(":id_plan_tratamiento", $datos["id_plan_tratamiento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_razonsocial", $datos["id_razonsocial"], PDO::PARAM_INT);
		$stmt->bindParam(":id_secretaria", $datos["id_secretaria"], PDO::PARAM_INT);
		$stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		return $stmt->execute() ? "ok" : "error";
	}

	/*=============================================
    ELIMINAR PAGO
    =============================================*/
	static public function mdlEliminarPago($id)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM pago WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		return $stmt->execute() ? "ok" : "error";
	}
}
