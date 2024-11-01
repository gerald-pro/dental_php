/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })// 

$('.tablaPlantratamiento').DataTable( {
    "ajax": "ajax/datatable-plantratamiento.ajax.php",
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
AGREGANDO SERVICIOS DESDE LA TABLA DINAMICA 
=============================================*/

$(".tablaPlantratamiento tbody").on("click", "button.agregarServicio", function(){

	var idServicio = $(this).attr("idServicio");

	$(this).removeClass("btn-primary agregarServicio");

	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idServicio", idServicio);

     $.ajax({

     	url:"ajax/servicios.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      	    var nombre = respuesta["nombre"];
			var stock = respuesta["stock"];
          	var precio = respuesta["precio"];

			/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

				swal({
				title: "No hay stock disponible",
				type: "error",
				confirmButtonText: "¡Cerrar!"
			  });

			  $("button[idServicio='"+idServicio+"']").addClass("btn-primary agregarServicio");

			  return;

			}

          	$(".nuevoServicio").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- nombre del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarServicio" idServicio="'+idServicio+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaNombreServicio" idServicio="'+idServicio+'" name="agregarServicio" value="'+nombre+'" readonly required>'+

	            '</div>'+

	          '</div>'+
			  '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3">'+
	            
	             '<input type="number" class="form-control nuevaCantidadServicio" name="nuevaCantidadServicio" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

	          '</div>' +

	          '<!-- Precio del servicio -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><b>Bs.</b></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioServicio" precioReal="'+precio+'" name="nuevoPrecioServicio" value="'+precio+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>') 

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPrecios()

	        // AGREGAR IMPUESTO// esto hay q cambiarlo

	        agregarDescuento()

	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarServicios()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioServicio").number(true, 2);


			localStorage.removeItem("quitarServicio");

      	}

     })

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaPlantratamiento").on("draw.dt", function(){

	if(localStorage.getItem("quitarServicio") != null){

		var listaIdServicio = JSON.parse(localStorage.getItem("quitarServicio"));

		for(var i = 0; i < listaIdServicio.length; i++){

			$("button.recuperarBoton[idServicio='"+listaIdServicio[i]["idServicio"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idServicio='"+listaIdServicio[i]["idServicio"]+"']").addClass('btn-primary agregarServicio');

		}


	}


})


/*=============================================
QUITAR SERVICIOS Y RECUPERAR BOTÓN
=============================================*/

var idQuitarServicio = [];

localStorage.removeItem("quitarServicio");

$(".formularioPlantratamiento").on("click", "button.quitarServicio", function(){

	$(this).parent().parent().parent().parent().remove();

	var idServicio = $(this).attr("idServicio");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarServicio") == null){

		idQuitarServicio = [];
	
	}else{

		idQuitarServicio.concat(localStorage.getItem("quitarServicio"))

	}

	idQuitarServicio.push({"idServicio":idServicio});

	localStorage.setItem("quitarServicio", JSON.stringify(idQuitarServicio));

	$("button.recuperarBoton[idServicio='"+idServicio+"']").removeClass('btn-default');//modifique aqui hoy

	$("button.recuperarBoton[idServicio='"+idServicio+"']").addClass('btn-primary agregarServicio');

	if($(".nuevoServicio").children().length == 0){

		$("#nuevoDescuento").val(0);
		$("#nuevoTotalPlantratamiento").val(0);
		$("#nuevosubTotalPlantratamiento").val(0);
		$("#totalPlantratamiento").val(0);
		$("#nuevoTotalPlantratamiento").attr("total",0);//pone el cuadro de los precios en 0
		$("#nuevosubTotalPlantratamiento").attr("subtotal",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()

    	// AGREGAR IMPUESTO
	        
        agregarDescuento()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarServicios()

	}

})

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/



/*=============================================
SELECCIONAR SERVICIO
=============================================*/

$(".formularioPlantratamiento").on("change", "select.nuevaNombreServicio", function(){

	var nombreServicio = $(this).val();

	var nuevaNombreServicio = $(this).parent().parent().parent().children().children().children(".nuevaNombreServicio");

	var nuevoPrecioServicio = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioServicio");

    var nuevaCantidadServicio = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadServicio");
	
	var datos = new FormData();
    datos.append("nombreServicio", nombreServicio);


	  $.ajax({

     	url:"ajax/servicios.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    
      	     $(nuevaNombreServicio).attr("idServicio", respuesta["id"]);
			$(nuevaCantidadServicio).attr("stock", respuesta["stock"]);
			$(nuevaCantidadServicio).attr("nuevoStock", Number(respuesta["stock"])-1);
      	    $(nuevoPrecioServicio).val(respuesta["precio_servicio"]);
      	    $(nuevoPrecioServicio).attr("precioReal", respuesta["precio_servicio"]);

  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarServicios()
			$(listaServicios).val(listarServicios());
      	}

      })
})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioPlantratamiento").on("change", "input.nuevaCantidadServicio", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioServicio");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(1);

		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

		sumarTotalPrecios();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}


	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO
	        
    agregarDescuento()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarServicios()

}) 

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

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
	
	$("#nuevosubTotalPlantratamiento").val(sumaTotalPrecio);//esto nos muestra el precio real sin un descuento//
	$("#nuevoTotalPlantratamiento").val(sumaTotalPrecio);//y esto nos muestra el total con descuento //
	$("#subtotalPlantratamiento").val(sumaTotalPrecio);
	$("#totalPlantratamiento").val(sumaTotalPrecio);
	$("#nuevosubTotalPlantratamiento").attr("subtotal",sumaTotalPrecio);
	$("#nuevoTotalPlantratamiento").attr("total",sumaTotalPrecio);


}

