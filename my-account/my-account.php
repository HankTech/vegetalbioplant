<?php
    session_start();
    
	require 'conexion.php';
	include 'funcs.php';
	
	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	
	$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/styles.css"> <!-- estilos de la pagina en general -->
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/icon-fonts.css">
    <link rel="stylesheet" href="../css/sections-styles.css">
    <link rel="stylesheet" href="css/styles.css"> <!-- estilos del login -->
    <link rel="shortcut icon" href="../img/logo-vegetal-bioplant.png">


    <title>HnkPharma</title>
</head>
body class="background-color">

  <!-- inicio de cabecera -->
  <header>
      <nav class="navbar navbar-expand-md navbar-dark navbar-default fixed-top">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo02"> 
            <div class="container-fluid">
            <div class="row">
              <div class="col">                       
                <div class="nav navbar-nav texto-de-barra justify-content-center text-center size-texto size-texto-barra-sup1">
                  <a class="list-group nav-item nav-link text-white" href="../index.html">INICIO</a>
                  <a class="list-group nav-item nav-link text-white" href="#">PRODUCTOS</a>
                  <a class="list-group nav-item nav-link text-white" href="../about-us/about-us.html">NOSOTROS</a>
                  <a class="list-group nav-item nav-link text-white" href="../cdb-studies/cdb-studies.html">ESTUDIOS DE CBD</a>
                  <a class="list-group nav-item nav-link text-white" href="#">PREGUNTAS FRECUENTES</a>
                  <a class="list-group nav-item nav-link text-white" href="#">CONTACTO</a>
                  <a class="list-group nav-item nav-link text-white" href="#">BLOG</a>
                </div>            
              </div>
            </div>

            <div class="sup"></div>

            <div class="row">
              <div class="col d-flex justify-content-center text-center">
                <div class="nav navbar-nav texto-de-barra size-texto-barra-sup2">
                  <a class="list-group nav-item nav-link text-white" href="../what-is-industrial/what-is-industrial.html">|&nbsp;&nbsp;¿QUE ES EL CÁÑAMO INDUSTRIAL?&nbsp;&nbsp;|</a>
                  <a class="list-group nav-item nav-link text-white" href="../history-use-of-ayurvedic-naturopathic-products/history-use-of-ayurvedic-naturopathic-products.html">|&nbsp;&nbsp;AYURVÉDICO Y NATUROPÁTICO&nbsp;&nbsp;|</a>
                  <a class="list-group nav-item nav-link text-white" href="../the-endocannabinoid-system/the-endocannabinoid-system.html">|&nbsp;&nbsp;EL SISTEMA ENDOCANNABINOIDE&nbsp;&nbsp;|</a>
                  <a class="list-group nav-item nav-link text-white" href="#">|&nbsp;&nbsp;¿POR QUÉ EL CBD ES BUENO PARA MI?&nbsp;&nbsp;|</a>     
                </div>
              </div>
            </div>
          </div>
        </div>        
      </nav>  
    </header>
    <!-- fin de cabecera -->

    <section>
      <!-- banner superior -->
      <div class="banner-header d-flex justify-content-center align-items-center flex-column" style="background-image: url(../img/banners/banner_history.jpg)">
        <img class="logo-banner" src="../img/logo-vegetal-bioplant.png" alt="logo">
        <h1 class="text-white">Mi cuenta</h1>
      </div>


        <!-- Contenido Central -->
        <div class="background-banner">
            <div class="container content">
                <div class="row"> 
                    <div class="filete"></div>
					
						<div class="container">
							<div class="d-flex justify-content-around align-self-center">
								<h2><?php echo 'Bienvenid@ '.utf8_decode($row['nombre']); ?></h1>

								<ul>
									<li><a style="font-size:25px;" href='logout.php'>Cerrar Sesi&oacute;n</a></li>
								</ul>
							</div>
						<div>

				
			
			
			<div class="filete"></div>
		</div>
	</body>
</html>