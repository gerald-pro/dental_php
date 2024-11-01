<?php

require_once "conexion.php";

class ModeloHorarios
{
    /*=============================================
	MOSTRAR SERVICIO
	=============================================*/

    static public function mdlMostrarHorarios($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM horario");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }
        

        $stmt -> close();

        $stmt = null;

    }

/*=============================================
	MOSTRAR Horario
	=============================================*/

	static public function mdlMostrarHorariosMedico($valor)
	{


		$stmt = Conexion::conectar()->prepare("SELECT id, entrada, salida, dia, estado, id_medico FROM horario h  WHERE h.id_medico=$valor;");

		$stmt->execute();

		return $stmt->fetchAll();
		
		$stmt->close();

		$stmt = null;
	}
    
    /*=============================================
	CREAR SERVICIO
	=============================================*/

    static public function mdlIngresarHorario($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(entrada,salida,dia,id_medico) VALUES (:entrada, :salida, :dia, :id_medico)");

        $stmt->bindParam(":entrada", $datos["entrada"], PDO::PARAM_STR);
        $stmt->bindParam(":salida", $datos["salida"], PDO::PARAM_STR);
        $stmt->bindParam(":dia", $datos["dia"], PDO::PARAM_STR);
        $stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        
        $stmt = null;
    }


    /*=============================================
	EDITAR SERVICIO
	=============================================*/

    static public function mdlEditarHorario($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_medico = :id_medico, entrada = :entrada, salida = :salida, dia = :dia WHERE id = :id");
       
		$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_STR);
        $stmt->bindParam(":entrada", $datos["entrada"], PDO::PARAM_STR);
        $stmt->bindParam(":salida", $datos["salida"], PDO::PARAM_STR);
        $stmt->bindParam(":dia", $datos["dia"], PDO::PARAM_STR);
		
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;
    }

     /*=============================================
	ACTUALIZAR HORARIO
	=============================================*/

    static public function mdlActualizarHorario($tabla, $item1, $valor1, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }
  
        /*=============================================
        ELIMINAR SERVICIO
        =============================================*/

    static public function mdlBorrarHorario($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }
}
