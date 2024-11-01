<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


require_once "../examples/tcpdf_include.php";

class imprimirFactura {

    public $codigo;

    public function traerImpresionFactura() {

        // TRAEMOS LA INFORMACIÓN DE LA VENTA
        $itemVenta = "codigo";
        $valorVenta = $this->codigo;

        $respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

        $fecha = substr($respuestaVenta["fecha"], 0, -8);
        $productos = json_decode($respuestaVenta["productos"], true);
        $neto = number_format($respuestaVenta["neto"], 0); // Subtotal sin decimales
        $impuesto = number_format($respuestaVenta["impuesto"], 0); // Descuento sin decimales
        $total = number_format($respuestaVenta["total"], 0); // Total sin decimales
        $tipoVenta = $respuestaVenta["tipo"]; // AÑADIR TIPO DE VENTA
        $estadoVenta = $respuestaVenta["estado"]; // Obtener el estado de la venta

        // Función para traducir el estado numérico a texto, considerando el tipo de venta
        function traducirEstado($estado, $tipoVenta) {
            if ($tipoVenta == "Venta") {
                return 'Finalizado';
            } else {
                switch ($estado) {
                    case 0:
                        return 'En Inicio';
                    case 1:
                        return 'En Proceso';
                    case 2:
                        return 'Finalizado';
                    default:
                        return 'Desconocido'; // En caso de que el estado no sea 0, 1 o 2
                }
            }
        }

        // TRAEMOS LA INFORMACIÓN DEL CLIENTE
        $itemCliente = "id";
        $valorCliente = $respuestaVenta["id_cliente"];

        $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

        // TRAEMOS LA INFORMACIÓN DEL VENDEDOR
        $itemVendedor = "id";
        $valorVendedor = $respuestaVenta["id_vendedor"];

        $respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

        // CREAR UNA NUEVA INSTANCIA DE TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->startPageGroup();

        $pdf->AddPage();

        // Información del encabezado del reporte
        $bloque1 = <<<EOF
        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <td style="width: 50%; vertical-align: top;"><img src="../../../vistas/img/factura/1.png" width="70" height="auto"></td>
                <td style="width: 50%; text-align:right; vertical-align: top;">
                    <div style="font-size:10px; line-height:15px;">
                        Dirección: Barrio Roca y Coronado calle 12 de octubre<br>
                        Teléfono: 78171596<br>
                        muebleriaa&f@gmail.com
                    </div>
                </td>
            </tr>
        </table>

EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, '');

        // Título del reporte
        $bloqueTitulo = <<<EOF
        <h1 style="text-align:center; margin-bottom: 20px; color: #747a80;">NOTA DE VENTA</h1>
        <br>
        <br><br> <!-- Espaciado adicional -->
EOF;


        $pdf->writeHTML($bloqueTitulo, false, false, false, false, '');

        // Sección de información de venta
        $estadoTraducido = traducirEstado($estadoVenta, $tipoVenta); // Traducir el estado de la venta considerando el tipo
        $bloque2 = <<<EOF

		<table style="font-size:10px; padding:5px 10px;">
			<tr>
				<td style="border: 1px solid #666; background-color:white; width:390px">
					Cliente: $respuestaCliente[nombre]
				</td>
				<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
					Fecha: $fecha
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid #666; background-color:white; width:390px">
					Tipo de Venta: $tipoVenta
				</td>
				<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
					Vendedor: $respuestaVendedor[nombre]
				</td>
			</tr>
            <tr>
				<td style="border: 1px solid #666; background-color:white; width:390px">
					Estado de Venta: $estadoTraducido
				</td>
				<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right"></td>
			</tr>
		</table>

		<br><br> <!-- Espaciado adicional -->

EOF;

        $pdf->writeHTML($bloque2, false, false, false, false, '');

        // ---------------------------------------------------------
        $bloque3 = <<<EOF

        <table style="font-size:10px; padding:5px 10px; border-collapse: collapse;">
        <tr>
            <td style="border: 1px solid #666; background-color:#d2b48c; width:260px; text-align:center; font-weight: bold;">Producto</td>
            <td style="border: 1px solid #666; background-color:#d2b48c; width:80px; text-align:center; font-weight: bold;">Cantidad</td>
            <td style="border: 1px solid #666; background-color:#d2b48c; width:100px; text-align:center; font-weight: bold;">Valor Unit.</td>
            <td style="border: 1px solid #666; background-color:#d2b48c; width:100px; text-align:center; font-weight: bold;">Valor Total</td>
        </tr>
        </table>

EOF;

        $pdf->writeHTML($bloque3, false, false, false, false, '');

        // ---------------------------------------------------------
        foreach ($productos as $key => $item) {

            $itemProducto = "descripcion";
            $valorProducto = $item["descripcion"];
            $orden = null;

            $respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

            $valorUnitario = number_format($respuestaProducto["precio_venta"], 0); // Sin decimales
            $precioTotal = number_format($item["total"], 0); // Sin decimales

            $bloque4 = <<<EOF

            <table style="font-size:10px; padding:5px 10px;">
                <tr>
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                        $item[descripcion]
                    </td>
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
                        $item[cantidad]
                    </td>
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                        Bs. $valorUnitario
                    </td>
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                        Bs. $precioTotal
                    </td>
                </tr>
            </table>

EOF;

            $pdf->writeHTML($bloque4, false, false, false, false, '');
        }

        // ---------------------------------------------------------
        $bloque5 = <<<EOF

        <table style="font-size:10px; padding:5px 10px;">
            <tr>
                <td style="color:#333; background-color:white; width:340px; text-align:center"></td>
                <td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>
                <td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>
            </tr>
            <tr>
                <td></td>
                <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center; font-weight: bold;">SUBTOTAL</td>
                <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Bs. $neto</td>
            </tr>
            <tr>
                <td></td>
                <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center; font-weight: bold;">DESCUENTO</td>
                <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Bs. $impuesto</td>
            </tr>
            <tr>
                <td></td>
                <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center; font-weight: bold;">TOTAL</td>
                <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center; font-weight: bold;">Bs. $total</td>
            </tr>
        </table>

EOF;

        $pdf->writeHTML($bloque5, false, false, false, false, '');

        $pdf->Output('factura.pdf', 'I');
    }
}

$imprimir = new imprimirFactura();
$imprimir->codigo = $_GET["codigo"];
$imprimir->traerImpresionFactura();

?>
