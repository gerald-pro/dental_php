<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorPlanTratamiento{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarPlanTratamiento($item, $valor){

		$tabla = "plan_tratamiento";

		$respuesta = ModeloPlanTratamiento::mdlMostrarPlanTratamiento($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA 
	=============================================*/

	static public function ctrCrearPlanTratamiento() {  
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (isset($_POST['listaServicios'])) {
				$idMedico = $_POST['idCajera'];
				$idPaciente = $_POST['seleccionarCliente'];
				$servicios = $_POST['listaServicios'];
				$descuento = $_POST['nuevoPrecioDescuento'];
				$subtotal = $_POST['nuevosubTotalPlantratamiento'];
				$total = $_POST['totalPlantratamiento'];
				$listaServicios = json_decode($_POST['listaServicios'], true); // Decodificamos solo una vez
				
				/*=============================================
				GUARDAR EL PLAN DE TRATAMIENTO
				=============================================*/    
				$tabla = "plan_tratamiento";
	
				$datos = array(
					"id_medico" => $idMedico,
					"id_paciente" => $idPaciente,
					"servicios" => $servicios,
					"descuento" => $descuento,
					"subtotal" => $subtotal,
					"total" => $total
				);
	
				
		
				$respuestaDetalle = ModeloPlanTratamiento::mdlIngresarPlanTratamiento($tabla, $datos);
				//$var_dump($respuestaDetalle);
				if ($respuestaDetalle != "id_plan_tratamiento") {
					// Guardar productos de la compra
					foreach ($servicios as $servicios) {
					  $tablaDetallesCompra = "detalle_plan_tratamiento";
					  $datosProducto = array(
						"id_plan_tratamiento" => $respuestaDetalle,
						"id_servicio" => $servicios["id"],
						"cantidad" => $servicios["cantidad"],
						"precio" => $servicios["precio"]
					  );
			
					  ModeloPlanTratamiento::mdlIngresarDetallePlantratamiento($tablaDetallesCompra, $datosProducto);
			
					  // Actualizar la cantidad de productos en la tabla de productos
					  ModeloPlanTratamiento::mdlActualizarCantidadServicio("servicio", $servicios["id"], $servicios["cantidad"]);
					  //ar_dump($a);
			
					 
					}
			
					echo '<script>
					  swal({
						type: "success",
						title: "El Plan Tratamiento ha sido guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
						  if (result.value) {
							window.location = "plantratamiento";
						  }
						})
					</script>';
				  } else {
					echo '<script>
					  swal({
						type: "error",
						title: "¡Error al guardar el Plan Tratamiento!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
						  if (result.value) {
							window.location = "plantratamiento";
						  }
						})
					</script>';
				  }
				}
			  }
			}

		
	
	

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaServicios"] == ""){

				$listaServicios = $traerVenta["servicios"];
				$cambioProducto = false;


			}else{

				$listaServicios = $_POST["listaServicios"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerVenta["servicios"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "servicios";

					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$traerProducto = ModeloServicios::mdlMostrarServicios($tablaProductos, $item, $valor, $orden);

					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];

					$nuevasVentas = ModeloServicios::mdlActualizarServicios($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloServicios::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				$tablaClientes = "paciente";

				$itemCliente = "id";
				$valorCliente = $_POST["seleccionarPaciente"];

				$traerCliente = ModeloPacientes::mdlMostrarPacientes($tablaClientes, $itemCliente, $valorCliente);

				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);		

				$comprasCliente = ModeloPacientes::mdlActualizarPacientes($tablaClientes, $item1a, $valor1a, $valorCliente);

				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaServicios_2 = json_decode($listaServicios, true);

				$totalProductosComprados_2 = array();

				foreach ($listaServicios_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "servicio";

					$item_2 = "id";
					$valor_2 = $value["id"];
					$orden = "id";

					$traerProducto_2 = ModeloServicios::mdlMostrarServicios($tablaProductos_2, $item_2, $valor_2, $orden);

					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

					$nuevasVentas_2 = ModeloServicios::mdlActualizarServicios($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

					$nuevoStock_2 = ModeloServicios::mdlActualizarServicios($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

				$item1a_2 = "compras";

				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["editarVenta"],
						   "productos"=>$listaServicios,
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"],
						   "metodo_pago"=>$_POST["listaMetodoPago"]);


			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}

		}

	}


	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarPlantratamiento(){

		if(isset($_GET["idPlantratamiento"])){ ///falta revisar

			$tabla = "plan_tratamiento";

			$item = "id";
			$valor = $_GET["idPlantratamiento"];

			$traerVenta = ModeloPlanTratamiento::mdlMostrarPlanTratamiento($tabla, $item, $valor);

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			//eliminar el detalle del tratamiento eliminada

            $tablaDetalle = "detalle_plan_tratamiento"; 
            $respuesta = ModeloPlanTratamiento::mdlEliminarDetallePlantratamiento($tablaDetalle, $_GET["idPlantratamiento"]);   //falta revisar 
 
			$respuesta = ModeloPlanTratamiento::mdlEliminarPlantratamiento($tabla, $_GET["idPlantratamiento"]);


			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "plantratamiento";

								}
							})

				</script>';

			}		
		}

	}

}