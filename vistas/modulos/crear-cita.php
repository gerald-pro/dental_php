<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idMedico = $_POST["id_Medico"];
    echo "El ID del médico es: " . $idMedico;
    $idPaciente = $_POST["seleccionarPaciente"];
  
    echo "El ID del paciente seleccionado es: " . htmlspecialchars($idPaciente);
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idSecretaria = $_POST["id_Secretaria"];
    echo "El ID de la secretaria es: " . $idSecretaria;
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <?php

              
             /* $valor_m = $_GET["idMedico"];
              $medico = ControladorMedicos::ctrMostrarMedicos($item_m, $valor_m);*/
             
              $item_m = "id";
              $valor_m = $_GET["idMedico"];
              $medico = ControladorUsuarios::ctrMostrarUsuarios($item_m, $valor_m);
              echo '<h1> Citas del Médico: '. $medico["nombre"].'</h1>';     

             $horariosmedico = ControladorHorarios::ctrMostrarHorariosMedico($valor_m);

              $citasmedico = ControladorCitas::ctrMostrarCitasMedico1($valor_m);

              //include "conexao.php";

              /*$consulta = $conexao->query("SELECT c.id, c.inicio, c.fin, c.id_paciente,  p.nombre FROM citas c, pacientes p WHERE c.id_paciente= p.id and c.id_medico=$valor_m;"); 
*/
             /*$consulta_h = $conexao->query("SELECT id, entrada, salida, dia, estado, id_medico FROM horarios h  WHERE h.id_medico=$valor_m;"); */
            ?>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
        <div class="card-header">
         
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>

        <div class="card-body">
          
        <script>
          $(function () {

              /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
              ele.each(function () {

                // create an Event Object (https://fullcalendar.io/docs/event-object)
                // it doesn't need to have a start or end
                var eventObject = {
                  title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                  zIndex        : 1070,
                  revert        : true, // will cause the event to go back to its
                  revertDuration: 0  //  original position after the drag
                })

              })
            }

            ini_events($('#external-events div.external-event'))
            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear(),
                       started,
                       categoryClass;

            //const urlSearchParams = new URLSearchParams(window.location.search);
           // const id = urlSearchParams.get("idMedico");
            //console.log("El idMedico es..:", id);
            
            var Calendar = FullCalendar.Calendar;
            //var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');
            var initialLocaleCode = 'es';
           
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
              locale: initialLocaleCode,
              headerToolbar: {
                left  : 'prev, next, today',
                center: 'title',
                right : 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
              },


              defaultView: 'agendaWeek',
              businessHours: true,

              themeSystem: 'bootstrap',
              //Random default events


            businessHours: [ // specify an array instead
                <?php
                    foreach ($horariosmedico  as $key => $value){
                        ?>
                        {
                          daysOfWeek: '<?php echo $value['dia']; ?>',  
                          startTime: '<?php echo $value['entrada']; ?>',
                          endTime: '<?php echo $value['salida']; ?>',
                        },<?php
                      }
                    ?>
                ],

                events: [
                    <?php
                     // while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { 
                     foreach ($citasmedico as $key => $value){
                        ?>
                        {
                        id: '<?php echo $value['id']; ?>',
                        title: '<?php echo $value['nombre']; ?>',
                        start: '<?php echo $value['inicio']; ?>',
                        end: '<?php echo $value['fin']; ?>',
                        },<?php
                      }
                    ?>
                   ],           
                backgroundColor: '#f39c12',
                editable  : true,
                droppable : true, // this allows things to be dropped onto the calendar !!!
                drop      : function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                  // if so, remove the element from the "Draggable Events" list
                  info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
                },
                selectable: true,
                selectHelper: true,

               select: function(info) {
                $('#fechaInicio').val(moment(info.start).format('YYYY-MM-DD HH:mm:ss'));
                $('#fechaFin').val(moment(info.end).format('YYYY-MM-DD HH:mm:ss'));
                $('#modalAgregarCita').modal();
                },

                
                
                /*dateClick: function(info) {
                 $('#fechaInicio').val(moment(info.start).format('YYYY-MM-DD HH:mm:ss'));
                 $('#fechaFin').val(moment(info.end).format('YYYY-MM-DD HH:mm:ss'));
                 $('#modalAgregarCita').modal();
                },*/

                eventClick: function(info){
                   var id = info.event.id;
                   eliminarCita(id);
                   //info.event.remove();
                }

            });

            calendar.render();

          });

          ////////////////////////////////////////////////////
          
          document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                
                editable: true,
                eventDrop: function(info) {
                    // Aquí se actualiza la cita arrastrada
                    updateEvent(info.event);
                },
                eventResize: function(info) {
                    // Aquí se actualiza la cita redimensionada
                    updateEvent(info.event);
                }
            });
            calendar.render();
        });

        function updateEvent(event) {
            // Aquí puedes hacer una llamada AJAX para guardar la nueva fecha en tu base de datos
            console.log('Evento actualizado:', event.title, 'Nueva fecha:', event.start);
            // Aquí podrías añadir una llamada AJAX para actualizar la cita en tu servidor
        }
