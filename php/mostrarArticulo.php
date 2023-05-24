<?php
    // Incluir archivo de conexión a la base de datos
    require 'db_connection.php';

    $id = $_POST['id'];

    // Verificar si se ha enviado un ID de dependencia
    if(isset($id)) {
        // Obtener el ID de la dependencia
        $query = "SELECT a.idArticulo, a.Nombre, a.Existencia, a.fechaRegistro, a.oficioEntra, m.Marca, ma.Material, u.Nombre AS Unidad 
        FROM tblArticulo a
        INNER JOIN tblMarca m ON a.idMarca = m.idMarca
        INNER JOIN tblMaterial ma ON a.idMaterial = ma.idMaterial
        INNER JOIN tblUnidad u ON a.idUnidad = u.idUnidad 
        WHERE a.idArticulo = ?";
        $params = array($id);
        $result = sqlsrv_query($connection, $query, $params);

        $articulo = array();

        if ($result && sqlsrv_has_rows($result)) {
            $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
            $arti = array(
                'id' => $row['idArticulo'],
                'nombre' => $row['Nombre'],
                'existencia' => $row['Existencia'],
                'fechaRegistro' => date_format($row['fechaRegistro'], 'd/m/Y'),
                'oficioEntra' => $row['oficioEntra'],
                'marca' => $row['Marca'],
                'material' => $row['Material'],
                'unidad' => $row['Unidad'],
            );
        }
        echo json_encode($arti);
    }
?>