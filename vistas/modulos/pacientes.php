<?php
//este codigo verifica que si es secretaria le mande al inicio , restringue que la secretaria cree un plan tratamiento//
if($_SESSION["perfil"] == "Secretaria"){

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
            <h1>Administrar Pacientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Pacientes</li>
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

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPaciente">
                  Agregar Pacientes
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
      
        <table class="table table-bordered table-hover table-striped example2 tablas">
         
        <thead>
         
         <tr>
           

           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Apellido Paterno</th>
           <th>Apellido Materno</th>
           <th>Documentación</th>
           <th>Sexo</th>
           <th>Teléfono</th>
           <th>Email</th>
           <th>Fecha de Nacimiento</th>
           <th>Dirección</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $usuarios = ControladorPacientes::ctrMostrarPacientes($item, $valor);

       foreach ($usuarios as $key => $value){

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["apellidoP"].'</td>
                  <td>'.$value["apellidoM"].'</td>
                  <td>'.$value["documento"].'</td>
                  <td>'.$value["sexo"].'</td>
                  <td>'.$value["telefono"].'</td>
                  <td>'.$value["email"].'</td>
                  <td>'.$value["fechaNacimiento"].'</td>
                  <td>'.$value["direccion"].'</td>
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarPaciente" idPaciente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPaciente"><i class="fa fa-inverse fa-pencil-alt"></i></button>

                      <button class="btn btn-danger btnEliminarPaciente" idPaciente="'.$value["id"].'"><i class="fa fa-trash-alt"></i></button>

                      <button class="btn btn-info btnImprimirFactura" facPaciente="'.$value["id"].'">

                        <i class="fa fa-print"></i>

                      </button>

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
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!--=====================================
MODAL AGREGAR PACIENTE
======================================-->

<div id="modalAgregarPaciente" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" >
          <h5 class="modal-title">Agregar paciente</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">

        <div class="row">
            <div class="col-6">
                <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span> 
              </div>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" 
                onkeypress="return soloLetras(event)" required>
              </div>

          </div>
          <!-- ENTRADA PARA EL APELLIDO PATERNO-->

          <div class="form-group">
              
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span> 
              </div>
                <input type="text" class="form-control input-lg" name="nuevoApellidoP" placeholder="Ingresar Apellido Paterno" id="nuevoApellidoP" 
                onkeypress="return soloLetras(event)" required>

              </div>

            </div>

          <!-- ENTRADA PARA EL APELLIDO MATERNO-->

           <div class="form-group">
            
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span> 
              </div>
                <input type="text" class="form-control input-lg" name="nuevoApellidoM" placeholder="Ingresar Apellido Materno" id="nuevoApellidoM" 
                onkeypress="return soloLetras(event)" required>

              </div>

            </div>

          <!-- ENTRADA PARA LA DOCUMENTACION-->

           <div class="form-group">
            
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-solid fa-id-card"></i></span> 
              </div>
                <input type="text" class="form-control input-lg" maxlength="8" onkeypress="return soloNumeros(event)" oninput="validarLongitud()" 
                name="nuevoDocumentacion" placeholder="Ingresar Documentación/CI" id="nuevoDocumentacion" required>
                
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
                <input type="text" class="form-control input-lg" name="nuevoSexo" placeholder="Ingresar Sexo" id="nuevoSexo" required>

              </div>

            </div>

          <!-- ENTRADA PARA EL TELEFONO-->

           <div class="form-group">
            
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone"></i></span> 
              </div>
                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar el teléfono" id="nuevoTelefono" 
                maxlength="8" onkeypress="return soloNumeros(event)" oninput="validarLongitud()" required>
              </div>

            </div>

          <!-- ENTRADA PARA EL EMAIL-->

           <div class="form-group">
            
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-solid fa-at"></i></span> 
              </div>
                <input type="text" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar el Email" id="nuevoEmail" required>
              </div>

            </div>

          <!-- ENTRADA PARA LA FECHA DE NACIMIENTO-->

           <div class="form-group">
            
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-solid fa-calendar"></i></span> 
              </div>
                <input type="date" class="form-control input-lg" name="nuevoFechaNacimiento" placeholder="Ingresar la fecha nacimiento" id="nuevoFechaNacimiento" 
                onchange="validarFechaNacimientos()" required>
              </div>

            </div>              

          <!-- ENTRADA PARA LA DIRECCION-->

           <div class="form-group">
            
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="nav-icon fas fa-columns"></i></span> 
              </div>
                <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar Dirección" id="nuevoDireccion" required>
              </div>

            </div>            
            </div>
          </div>
          
        </div>
            
        <!--=====================================
        PIE DEL MODAL
        ======================================-->


        <div class="modal-footer justify-content-end">

          <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Paciente</button>
        </div>
        <?php

          $crearPaciente = new ControladorPacientes();
          $crearPaciente -> ctrCrearPacientes();

        ?>

      </form>


    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PACIENTE
======================================-->

<div id="modalEditarPaciente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">

          <h5 class="modal-title">Editar paciente</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span> 
              </div>
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" 
                onkeypress="return soloLetras(event)" required>
             
              </div>

            </div>

             <input type="hidden" id="IdPaciente" name="IdPaciente">
            <!-- ENTRADA PARA EL APELLIDO PATERNO-->

             <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="editarApellidoP" placeholder="Ingresar Apellido Paterno" id="editarApellidoP" 
                  onkeypress="return soloLetras(event)" required>

                </div>

              </div>

            <!-- ENTRADA PARA EL APELLIDO MATERNO-->

             <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="editarApellidoM" placeholder="Ingresar Apellido Materno" id="editarApellidoM" 
                  onkeypress="return soloLetras(event)" required>

                </div>

              </div>

            <!-- ENTRADA PARA LA DOCUMENTACION-->

             <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-solid fa-id-card"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="editarDocumentacion" placeholder="Ingresar Documentación/CI" id="editarDocumentacion" 
                  maxlength="8" onkeypress="return soloNumeros(event)" oninput="validarLongitud()" required>

                </div>

              </div>
            <!-- ENTRADA PARA EL SEXO-->

             <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-solid fa-venus-mars"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="editarSexo" placeholder="Ingresar Sexo" id="editarSexo" required>

                </div>

              </div>

            <!-- ENTRADA PARA EL TELEFONO-->

             <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="editarTelefono" placeholder="Ingresar el teléfono" id="editarTelefono" 
                  maxlength="8" onkeypress="return soloNumeros(event)" oninput="validarLongitud()" required>
                </div>

              </div>

            <!-- ENTRADA PARA EL EMAIL-->

             <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-solid fa-at"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="editarEmail" placeholder="Ingresar el Email" id="editarEmail" required>
                </div>

              </div>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO-->

             <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-solid fa-calendar"></i></span> 
                </div>
                  <input type="date" class="form-control input-lg" name="editarFechaNacimiento" placeholder="Ingresar la fecha nacimiento" id="editarFechaNacimiento" 
                  onchange="validarFechaNacimiento()" required>
                </div>

              </div>              

            <!-- ENTRADA PARA LA DIRECCION-->

             <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="nav-icon fas fa-columns"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="editarDireccion" placeholder="Ingresar Dirección" id="editarDireccion" required>
                </div>

              </div>              

    


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->




        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Paciente</button>

        </div>

       <?php

          $editarPaciente = new ControladorPacientes();
          $editarPaciente -> ctrEditarPacientes();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarPaciente = new ControladorPacientes();
  $borrarPaciente -> ctrBorrarPaciente();

?> 


