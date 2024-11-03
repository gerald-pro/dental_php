<?php

class ControladorRazonSocial
{
	/*=============================================
	MOSTRAR SERVICIOS
	=============================================*/

	static public function ctrMostrarRazonSocial($item, $valor)
	{

		$tabla = "razonsocial";

		$respuesta = ModeloRazonSocial::mdlMostrarRazonSocial($tabla, $item, $valor);

		return $respuesta;
	}

	static public function listar()
	{
		$respuesta = ModeloRazonSocial::listar();
		return $respuesta;
	}

	/*=============================================
	CREAR SERVICIOS
	=============================================*/

	static public function ctrCrearRazonSocial()
	{

		if(isset($_POST["nuevoNit"])) {
				
			$nit = $_POST["nuevoNit"];
			$razonsocial = $_POST["nuevoNombreSocial"];
		
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nit)) {

			$tabla = "razonsocial";
			$datos = array(
				"nit" => $nit,
				"nombre" => $razonsocial
			);


				$respuesta = ModeloRazonSocial::mdlIngresarRazonSocial($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

						swal({
							type: "success",
							title: "La Razon Social ha sido guardado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {

										window.location = "razonsocial";

										}
									})

						</script>';
				}
			} else {

				echo '<script>

					swal({
						type: "error",
						title: "¡La Razon Social no puede ir con los campos vacíos",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "razonsocial";

							}
						})

				</script>';
			}
		}
	}


	/*=============================================
	EDITAR SERVICIOS
	=============================================*/

	/*static public function ctrEditarRazonSocial()
	{

		if(isset($_POST["editarNit"])) {
			$id = $_POST["IdRazonSocial"];
			$nit = $_POST["editarNit"];
			$nombre = $_POST["editarNombreSocial"];
		
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nit)) {

			$tabla = "razonsocial";
			$datos = array(
				"id" => $id,
				"nit" => $nit,
				"nombre" => $nombre
				
			);

				$respuesta = ModeloRazonSocial::mdlEditarRazonSocial($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						type: "success",
						title: "La razon social ha sido cambiado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
									if (result.value) {

									window.location = "razonsocial";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					swal({
						type: "error",
						title: "¡La razon social no puede ir vacío",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "razonsocial";

							}
						})

				</script>';
			}
		}
	}*/

	static public function ctrEditarRazonSocial()
	{

		if(isset($_POST["editarNit"])) {
			$id = $_POST["IdRazonSocial"];
			$nit = $_POST["editarNit"];
			$nombre = $_POST["editarNombreSocial"];
			
		
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nit)) {

			$tabla = "razonsocial";
			$datos = array(
				"id" => $id,
				"nit" => $nit,
				"nombre" => $nombre
				
				
			);

				$respuesta = ModeloRazonSocial::mdlEditarRazonSocial($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						type: "success",
						title: "La Razon Social ha sido cambiado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
									if (result.value) {

									window.location = "razonsocial";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					swal({
						type: "error",
						title: "¡La Razon Social no puede ir vacío",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "razonsocial";

							}
						})

				</script>';
			}
		}
	}




	/*=============================================
	ELIMINAR SERVICIO
	=============================================*/

static public function ctrBorrarRazonSocial(){

	if(isset($_GET["idRazonSocial"])){

		$tabla ="razonsocial";
		$datos = $_GET["idRazonSocial"];

		$respuesta = ModeloRazonSocial::mdlBorrarRazonSocial($tabla, $datos);

		if($respuesta == "ok"){

			echo'<script>

			swal({
				type: "success",
				title: "El RazonSocial ha sido borrado correctamente",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"
				}).then(function(result){
							if (result.value) {

							window.location = "razonsocial";

							}
						})

			</script>';

		}

	}

}
}