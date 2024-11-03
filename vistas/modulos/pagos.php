<div class="content-wrapper">
  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Pagos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Pagos</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPago">
          Agregar Pago
        </button>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover table-striped example2">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>ID</th>
              <th>Paciente</th>
              <th>Razón Social</th>
              <th>Secretaria</th>
              <th>Monto</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $pagos = ControladorPagos::ctrMostrarPagos();
            foreach ($pagos as $key => $pago) {
              echo '<tr>
                        <td>' . ($key + 1) . '</td>
                        <td>' . $pago["id"] . '</td>
                        <td>' . $pago["paciente"] . '</td>
                        <td>' . $pago["razon_social"] . '</td>
                        <td>' . $pago["secretaria"] . '</td>
                        <td>' . $pago["monto"] . '</td>
                        <td>' . date_format(date_create($pago["fecha"]), "d/m/Y H:i") . '</td>' .
                '<td>
                          <button class="btn btn-info btnVerPago btn-sm" data-toggle="modal" data-target="#modalVerPago" data-id="' . $pago["id"] . '">
                              <i class="fas fa-eye"></i>
                          </button>
                            <button class="btn btn-danger btnEliminarPago btn-sm" data-id="' . $pago["id"] . '"><i class="fas fa-trash"></i></button>
                        
                        </td>
                    </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<!-- Modal para agregar un nuevo pago -->
<div class="modal fade" id="modalAgregarPago" tabindex="-1" role="dialog" aria-labelledby="modalAgregarPagoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" id="formAgregarPago">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAgregarPagoLabel">Agregar Nuevo Pago</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="id_paciente">Paciente</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <select class="form-control" name="id_paciente" id="id_paciente" required>
                  <option value="">Seleccione una opción</option>
                  <?php
                  $pacientes = ControladorPacientes::ctrMostrarPacientes(null, null);
                  foreach ($pacientes as $paciente) {
                    echo '<option value="' . $paciente["id"] . '">' . $paciente["nombre"] . ' ' . $paciente["apellidoP"] . ' ' . $paciente["apellidoM"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label for="id_razonsocial">Razón Social</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-building"></i></span>
                </div>
                <select class="form-control" name="id_razonsocial" id="id_razonsocial">
                  <option value="">Seleccione una opción</option>
                  <?php
                  $razonesSociales = ControladorRazonSocial::listar();
                  foreach ($razonesSociales as $razonSocial) {
                    echo '<option value="' . $razonSocial["id"] . '">' . $razonSocial["nombre"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="id_plan_tratamiento">Plan de Tratamiento</label>
            <select class="form-control" name="id_plan_tratamiento" id="id_plan_tratamiento" required>
              <option value="">Seleccione una opción</option>
            </select>
          </div>

          <div class="form-group">
            <label for="id_secretaria">Secretaria</label>
            <select class="form-control" name="id_secretaria" required>
              <option value="">Seleccione una opción</option>
              <?php
              $secretarias = ControladorUsuarios::ctrMostrarSecretarias();
              foreach ($secretarias as $secretaria) {
                echo '<option value="' . $secretaria["id"] . '">' . $secretaria["nombre"] . '</option>';
              }
              ?>
            </select>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="costoPlan">Costo Total del Plan</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                </div>
                <input type="number" class="form-control" id="costoPlan" name="costoPlan" readonly>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label for="saldoPlan">Saldo Pendiente</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                </div>
                <input type="number" class="form-control" id="saldoPlan" name="saldoPlan" readonly>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="monto">Monto</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
              </div>
              <input type="number" class="form-control" name="monto" id="monto" required min="1">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Pago</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>

        <?php
        $registro = new ControladorPagos();
        $registro->crear();
        ?>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalVerPago" tabindex="-1" role="dialog" aria-labelledby="modalVerPagoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalVerPagoLabel">Detalles del Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">
            <div class="form-group col">
              <label for="detallePaciente">Paciente</label>
              <input type="text" class="form-control" id="detallePaciente" readonly>
            </div>
            <div class="form-group col">
              <label for="detalleRazonSocial">Razón Social</label>
              <input type="text" class="form-control" id="detalleRazonSocial" readonly>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col">
              <label for="detallePlan">Plan de tratamiento</label>
              <input type="number" class="form-control" id="detallePlan" readonly>
            </div>
            <div class="form-group col">
              <label for="detalleSecretaria">Secretaria</label>
              <input type="text" class="form-control" id="detalleSecretaria" readonly>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col">
              <label for="detalleMonto">Monto (Bs)</label>
              <input type="number" class="form-control" id="detalleMonto" readonly>
            </div>
            <div class="form-group col">
              <label for="detalleFecha">Fecha</label>
              <input type="text" class="form-control" id="detalleFecha" readonly>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>