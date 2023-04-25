<?php
    // Incluir archivo de conexión a la base de datos
    require 'db_connection.php';

    $id = $_POST['id'];

    // Verificar si se ha enviado un ID de dependencia
    if(isset($id)) {
        // Obtener el ID de la dependencia
        
        // Eliminar la dependencia de la base de datos
        $query = "SELECT idRol, nombreRol, Estatus FROM tblRol WHERE idRol = ?";
        $params = array($id);
        $result = sqlsrv_query($connection, $query, $params);

        $depen = array();

        if ($result && sqlsrv_has_rows($result)) {
            $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
            $rol = array(
                'id' => $row['idRol'],
                'nombre' => $row['nombreRol'],
                'estatus' => $row['Estatus']
            );
        }
        echo json_encode($rol);
    }
?>