<?php
    require 'php/db_connection.php';

    $id = $_POST['idDepen'];

    $datos = array();

    if(empty($_POST['idDepen'])){
        // Uno o ambos campos están vacíos, muestra un mensaje de error
        $response = array('status' => 0, 'msg' => 'Error al eliminar el registro.');
        echo json_encode($response);
    }else{

        // Realizar la eliminación del registro de la base de datos
        $consulta = "DELETE FROM tblDependencia WHERE idDependencia = ?";
        $parametros = array($_POST['idDepen']);
        $resultado = sqlsrv_query($connection, $consulta, $parametros);
        if($stmt){ //validamos si se encontro el registro
            $datos['status']=1;
            $datos['msg']="!Dependencia eliminada satisfactoriamente!";
        }
        else{ //accion si no se encuentra el registro
            $datos['status']=0;
            $datos['msg']="Error al eliminar el registro.";
        }
        sqlsrv_close($connection);
        //convertir array a json
        $json=json_encode($datos);
        echo $json;

    }
?>