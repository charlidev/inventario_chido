<?php
    require 'db_connection.php';

    $material= $_POST['nombreMaterial'];

    $datos=array();

    if(empty($material)){
        // Uno o ambos campos están vacíos, muestra un mensaje de error
        $response = array('status' => 0, 'msg' => 'Por favor, complete el campo.');
        echo json_encode($response);
    }
    else{
        // Ambos campos están completos, continua con la lógica de tu programa
        $tsql = "INSERT INTO tblMaterial (Material) VALUES (?)";
        $params = array($material);

        $stmt = sqlsrv_query($connection, $tsql, $params);

        if($stmt){ //validamos si se encontro el registro
            $datos['status']=1;
            $datos['msg']="!Material guardado satisfactoriamente!";
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