/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

//$.ajax({

//	url: "ajax/datatable-servicios.ajax.php",
//	success:function(respuesta){
		
		//console.log("respuesta", respuesta);

//	}

//})

//var perfilOculto = $("#perfilOculto").val();

$('.tablaServicio').DataTable( {
    "ajax": "ajax/datatable-servicios.ajax.php",
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
validacion de solo ingreso de numeros 
=============================================*/
function soloNumeros(e) {
    var key = e.charCode || e.keyCode || 0;
    // Solo permitir números (códigos de teclas 48 a 57) y teclas de control como retroceso (8)
    return (key >= 48 && key <= 57) || key == 8;
}

function validarLongitud() {
    var input = document.getElementById('numero');
    if (input.value.length > 8) {
        input.value = input.value.slice(0, 5); // Limita el valor a 8 caracteres
    }
}
/*=============================================
validacion de solo ingreso de Letras
=============================================*/
function soloLetras(e) {
    var key = e.charCode || e.keyCode || 0;
    return (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || key == 8;
}
/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablaServicio").on("click", ".btnEditarServicio", function(){

	var idServicio = $(this).attr("idServicio");

	var datos = new FormData();
	datos.append("idServicio", idServicio);

	$.ajax({
		url: "ajax/servicios.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
            $("#IdServicio").val(respuesta["id"]);
     		$("#editarNombreServicio").val(respuesta["nombre"]);
			$("#editarPrecio").val(respuesta["precio"]);
     		

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablaServicio").on("click", ".btnEliminarServicio", function(){

	 var idServicio = $(this).attr("idServicio");

	 
	 swal({
	 	title: '¿Está seguro de borrar el servicio?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar servicio!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=servicios&idServicio="+idServicio;

	 	}

	 })

})