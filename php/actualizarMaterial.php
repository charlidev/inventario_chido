<?php
    require 'db_connection.php';

    $id = $_POST['id'];
    $material = $_POST['material'];

    $datos = array();

    if(empty($material)){
        // Uno o ambos campos están vacíos, muestra un mensaje de error
        $response = array('status' => 0, 'msg' => 'Por favor, no deje campos vacíos.');
        echo json_encode($response);
    }
    else{
        // Ambos campos están completos, continua con la lógica de tu programa
        $tsql = "UPDATE tblMaterial SET Material = ? WHERE idMaterial = ?";
        $params = array($material, $id);

        $stmt = sqlsrv_query($connection, $tsql, $params);

        if($stmt){ //validamos si se encontro el registro
            $datos['status'] = 1;
            $datos['msg'] = "!Material editado satisfactoriamente!";
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