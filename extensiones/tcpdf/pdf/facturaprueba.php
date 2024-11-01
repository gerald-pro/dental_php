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
        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Añadir una página
        $pdf->AddPage();

        // Información del encabezado del reporte
        $bloque1 = <<<EOF
        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <td style="width: 60%; vertical-align: top;"><img src="../../../vistas/img/factura/1.png" width="70" height="auto"></td>
                <td style="width: 40%; text-align:right; vertical-align: top;">
                    <div style="font-size:10px; line-height:15px;">
                        Dirección: Calle 44B 92-11<br>
                        Teléfono: 300 786 52 49<br>
                        muebleriaa&f@gmail.com
                    </div>
                </td>
            </tr>
        </table>
EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, '');

        // Título del reporte
        $bloqueTitulo = <<<EOF
        <h1 style="text-align:center; margin-bottom: 20px; color: #747a80;">VENTAS POR RANGO DE FECHA</h1>
        <br>


EOF;
        $pdf->writeHTML($bloqueTitulo, false, false, false, false, '');

        // SALIDA DEL ARCHIVO
        $pdf->Output('factura.pdf', 'I'); // Cambiar a 'I' para mostrar en el navegador
    }
}

$factura = new imprimirFactura();
$factura->codigo = isset($_GET["codigo"]) ? $_GET["codigo"] : "default";
$factura->traerImpresionFactura();

?>