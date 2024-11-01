<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar horarios

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio </a></li>

      <li class="active">Administrar horarios</li>

    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">

      <div class="card-header">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarHorario">
          Agregar Horario
        </button>

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

        <table class="table table-bordered table-hover table-striped dt-responsive example2 tablas" width="100%">

          <thead>

            <tr>


              <th style="width:10px">#</th>
              <th>Entrada</th>
              <th>Salida</th>
              <th>Día</th>
              <th>Médico</th>
              <th>Estado</th>
              <th>Acciones</th>

            </tr>

          </thead>
          <tbody>

            <?php

            $item = null;
            $valor = null;

            $usuarios = ControladorHorarios::ctrMostrarHorarios($item, $valor);

            foreach ($usuarios as $key => $value) {


              echo ' <tr>
                    <td>' . ($key + 1) . '</td>
                    <td>' . $value["entrada"] . '</td>
                    <td>' . $value["salida"] . '</td>
                    <td>' . $value["dia"] . '</td>';

              $item = "id";
              $valor = $value["id_medico"];
              $medico = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
              $nomMayus = mb_strtoupper($medico["nombre"], 'UTF-8');

              echo '<td>' . $nomMayus . '</td>';

              if ($value["estado"] != 0) {

                echo '<td><button class="btn btn-sm btn-success btn-xs btnActivarHora" idHorario="' . $value["id"] . '" estadoHorario="0">Activado</button></td>';

              } else {

                echo '<td><button class="btn btn-danger btn-xs btnActivarHora" idHorario="' . $value["id"] . '" estadoHorario="1">Desactivado</button></td>';

              }

              echo '<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarHorario" idHorario="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarHorario"><i class="fa fa-inverse fa-pencil-alt"></i></button>

                      <button class="btn btn-danger btnEliminarHorario" idHorario="' . $value["id"] . '"><i class="fa fa-trash-alt"></i></button>

                    </div>  

                  </td>

                </tr>';
            }


            ?>

          </tbody>


        </table>
      </div>
      <!-- /.card-body -->

    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--=====================================
MODAL AGREGAR HORARIO
======================================-->

<div id="modalAgregarHorario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
          <h5 class="modal-title">Agregar Horario</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">

          <!-- ENTRADA PARA SELECCIONAR MEDICO -->

          <div class="form-group">

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-users"></i></span>
              </div>
              <select class="form-control input-lg" id="nuevaMedico" name="nuevaMedico" required>

                <option value="">Selecionar Medico</option>


                <?php

                $item = null;
                $valor = null;

                $pacientes = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                foreach ($pacientes as $key => $value) {

                  echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                  //echo '<option value="1"> fsg </option>';
                }

                ?>

              </select>

            </div>

          </div>

          <!-- ENTRADA PARA LA ENTRADA -->

          <div class="form-group">

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="time" class="form-control input-lg" name="nuevaEntrada" required>
            </div>

          </div>

          <!-- ENTRADA PARA LA SALIDA -->

          <div class="form-group">

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-key"></i></span>
              </div>
              <input type="time" class="form-control input-lg" name="nuevaSalida" id="nuevaSalida" required>

            </div>

          </div>
          <!-- ENTRADA PARA LA DIA -->

          <div class="form-group">

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-key"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoDia" id="nuevoDia" required>

            </div>

          </div>

        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->


        <div class="modal-footer justify-content-end">

          <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Horario</button>
        </div>
        <?php

        $crearHorario = new ControladorHorarios();
        $crearHorario->ctrCrearHorario();

        ?>

      </form>
    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SERVICIO
======================================-->

<div id="modalEditarHorario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
          <h5 class="modal-title">Editar Horario</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->


        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR MEDICO -->

            <div class="form-group">

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-users"></i></span>
                </div>
                <select class="form-control input-lg" name="editarMedico" readonly>

                  <option value="" id="editarMedico">Selecionar medico</option>

                </select>

              </div>

            </div>



            <!-- ENTRADA PARA LA ENTRADA -->

            <div class="form-group">

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" class="form-control input-lg" id="editarEntrada" name="editarEntrada" value=""
                  required>
                <input type="hidden" id="IdHorario" name="IdHorario">
              </div>

            </div>


            <!-- ENTRADA PARA EL SALIDA -->

            <div class="form-group">

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-key"></i></span>
                </div>
                <input type="text" class="form-control input-lg" name="editarSalida" id="editarSalida" required>

              </div>
            </div>
            <!-- ENTRADA PARA EL DIA -->

            <div class="form-group">

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-key"></i></span>
                </div>
                <input type="text" class="form-control input-lg" name="editarDia" id="editarDia" required>

              </div>

            </div>


          </div>

        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->


        <div class="modal-footer">

          <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Horario</button>
        </div>
        <?php

        $editarHorario = new ControladorHorarios();
        $editarHorario->ctrEditarHorario();

        ?>

      </form>


    </div>

  </div>

</div>

<?php

$borrarHorario = new ControladorHorarios();
$borrarHorario->ctrBorrarHorario();

?>