/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarRazonSocial", function(){

	var idRazonSocial = $(this).attr("idRazonSocial");

	var datos = new FormData();
	datos.append("idRazonSocial", idRazonSocial);

	$.ajax({
		url: "ajax/razonsocial.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
            $("#IdRazonSocial").val(respuesta["id"]);
     		$("#editarNit").val(respuesta["nit"]);
			$("#editarNombreSocial").val(respuesta["nombre"]);
     		

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarRazonSocial", function(){

	var idRazonSocial = $(this).attr("idRazonSocial");

	swal({
		title: '¿Está seguro de borrar la Razon Social?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar Razon Social!'
	}).then(function(result){

		if(result.value){

			window.location = "index.php?ruta=razonsocial&idRazonSocial="+idRazonSocial;

		}

	})

})
/*$(".tablas").on("click", ".btnEliminarRazonSocial", function(){

	var idRazonSocial = $(this).attr("idRazonSocial");

	swal({
		title: '¿Está seguro de borrar la servicio?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar servicio!'
	}).then(function(result){

		if(result.value){

			window.location = "index.php?ruta=razonsocial&idRazonSocial="+idRazonSocial;

		}

	})

})*/