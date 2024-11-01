<?php

require_once "../../../controladores/pacientes.controlador.php";
require_once "../../../modelos/pacientes.modelo.php";
require_once "../examples/tcpdf_include.php";

class imprimirFactura extends TCPDF {

    public $id;

     // Método para agregar el pie de página con la fecha, hora y número de página
	 public function Footer() {
        // Posición a 15 mm del final
        $this->SetY(-15);
        
        // Configura la fuente para el pie de página
        $this->SetFont('helvetica', 'I', 8);
        
        // Fecha y hora actuales
        $fechaHora = date("d/m/Y H:i:s");
        
        // Añadir fecha y hora alineada a la izquierda
        $this->Cell(0, 10, "Generado el: $fechaHora", 0, 0, 'L');
        
        // Añadir número de página alineado a la derecha
        $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), 0, 0, 'R');
    }

    public function traerImpresionFactura() {
        ///// TRAEMOS LA INFORMACIÓN DEL PACIENTE
        $itemPaciente = "id";
        $valorPaciente = $this->id;

        $respuestaPaciente = ControladorPacientes::ctrMostrarPacientes($itemPaciente, $valorPaciente);

        $nombre = $respuestaPaciente["nombre"];
        $apellidoP = $respuestaPaciente["apellidoP"];
        $apellidoM = $respuestaPaciente["apellidoM"];
        $documento = $respuestaPaciente["documento"];
        $sexo = $respuestaPaciente["sexo"];
        $telefono = $respuestaPaciente["telefono"];

        $pdf = new imprimirFactura(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->startPageGroup();
        $pdf->AddPage();

        // ---------------------------------------------------------

        // Agregar imagen (logotipo) al encabezado
        $pdf->Image('../../../vistas/img/factura/logo.png', 15, 10, 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

        // Encabezado mejorado
        $bloque1 = <<<EOF
            <table style="width:100%; text-align:center;">
                <tr>
                    <td style="font-size:20px; font-weight:bold; color:#333;">CONSULTORIO DENTAL ROJAS</td>
                </tr>
                <tr>
                    <td style="font-size:12px; color:#666;">NIT: 71.759.963-9</td>
                </tr>
                <tr>
                    <td style="font-size:12px; color:#666;">Dirección: Avenida Sinai</td>
                </tr>
                <tr>
                    <td style="font-size:12px; color:#666;">Teléfono: 75596357</td>
                </tr>
                <tr>
                    <td style="font-size:12px; color:#666;">ConsultorioDentalRojas@gmail.com</td>
                </tr>
                <tr>
                    <td style="font-size:14px; font-weight:bold; margin-top:10px;">FACTURA N° $valorPaciente</td>
                </tr>
            </table>
        EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, '');

        // ---------------------------------------------------------
        // INFORMACIÓN DEL PACIENTE
        $htmlPaciente = <<<EOF
        <table style="font-size:10px; padding:5px 10px;">
            <h2>Datos del Paciente</h2>
            <tr>
                <td style="border: 1px solid #666; background-color:#B2EBF2; width:260px; text-align:center"><strong>Nombre Completo</strong></td>
                <td style="border: 1px solid #666; background-color:#B2EBF2; width:80px; text-align:center"><strong>Documento</strong></td>
                <td style="border: 1px solid #666; background-color:#B2EBF2; width:100px; text-align:center"><strong>Sexo</strong></td>
                <td style="border: 1px solid #666; background-color:#B2EBF2; width:100px; text-align:center"><strong>Teléfono</strong></td>
            </tr>
            <tr>
                <td style="border: 1px solid #666; text-align:center;">$nombre $apellidoP $apellidoM</td>
                <td style="border: 1px solid #666; text-align:center;">$documento</td>
                <td style="border: 1px solid #666; text-align:center;">$sexo</td>
                <td style="border: 1px solid #666; text-align:center;">$telefono</td>
            </tr>
        </table>
        <br>
        EOF;

        $pdf->writeHTML($htmlPaciente, false, false, false, false, '');

        // SALIDA DEL ARCHIVO
        $pdf->Output('factura.pdf', 'I'); // 'I' muestra el PDF en el navegador
    }
}

// Instancia de la clase e impresión de la factura
$factura = new imprimirFactura();
$factura->id = $_GET["id"];
$factura->traerImpresionFactura();

?>
