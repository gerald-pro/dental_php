<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";


class TablaServiciosPlanTratamiento{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaServiciosPlanTratamiento(){
		

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

		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarServicio recuperarBoton' idServicio='".$servicios[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
			     "' . ($i + 1) . '",
			    "' . $servicios[$i]["nombre"] . '",
			    "Bs '.number_format($servicios[$i]["precio"],2) . '",
			    "' . $botones . '"
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
$activarProductosVentas = new TablaServiciosPlanTratamiento();
$activarProductosVentas -> mostrarTablaServiciosPlanTratamiento();

/*=============================================
TRAER SERVICIO
=============================================*/ 

if(isset($_POST["traerTratamiento"])){

    $traerServicio = new TablaServiciosPlanTratamiento();
    $traerServicio -> traerServicio = $_POST["traerTratamiento"];
    $traerServicio -> ajaxEditarServicio();
  
  }
  
  /*=============================================
  TRAER SERVICIO
  =============================================*/ 
  
  if(isset($_POST["nombreTratamiento"])){
  
    $traerServicio = new TablaServiciosPlanTratamiento();
    $traerServicio -> nombreServicio = $_POST["nombreTratamiento"];
    $traerServicio -> ajaxEditarServicio();
  
  }