/*=============================================
FUNCIÓN AGREGAR Descuento
=============================================*/

function agregarDescuento() {
    // Obtenemos los valores del descuento y el precio total
    var descuento = $("#nuevoDescuento").val();
    var precioTotal = $("#nuevoTotalPlantratamiento").attr("total");

    // Mostramos el precio original (subtotal)
    var subtotal = Number(precioTotal);
    $("#subtotalPlantratamiento").val(subtotal);

    // Calculamos el precio después del descuento
    var precioDescuento = Number(precioTotal * descuento / 100);
    var precioConDescuento = Number(precioTotal) - precioDescuento;

    // Actualizamos los valores en los elementos correspondientes
    $("#nuevoTotalPlantratamiento").val(precioConDescuento);
    $("#totalPlantratamiento").val(precioConDescuento);
	$("#nuevoPrecioDescuento").val(precioDescuento);
    $("#nuevoPrecioNeto").val(precioTotal);
}


/*=============================================
CUANDO CAMBIA EL DESCUENTO
=============================================*/

$("#nuevoDescuento").change(function(){

	agregarDescuento();

});

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalPlantratamiento").number(true, 2);

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

	

})

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioPlantratamiento").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio =  Number(efectivo) - Number($('#nuevoTotalPlantratamiento').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioPlantratamiento").on("change", "input#nuevoCodigoTransaccion", function(){

	// Listar método en la entrada
     listarMetodos()


})


/*=============================================
LISTAR TODOS LOS PRODUCTOS
============================================= modificaciones aqui*/ 

function listarServicios(){

	var listaServicios = [];

	var nombre = $(".nuevaNombreServicio");

	var cantidad = $(".nuevaCantidadServicio");

	var precio = $(".nuevoPrecioServicio");

	for(var i = 0; i < nombre.length; i++){

		listaServicios.push({ "id" : $(nombre[i]).attr("idServicio"), 
							  "nombre" : $(nombre[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()
							 })

	}

	$("#listaServicios").val(JSON.stringify(listaServicios)); 

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

/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarPlantratamiento", function(){

	var idPlantratamiento = $(this).attr("idPlantratamiento");

	window.location = "index.php?ruta=editar-venta&idVenta="+idPlantratamiento;


})

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarServicio(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idServicios = $(".quitarServicio");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaPlantratamiento tbody button.agregarServicio");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idServicios.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idServicios[i]).attr("idServicio");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idServicio") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarServicio");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaPlantratamiento').on( 'draw.dt', function(){

	quitarAgregarServicio();

})


/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarPlantratamiento", function(){

  var idPlantratamiento = $(this).attr("idPlantratamiento");

  swal({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=Plantratamiento&idPlantratamiento="+idPlantratamiento;
        }

  })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirFactura", function(){

	var codigoVenta = $(this).attr("codigoVenta");

	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");

})

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		// if(mes < 10){

		// 	var fechaInicial = año+"-0"+mes+"-"+dia;
		// 	var fechaFinal = año+"-0"+mes+"-"+dia;

		// }else if(dia < 10){

		// 	var fechaInicial = año+"-"+mes+"-0"+dia;
		// 	var fechaFinal = año+"-"+mes+"-0"+dia;

		// }else if(mes < 10 && dia < 10){

		// 	var fechaInicial = año+"-0"+mes+"-0"+dia;
		// 	var fechaFinal = año+"-0"+mes+"-0"+dia;

		// }else{

		// 	var fechaInicial = año+"-"+mes+"-"+dia;
	 //    	var fechaFinal = año+"-"+mes+"-"+dia;

		// }

		dia = ("0"+dia).slice(-2);
		mes = ("0"+mes).slice(-2);

		var fechaInicial = año+"-"+mes+"-"+dia;
		var fechaFinal = año+"-"+mes+"-"+dia;	

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})

/*=============================================
ABRIR ARCHIVO XML EN NUEVA PESTAÑA
=============================================*/

$(".abrirXML").click(function(){

	var archivo = $(this).attr("archivo");
	window.open(archivo, "_blank");


})


