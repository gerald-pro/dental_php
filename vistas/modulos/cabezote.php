  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->       
           <li class="dropdown user user-menu">
               

          <a href="#" class="dropdown-toggle" data-toggle="dropdown">

          <?php

          if($_SESSION["foto"] != ""){

            echo '<img src="'.$_SESSION["foto"].'" class="user-image">';

          }else{


            echo '<img src="vistas/img/usuarios/191.jpg" class="user-image">';

          }


          ?>
            
            <span class="hidden-xs"><?php  echo $_SESSION["nombre"]; ?></span>

          </a>

               
             <ul class="dropdown-menu">
              <li class="user-body">
                <div class="pull-right">
                  <a href="salir" class="btn btn-default btn-flat">Cerrar</a>

                </div>
              </li>
             </ul>

           </li>
       


    </ul>
  </nav>
  <!-- /.navbar -->