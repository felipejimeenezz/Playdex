<?php

include_once "/xampp/htdocs/Playdex/function/BDD/connection_BDD.php";

function consultaUsuarios($consulta) {

$conexion = connect_bbdd();

$usuario = mysqli_query($conexion, $consulta);

    if ($usuario != null) {
        mysqli_data_seek($usuario, 0);
        $extraido = mysqli_fetch_array($usuario);
        return $extraido;
    } else {
        return null;
    }
    
}

function login ($user, $pass, $extraido){
    if ($extraido['nombre'] == $user && $extraido['contrasena'] == $pass) {
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['nombre'] = $user;
        $_SESSION['contrasena'] = $pass;
        $_SESSION['id'] = $extraido['id'];
        header("Location: index.php");
        exit;
    } else {
        echo "Nombre o contraseña incorrectos";
    }
}

function register ($user, $email, $pass) {
    $conexion = connect_bbdd();
    $consulta = "INSERT INTO `usuario` (`nombre`, `email`, `contrasena`) VALUES ('$user', '$email', '$pass')";
    if (mysqli_query($conexion, $consulta)) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($conexion);
    }
}
?>