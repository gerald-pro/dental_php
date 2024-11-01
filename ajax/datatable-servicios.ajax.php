<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";




class TablaServicios{

 	/*=============================================
 	 MOSTRAR LA TABLA DE SERVICIOS
  	=============================================*/ 

	public function mostrarTablaServicios(){

		$item = null;
    	$valor = null;
    	

  		$servicios = ControladorServicios::ctrMostrarServicios($item, $valor);	

  		if(count($servicios) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($servicios); $i++){

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

			  $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarServicio' idServicio='".$servicios[$i]["id"]."' data-toggle='modal' data-target='#modalEditarServicio'><i class='fa fa-inverse fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarServicio' idServicio='".$servicios[$i]["id"]."'><i class='fa fa-trash-alt'></i></button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$servicios[$i]["nombre"].'",
			      "'.$servicios[$i]["precio"].'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}



}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaServicios();
$activarProductos -> mostrarTablaServicios();

