<?php
    require 'db_connection.php';

    $nombre= $_POST['nombreDepen'];
    $status= $_POST['estatusDepen'];

    $datos=array();

    if(empty($nombre) || empty($status)){
        // Uno o ambos campos están vacíos, muestra un mensaje de error
        $response = array('status' => 0, 'msg' => 'Por favor, complete AMBOS campos.');
        echo json_encode($response);
    }
    else{
        // Ambos campos están completos, continua con la lógica de tu programa
        $tsql = "INSERT INTO tblDependencia (Nombre, Estatus) VALUES (?, ?)";
        $params = array($nombre, $status);

        $stmt = sqlsrv_query($connection, $tsql, $params);

        if($stmt){ //validamos si se encontro el registro
            $datos['status']=1;
            $datos['msg']="!Dependencia guardada satisfactoriamente!";
        }
        else{ //accion si no se encuentra el registro
            $datos['status']=0;
            $datos['msg']="Ocurrió un problema.";
        }
        sqlsrv_close($connection);
        //convertir array a json
        $json=json_encode($datos);
        echo $json;
    }

?>