<?php

include_once "function/BDD/connection_BDD.php";
include_once "class/juego.php";
include_once "function/login/loginFunction.php";
include_once "class/genero.php";
include_once "class/plataforma.php";

$conexion = connect_bbdd();

$hrefUsuario = loginPerfil();
$hrefFavoritos = loginFavoritos();
$bienvenido = bienvenido();

?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>Playdex - Explorar</title>
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
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}
    </style>
  </head>
  <body>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container">
          <div class="cssload-speeding-wheel"></div>
        </div>
      </div>
    </div>
    <div class="page">
      <header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap rd-navbar-absolute">
          <nav class="rd-navbar rd-navbar-creative" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="20px" data-xl-stick-up-offset="20px" data-xxl-stick-up-offset="20px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!-- RD Navbar Brand-->
                  <div class="rd-navbar-brand"><a class="brand" href="index.php"><img src="img/logo.png" alt="" width="151" height="22"/></a>
                  </div>
                </div>
                <div class="rd-navbar-main-element">
                  <div class="rd-navbar-nav-wrap">
                    <!-- RD Navbar Nav-->
                    <ul class="rd-navbar-nav">
                      <li class="rd-nav-item" id="index"><a class="rd-nav-link" href="index.php">Home</a>
                      </li>
                      <li class="rd-nav-item" id="info"><a class="rd-nav-link" href="info.php">Info</a>
                      </li>
                      <li class="rd-nav-item active" id="explorar"><a class="rd-nav-link" href="explorar.php">Explorar</a>
                      </li>
                    </ul>
                  </div>
                  <!-- RD Navbar Search-->
                  <div class="rd-navbar-search">
                    <a class="user text-white" href="<?php echo $hrefFavoritos ?>"><span><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                      <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                    </svg></span></a>
                  </div>

                  <div class="rd-navbar-search">
                    <a class="user text-white" href="<?php echo $hrefUsuario ?>"><span><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                      <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg></span> <?php echo $bienvenido ?></a>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>

      <section class="section section-bredcrumbs" style="position: relative; overflow: hidden;">
        <video autoplay muted loop playsinline disablepictureinpicture style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
          <source src="videos/explorarfondo.mp4" type="video/mp4">
        </video>

        <div class="container context-dark breadcrumb-wrapper text-left" style="position: relative;">
          <h1>Explorar</h1>
          <br>
        </div>
      </section>

      <div class="containerExplorar bg-gray-100">

        <div class="row justify-content-center">
          <aside class="sidebar col-md-2">
            <h5 class="text-center"><b>FILTROS</b></h5>
              <div class="filtros mt-4">
                <div class="tituloFiltros">
                  <h6 class="text-center text-white">Géneros</h6>
                </div>

                <?php
                // Obtener los géneros de la base de datos
                $generos = mysqli_query($conexion, "SELECT * FROM `genero`");
                foreach ($generos as $genero) {
                  $id_genero = $genero['id'];
                  $nombre = $genero['nombre'];
                ?>
                <div class="form-check ml-2">
                  <input class="form-check-input generos" value="<?php echo $id_genero ?>" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault"><?php echo $nombre ?></label>
                </div>
                <?php
                }
                ?>

              </div>

              <div class="filtros mt-4">

                  <div class="tituloFiltros">
                    <h6 class="text-center text-white">Plataformas</h6>
                  </div>

                  <?php
                  // Obtener las plataformas de la base de datos
                  $plataformas = mysqli_query($conexion, "SELECT * FROM `plataforma`");
                  foreach ($plataformas as $plataforma) {
                    $id_plataforma = $plataforma['id'];
                    $nombre = $plataforma['nombre'];
                  ?>
                  <div class="form-check ml-2">
                    <input class="form-check-input plataformas" value="<?php echo $id_plataforma ?>" type="checkbox" value="">
                    <label class="form-check-label" for="flexCheckDefault"><?php echo $nombre ?></label>
                  </div>
                  <?php
                  }
                  ?>

              </div>

              <div class="d-flex justify-content-center mr-2 mt-4">
                <button id="btnFiltro" class="button button-primary mb-4">Aplicar</button>
              </div>
          </aside>

          <div class="col-md-10 p-2">
            <div class="containerJuegos">
              
            <?php
            
            // Obtener todos los juegos de la base de datos
            $juegos = mysqli_query($conexion, "SELECT * FROM `juego`");

            foreach ($juegos as $juego) {
              $id_juego = $juego['id'];
              $portada = $juego['url_img'];
              $nombre = $juego['nombre'];
              $fecha_lanzamiento = $juego['fecha_lanzamiento'];
              $rating = $juego['rating'];
              $descripcion = $juego['descripcion'];

              $j = new Juego($id_juego, $nombre, $fecha_lanzamiento, $portada, $rating, $descripcion);

              //Generos
              $generos = mysqli_query($conexion,
              "SELECT g.id, g.nombre
              FROM genero g
              JOIN juego_genero jg ON g.id = jg.id_genero
              WHERE jg.id_juego = $id_juego"
              );

              while ($g = mysqli_fetch_assoc($generos)) {
                  $j->addGenero(new Genero($g['id'], $g['nombre']));
              }

              //Plataformas
              $plataformas = mysqli_query($conexion,
              "SELECT p.id, p.nombre
              FROM plataforma p
              JOIN juego_plataforma jp ON p.id = jp.id_plataforma
              WHERE jp.id_juego = $id_juego"
              );

              while ($p = mysqli_fetch_assoc($plataformas)) {
                  $j->addPlataforma(new Plataforma($p['id'], $p['nombre']));
              }

            ?>
            <div class="juego" generos="<?php
            // Atributo para almacenar las IDs de los géneros y plataformas
                            foreach ($j->getGeneros() as $genero) {
                                echo $genero->getId() . " ";
                            }
                          ?>" plataformas="<?php
                            foreach ($j->getPlataformas() as $plataforma) {
                            echo $plataforma->getId() . " ";
                            }
                            ?>" id="<?php echo $id_juego ?>">
              <a href="juegoinfo.php?id=<?php echo $id_juego; ?>">
                <img src="<?php echo $portada; ?>" alt="<?php echo $nombre; ?>">
                <h5 class="text-center"><?php echo $nombre; ?></h5>
              </a>
            </div>
            <?php
            }
            ?>

            </div>
          </div>
        </div>

      </div>

        <!-- Page Footer-->
        <footer class="section footer-2">
        <div class="container">
          <div class="row row-40">
            <div class="col-md-6 col-lg-6"><a class="footer-logo" href="index.html"><img src="img/logo.png" alt="" width="180" height="26"/></a>
              <p>Playdex es un proyecto web creado por Felipe Jiménez que permite a los usuarios consultar videojuegos de diversos géneros, plataformas y características y agregarlos a colecciones si así lo desean, todo a través de una interfaz intuitiva, amigable y cómoda.</p>
            </div>
            <div class="col-md-6 col-lg-6">
              <h5 class="text-white title">Información de contacto</h5>
              <ul class="contact-box">
                <li>
                  <div class="unit unit-horizontal unit-spacing-xxs">
                    <div class="unit-left"><span class="icon mdi mdi-email-outline accent-icon"></span></div>
                    <div class="unit-body"><a href="mailto:#">jimenezluquefelipe@gmail.com</a></div>
                  </div>
                </li>
                <li>
                  <div class="unit unit-horizontal unit-spacing-xxs">
                    <div class="unit-left"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16">
                      <defs>
                        <linearGradient id="gradientGithub" x1="0%" y1="0%" x2="100%" y2="0%">
                          <stop offset="0%" stop-color="#64aee5" />
                          <stop offset="100%" stop-color="#4c2882" />
                        </linearGradient>
                      </defs>
                      <path fill="url(#gradientGithub)" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 
                      2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 
                      0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 
                      1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 
                      0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 
                      0 0 .67-.21 2.2.82.64-.18 
                      1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 
                      2.2-.82 2.2-.82.44 1.1.16 1.92.08 
                      2.12.51.56.82 1.27.82 2.15 
                      0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 
                      0 1.07-.01 1.93-.01 2.2 
                      0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                    </svg>
                    </div>
                    <div class="unit-body"><a href="https://www.github.com/felipejimeenezz">@felipejimeenezz</a></div>
                  </div>
                </li>
                <li>
                  <div class="unit unit-horizontal unit-spacing-xxs">
                    <div class="unit-left"><span class="icon icon-md novi-icon mdi mdi-instagram accent-icon"></span></div>
                    <div class="unit-body"><a href="https://www.instagram.com/felipejimeenezz">@felipejimeenezz</a></div>
                  </div>
                </li>
                <li>
                  <div class="unit unit-horizontal unit-spacing-xxs">
                    <div class="unit-left"><span class="icon icon-md novi-icon mdi mdi-linkedin accent-icon"></span></div>
                    <div class="unit-body"><a href="https://www.linkedin.com/in/felipe-jiménez-luque-b6a1082a2/">Felipe Jiménez Luque</a></div>
                  </div>
                </li>
              </ul>
          <!-- Rights-->
          <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span> <span>Playdex</span>
          </p>
        </div>
      </footer>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/scriptPlaydex.js"></script>
  </body>
</html>