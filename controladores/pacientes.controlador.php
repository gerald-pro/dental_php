<?php

class ControladorPacientes{

	

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarPacientes($item, $valor){

		$tabla = "paciente";


		$respuesta = ModeloPacientes::mdlMostrarPacientes($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR PACIENTE POR FECHA
	=============================================*/

	public static function ctrMostrarPacientesPorFecha($item, $rangoFechas) {
        $tabla = "paciente"; // Nombre de la tabla en la base de datos
        return ModeloPacientes::mdlMostrarPacientesPorFecha($tabla, $item, $rangoFechas);
    }

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearPacientes(){

		if(isset($_POST["nuevoNombre"])) {
				
				$nombre = $_POST["nuevoNombre"];
				$apellidoP = $_POST["nuevoApellidoP"];
				$apellidoM = $_POST["nuevoApellidoM"];
				$documento = $_POST["nuevoDocumentacion"];
				$sexo = $_POST["nuevoSexo"];
				$telefono = $_POST["nuevoTelefono"];
				$email = $_POST["nuevoEmail"];
				$fechaNacimiento = $_POST["nuevoFechaNacimiento"];
				$direccion = $_POST["nuevoDireccion"];
			
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombre)) {

				$tabla = "paciente";
				$datos = array(
					"nombre" => $nombre,
					"apellidoP" => $apellidoP,
					"apellidoM" => $apellidoM,
					"documento" => $documento,
					"sexo" => $sexo,
					"telefono" => $telefono,
					"email" => $email,
					"fechaNacimiento" => $fechaNacimiento,
					"direccion" => $direccion
				);

				$respuesta = ModeloPacientes::mdlIngresarPacientes($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Paciente ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "pacientes";

									}
								})

					</script>';

				}
			


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Paciente no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "pacientes";

							}
						})

			  	</script>';

			}

		}
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarPacientes(){

		if(isset($_POST["editarNombre"])) {
				$id = $_POST["IdPaciente"];
				$nombre = $_POST["editarNombre"];
				$apellidoP = $_POST["editarApellidoP"];
				$apellidoM = $_POST["editarApellidoM"];
				$documento = $_POST["editarDocumentacion"];
				$sexo = $_POST["editarSexo"];
				$telefono = $_POST["editarTelefono"];
				$email = $_POST["editarEmail"];
				$fechaNacimiento = $_POST["editarFechaNacimiento"];
				$direccion = $_POST["editarDireccion"];
			
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombre)) {

				$tabla = "paciente";
				$datos = array(
					"id" => $id,
					"nombre" => $nombre,
					"apellidoP" => $apellidoP,
					"apellidoM" => $apellidoM,
					"documento" => $documento,
					"sexo" => $sexo,
					"telefono" => $telefono,
					"email" => $email,
					"fechaNacimiento" => $fechaNacimiento,
					"direccion" => $direccion
				);


				$respuesta = ModeloPacientes::mdlEditarPacientes($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Paciente ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "pacientes";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Paciente no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "pacientes";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarPaciente(){

		if(isset($_GET["idPaciente"])){

			$tabla ="paciente";
			$datos = $_GET["idPaciente"];

			$respuesta = ModeloPacientes::mdlBorrarPacientes($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El Paciente ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "pacientes";

									}
								})

					</script>';
			}
		}
		
	}

}