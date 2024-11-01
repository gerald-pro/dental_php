<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../examples/tcpdf_include.php";

class imprimirReporteVentas {

    public function generarReporteVentas() {
        // Crear una nueva instancia de TCPDF en orientación horizontal
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Añadir una página
        $pdf->AddPage();

        // Información del encabezado del reporte
        $bloque1 = <<<EOF
        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <td style="width: 60%; vertical-align: top;"><img src="../../../vistas/img/factura/1.png" width="70" height="auto"></td>
                <td style="width: 40%; text-align:right; vertical-align: top;">
                    <div style="font-size:10px; line-height:15px;">
                        Dirección: Barrio Roca y Coronado calle 12de octubre<br>
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
        <h1 style="text-align:center; margin-bottom: 20px; color: #747a80;">REPORTE DE VENTAS FINALIZADAS</h1>
        <br>
EOF;
        $pdf->writeHTML($bloqueTitulo, false, false, false, false, '');

        // Traemos la información de todas las ventas
        $ventas = ControladorVentas::ctrMostrarVentas(null, null);

        // Inicializar contador de filas
        $contadorFilas = 0;

        // Función para traducir el estado numérico a texto
        function traducirEstado($estado) {
            switch ($estado) {
                case 0:
                    return 'En Inicio';
                case 1:
                    return 'En Proceso';
                case 2:
                    return 'Finalizado';
                default:
                    return 'Desconocido'; // En caso de que el estado no coincida con ninguno de los valores esperados
            }
        }

        // Tabla de ventas con los nuevos campos añadidos, incluyendo la columna de estado
        $tablaVentas = <<<EOF
        <table style="font-size:10px; padding:5px 10px; border-collapse: collapse; text-align: center;">
            <tr>
                <td style="border: 1px solid #666; background-color:#d2b48c; width:80px; font-weight: bold;">Código</td>
                <td style="border: 1px solid #666; background-color:#d2b48c; width:100px; font-weight: bold;">Cliente</td>
                <td style="border: 1px solid #666; background-color:#d2b48c; width:100px; font-weight: bold;">Vendedor</td>
                <td style="border: 1px solid #666; background-color:#d2b48c; width:100px; font-weight: bold;">Fecha</td>
                <td style="border: 1px solid #666; background-color:#d2b48c; width:80px; font-weight: bold;">Método Pago</td>
                <td style="border: 1px solid #666; background-color:#d2b48c; width:80px; font-weight: bold;">Tipo Venta</td>
                <td style="border: 1px solid #666; background-color:#d2b48c; width:80px; font-weight: bold;">Estado</td>
                <td style="border: 1px solid #666; background-color:#d2b48c; width:80px; font-weight: bold;">Total</td>
                <td style="border: 1px solid #666; background-color:#d2b48c; width:80px; font-weight: bold;">Descuento</td>
            </tr>
EOF;

        // Agregar las filas de ventas, filtrando solo las que son de tipo "Venta" y estado "Finalizado"
        foreach ($ventas as $venta) {
            // Verificar si el tipo es 'Venta' y el estado es 'Finalizado' (estado = 2)
            if ($venta['tipo'] === 'Venta' && $venta['estado'] == 2) {
                // Incrementar el contador de filas
                $contadorFilas++;

                // Obtener detalles del cliente y vendedor
                $cliente = ControladorClientes::ctrMostrarClientes("id", $venta["id_cliente"]);
                $vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $venta["id_vendedor"]);

                $neto = number_format($venta['neto']);
                $total = number_format($venta['total']);
                $metodoPago = $venta['metodo_pago'];
                $tipoVenta = $venta['tipo'];
                $estado = traducirEstado($venta['estado']); // Traducir el estado numérico a texto

                // Cambiar el signo $ por Bs.
                $tablaVentas .= <<<EOF
                <tr>
                    <td style="border: 1px solid #666;">{$venta['codigo']}</td>
                    <td style="border: 1px solid #666;">{$cliente['nombre']}</td>
                    <td style="border: 1px solid #666;">{$vendedor['nombre']}</td>
                    <td style="border: 1px solid #666;">{$venta['fecha']}</td>
                    <td style="border: 1px solid #666;">$metodoPago</td>
                    <td style="border: 1px solid #666;">$tipoVenta</td>
                    <td style="border: 1px solid #666;">$estado</td> <!-- Mostrar el estado como texto aquí -->
                    <td style="border: 1px solid #666;">Bs. $neto</td>
                    <td style="border: 1px solid #666;">Bs. $total</td>
                </tr>
EOF;
            }
        }

        $tablaVentas .= "</table>";

        // Mostrar la tabla de ventas en el PDF
        $pdf->writeHTML($tablaVentas, false, false, false, false, '');

        // Mostrar el total de filas al final
        $bloqueTotalFilas = <<<EOF
        <br><br>
        <h3 style="text-align: center;">Total de ventas finalizadas: $contadorFilas</h3>
EOF;
        $pdf->writeHTML($bloqueTotalFilas, false, false, false, false, '');

        // Salida del archivo en formato horizontal
        $pdf->Output('reporte_ventas_finalizadas.pdf', 'I'); // Mostrar en el navegador
    }
}

// Instanciar la clase e invocar el método para generar el reporte de ventas
$reporteVentas = new imprimirReporteVentas();
$reporteVentas->generarReporteVentas();
