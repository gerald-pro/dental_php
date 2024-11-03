<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorPlanTratamiento
{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarPlanTratamiento($item, $valor)
	{
		$tabla = "plan_tratamiento";

		$respuesta = ModeloPlanTratamiento::mdlMostrarPlanTratamiento($tabla, $item, $valor);

		return $respuesta;
	}

	static public function buscarPorId($idPlan)
	{
		$respuesta = ModeloPlanTratamiento::buscarPorId($idPlan);
		return $respuesta;
	}

	static public function ctrMostrarPagosPorPlan($idPlan)
	{
		return ModeloPagos::listarPorPlanTratamiento($idPlan);
	}

	static public function ctrMostrarServiciosPorPlan($idPlan)
	{
		return ModeloServicios::listarServiciosPorPlan($idPlan);
	}

	/*=============================================
	CREAR VENTA 
	=============================================*/

	static public function ctrCrearPlanTratamiento()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (isset($_POST['listaServicios'])) {
				$idMedico = $_POST['idCajera'];
				$idPaciente = $_POST['seleccionarCliente'];
				$servicios = $_POST['listaServicios'];
				$descuento = $_POST['nuevoDescuento'];
				$subtotal = $_POST['nuevosubTotalPlantratamiento'];
				$total = $_POST['totalPlantratamiento'];
				$listaServicios = json_decode($_POST['listaServicios'], true);

				$tabla = "plan_tratamiento";

				$datos = array(
					"id_medico" => $idMedico,
					"id_paciente" => $idPaciente,
					"descuento" => $descuento,
					"subtotal" => $subtotal,
					"total" => $total
				);

				$respuestaDetalle = ModeloPlanTratamiento::mdlIngresarPlanTratamiento($tabla, $datos);

				if ($respuestaDetalle != "error") {
					$idPlanTratamiento = $respuestaDetalle;

					foreach ($listaServicios as $servicio) {
						$tablaDetallesCompra = "detalle_plan_tratamiento";
						$datosProducto = array(
							"id_plan_tratamiento" => $idPlanTratamiento,
							"id_servicio" => $servicio["id"],
							"cantidad" => $servicio["cantidad"],
							"precio" => $servicio["precio"]
						);

						ModeloPlanTratamiento::mdlIngresarDetallePlantratamiento($tablaDetallesCompra, $datosProducto);

						//ModeloPlanTratamiento::mdlActualizarCantidadServicio("servicio", $servicio["id"], $servicio["cantidad"]);
					}

					echo '<script>
					  swal({
						type: "success",
						title: "El Plan Tratamiento ha sido guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
						  if (result.value) {
							window.location = "plantratamiento";
						  }
						})
					</script>';
				} else {
					echo '<script>
					  swal({
						type: "error",
						title: "¡Error al guardar el Plan Tratamiento!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
						  if (result.value) {
							window.location = "plantratamiento";
						  }
						})
					</script>';
				}
			}
		}
	}


	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	public static function ctrEliminarPlanTratamiento($id)
	{
		$respuesta = ModeloPlanTratamiento::mdlEliminarPlanTratamiento($id);

		return $respuesta;
	}
}
