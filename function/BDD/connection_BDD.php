<?php

function connect_bbdd() {
    //Datos de conexión a la base de datos
    $host = 'localhost';   
    $usuario = 'admin_playdex';     
    $password = 'admin_playdex';        
    $basedatos = 'playdex_bd';

    //Crear la conexión
    $conexion = mysqli_connect($host, $usuario, $password, $basedatos);

    //Verificar si hay errores en la conexión
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
    }
    
    return $conexion;
}

?>