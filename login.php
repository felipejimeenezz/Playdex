<?php

include_once "function/login/loginFunction.php";

$login = "";

// Obtener los datos del formulario de inicio de sesión
if(isset($_POST["username"]) && (isset($_POST["password"]))) {
    $user=$_POST["username"];
    $pass=$_POST["password"];

    $consulta = "SELECT `nombre`,`contrasena` FROM `usuario` WHERE `nombre` = '$user' AND `contrasena` = '$pass'";

    $extraido = consultaUsuarios($consulta);

    $login = login($user, $pass, $extraido);
    
}

?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title>Playdex - Iniciar sesión</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="img/icono.png" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:100,300,300i,400,700,900">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css" id="main-styles-link">
    <link rel="stylesheet" href="css/playdex.css">

    <!-- MDB CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />

    <!-- MDB JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>

    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}
    </style>
  </head>
</head>
<body>

<section style="background-color: #212121;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-6">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <div class="pt-1 mb-4">
                    <button onclick="window.history.back();" class="btn btn-outline-secondary btn-lg btn-block">Volver</button>
                </div>

                <form method="POST" action="login.php">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <img src="img/logo.PNG" alt="logo">
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar sesión</h5>

                  <?php if (!empty($login)): ?>
                      <div class="alert alert-danger text-center mb-4"><?php echo $login; ?></div>
                  <?php endif; ?>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control form-control-lg" required/>
                    <label class="form-label" for="username">Usuario</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control form-control-lg" required/>
                    <label class="form-label" for="password">Contraseña</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Iniciar sesión</button>
                  </div>

                  <p class="mb-5 pb-lg-2" style="color: #393f81;">¿No tienes una cuenta? <a href="register.php"
                      style="color: #393f81;">Registrate!</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>