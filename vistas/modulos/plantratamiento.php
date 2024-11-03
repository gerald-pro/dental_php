<?php
//este codigo verifica que si es secretaria le mande al inicio , restringue que la secretaria cree un plan tratamiento//
if ($_SESSION["perfil"] == "Secretaria") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Plan Tratamiento </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Plan Tratamiento</li>
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
        <a href="crear-plan-tratamiento">

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPaciente">
            Agregar Plan Tratamiento
          </button>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
        </a>
      </div>

      <div class="card-body">

        <table class="table table-bordered table-hover table-striped example2 tablas">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Paciente</th>
              <th>Descuento</th>
              <th>SubTotal</th>
              <th>Total</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $item = null;
            $valor = null;

            $respuesta = ControladorPlanTratamiento::ctrMostrarPlanTratamiento($item, $valor);

            foreach ($respuesta as $key => $value) {

              echo '<tr>

                        <td>' . ($key + 1) . '</td>';

              $itemUsuario = "id";
              $valorUsuario = $value["id_paciente"];

              $respuestaPaciente = ControladorPacientes::ctrMostrarPacientes($itemUsuario, $valorUsuario);

              echo '<td>' . $respuestaPaciente["nombre"] . ' ' . $respuestaPaciente["apellidoP"] . ' ' . $respuestaPaciente["apellidoM"] . '</td>';
              echo '<td>' . $value["descuento"] . "%" . '</td>';
              echo '<td>' . $value["subtotal"] . '</td>';
              echo '<td>' . $value["total"] . '</td>';

              echo '<td>
                      <button class="btn btn-info btn-sm btnDetallePlan" data-toggle="modal" data-target="#modalDetallePlan" data-id="' . $value["id"] . '">
                        <i class="fas fa-eye"></i> Detalle
                      </button>
                      <button class="btn btn-success btn-sm btnPagosPlan" data-toggle="modal" data-target="#modalPagosPlan" data-id="' . $value["id"] . '">
                        <i class="fas fa-dollar-sign"></i> Pagos
                      </button>
                      <button class="btn btn-danger btn-sm btnEliminarPlan" data-id="' . $value["id"] . '">
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>';

              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="modalDetallePlan" tabindex="-1" role="dialog" aria-labelledby="detallePlanLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detallePlanLabel">Detalle del Plan de Tratamiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="colmb-3">
            <label>Usuario</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input class="form-control" name="paciente" id="inputPaciente" readonly>
            </div>
          </div>

          <div class="col mb-3">
            <label>Médico</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user-md" aria-hidden="true"></i></span>
              </div>
              <input class="form-control" name="medico" id="inputMedico" readonly>
            </div>
          </div>
        </div>

        <hr>

        <table class="table table-bordered table-sm" id="tablaServicios">
          <thead>
            <tr>
              <th>Servicio</th>
              <th>Cantidad</th>
              <th>Precio (Bs)</th>
              <th>Total (Bs)</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Pagos -->
<div class="modal fade" id="modalPagosPlan" tabindex="-1" role="dialog" aria-labelledby="pagosPlanLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pagosPlanLabel">Pagos del Plan de Tratamiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="colmb-3">
            <label>Usuario</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input class="form-control" name="paciente" id="inputPacientePago" readonly>
            </div>
          </div>

          <div class="col mb-3">
            <label>Médico</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user-md" aria-hidden="true"></i></span>
              </div>
              <input class="form-control" name="medico" id="inputMedicoPago" readonly>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="colmb-3">
            <label>Costo total</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Bs</span>
              </div>
              <input class="form-control" name="paciente" id="inputCostoTotal" readonly>
            </div>
          </div>

          <div class="col mb-3">
            <label>Saldo pendiente</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Bs</span>
              </div>
              <input class="form-control" name="medico" id="inputSaldoPendiente" readonly>
            </div>
          </div>
        </div>

        <hr>

        <table class="table table-sm table-bordered" id="tablaPagos">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Monto</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>