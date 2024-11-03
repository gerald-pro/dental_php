<?php

require_once "../controladores/plantratamiento.controlador.php";
require_once "../controladores/pagos.controlador.php";
require_once "../modelos/pagos.modelo.php";
require_once "../modelos/plantratamiento.modelo.php";
require_once "../modelos/servicios.modelo.php";

if (isset($_POST["idPlanPagos"])) {
    $idPlan = $_POST["idPlanPagos"];
    $pagos = ControladorPlanTratamiento::ctrMostrarPagosPorPlan($idPlan);
    $plan = ControladorPlanTratamiento::buscarPorId($idPlan);

    $detalles = ControladorPagos::obtenerDetallesPlan($idPlan);

    $plan['pagos'] = $pagos;
    $plan['saldo_pendiente'] = $detalles['saldo_pendiente'];

    echo json_encode($plan);
}

if (isset($_POST["idPlanServicios"])) {
    $idPlan = $_POST["idPlanServicios"];

    $plan = ControladorPlanTratamiento::buscarPorId($idPlan);
    $servicios = ControladorPlanTratamiento::ctrMostrarServiciosPorPlan($idPlan);
    $plan['servicios'] = $servicios;

    echo json_encode($plan);
}

if (isset($_POST["idPlan"])) {
    $idPlan = $_POST["idPlan"];
    $plan = ControladorPlanTratamiento::buscarPorId($idPlan);

    echo json_encode($plan);
}

if (isset($_POST["idPlan"]) && isset($_POST["delete"])) {
    $idPlan = $_POST["idPlan"];
    $response = ControladorPlanTratamiento::ctrEliminarPlantratamiento($idPlan);
    echo json_encode($response);
}
