<?php
    require 'db_connection.php';

    $id = $_POST['id'];
    $nombre = $_POST['nombreRole'];
    $status = $_POST['estatusRole'];

    $datos = array();

    if(empty($nombre) || empty($status)){
        // Uno o ambos campos están vacíos, muestra un mensaje de error
        $response = array('status' => 0, 'msg' => 'Por favor, no deje campos vacíos.');
        echo json_encode($response);
    }
    else{
        // Ambos campos están completos, continua con la lógica de tu programa
        $tsql = "UPDATE tblRol SET nombreRol = ?, Estatus = ? WHERE idRol = ?";
        $params = array($nombre, $status, $id);

        $stmt = sqlsrv_query($connection, $tsql, $params);

        if($stmt){ //validamos si se encontro el registro
            $datos['status'] = 1;
            $datos['msg'] = "!Rol editado satisfactoriamente!";
        }
        else{ //accion si no se encuentra el registro
            $datos['status'] = 0;
            $datos['msg'] = "Ocurrió un problema.";
        }

        //convertir array a json
        $json=json_encode($datos);
        echo $json;

        sqlsrv_free_stmt($stmt); // Liberar recursos del statement
    }
    sqlsrv_close($connection); // Cerrar conexión a la base de datos
?>