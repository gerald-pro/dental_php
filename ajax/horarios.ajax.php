<?php

require_once "../controladores/horarios.controlador.php";
require_once "../modelos/horarios.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxHorarios{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  /*public $idMedico;

  public function ajaxCrearCodigoHorario(){

  	$item = "id_medico";
  	$valor = $this->idMedico;

  	$respuesta = ControladorHorarios::ctrMostrarHorarios($item, $valor);

  	echo json_encode($respuesta);

  }*/
   public $idUsuario;

  public function ajaxCrearCodigoHorario(){

  	$item = "id_medico";
  	$valor = $this->idUsuario;
    $orden = "id";

  	$respuesta = ControladorHorarios::ctrMostrarHorarios($item, $valor, $orden);

  	echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idHorario;

  public function ajaxEditarHorario(){

    $item = "id";
    $valor = $this->idHorario;

    $respuesta = ControladorHorarios::ctrMostrarHorarios($item, $valor);

    echo json_encode($respuesta);

  }

    /*=============================================
        ACTIVAR HORA
        =============================================*/

        public $activarHorario;
        public $activarId;
    
        public function ajaxActivarHorario()
        {
    
            $tabla = "horario";
    
            $item1 = "estado";
            $valor1 = $this->activarHorario;
    
            $item2 = "id";
            $valor2 = $this->activarId;
    
            $respuesta = ModeloHorarios::mdlActualizarHorario($tabla, $item1, $valor1, $item2, $valor2);
        }
    

}




/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/	

if(isset($_POST["id_medico"])){

	$codigoHorario = new AjaxUsuarios();
	$codigoHorario -> idMedico = $_POST["id_medico"];
	$codigoHorario -> ajaxCrearCodigoHorario();

}
/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idHorario"])){

  $editarHorario = new AjaxHorarios();
  $editarHorario -> idHorario = $_POST["idHorario"];
  $editarHorario -> ajaxEditarHorario();

}

/*=============================================
ACTIVAR SERVICIO
=============================================*/

if (isset($_POST["activarHorario"])) {

  $activarServicio = new AjaxHorarios();
  $activarServicio->activarHorario = $_POST["activarHorario"];
  $activarServicio->activarId = $_POST["activarId"];
  $activarServicio->ajaxActivarHorario();
}



