<?php
    require 'db_connection.php';
    $con = $connection;

    if(isset($_POST['guardar_depen'])){

        $nombre = QUOTENAME($_POST['nombre'], "'");
        $estatus = QUOTENAME($_POST['estatus'], "'");
        
        if($nombre == NULL || $estatus == NULL){
            $response['status'] = 0;
            $response['msg'] = 'Todos los campos son abligatorios.';
            echo json_encode($response);
            return false;
        }else{
    
            $query = "INSERT INTO tblDependencia (Nombre, Estatus) VALUES ('$nombre', '$estatus')";
            $stmt = sqlsrv_query($con, $query);

            if($stmt){
                $response['status'] = 1;
                $response['msg'] = 'Dependencia agregada correctamente!';
                echo json_encode($response);
                return false;
            }else{
                $response['status'] = 2;
                $response['msg'] = 'Ocurrió un error.';
                echo json_encode($response);
                return false;
            }
        }
    }

?>