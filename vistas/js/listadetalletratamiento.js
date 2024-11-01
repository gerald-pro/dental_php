$(document).ready(function () {
    // Inicializar la DataTable para los detalles de las compras
    if ($.fn.DataTable.isDataTable("#tablaListaDetalleTratamiento")) {
        $("#tablaListaDetalleTratamiento").DataTable().destroy();
    }
  
    var tablaListaDetalleCompras = $("#tablaListaDetalleTratamiento").DataTable({
        ajax: "ajax/datatable-detalle-plantratamiento.ajax.php",
        deferRender: true,
        retrieve: true,
        processing: true,
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar MENU registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando registros del START al END de un total de TOTAL",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
            sInfoFiltered: "(filtrado de un total de MAX registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            oAria: {
                sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                sSortDescending: ": Activar para ordenar la columna de manera descendente",
            },
        },
        columns: [
            { data: "numero", className: "text-center" },
            { data: "id_servicio", className: "text-center" },
            { data: "precio", className: "text-center" },
            { data: "cantidad", className: "text-center" },
            { data: "acciones", className: "text-center" },
            
        ],
        destroy: true, // Asegura la destrucción previa de la tabla
    });
  
    // Manejar la apertura del modal de edición
    $('#tablaListaDetalleCompras tbody').on('click', 'button.btnEditarCompra', function () {
        var idCompra = $(this).attr("idCompra");
        // Lógica para cargar datos de la compra en el modal
        $('#modalEditarCompra').modal('show');
    });
  
    // Manejar la eliminación de la compra
    $('#tablaListaDetalleCompras tbody').on('click', 'button.btnEliminarCompra', function () {
        var idCompra = $(this).attr("idCompra");
        // Lógica para eliminar la compra
    });
  });