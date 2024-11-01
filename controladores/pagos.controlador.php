<?php

class ControladorPagos{

	/*=============================================
	MOSTRAR PAGOS
	=============================================*/

	static public function ctrMostrarPagos($item, $valor){

		$tabla = "razonsocial";

		$respuesta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasPagos($fechaInicial, $fechaFinal){

		$tabla = "pago";

		$respuesta = ModeloPagos::mdlRangoFechasPagos($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

  static public function ctrEntreFechasPagos($fechaInicial, $fechaFinal){

		$tabla = "pago";

		$respuesta = ModeloPagos::mdlEntreFechasPagos($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	SUMA TOTAL PAGOS SERVICIO
	=============================================*/

	static public function ctrSumaTotalPagos(){

		$tabla = "pago";

		$respuesta = ModeloPagos::mdlSumaTotalPagos($tabla);

		return $respuesta;

	}

	/*============================================
	CREAR PAGO
	=============================================*/

	static public function ctrCrearPago(){

		if(isset($_POST["nuevaVenta"])){

			$tablaTrabajadores = "usuario";

			$item = "id";
			$valor = $_POST["seleccionarTrabajador"];

			$traerCliente = ModeloUsuarios::mdlMostrarUsuarios($tablaTrabajadores, $item, $valor);

			$tablacliente = "paciente";

			$item = "id";
			$valor = $_POST["seleccionarCliente"];

			$traeridcliente = ModeloPacientes::mdlMostrarPacientes($tablacliente, $item, $valor);

		

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/

			$tabla = "pago";

			$datos = array("id_secretaria"=>$_POST["idCajera"],
						"numeroPago"=>$_POST["nuevaVenta"],
						"idcliente"=>$_POST["seleccionarCliente"],
						"id_plan_tratamiento"=>$_POST["listaTratamiento"],
						"monto"=>$_POST["totalPago"],
						"metodo_pago"=>($_POST["nuevoMetodoPago"] == "Efectivo")? $_POST["nuevoMetodoPago"]: $_POST["listaMetodoPago"]);

			$respuesta = ModeloPagos::mdlIngresarPagos($tabla, $datos);

			if($respuesta == "ok" ){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "El pago ha sido guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "pago";

								}
							})

				</script>';
			}
		}
	}

		/*=============================================
		ELIMINAR PAGO
		=============================================*/

	static public function ctrEliminarPago(){

		if(isset($_GET["idPago"])){

			$tabla = "pago";

			$item = "idpagoservicio";
			$valor = $_GET["idPago"];

			$traerVenta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor);

			/*=============================================
			ELIMINAR PAGO
			=============================================*/

            //eliminar el detalle de la venta eliminada

            $tablaDetalle = "detallepagoservicio"; 
            $respuesta = ModeloPagos::mdlEliminarDetallePago($tablaDetalle, $_GET["idPago"]);    
 
			$respuesta = ModeloPagos::mdlEliminarPago($tabla, $_GET["idPago"]);

			if($respuesta == "ok"){



				echo'<script>

				swal({
					  type: "success",
					  title: "El pago ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "pagos";

								}
							})

				</script>';

			}		
		}

	}
}