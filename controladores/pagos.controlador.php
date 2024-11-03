<?php

require_once 'Mensajes.php';

class ControladorPagos
{

	/*=============================================
	MOSTRAR PAGOS
	=============================================*/

	static public function ctrMostrarPagos()
	{
		$respuesta = ModeloPagos::mdlMostrarPagos();
		return $respuesta;
	}

	public static function ctrMostrarPagoPorId($idPago) {
		return ModeloPagos::buscarPorId($idPago);
	}

	static public function ctrObtenerPlanesPorRazonSocial($idRazonSocial)
	{
		return ModeloPlanTratamiento::listarPlanesPorRazonSocial($idRazonSocial);
	}

	static public function ctrObtenerPlanesPorPaciente($idPaciente)
	{
		return ModeloPlanTratamiento::listarPorPaciente($idPaciente);
	}

	static public function obtenerDetallesPlan($planId)
	{
		return ModeloPlanTratamiento::obtenerDetallesPlan($planId);
	}

	/*=============================================
	RANGO FECHAS
	=============================================*/

	static public function ctrRangoFechasPagos($fechaInicial, $fechaFinal)
	{

		$tabla = "pago";

		$respuesta = ModeloPagos::mdlRangoFechasPagos($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
	}

	static public function ctrEntreFechasPagos($fechaInicial, $fechaFinal)
	{

		$tabla = "pago";

		$respuesta = ModeloPagos::mdlEntreFechasPagos($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
	}

	/*=============================================
	SUMA TOTAL PAGOS SERVICIO
	=============================================*/

	static public function ctrSumaTotalPagos()
	{
		$tabla = "pago";
		$respuesta = ModeloPagos::mdlSumaTotalPagos($tabla);
		return $respuesta;
	}

	/*============================================
	CREAR PAGO
	=============================================*/

	static public function crear()
	{
		if (isset($_POST["id_paciente"])) {
			if (isset($_POST["id_paciente"]) && isset($_POST["id_plan_tratamiento"]) && isset($_POST["id_secretaria"]) && isset($_POST["monto"])) {

				// Preparar datos para el modelo, usando id_razonsocial solo si está definido
				$datos = array(
					"id_paciente" => $_POST["id_paciente"],
					"id_plan_tratamiento" => $_POST["id_plan_tratamiento"],
					"id_razonsocial" => !empty($_POST["id_razonsocial"]) ? $_POST["id_razonsocial"] : null,
					"id_secretaria" => $_POST["id_secretaria"],
					"monto" => $_POST["monto"],
					"fecha" => date("Y-m-d H:i:s")
				);

				// Llamar al modelo para insertar el pago
				$respuesta = ModeloPagos::mdlIngresarPagos($datos);

				// Validar la respuesta y mostrar un mensaje de confirmación
				if ($respuesta == "ok") {
					$mensaje =  Mensaje::obtenerMensaje(
						"success",
						"El pago ha sido registrado correctamente",
						null,
						"pagos"
					);
				} else {
					$mensaje = Mensaje::obtenerMensaje(
						"error",
						"Error al guardar el pago",
						$respuesta,
						"pagos"
					);
				}

				echo $mensaje;
			} else {
				$mensaje = Mensaje::obtenerMensaje(
					"error",
					"Entrada incorrecta",
					"Complete todos los campos obligatorios",
					"pagos"
				);

				echo $mensaje;
			}
		}
	}

	/*=============================================
		ELIMINAR PAGO
		=============================================*/

	static public function ctrEliminarPago($idPago)
	{
		$respuesta = ModeloPagos::mdlEliminarPago($idPago);
		return $respuesta;
	}
}
