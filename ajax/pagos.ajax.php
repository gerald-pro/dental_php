<?php

require_once "../controladores/plantratamiento.controlador.php";
require_once "../modelos/plantratamiento.modelo.php";

class TablaPagoPlanTratamiento
{
    /*=============================================
        MOSTRAR LA TABLA DE TRATAMIENTO
        =============================================*/
    public function mostrarTablaPagoTratamiento()
    {

        $item = null;
        $valor = null;

        $servicios = ControladorPlanTratamiento::ctrMostrarPlanTratamiento($item, $valor);

        if (count($servicios) == 0) {

            echo '{"data": []}';

            return;
        }

        $datosJson = '{
		    "data": [';

        for ($i = 0; $i < count($servicios); $i++) {

            /*=============================================
                TRAEMOS LAS ACCIONES
                ============================================*/

            $botones =  "<div class='btn-group'><button class='btn btn-sm btn-outline-info agregarProducto recuperarBoton' idServicio='" . $servicios[$i]["idservicio"] . "'>Agregar</button></div>";

            $datosJson .= '[
			    "' . ($i + 1) . '",
			    "' . $servicios[$i]["nombre"] . '",
			    "Bs '.number_format($servicios[$i]["precio"],2) . '",
			    "' . $botones . '"
			    ],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .=   ']

		}';

        echo $datosJson;
    }
}
/*=============================================
ACTIVAR TABLA DE PAGO SERVICIOS
=============================================*/
$activarPagoServicios = new TablaPagoPlanTratamiento();
$activarPagoServicios -> mostrarTablaPagoTratamiento();