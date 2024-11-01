<?php

require_once "../controladores/plantratamiento.controlador.php";
require_once "../modelos/plantratamiento.modelo.php";
require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";

class TablaDetalleTratamiento {

    /*=============================================
     MOSTRAR LA TABLA DE DETALLE DE COMPRAS
    =============================================*/

    public function mostrarTablaDetalleServicio() {

        $item = null;
        $valor = null;

        $detalleTratamiento = ControladorPlanTratamiento::ctrMostrarPlanTratamiento($item, $valor);

        if (count($detalleTratamiento) == 0) {
            echo '{"data": []}';
            return;
        }

        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($detalleTratamiento); $i++) {

            /*=============================================
            TRAEMOS EL NOMBRE DEL PRODUCTO
            =============================================*/
            $itemProducto = "id";
            $valorProducto = $detalleTratamiento[$i]["id_producto"];
            $producto = ControladorServicios::ctrMostrarServiciosdetalles($itemProducto, $valorProducto);
            //print_r($producto);
            //var_dump($producto);
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/
            $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarCompra' idCompra='" . $detalleTratamiento[$i]["id_compra"] . "' data-toggle='modal' data-target='#modalEditarCompra'><i class='fa fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarCompra' idCompra='" . $detalleTratamiento[$i]["id_compra"] . "'><i class='fa fa-trash-alt'></i></button></div>";

            $datosJson .= '{
                "numero": "' . ($i + 1) . '",
                "id_servicio": "' . $detalleTratamiento[$i]["id_compra"] . '",
                "precio": "' . $producto["precio_compra"] . '",
                "cantidad": "' . $detalleTratamiento[$i]["cantidad"] . '",
                "acciones": "' . $acciones . '"
            },';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= ']
        }';

        echo $datosJson;
    }
}

/*=============================================
ACTIVAR TABLA DE DETALLE DE COMPRAS
=============================================*/
$activarDetalleCompras = new TablaDetalleTratamiento();
$activarDetalleCompras->mostrarTablaDetalleServicio();

?>
