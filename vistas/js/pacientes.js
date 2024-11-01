/*=============================================
REVISAR SI EL PACIENTE YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoNombre").change(function(){

	$(".alert").remove();

	var paciente = $(this).val();

	var datos = new FormData();
	datos.append("validarPaciente", paciente);

	 $.ajax({
	    url:"ajax/pacientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoNombre").parent().after('<div class="alert alert-warning">Este paciente ya existe en la base de datos</div>');

	    		$("#nuevoNombre").val("");

	    	}

	    }

	})
})
/*=============================================
validacion de solo ingreso de numeros en C.I y TLF
=============================================*/
function soloNumeros(e) {
    var key = e.charCode || e.keyCode || 0;
    // Solo permitir números (códigos de teclas 48 a 57) y teclas de control como retroceso (8)
    return (key >= 48 && key <= 57) || key == 8;
}

function validarLongitud() {
    var input = document.getElementById('numero');
    if (input.value.length > 8) {
        input.value = input.value.slice(0, 8); // Limita el valor a 8 caracteres
    }
}
/*=============================================
validacion de solo ingreso de Letras
=============================================*/
function soloLetras(e) {
    var key = e.charCode || e.keyCode || 0;
    return (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || key == 8 || key == 32;
}
/*=============================================
validacion de fecha de nacimiento
=============================================*/
function validarFechaNacimientos() {
    const fechaIngresada = new Date(document.getElementById('nuevoFechaNacimiento').value);
    const anioIngresado = fechaIngresada.getFullYear();
    const anioActual = new Date().getFullYear();

    // Validar si el año ingresado es mayor que el año actual
    if (anioIngresado > anioActual) {
            // Muestra la alerta estilizada con SweetAlert
            swal({
                title: 'Error en la Fecha',
                text: 'El Año de la Fecha de Nacimiento no puede ser mayor que el Año Actual.',
                type: 'error',
                showCancelButton: true,
                cancelButtonColor: '#d33',  // Esto le da el color rojo al botón
                cancelButtonText: 'Cerrar',
                showConfirmButton: false
            })
            document.getElementById('nuevoFechaNacimiento').value = ""; // Limpia el campo si se presiona el botón "Cerrar"
                
        }
    }
function validarFechaNacimiento() {
    const fechaIngresada = new Date(document.getElementById('editarFechaNacimiento').value);
    const anioIngresado = fechaIngresada.getFullYear();
    const anioActual = new Date().getFullYear();

    // Validar si el año ingresado es mayor que el año actual
    if (anioIngresado > anioActual) {
            // Muestra la alerta estilizada con SweetAlert
            swal({
                title: 'Error en la Fecha',
                text: 'El Año de la Fecha de Nacimiento no puede ser mayor que el Año Actual.',
                type: 'error',
                showCancelButton: true,
                cancelButtonColor: '#d33',  // Esto le da el color rojo al botón
                cancelButtonText: 'Cerrar',
                showConfirmButton: false
            })
            document.getElementById('editarFechaNacimiento').value = ""; // Limpia el campo si la fecha es inválida
        }
    }
/*=============================================
EDITAR PACIENTES
=============================================*/

$(".tablas").on("click", ".btnEditarPaciente", function(){
    
    //alert("ok") 
    var idPaciente = $(this).attr("idPaciente");
    //alert(idPaciente)
    var datos = new FormData();
    datos.append("idPaciente", idPaciente);

    $.ajax({
        url: "ajax/pacientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
             $("#IdPaciente").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["nombre"]);
             $("#editarApellidoP").val(respuesta["apellidoP"]);
             $("#editarApellidoM").val(respuesta["apellidoM"]);
             $("#editarDocumentacion").val(respuesta["documento"]);
             $("#editarSexo").val(respuesta["sexo"]);
             $("#editarTelefono").val(respuesta["telefono"]);
             $("#editarEmail").val(respuesta["email"]);
             $("#editarFechaNacimiento").val(respuesta["fecha"]);
             $("#editarDireccion").val(respuesta["direccion"]);

        }

    })

})

/*=============================================
ELIMINAR PACIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarPaciente", function(){

    var idPaciente = $(this).attr("idPaciente");
    
    swal({
        title: '¿Está seguro de borrar el paciente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar paciente!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=pacientes&idPaciente="+idPaciente;

        }

    })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".formularioReporteNacimiento").on("click", "button.btnReporteNacimiento", function(){

    var fechaInicio = $("#fechaNacimientoInicio").val();
    var fechaFin = $("#fechaNacimientoFin").val();

	  window.open("extensiones/tcpdf/pdf/reporte_pacientes.php?fechaNacimiento="+fechaInicio+"&fechaNacimiento="+fechaFin, "_blank");
    
    // window.open("extensiones/tcpdf/pdf/pago-rango-fecha.php", "_blank");
    
})	
/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirFactura", function(){

	
    var facPaciente = $(this).attr("facPaciente");

	window.open("extensiones/tcpdf/pdf/factura.php?id="+facPaciente, "_blank");

})