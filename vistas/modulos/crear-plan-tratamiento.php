<?php
//este codigo verifica que si es secretaria le mande al inicio , restringue que la secretaria cree un plan tratamiento//
if ($_SESSION["perfil"] == "Secretaria") {

    echo '<script>
        window.location = "inicio";
    </script>';

    return;
}
?>

<div class="content-wrapper px-4">
    <section class="content-header">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear Plan Tratamiento</li>
        </ol>
        <h1 class="mt-3">Crear Plan Tratamiento</h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- Formulario para creación de plan de tratamiento -->
            <div class="col-lg-5 col-xs-12">
                <div class="card card-success shadow-sm p-3 mb-5 bg-white rounded">
                    <div class="card-header bg-success text-white">
                        <h3 class="card-title">Datos del Plan de Tratamiento</h3>
                    </div>

                    <form role="form" method="post" class="formularioPlantratamiento p-3">
                        <!-- Campo de vendedor o usuario actual -->
                        <div class="form-group">
                            <label>Usuario</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nuevoCajera" value="<?php echo $_SESSION['nombre']; ?>" readonly>
                                <input type="hidden" name="idCajera" value="<?php echo $_SESSION['id']; ?>">
                            </div>
                        </div>

                        <!-- Campo de selección del paciente -->
                        <div class="form-group">
                            <label>Paciente</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-users"></i></span>
                                </div>
                                <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                                    <option selected="selected">Seleccionar Paciente</option>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $clientes = ControladorPacientes::ctrMostrarPacientes($item, $valor);
                                    foreach ($clientes as $key => $value) {
                                        echo '<option value="' . $value['id'] . '">' . $value['nombre'] . ' ' . $value['apellidoP'] . ' ' . $value['apellidoM'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary btn-sm ml-2" data-toggle="modal" data-target="#modalAgregarPaciente" data-dismiss="modal">Agregar Paciente</button>
                                </div>
                            </div>
                        </div>

                        <!-- Sección para añadir servicios -->
                        <div class="form-group">
                            <label>Servicios</label>
                            <div class="nuevoServicio mb-3">
                                <!-- Aquí se añadirán los servicios dinámicamente -->
                            </div>
                            <input type="hidden" id="listaServicios" name="listaServicios">
                        </div>

                        <hr class="mt-4">

                        <!-- Sección de descuento, subtotal y total -->
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label>Descuento</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" min="0" id="nuevoDescuento" name="nuevoDescuento" placeholder="0" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-percent fa-xs "></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label>SubTotal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Bs.</span>
                                    </div>
                                    <input type="text" class="form-control" id="nuevosubTotalPlantratamiento" name="nuevosubTotalPlantratamiento" placeholder="0" readonly required>
                                    <input type="hidden" name="subtotalPlantratamiento" id="subtotalPlantratamiento">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label>Total</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Bs.</span>
                                    </div>
                                    <input type="text" class="form-control" id="nuevoTotalPlantratamiento" name="nuevoTotalPlantratamiento" placeholder="0" readonly required>
                                    <input type="hidden" name="totalPlantratamiento" id="totalPlantratamiento">
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Guardar Tratamiento</button>
                        </div>
                    </form>
                    <?php
                        $guardarVenta = new ControladorPlanTratamiento();
                        $guardarVenta->ctrCrearPlanTratamiento();
                    ?>
                </div>
            </div>

            <!-- Tabla de productos -->
            <div class="col-lg-7 d-none d-lg-block">
                <div class="card card-warning shadow-sm p-3 mb-5 bg-white rounded">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title">Lista de Servicios</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover dt-responsive tablaPlantratamiento">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí irán los datos de los servicios -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!--=====================================
MODAL AGREGAR PACIENTE
======================================-->

<div id="modalAgregarPaciente" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar paciente</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <!-- ENTRADA PARA EL NOMBRE -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoNombre"
                                        placeholder="Ingresar nombre" required>
                                </div>
                            </div>
                            <!-- ENTRADA PARA EL APELLIDO PATERNO-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoApellidoP"
                                        placeholder="Ingresar Apellido Paterno" id="nuevoApellidoP" required>
                                </div>
                            </div>

                            <!-- ENTRADA PARA EL APELLIDO MATERNO-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoApellidoM"
                                        placeholder="Ingresar Apellido Materno" id="nuevoApellidoM" required>
                                </div>
                            </div>

                            <!-- ENTRADA PARA LA DOCUMENTACION-->

                            <div class="form-group">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-solid fa-id-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoDocumentacion"
                                        placeholder="Ingresar Documentación/CI" id="nuevoDocumentacion" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- ENTRADA PARA EL SEXO-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-solid fa-venus-mars"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoSexo"
                                        placeholder="Ingresar Sexo" id="nuevoSexo" required>

                                </div>
                            </div>

                            <!-- ENTRADA PARA EL TELEFONO-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoTelefono"
                                        placeholder="Ingresar el teléfono" id="nuevoTelefono" required>
                                </div>
                            </div>

                            <!-- ENTRADA PARA EL EMAIL-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-solid fa-at"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoEmail"
                                        placeholder="Ingresar el Email" id="nuevoEmail" required>
                                </div>
                            </div>

                            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-solid fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control input-lg" name="nuevoFechaNacimiento"
                                        placeholder="Ingresar la fecha nacimiento" id="nuevoFechaNacimiento" required>
                                </div>
                            </div>

                            <!-- ENTRADA PARA LA DIRECCION-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="nav-icon fas fa-columns"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoDireccion"
                                        placeholder="Ingresar Dirección" id="nuevoDireccion" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Paciente</button>
                </div>

                <?php
                $crearPaciente = new ControladorPacientes();
                $crearPaciente->ctrCrearPacientes();
                ?>
            </form>
        </div>
    </div>
</div>