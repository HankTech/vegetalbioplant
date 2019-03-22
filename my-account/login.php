<?php
	require 'conexion.php';
	require 'funcs.php';

	session_start(); //Iniciar una nueva sesión o reanudar la existente
	
	if(isset($_SESSION["id_usuario"]))//En caso de existir la sesión redireccionamos
	{ 
		header("Location: my-account.php");
	}
	
	$errors = array();
	
	if(!empty($_POST))
	{
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);
		
		if(isNullLogin($usuario, $password))
		{
			$errors[] = "Debe llenar todos los campos";
		}
		
		$errors[] = login($usuario, $password);	
	}
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


<body class="background-color">

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
                <div class="row d-flex justify-content-center"> 
                    <div class="filete"></div>

                    <div class="col-ms-12 col-md-6 col-lg-7 align-self-center justify-content-center">

                        <h2>ACCEDER</h2>
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

						<form id="loginform" class="formulario justify-content-center" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="usuario o email" required>                                        
							</div>
							
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input id="password" type="password" class="form-control" name="password" placeholder="password" required>
							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success">Iniciar Sesi&oacute;n</a>
								</div>
              </div>

							<div class="">
							  <div class="col-md-12 control">
								  <div class="registrate-texto" style="border-top: 1px solid#888; padding-top:15px; font-size:100%" >
										<p  class="registrate-texto">No tiene una cuenta?</p> <a  class="registrate-texto" style="color:red;" href="singup.php">Registrate aquí</a>
									</div>
                </div>
                               
                <div class="">
                  <br>
						      <div style="float:right; font-size: 100%; position: relative; top:-10px"><a href="recupera.php">¿Se te olvid&oacute; tu contraseña?</a></div>
					      </div> 

							</div>    
              </form>

              <?php echo resultBlock($errors) ?>   
 
              </div>
                                      
                    <div class="filete"></div>
                </div>
            </div>
        </div>

      <!-- fin contenido central -->
    </section>


        <!-- banner inferior -->
    <section style="background-color:#fff">
      <div class="container d-flex flex-column">
        <div class="row d-flex justify-content-start">
          <div class="col-sm-6 col-md-3">
            <a class="" target="_blank" href="#">
              <img class="cajas" src="../img/banners/Caja_bote_hemps_400_croped.png" alt="">
              <h5 class="text-caja ">CBD Balm <br> 400 mg Cannabidiol</h5>
            </a>            
          </div>
          <div class="col-sm-6 col-md-3">
            <img class="cajas" src="../img/banners/Caja_bote_hemps_800_croped.png" alt="">
            <h5 class="text-caja">CBD Balm Extra Strength <br> 800 mg Cannabidiol</h5>
          </div>
        </div>
      </div>
    </section>




    <!-- inicio del footer -->
    <footer class="footer-color">
        <div class="container">
            <div class="row">
              <!-- Logo -->
              <div class="col-sm">
                <img class="logo-inferior" src="../img/logo-vegetal-bioplant.png" alt="logo">
              </div>
              <!-- iconos de redes sociales -->
              <div class="col-sm">
                <p class="text-white redes-sociales size-texto">SIGUENOS EN:</p>
                <div class="iconos-sociales">
                  <a class="text-white icon-facebook2" target="_blank" href="http://facebook.com/"></a>
                  <a class="text-white icon-twitter" target="_blank" href="https://twitter.com/"></a>
                  <a class="text-white icon-instagram" target="_blank" href="https://www.instagram.com/"></a>
                </div>
              </div>
              <!-- columna 1 -->
              <div class="col-sm">
                <div class="primer-texto-columna size-texto">
                    <a class="text-white" target="_blank" href="../index.html">INICIO</a>
                    <div class="barra-separadora"></div>
                    <a class="text-white" target="_blank" href="#">PRODUCTOS</a>
                    <div class="barra-separadora"></div>
                    <a class="text-white" target="_blank" href="#">
                      CBD Balm <br>
                      CBD Balm Extra Strength
                    </a>
                </div>                
              </div>
              <!-- columna 2 -->
              <div class="col-sm">
                <div class="primer-texto-columna size-texto">
                  <a class="text-white" target="_blank" href="../about-us/about-us.html">NOSOTROS</a>
                  <div class="barra-separadora"></div>
                  <a class="text-white" target="_blank" href="../cdb-studies/cdb-studies.html">ESTUDIOS DE CBD</a>
                  <div class="barra-separadora"></div>
                  <a class="text-white" target="_blank" href="#">PREGUNTAS FRECUENTES</a>
                  <div class="barra-separadora"></div>
                  <a class="text-white" target="_blank" href="#">CONTACTO</a>
                  <div class="barra-separadora"></div>
                </div>
              </div>
              <!-- columna 3 -->
              <div class="col-sm">
                <div class="primer-texto-columna size-texto">
                  <a class="text-white" target="_blank" href="../what-is-industrial/what-is-industrial.html">¿QUÉ ES EL CÁÑAMO INDUSTRIAL?</a>
                  <div class="barra-separadora"></div>
                  <a class="text-white" target="_blank" href="../history-use-of-ayurvedic-naturopathic-products/history-use-of-ayurvedic-naturopathic-products.html">AYURVÉDICO Y NATUROPÁTICO</a>
                  <div class="barra-separadora"></div>
                  <a class="text-white" target="_blank" href="../the-endocannabinoid-system/the-endocannabinoid-system.html">EL SISTEMA ENDOCANNABINOIDE</a>
                  <div class="barra-separadora"></div>
                  <a class="text-white" target="_blank" href="#">¿POR QUÉ EL CBD ES BUENO PARA MI?</a>
                  <div class="barra-separadora"></div>
                </div>
              </div>
              <!-- columna 4 -->
              <div class="col-sm">
                <div class="primer-texto-columna size-texto">
                  <a class="text-white" target="_blank" href="#">MI CUENTA</a>
                  <div class="barra-separadora"></div>
                </div>
              </div>
            </div>
            <!-- footer legal -->
            <div class="row d-flex justify-content-center size-texto">
              <div class="footer-legal text-center">
                <a class="text-white" target="_blank" href="#">Política de privacidad</a>
                <a class="text-white" target="_blank" href="#">Condiciones para los usuarios, venta y devoluciones</a>
                <a class="text-white" target="_blank" href="#">Política de Cookies</a>
                <a class="text-white" target="_blank" href="#">Aviso Legal</a>
              </div>
            </div>
            <div class="row d-flex justify-content-center">
                <p class="text-white size-texto">Hnk.inc, Ⓒ 2018 Todos los derechos reservados </p>
            </div>
          </div>

    </footer>
    <!-- fin del footer -->




                     

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>