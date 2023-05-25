<?php
    // Incluir archivo de conexión a la base de datos
    require 'db_connection.php';

    // Consultar la lista de materiales
    $query = "SELECT idMaterial, Material FROM tblMaterial";
    $result = sqlsrv_query($connection, $query);

    $materiales = array();

    if ($result && sqlsrv_has_rows($result)) {
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $material = array(
                'id' => $row['idMaterial'],
                'nombre' => $row['Material']
            );
            $materiales[] = $material;
        }
    }

    echo json_encode($materiales);
?>