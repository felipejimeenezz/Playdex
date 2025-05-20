<?php

include_once "/xampp/htdocs/Playdex/function/BDD/connection_BDD.php";

// Función para comprobar si el usuario existe en la base de datos
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

// Función para iniciar sesión
function login ($user, $pass, $extraido){
    if ($extraido && $extraido['nombre'] == $user && $extraido['contrasena'] == $pass) {
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['nombre'] = $user;
        $_SESSION['contrasena'] = $pass;
        header("Location: index.php");
        exit;
    } else {
        return "Nombre o contraseña incorrectos";
    }
}

// Función para registrar un nuevo usuario
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

// Funciones para redirigir a las páginas según el estado de la sesión
function loginPerfil() {
    $hrefUsuario = "";

    session_start();

    if(isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    $hrefUsuario = "perfil.php";
    } else {
    $hrefUsuario = "login.php";
    }

    return $hrefUsuario;
}

function loginFavoritos() {
    $hrefFavoritos = "";

    if (!isset($_SESSION)) {
        session_start();
    }

    if(isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    $hrefFavoritos = "favoritos.php";
    } else {
    $hrefFavoritos = "login.php";
    }

    return $hrefFavoritos;
}

// Función para mostrar el mensaje de bienvenida o iniciar sesión
function bienvenido() {
    $bienvenido = "";

    if (!isset($_SESSION)) {
        session_start();
    }

    if(isset($_SESSION["login"]) && $_SESSION["login"] == true) {
        $bienvenido = "Bienvenido, " . $_SESSION['nombre'];
    } else {
        $bienvenido = "Iniciar sesión";
    }

    return $bienvenido;
}

?>