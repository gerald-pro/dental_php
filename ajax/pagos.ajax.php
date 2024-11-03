<?php

require_once "../controladores/pagos.controlador.php";
require_once "../modelos/plantratamiento.modelo.php";
require_once "../modelos/pagos.modelo.php";

if (isset($_POST["idPaciente"])) {
    $idPaciente = $_POST["idPaciente"];
    $planes = ControladorPagos::ctrObtenerPlanesPorPaciente($idPaciente);
    echo json_encode($planes);
}

if (isset($_POST["id_plan_tratamiento"])) {
    $planId = $_POST["id_plan_tratamiento"];
    $respuesta = ControladorPagos::obtenerDetallesPlan($planId);
    echo json_encode($respuesta);
}

if (isset($_POST["idPago"])) {
    $idPago = $_POST["idPago"];
    $pago = ControladorPagos::ctrMostrarPagoPorId($idPago);
    echo json_encode($pago);
}

if (isset($_POST["idPago"]) && isset($_POST["delete"])) {
    $idPago = $_POST["idPago"];
    $pago = ControladorPagos::ctrEliminarPago($idPago);
    echo json_encode($pago);
}
