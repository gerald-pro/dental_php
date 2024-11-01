<?php

class ControladorServicios
{
	/*=============================================
	MOSTRAR SERVICIOS
	=============================================*/

	static public function ctrMostrarServicios($item, $valor)
	{

		$tabla = "servicio";

		$respuesta = ModeloServicios::mdlMostrarServicios($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
    MOSTRAR SERVICIOS
    =============================================*/
    static public function ctrMostrarServiciosdetalles($item, $valor) {
		$tabla = "servicio";
		$respuesta = ModeloServicios::mdlMostrarServiciosdetalles($tabla, $item, $valor);
		return $respuesta;
}

	/*=============================================
	CREAR SERVICIOS
	=============================================*/

	static public function ctrCrearServicio()
	{

		if(isset($_POST["nuevoNombreServicio"])) {
				
			$nombre = $_POST["nuevoNombreServicio"];
			$precio = $_POST["nuevoPrecio"];
		
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombre)) {

			$tabla = "servicio";
			$datos = array(
				"nombre" => $nombre,
				"precio" => $precio
			);


				$respuesta = ModeloServicios::mdlIngresarServicio($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

						swal({
							type: "success",
							title: "El servicio ha sido guardado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {

										window.location = "servicios";

										}
									})

						</script>';
				}
			} else {

				echo '<script>

					swal({
						type: "error",
						title: "¡El servicio no puede ir con los campos vacíos",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "servicios";

							}
						})

				</script>';
			}
		}
	}


	/*=============================================
	EDITAR SERVICIOS
	=============================================*/

	static public function ctrEditarServicio()
	{

		if(isset($_POST["editarNombreServicio"])) {
			$id = $_POST["IdServicio"];
			$nombre = $_POST["editarNombreServicio"];
			$precio = $_POST["editarPrecio"];
		
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombre)) {

			$tabla = "servicio";
			$datos = array(
				"id" => $id,
				"nombre" => $nombre,
				"precio" => $precio
				
			);

				$respuesta = ModeloServicios::mdlEditarServicio($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						type: "success",
						title: "El servicio ha sido cambiado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
									if (result.value) {

									window.location = "servicios";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					swal({
						type: "error",
						title: "¡El servicio no puede ir vacío",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "servicios";

							}
						})

				</script>';
			}
		}
	}

	static public function ctrMostrarDetalleServicios($item, $valor){

		$respuesta = ModeloServicios::mdlMostrarDetalleServicios($item, $valor);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR SERVICIO
	=============================================*/

	static public function ctrBorrarServicio(){

		if(isset($_GET["idServicio"])){

			$tabla ="servicio";
			$datos = $_GET["idServicio"];

			$respuesta = ModeloServicios::mdlBorrarServicio($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					type: "success",
					title: "El servicio ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "servicios";

								}
							})

				</script>';

			}

		}

	}
}