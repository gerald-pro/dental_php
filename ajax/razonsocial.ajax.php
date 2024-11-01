<?php

require_once "../controladores/razonsocial.controlador.php";
require_once "../modelos/razonsocial.modelo.php";


class AjaxRazonSocial
{
    /*=============================================
    EDITAR SERVICIO
    =============================================*/

    public $idRazonSocial;

    public function ajaxEditarRazonSocial()
    {

        $item = "id";
        $valor = $this->idRazonSocial;

        $respuesta = ControladorRazonSocial::ctrMostrarRazonSocial($item, $valor);

        echo json_encode($respuesta);
    }
        /*=============================================
        ACTIVAR SERVICIO
        =============================================*/

    public $activarRazonSocial;
    public $activarId;

    public function ajaxActivarRazonSocial()
    {

        $tabla = "razonsocial";

        $item1 = "estado";
        $valor1 = $this->activarRazonSocial;

        $item2 = "idRazonSocial";
        $valor2 = $this->activarId;

        $respuesta = ModeloRazonSocial::mdlActualizarRazonSocial($tabla, $item1, $valor1, $item2, $valor2);
    }
}
/*=============================================
EDITAR SERVICIOS
=============================================*/
if (isset($_POST["idRazonSocial"])) {

    $editarRazonSocial = new AjaxRazonSocial();
    $editarRazonSocial->idRazonSocial = $_POST["idRazonSocial"];
    $editarRazonSocial->ajaxEditarRazonSocial();
}
/*=============================================
ACTIVAR SERVICIO
=============================================*/

if (isset($_POST["activarRazonSocial"])) {

    $activarRazonSocial = new AjaxRazonSocial();
    $activarRazonSocial->activarRazonSocial = $_POST["activarRazonSocial"];
    $activarRazonSocial->activarId = $_POST["activarId"];
    $activarRazonSocial->ajaxActivarRazonSocial();
}
