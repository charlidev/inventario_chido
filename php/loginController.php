<?php
    session_start();
    require 'db_connection.php';
    $datos=array();//guardar informacion del usuario

    $tsql = "SELECT * FROM tblLogin WHERE Usuario = ? AND Contrasena = ?";
    $params = array($_POST['usuario'], $_POST['contraseña']);

    $stmt = sqlsrv_query($connection, $tsql, $params);

    if($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){ //validamos si se encontro el registro
            $datos['status']=1;
    }
    else{ //accion si no se encuentra el registro
        $datos['status']=0;
        $datos['msg']="Usuario o contraseña no valida";
    }
    sqlsrv_close($connection);
    //convertir array a json
    $json=json_encode($datos);
    echo $json;
?>