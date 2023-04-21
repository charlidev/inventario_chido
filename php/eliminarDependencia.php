<?php
    // Incluir archivo de conexión a la base de datos
    include('db_connection.php');

    // Verificar si se ha enviado un ID de dependencia
    if(isset($_POST['id'])) {
        // Obtener el ID de la dependencia
        $id = $_POST['id'];

        // Eliminar la dependencia de la base de datos
        $query = "DELETE FROM dependencias WHERE id = ?";
        $params = array($id);
        $result = sqlsrv_query($connection, $query, $params);

        // Verificar si se eliminó la dependencia correctamente
        if($result) {
            // Si la eliminación fue exitosa, enviar una respuesta JSON al cliente
            $response = array(
                'status' => 1,
                'msg' => 'La dependencia se eliminó correctamente'
            );
            echo json_encode($response);
        } else {
            // Si hubo un error al eliminar la dependencia, enviar una respuesta JSON al cliente
            $response = array(
                'status' => 0,
                'msg' => 'Hubo un error al eliminar la dependencia'
            );
            echo json_encode($response);
        }
    }
?>