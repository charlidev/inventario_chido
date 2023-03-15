<?php
    //se hace la conexión a la BD
    require 'db_connection.php';
    session_start();
    //Datos que llegan del front end por el metodo post
    $usuario= $_POST['usuario'];
    $contraseña= $_POST['contraseña'];
    //guardar informacion del usuario
    $datos=array();

    if(empty($_POST['usuario']) || empty($_POST['contraseña'])){
        // Uno o ambos campos están vacíos, muestra un mensaje de error
        $response = array('status' => 0, 'msg' => 'Por favor, complete AMBOS campos.');
        echo json_encode($response);
    }
    else{
        // Ambos campos están completos, continua con la lógica de tu programa
        $tsql = "SELECT * FROM tblLogin WHERE Usuario = ? AND Contrasena = ?";
        $params = array($_POST['usuario'], $_POST['contraseña']);

        $stmt = sqlsrv_query($connection, $tsql, $params);

        if($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){ //validamos si se encontro el registro
            //guardar información del usuario en la sesión
            $_SESSION['username'] = $usuario;
            $datos['status']=1;   
        }
        else{ //accion si no se encuentra el registro
            $datos['status']=0;
            $datos['msg']="Usuario o contraseña no válida.";
        }
        sqlsrv_close($connection);
        //convertir array a json
        $json=json_encode($datos);
        echo $json;
    }
?>
