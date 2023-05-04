<?php
    // Incluir archivo de conexión a la base de datos
    require 'db_connection.php';

    $id = $_POST['id'];

    // Verificar si se ha enviado un ID de dependencia
    if(isset($id)) {
        // Obtener el ID de la dependencia
        
        // Eliminar la dependencia de la base de datos
        $query = "SELECT idUnidad, Nombre FROM tblUnidad WHERE idUnidad = ?";
        $params = array($id);
        $result = sqlsrv_query($connection, $query, $params);

        $depen = array();

        if ($result && sqlsrv_has_rows($result)) {
            $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
            $unidad = array(
                'id' => $row['idUnidad'],
                'nombre' => $row['Nombre'],
            );
        }
        echo json_encode($unidad);
    }
?>