/////////////////////////////////////////////////////////////////////////////////////////////

          
        
          ////////////////////////////////////////////////////////////
            
         function eliminarCita(id){

              var idCita = id;

              swal({
                title: '¿Está seguro de borrar la cita?',
                text: "¡Si no lo está puede cancelar la accíón!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Cancelar',
                  confirmButtonText: 'Si, borrar cita!'
              }).then(function(result){

                if(result.value){
                     //alert(usuario);
                  window.location = "index.php?ruta=citas&idCita="+idCita;

                }

              })
         }   

        </script>
          <div id="calendar"></div>
         <!-- <script src="vistas/js/calendario.js"></script> -->

        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarCita" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" >
          <h5 class="modal-title">Agregar Cita</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">
          

            <!-- ENTRADA PARA EL MEDICO-->
            
            <div class="form-group">
            
                 <input type="hidden" id="id_Medico" name="id_Medico" value="<?php echo $_GET["idMedico"] ?>">
            
            </div>


            <!-- Validación y Entrada para la Secretaria -->
          <?php
         

          if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'Secretaria') {
              // Obtener el ID de la secretaria desde la sesión
              $idSecretaria = $_SESSION["id"];
              echo '<input type="hidden" id="id_Secretaria" name="id_Secretaria" value="' . $idSecretaria . '">';
          }
          ?>

          
            <!-- ENTRADA PARA SELECCIONAR EL PACIENTE-->

            <div class="form-group">
              
              <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-users"></i></span> 
                </div>
                    <select class="form-control select2"  id="seleccionarPaciente" name="seleccionarPaciente" required>

                    <option value="">Seleccionar pacientes</option>

                    <?php

                      $item = null;
                      $valor = null;

                      $pacientes = ControladorPacientes::ctrMostrarPacientes($item, $valor);

                       foreach ($pacientes as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"]." ". $value["apellidoP"]." ". $value["apellidoM"].'</option>';
                         
                       }

                    ?>

                    </select>

              </div>
            </div>

             <div class="form-group">
               <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span> 
                </div>
                <input type="text" class="form-control input-lg" name="fechaInicio" id="fechaInicio" required>
                
               </div>
             </div>
                
             <div class="form-group">
               <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span> 
                </div>
                <input type="text" class="form-control input-lg" name="fechaFin" id="fechaFin" required >
               </div>
             </div>

           

            <!-- ENTRADA PARA SUBIR FOTO -->


     </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer justify-content-end">

          <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Pedir Cita</button>
        </div>
        <?php

          $crearCita = new ControladorCitas();
          $crearCita -> ctrCrearCita();

        ?>

      </form>


    </div>

  </div>

</div>
