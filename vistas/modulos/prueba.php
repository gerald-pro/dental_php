
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Razon Social </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Razon Social</li>
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
        <a href="citas">

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPaciente">
          Agregar Razon Social
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
        </div>

        <div class="card-body">
      
        <table class="table table-bordered table-hover table-striped example2 tablas">
         
        <thead>
         
         <tr>
           

           <th style="width:10px">#</th>
           <th>Nit</th>
           <th>Nombre</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

            $item = null;
            $valor = null;

            $usuarios = ControladorRazonSocial::ctrMostrarRazonSocial($item, $valor);

            foreach ($usuarios as $key => $value){

            echo ' <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["nit"].'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarRazonSocial" idRazonSocial="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarRazonSocial"><i class="fa fa-inverse fa-pencil-alt"></i></button>

                      <button class="btn btn-danger btnEliminarRazonSocial" idRazonSocial="'.$value["id"].'"><i class="fa fa-trash-alt"></i></button>

                     <button class="btn btn-primary btnEditarRazonSocial" idRazonSocial="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarRazonSocial"><i class="fa fa-inverse fas fa-money-check-alt"></i></button>

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
MODAL AGREGAR SERVICIO
======================================-->

<div id="modalAgregarRazonSocial" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" >
          <h5 class="modal-title">Agregar Razon Social</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">
          

            <!-- ENTRADA PARA EL NIT -->
            
            <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="nuevoNit" placeholder="Ingresar nit" required>
                </div>

            </div>

            <!-- ENTRADA PARA LA RAZON SOCIAL-->

             <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-key"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="nuevoNombreSocial" placeholder="Ingresar Razon Social" id="nuevoNombreSocial" required>

                </div>

              </div>

     </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->


        <div class="modal-footer justify-content-end">

          <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Razon Social</button>
        </div>
        <?php

          $crearRazonSocial = new ControladorRazonSocial();
          $crearRazonSocial -> ctrCrearRazonSocial();

        ?>

      </form>
      </div>

    </div>

</div>     

<!--=====================================
MODAL EDITAR SERVICIO
======================================-->

   <div id="modalEditarRazonSocial" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" >
          <h5 class="modal-title">Editar Razon Social</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->


        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NIT -->
            
            <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span> 
                </div>
                  
                  <input type="text" class="form-control input-lg" id="editarNit" name="editarNit" value="" required>
                </div>

            </div>
            <input type="hidden" id="IdRazonSocial" name="IdRazonSocial">

            <!-- ENTRADA PARA EL NOMBRE-->

             <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-key"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="editarNombreSocial"  id="editarNombreSocial" value="" required>

                </div>

              </div>
              </div>

        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->


        <div class="modal-footer">

          <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Razon Social</button>
        </div>
        <?php

          $editarRazonSocial = new ControladorRazonSocial();
          $editarRazonSocial -> ctrEditarRazonSocial();

        ?>

      </form>


    </div>

  </div>

</div>

<?php

  $borrarRazonSocial = new ControladorRazonSocial();
  $borrarRazonSocial-> ctrBorrarRazonSocial();

?>

