$('.example2').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,

    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
});


$(document).on("click", ".btnDetallePlan", function () {
    var idPlan = $(this).data("id");

    $.ajax({
        url: "ajax/planTratamiento.ajax.php",
        method: "POST",
        data: { idPlanServicios: idPlan },
        dataType: "json",
        success: function (response) {
            $("#tablaServicios tbody").html("");

            $("#inputMedico").val(response.medico);
            $("#inputPaciente").val(response.paciente);

            var tableContent = ``;

            if (response.servicios.length > 0) {
                response.servicios.forEach(function (item) {
                    tableContent += `
                    <tr>
                        <td>${item.nombre}</td>
                        <td>${item.cantidad}</td>
                        <td>${item.precio}</td>
                        <td>${item.cantidad * item.precio}</td>
                    </tr>
                `;
                });
            } else {
                tableContent += `
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron registros</td>
                    </tr>
                `;
            }

            $("#tablaServicios tbody").html(tableContent);
        },
        error: function (error) {
            console.error("Error al obtener el detalle del plan:", error);
            $("#tablaServicios tbody").html("<p class='text-danger'>No se pudo cargar el detalle del plan.</p>");
        }
    });
});

// Evento click para el botón "Pagos"
$(document).on("click", ".btnPagosPlan", function () {
    var idPlan = $(this).data("id"); // Obtenemos el ID del plan

    $.ajax({
        url: "ajax/planTratamiento.ajax.php",
        method: "POST",
        data: { idPlanPagos: idPlan },
        dataType: "json",
        success: function (response) {
            console.log(response);
            
            $("#tablaPagos tbody").html("");
            var pagosContent = ``;

            $("#inputPacientePago").val(response.paciente);
            $("#inputMedicoPago").val(response.medico);
            $("#inputCostoTotal").val(response.total);
            $("#inputSaldoPendiente").val(response.saldo_pendiente);

            if (response.pagos.length > 0) {
                response.pagos.forEach(function (pago) {
                    pagosContent += `
                        <tr>
                            <td>${pago.fecha}</td>
                            <td>${pago.monto}</td>
                        </tr>
                    `;
                });
            } else {
                pagosContent += `
                <tr>
                    <td colspan="3" class="text-center">No se encontraron registros</td>
                </tr>
            `;
            }

            $("#tablaPagos tbody").html(pagosContent);
        },
        error: function (error) {
            console.error("Error al obtener los pagos del plan:", error);
            $("#tablaPagos body").html("<p class='text-danger'>No se pudo cargar la información de pagos.</p>");
        }
    });
});


$(document).on("click", ".btnEliminarPlan", function () {
	let idPlan = $(this).data("id");

	// Confirmar antes de eliminar
	swal({
		title: "¿Estás seguro?",
		text: "Esta acción no se puede deshacer",
		icon: "warning",
		buttons: ["Cancelar", "Eliminar"],
		dangerMode: true,
	}).then(function (result) {
		console.log(result.value);

		if (result.value) {
			$.ajax({
				url: "ajax/planTratamiento.ajax.php",
				method: "POST",
				data: { idPlan: idPlan, delete: true },
				success: function (response) {

					swal({
						type: "success",
						title: "El plan de tratamiento ha sido borrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if (result.value) {
							window.location = "plantratamiento";
						}
					})

				},
				error: function () {
					swal("Error de comunicación con el servidor", {
						icon: "error",
					});
				},
			});
		}
	});
});


function obtenerDatos(idPlan) {
    $.ajax({
        url: "ajax/planTratamiento.ajax.php",
        method: "POST",
        data: { idPlan: idPlan },
        dataType: "json",
        success: function (response) {
            console.log(response);
            
            if (response) {
                $("#inputMedico").val(response.medico);
                $("#inputPaciente").val(response.paciente);
            }
        },
        error: function (error) {
            console.error("Error al obtener datos del plan:", error);
        }
    });
}