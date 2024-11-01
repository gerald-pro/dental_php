<?php

class ControladorCitas
{
		/**
		 *CREAR REGISTRO Cita
		*/
	static public function ctrCrearCita()
	{
		if (isset($_POST["id_Medico"])) {

				$tabla = "cita";

				$datos = array(
					"id_Medico" => $_POST["id_Medico"],
					"id_Secretaria" => $_POST["id_Secretaria"],
					"id_Paciente" => $_POST["seleccionarPaciente"],
					"fechaInicio" => $_POST["fechaInicio"],
                    "fechaFin" => $_POST["fechaFin"]
					
				);

				$respuesta = ModeloCitas::mdlIngresarCita($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "Los datos de la Cita ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "citas";

									}
								})

					</script>';
				}
			
		}
	}



	/*=============================================
	MOSTRAR Citas
	=============================================*/

	static public function ctrMostrarCita($item, $valor)
	{

		$tabla = "cita";

		$respuesta = ModeloCitas::mdlMostraCita($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================================
	MOSTRAR LAS CITAS DE UN MEDICO
	=============================================*/


	static public function ctrMostrarCitasMedico1($valor)
	{

		$respuesta = ModeloCitas::mdlMostrasCitaMedico1($valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR TOTAL Citas
	=============================================*/

	static public function ctrMostrarTotalCita($item, $valor){

		$tabla = "cita";

		$respuesta = ModeloCitas::MdlMostrarTotalCita($tabla, $item, $valor);

		return $respuesta;
	}
	/*=============================================
	MOSTRAR TOTAL Citas
	=============================================*/

	static public function ctrMostrarCitaDia($item, $valor){

		$tabla = "cita";

		$respuesta = ModeloCitas::MdlMostrasCitaPorDia($tabla);

		return $respuesta;
	}
	/*=============================================
	EDITAR Citas
	=============================================*/

	static public function ctrEditarCita()
	{

		if (isset($_POST["editarcarnetP"])) {

			if (
				preg_match('/^[()\-0-9 ]+$/', $_POST["editarcarnetP"]) &&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarnombreP"]) &&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarapellidoP"]) &&
				preg_match('/^[0-9]+$/', $_POST["editartelefonoP"])
			) {

				$tabla = "Cita";

				$datos = array(
					"idCita" => $_POST["idCita"],
					"documento" => $_POST["editarcarnetP"],
					"nombres" => $_POST["editarnombreP"],
					"apellidos" => $_POST["editarapellidoP"],
					"telefono" => $_POST["editartelefonoP"],
					"direccion" => $_POST["editardomicilioP"],
					"sexo" => $_POST["editarsexoP"],
					"fechaNacimiento" => $_POST["editarfechaNacimientoP"]
				);

				$respuesta = ModeloCitas::mdlEditarCita($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "Los datos de la Cita ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "Citas";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					swal({
						  type: "error",
						  title: "¡Los datos de la Cita no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "citas";

							}
						})

			  	</script>';
			}
		}
	}

	/*=============================================
	ELIMINAR Citas
	=============================================*/

	static public function ctrEliminarCita()
	{

		if (isset($_GET["idCita"])) {

			$tabla = "cita";
			$datos = $_GET["idCita"];

			$respuesta = ModeloCitas::mdlEliminarCita($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "Los datos de la Cita han sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "citas";

								}
							})

				</script>';
			}
		}
	}
}
