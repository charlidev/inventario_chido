<?php
    // Incluir archivo de conexión a la base de datos
    require 'db_connection.php';

    $id = $_POST['id'];

    // Verificar si se ha enviado un ID de dependencia
    if(isset($id)) {
        // Obtener el ID de la dependencia
        $query = "SELECT idMarca, Marca FROM tblMarca WHERE idMarca = ?";
        $params = array($id);
        $result = sqlsrv_query($connection, $query, $params);

        $depen = array();

        if ($result && sqlsrv_has_rows($result)) {
            $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
            $marca = array(
                'id' => $row['idMarca'],
                'nombre' => $row['Marca'],
            );
        }
        echo json_encode($marca);
    }
?>