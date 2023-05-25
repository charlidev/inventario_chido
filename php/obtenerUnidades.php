<?php
    // Incluir archivo de conexión a la base de datos
    require 'db_connection.php';

    // Consultar la lista de unidades
    $query = "SELECT idUnidad, Nombre FROM tblUnidad";
    $result = sqlsrv_query($connection, $query);

    $unidades = array();

    if ($result && sqlsrv_has_rows($result)) {
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $unidad = array(
                'id' => $row['idUnidad'],
                'nombre' => $row['Nombre']
            );
            $unidades[] = $unidad;
        }
    }

    echo json_encode($unidades);
?>