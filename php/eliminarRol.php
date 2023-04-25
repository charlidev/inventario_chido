<?php
    // Incluir archivo de conexión a la base de datos
    require 'db_connection.php';

    $id = $_POST['id'];

    $datos = array();

    // Verificar si se ha enviado un ID de dependencia
    if(isset($id)) {
        // Obtener el ID de la dependencia
        
        // Eliminar la dependencia de la base de datos
        $query = "DELETE FROM tblRol WHERE idRol = ?";
        $params = array($id);
        $result = sqlsrv_query($connection, $query, $params);

        // Verificar si se eliminó la dependencia correctamente
        if($result) {
            $datos['status'] = 1;
            $datos['msg'] = "Rol eliminado correctamente.";
            
        } else {
            // Si hubo un error al eliminar la dependencia, enviar una respuesta JSON al cliente
            $datos['status'] = 0;
            $datos['msg'] = "Error al eliminar el registro.";
        }
        sqlsrv_close($connection);
        $json=json_encode($datos);
        echo $json;
    }
?>