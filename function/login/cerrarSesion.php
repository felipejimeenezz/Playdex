<?php 

    // Cerrar sesión y redirigir al usuario a la página de inicio
    session_start();
    session_destroy();
    header("Location: ../../index.php");
    exit;
?>