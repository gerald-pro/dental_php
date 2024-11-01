<?php

require_once "controladores/plantilla.controlador.php";

require_once "controladores/usuarios.controlador.php";
require_once "controladores/servicios.controlador.php";
require_once "controladores/pacientes.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/horarios.controlador.php";
require_once "controladores/razonsocial.controlador.php";
require_once "controladores/citas.controlador.php";
require_once "controladores/pagos.controlador.php";
require_once "controladores/plantratamiento.controlador.php";
require_once "controladores/reportes.controlador.php";


require_once "modelos/plantilla.modelo.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/servicios.modelo.php";
require_once "modelos/pacientes.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/horarios.modelo.php";
require_once "modelos/razonsocial.modelo.php";
require_once "modelos/citas.modelo.php";
require_once "modelos/pagos.modelo.php";
require_once "modelos/plantratamiento.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();