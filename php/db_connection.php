<?php
//Nombre del servidor de la base de datos
$serverName = "DESKTOP-8JB1CA9\SQLEXPRESS";
//Información de la base de datos
$connectionInfo = array("Database"=>"Sistema_Inventario", "UID"=>"sa", "PWD"=>"root");
//Se establece la conexión a la base de datos
$connection = sqlsrv_connect($serverName, $connectionInfo);

?>