<?php

require_once "../controladores/citas.controlador.php";
require_once "../modelos/citas.modelo.php";

class Ajaxcitas{

	/*=============================================
	NUMERO MAXIMO
	=============================================*/	

	public $idTrabajador;

	public function ajaxObtenerMaximaNumero(){

		$item = "idtrabajador";
		$valor = $this->idTrabajador;

		$respuesta = ControladorCitas::ctrMostrarCitasNumero($item, $valor);

		echo json_encode($respuesta);
	}

}

if(isset($_POST["idTrabajador"])){

	$fichas = new Ajaxcitas();
	$fichas -> idTrabajador = $_POST["idTrabajador"];
	$fichas -> ajaxObtenerMaximaNumero();

}

