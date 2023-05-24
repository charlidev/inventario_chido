<?php
    require 'db_connection.php';

    $nombre= $_POST['nombreArticulo'];
    $existencia= $_POST['existenciaArticulo'];
    $fecha= $_POST['fechaRegistroArticulo'];
    $fechaFormateada = date('Y-m-d', strtotime($fecha));
    $oficio= $_POST['oficioArticulo'];
    $marca= $_POST['marcaArticulo'];
    $material= $_POST['materialArticulo'];
    $unidad= $_POST['unidadArticulo'];

    $datos=array();

    if(empty($nombre) || empty($existencia) || empty($fecha) || empty($oficio) || empty($marca) || empty($material) || empty($unidad)){
        // Uno o ambos campos están vacíos, muestra un mensaje de error
        $response = array('status' => 0, 'msg' => 'Por favor, complete TODOS los campos.');
        echo json_encode($response);
    }
    else{
        // Ambos campos están completos, continua con la lógica de tu programa
        $tsql = "INSERT INTO tblArticulo (Nombre, Existencia, fechaRegistro, oficioEntra, idMarca, idMaterial, idUnidad) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = array($nombre, $existencia, $fechaFormateada, $oficio, $marca, $material, $unidad);

        $stmt = sqlsrv_query($connection, $tsql, $params);

        if ($stmt) {
            // Registro insertado correctamente
            $datos['status'] = 1;
            $datos['msg'] = "¡Artículo agregado exitosamente!";
        } else {
            // Ocurrió un error al insertar el registro
            $datos['status'] = 0;
            $datos['msg'] = "Ocurrió un problema al agregar el artículo. ";
        }
        sqlsrv_close($connection);
        //convertir array a json
        $json=json_encode($datos);
        echo $json;
    }

?>