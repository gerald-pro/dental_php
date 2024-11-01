<?php

require_once "../../../controladores/pacientes.controlador.php";
require_once "../../../modelos/pacientes.modelo.php";
require_once "../examples/tcpdf_include.php";

class imprimirReportePacientes extends TCPDF {

    public $fechaInicio;
    public $fechaFin;

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

    public function generarReportePacientesPorFechaNacimiento() {

        $fechaInicio = $this->fechaInicio;
        $fechaFin = $this->fechaFin;

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetTitle('Reporte de fecha nacimiento');
        $pdf->startPageGroup();
        $pdf->AddPage();

        $encabezado = <<<EOF
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
                <td style="font-size:14px; font-weight:bold; margin-top:10px;">Reporte de Pacientes por Fecha de Nacimiento</td>
            </tr>
        </table>
    EOF;

    $pdf->writeHTML($encabezado, false, false, false, false, '');

    $tablaRangoFechas = <<<EOF
            <table style="font-size:10px; padding:5px 10px;">
                <tr>
                    <td style="background-color:#B2EBF2; width:160px; text-align:right">Desde <b>$fechaInicio</b></td>
                    <td style="background-color:#B2EBF2; width:80px; text-align:left">Hasta <b>$fechaFin</b></td>
                </tr>
            </table>
    EOF;
    $pdf->writeHTML($tablaRangoFechas, false, false, false, false, '');

    $tablaCabecera = <<<EOF
            <table style="font-size:10px; padding:5px 10px;">
                <tr>
                   <td style="border: 1px solid #666; background-color:#B2EBF2; width:160px; text-align:center"><strong>Nombre Completo</strong></td>
                    <td style="border: 1px solid #666; background-color:#B2EBF2; width:80px; text-align:center"><strong>Documento</strong></td>
                    <td style="border: 1px solid #666; background-color:#B2EBF2; width:80px; text-align:center"><strong>Sexo</strong></td>
                    <td style="border: 1px solid #666; background-color:#B2EBF2; width:80px; text-align:center"><strong>Teléfono</strong></td>
                    <td style="border: 1px solid #666; background-color:#B2EBF2; width:150px; text-align:center"><strong>Fecha de Nacimiento</strong></td>
                </tr>
            </table>
    EOF;
    $pdf->writeHTML($tablaCabecera, false, false, false, false, '');

    $respuestaPacientes = ControladorPacientes::ctrMostrarPacientesPorFecha($fechaInicio, $fechaFin);

    foreach ($respuestaPacientes as $paciente) {

        $nombre = $paciente["nombre"] . " " . $paciente["apellidoP"] . " " . $paciente["apellidoM"];
        $documento = $paciente["documento"];
        $sexo = $paciente["sexo"];
        $telefono = $paciente["telefono"];
        $fechaNacimiento = $paciente["fechaNacimiento"];

        $filaDatos = <<<EOF
        <table style="font-size:10px; padding:5px 10px;">
            <tr>
                <td style="border: 1px solid #666; color:#333; background-color:white; width:160px; text-align:center">$nombre</td>
                <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$documento</td>
                <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$sexo</td>
                <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$telefono</td>
                <td style="border: 1px solid #666; color:#333; background-color:white; width:150px; text-align:center">$fechaNacimiento</td>
            </tr>
        </table>
EOF;

        $pdf->writeHTML($filaDatos, false, false, false, false, '');
    }

    // SALIDA DEL ARCHIVO
    $pdf->Output('reporte_pacientes.pdf', 'I'); // 'I' muestra el PDF en el navegador
    }
}

// Instancia de la clase y generación del reporte
$reportePacientes = new imprimirReportePacientes();
$reportePacientes->fechaInicio = isset($_GET["fechaInicio"]) ? $_GET["fechaInicio"] : null;
$reportePacientes->fechaFin = isset($_GET["fechaFin"]) ? $_GET["fechaFin"] : null;
$reportePacientes->generarReportePacientesPorFechaNacimiento();

?>
