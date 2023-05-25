<?php
    // Incluir archivo de conexión a la base de datos
    require 'db_connection.php';

    // Obtener la lista de marcas
    $query = "SELECT Marca FROM tblMarca";
    $result = sqlsrv_query($connection, $query);

    $marcas = array();

    if ($result && sqlsrv_has_rows($result)) {
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $marcas[] = $row['Marca'];
        }
    }

    echo json_encode($marcas);
?>
