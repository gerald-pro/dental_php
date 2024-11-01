

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    const urlSearchParams = new URLSearchParams(window.location.search);
    const id = urlSearchParams.get("idMedico");
    console.log("El idMedico es..:", id);
    var Calendar = FullCalendar.Calendar;
    //var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

   
    // initialize the external events
    // -----------------------------------------------------------------

    /*new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });*/

    var calendar = new Calendar(calendarEl, {
     
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },

      defaultView: 'agendaWeek',
      businessHours: true,

      themeSystem: 'bootstrap',
      //Random default events

      /*dateClick: function(date,jsEvent,view){
            $("#fechaCita").html(info.dateStr);
            $('#modalAgregarCita').modal();
      },*/

      /* dateClick:function(info){
          $("#fechaCita").html(info.dateStr);
          $("#modalAgregarCita").modal('toggle');
        },
*/


        dateClick: function(calEvent, jsEvent, view) {
          $('#fechaCita').val(moment(calEvent.start).format('YYYY-MM-DD'));
          $('#fechaInicio').val(moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss'));

          $('#horaCita').val(moment(calEvent.start).format('HH:mm:ss'));
          
          $('#modalAgregarCita').modal();
       },

      businessHours: [ // specify an array instead
          {
            daysOfWeek: '1', 
            startTime: '08:00', // 8am
            endTime: '18:00' // 6pm
          },
          {
            daysOfWeek: '2', 
            startTime: '08:00', // 8am
            endTime: '18:00' // 6pm
          },
          {
            daysOfWeek: '3', 
            startTime: '08:00', // 8am
            endTime: '18:00' // 6pm
          }
        ],

        events  : [
        {
          title          : 'All Day Event',
          start          : new Date(y, m, d, 12, 0),
          end            : new Date(y, m, d, 13, 0),
          allDay         : false,
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
        },
        {
          title          : 'Birthday Party',
          start          : new Date(y, m, d + 1, 19, 0),
          end            : new Date(y, m, d + 1, 19, 30),
          allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
        }

      ],         
      eventColor: '#dd6777',
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */


/*
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')



    })

*/