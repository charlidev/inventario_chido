<?php
//Nombre del servidor de la base de datos
$serverName = "DESKTOP-RFI1D63";
//Información de la base de datos
$connectionInfo = array("Database"=>"Sistema_Inventario", "UID"=>"sa", "PWD"=>"12345");
//Se establece la conexión a la base de datos
$connection = sqlsrv_connect($serverName, $connectionInfo);

?>