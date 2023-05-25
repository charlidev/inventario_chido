<?php
    require 'db_connection.php';

    $id = $_POST['idArticulo'];
    $nombre = $_POST['nombreArticulo'];
    $existencia = $_POST['existenciaArticulo'];
    $fecha = $_POST['fechaRegistroArticulo'];
    $fechaFormateada = date('Y-m-d', strtotime($fecha));
    $oficio = $_POST['oficioArticulo'];
    $marca = $_POST['marcaArticulo'];
    $material = $_POST['materialArticulo'];
    $unidad = $_POST['unidadArticulo'];

    $datos = array();

    if (empty($id) || empty($nombre) || empty($existencia) || empty($fecha) || empty($oficio) || empty($marca) || empty($material) || empty($unidad)) {
        // Uno o ambos campos están vacíos, muestra un mensaje de error
        $response = array('status' => 0, 'msg' => 'Por favor, complete TODOS los campos.');
        echo json_encode($response);
    } else {
        // Ambos campos están completos, continua con la lógica de tu programa
        $tsql = "UPDATE tblArticulo SET Nombre = ?, Existencia = ?, fechaRegistro = ?, oficioEntra = ?, idMarca = ?, idMaterial = ?, idUnidad = ? WHERE idArticulo = ?";
        $params = array($nombre, $existencia, $fechaFormateada, $oficio, $marca, $material, $unidad, $id);

        $stmt = sqlsrv_query($connection, $tsql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_rows_affected($stmt) > 0) {
            // Artículo actualizado correctamente
            $datos['status'] = 1;
            $datos['msg'] = "¡Artículo actualizado exitosamente!";
        } else {
            // No se pudo actualizar el artículo
            $datos['status'] = 0;
            $datos['msg'] = "Ocurrió un problema al actualizar el artículo.";
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($connection);

        // Convertir array a JSON
        $json = json_encode($datos);
        echo $json;
    }
?>
