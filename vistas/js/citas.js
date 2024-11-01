$(".formularioFichaEntreFecha").on("click", "button.btnReporteCita", function() {
  var periodo = $("select[name='periodo']").val(); // Obtiene el periodo seleccionado
  var startDate, endDate; // Variables para el rango de fechas
  var calendar = $('#calendar').fullCalendar('getCalendar'); // Suponiendo que el id del FullCalendar es 'calendar'
  
  // Obtener el rango de fechas según el periodo seleccionado
  if (periodo === "dia") {
    startDate = $("#fechaDia").val();
    endDate = $("#fechaDia").val();
  } else if (periodo === "semana") {
    startDate = $("#fechaSemana").val() + "-1"; // Empieza en lunes
    endDate = moment(startDate).add(6, 'days').format('YYYY-MM-DD'); // Termina en domingo
  } else if (periodo === "mes") {
    startDate = $("#fechaMes").val() + "-01"; // Primer día del mes
    endDate = moment(startDate).endOf('month').format('YYYY-MM-DD'); // Último día del mes
  } else if (periodo === "año") {
    startDate = $("#fechaAnio").val() + "-01-01"; // Primer día del año
    endDate = $("#fechaAnio").val() + "-12-31"; // Último día del año
  }

  // Obtener los eventos del calendario dentro del rango seleccionado
  var eventsInRange = calendar.getEvents().filter(function(event) {
    var eventStart = moment(event.start).format('YYYY-MM-DD');
    return eventStart >= startDate && eventStart <= endDate;
  });

  if (eventsInRange.length > 0) {
    // Aquí podrías enviar los eventos al servidor usando AJAX
    var eventData = eventsInRange.map(function(event) {
      return {
        title: event.title,
        start: event.start.format('YYYY-MM-DD HH:mm:ss'),
        end: event.end ? event.end.format('YYYY-MM-DD HH:mm:ss') : null
      };
    });

    $.ajax({
      url: 'extensiones/tcpdf/pdf/generar-reporte-citas.php', // Archivo PHP que generará el PDF
      method: 'POST',
      data: {
        events: eventData,
        periodo: periodo,
        startDate: startDate,
        endDate: endDate
      },
      success: function(response) {
        // Abrir el reporte en una nueva ventana
        window.open(response, "_blank");
      },
      error: function(xhr, status, error) {
        alert("Error al generar el reporte: " + error);
      }
    });
  } else {
    alert("No hay eventos en el rango seleccionado.");
  }
});


/*=============================================
ELIMINAR USUARIO
=============================================*/
$(document).on("click", ".btnEliminarUsuario", function(){

    var idUsuario = $(this).attr("idUsuario");
    var fotoUsuario = $(this).attr("fotoUsuario");
    var usuario = $(this).attr("usuario");
  
    swal({
      title: '¿Está seguro de borrar el usuario?',
      text: "¡Si no lo está puede cancelar la accíón!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar usuario!'
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
  
      }
  
    })
  
  })