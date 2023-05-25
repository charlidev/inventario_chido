<?php
// Incluir archivo de conexión a la base de datos
require 'db_connection.php';

// Consultar la lista de materiales
$query = "SELECT Material FROM tblMaterial";
$result = sqlsrv_query($connection, $query);

$materiales = array();

if ($result && sqlsrv_has_rows($result)) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $materiales[] = $row['Material'];
    }
}

echo json_encode($materiales);
?>
