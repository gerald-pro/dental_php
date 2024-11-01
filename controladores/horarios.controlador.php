<?php

class ControladorHorarios
{
    /*=============================================
    MOSTRAR HORARIOS
    =============================================*/

    static public function ctrMostrarHorarios($item, $valor)
    {
        $tabla = "horario";
        $respuesta = ModeloHorarios::mdlMostrarHorarios($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    MOSTRAR HORARIOS MÉDICO
    =============================================*/

   
    
    static public function ctrMostrarHorariosMedico($valor)
	{

		$respuesta = ModeloHorarios::mdlMostrarHorariosMedico($valor);

		return $respuesta;
	}

    /*=============================================
    CREAR HORARIO
    =============================================*/

    static public function ctrCrearHorario()
    {
        if (isset($_POST["nuevaEntrada"]) && isset($_POST["nuevaSalida"]) && isset($_POST["nuevoDia"]) && isset($_POST["nuevaMedico"])) {
            $entrada = $_POST["nuevaEntrada"];
            $salida = $_POST["nuevaSalida"];
            $dia = $_POST["nuevoDia"];
            $medico = $_POST["nuevaMedico"];

            if (!empty($entrada)) {
                $tabla = "horario";
                $datos = array(
                    "id_medico" => $medico,
                    "entrada" => $entrada,
                    "salida" => $salida,
                    "dia" => $dia
                );

                $respuesta = ModeloHorarios::mdlIngresarHorario($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                            swal({
                                type: "success",
                                title: "El horario ha sido guardado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "horarios";
                                }
                            });
                        </script>';
                }
            } else {
                echo '<script>
                        swal({
                            type: "error",
                            title: "¡El horario no puede tener campos vacíos!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "horarios";
                            }
                        });
                    </script>';
            }
        }
    }

    /*=============================================
    EDITAR HORARIO
    =============================================*/

    static public function ctrEditarHorario()
    {
        if (isset($_POST["editarEntrada"])) {
            $id = $_POST["IdHorario"];
            $entrada = $_POST["editarEntrada"];
            $salida = $_POST["editarSalida"];
            $dia = $_POST["editarDia"];
            $medico = $_POST["editarMedico"];

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $entrada)) {
                $tabla = "horario";
                $datos = array(
                    "id" => $id,
                    "id_medico" => $medico,
                    "entrada" => $entrada,
                    "salida" => $salida,
                    "dia" => $dia
                );

                $respuesta = ModeloHorarios::mdlEditarHorario($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                            swal({
                                type: "success",
                                title: "El horario ha sido actualizado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "horarios";
                                }
                            });
                        </script>';
                }
            } else {
                echo '<script>
                        swal({
                            type: "error",
                            title: "¡El horario no puede ir vacío!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "horarios";
                            }
                        });
                    </script>';
            }
        }
    }

    /*=============================================
    ELIMINAR HORARIO
    =============================================*/

    static public function ctrBorrarHorario()
    {
        if (isset($_GET["idHorario"])) {
            $tabla = "horario";
            $datos = $_GET["idHorario"];

            $respuesta = ModeloHorarios::mdlBorrarHorario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        swal({
                            type: "success",
                            title: "El horario ha sido borrado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "horarios";
                            }
                        });
                    </script>';
            }
        }
    }
}
