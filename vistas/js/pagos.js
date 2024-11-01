/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/
// $.ajax({
// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){
// 		console.log("respuesta", respuesta);
// 	}
// })
$('.tablaPagos').DataTable( {
    "ajax": "ajax/pagos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
	}
} );

/*=============================================
AGREGANDO TRATAMIENTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaPagos tbody").on("click", "button.agregarTratamiento", function(){

	var idPlantratamiento = $(this).attr("idPlantratamiento");

	$(this).removeClass("btn-outline-info agregarTratamiento");

	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idPlantratamiento", idPlantratamiento);

    $.ajax({

		url:"ajax/plantratamiento.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			var nombre = respuesta["id_plan_tratamiento"];
			var stock = respuesta["stock"];
			var precio = respuesta["monto"];

        $(".nuevoTratamiento").append(

			'<div class="row" style="padding:5px 15px">'+

			'<!-- nombre del tratamiento -->'+
			
			'<div class="col-xs-6" style="padding-right:0px">'+
			
			  '<div class="input-group">'+
				
				'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarTratamiento" idPlantratamiento="'+idPlantratamiento+'"><i class="fa fa-times"></i></button></span>'+

				'<input type="text" class="form-control nuevaNombreTratamiento" idPlantratamiento="'+idPlantratamiento+'" name="agregarTratamiento" value="'+nombre+'" readonly required>'+

			  '</div>'+

			'</div>'+


			'<!-- Precio del servicio -->'+

			'<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

			  '<div class="input-group">'+

				'<span class="input-group-addon"><b>Bs.</b></i></span>'+
				   
				'<input type="text" class="form-control nuevoPrecioServicio" precioReal="'+precio+'" name="nuevoPrecioServicio" value="'+precio+'" readonly required>'+
   
			  '</div>'+
			   
			'</div>'+

		  '</div>') 

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPrecios();

	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listaTratamiento();

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioServicio").number(true, 2);

    	}
    })
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaPagos").on("draw.dt", function(){

	if(localStorage.getItem("quitarTratamiento") != null){

		var listaIdTratamiento = JSON.parse(localStorage.getItem("quitarTratamiento"));

		for(var i = 0; i < listaIdTratamiento.length; i++){

			$("button.recuperarBoton[idPlantratamiento='"+listaIdTratamiento[i]["idPlantratamiento"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idPlantratamiento='"+listaIdTratamiento[i]["idPlantratamiento"]+"']").addClass('btn-outline-info agregarTratamiento');

		}
	}
})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarTratamiento = [];

localStorage.removeItem("quitarTratamiento");

$(".formularioPago").on("click", "button.quitarTratamiento", function(){

	$(this).parent().parent().parent().parent().remove();

	var idServicio = $(this).attr("idPlantratamiento");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarTratamiento") == null){

		idQuitarTratamiento = [];
	}else{

		idQuitarTratamiento.concat(localStorage.getItem("quitarTratamiento"))
	}

	idQuitarTratamiento.push({"idPlantratamiento":idPlantratamiento});

	localStorage.setItem("quitarTratamiento", JSON.stringify(idQuitarTratamiento));

	$("button.recuperarBoton[idPlantratamiento='"+idPlantratamiento+"']").removeClass('btn-default');

	$("button.recuperarBoton[idPlantratamiento='"+idPlantratamiento+"']").addClass('btn-outline-info agregarTratamiento');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoTotalPago").val(0);
		$("#totalPago").val(0);
		$("#nuevoTotalPago").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios();

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listaTratamiento();
	}
})

// /*=============================================
// SUMAR TODOS LOS PRECIOS
// =============================================*/

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioServicio");
	var arraySumaPrecio = [];

	for(var i = 0; i < precioItem.length; i++){

		arraySumaPrecio.push(Number($(precioItem[i]).val()));
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;
	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

	$("#nuevoTotalPago").val(sumaTotalPrecio);
	$("#totalPago").val(sumaTotalPrecio);
	$("#nuevoTotalPago").attr("total",sumaTotalPrecio);
}

// /*=============================================
// FORMATO AL PRECIO FINAL
// =============================================*/

$("#nuevoTotalPago").number(true, 2);

	/*=============================================
	SELECCIONAR MÉTODO DE PAGO
	=============================================*/

$("#nuevoMetodoPago").change(function(){

	var metodo = $(this).val();

	if(metodo == "Efectivo"){

		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			 '<div class="col-xs-4">'+ 

			 	'<div class="input-group">'+ 

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

			 		'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>'+

			 	'</div>'+

			 '</div>'+

			 '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

			 	'<div class="input-group">'+

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

			 		'<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>'+

			 	'</div>'+

			 '</div>'

		 )

		// Agregar formato al precio

		$('#nuevoValorEfectivo').number( true, 2);
      	$('#nuevoCambioEfectivo').number( true, 2);


      	// Listar método en la entrada
      	listarMetodos()

	}else{

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPago').html(

		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

              '</div>')

	}

	listarMetodos();

})

// /*=============================================
// CAMBIO EN EFECTIVO
// =============================================*/
$(".formularioPago").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio =  Number(efectivo) - Number($('#nuevoTotalPago').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioPago").on("change", "input#nuevoCodigoTransaccion", function(){

	// Listar método en la entrada
     listarMetodos()


})
/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listaTratamiento(){

	var listaTratamiento = [];

	var nombre = $(".nuevaDescripcionProducto");

	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i < nombre.length; i++){

		listaTratamiento.push({ "id" : $(nombre[i]).attr("idPlantratamiento"),
							"id_plan_tratamiento" : $(nombre[i]).val(),
							"monto" : $(precio[i]).attr("precioReal"),
							"total" : $(precio[i]).val()})
	}

	$("#listaTratamiento").val(JSON.stringify(listaTratamiento));
}
/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodos(){

	var listaMetodos = "";

	if($("#nuevoMetodoPago").val() == "Efectivo"){

		$("#listaMetodoPago").val("Efectivo");

	}else{

		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());
	}
}
// /*=============================================
// FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
// =============================================*/

function quitarAgregarTratamiento(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idPlantratamiento = $(".quitarTratamiento");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaPagos tbody button.agregarTratamiento");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idPlantratamiento.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idPlantratamiento[i]).attr("idPlantratamiento");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idPlantratamiento") == boton){

				$(botonesTabla[j]).removeClass("btn-outline-info agregarTratamiento");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}
	}
}
// /*=============================================
// CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
// =============================================*/

$('.tablaPagos').on( 'draw.dt', function(){

	quitarAgregarTratamiento();

})