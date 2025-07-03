<?php

    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "colegio";

    $conexion = new mysqli($server, $user, $password, $database);

    if ($conexion -> connect_error){
        error_log("Error de conexión: " . $conexion -> connect_error);
        die("Error al conectarse a la base de datos.");
    }

?>