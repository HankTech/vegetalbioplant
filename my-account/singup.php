<?php
	require 'conexion.php';
	require 'funcs.php';
 
	$errors = array();
	$message ='';
	
	if(!empty($_POST)){
		$nombre = $mysqli->real_escape_string($_POST['nombre']);
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);
		$con_password = $mysqli->real_escape_string($_POST['con_password']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);

		$activo = 1; # 1 es cuenta activada, 0 es cuenta desasctivda, necesita activacion generado por le token al correo 
		$tipo_usuario = 2;
		$secret = '6LcjYnsUAAAAADoyNQ4R_d3nh7yGmIx3Kz1usXKT';//Modificar
		
		#Validando Captcha
		if(!$captcha){
			$errors[] = "Por favor verifica el captcha";
		}
		
		#validando datos
		if(isNull($nombre, $usuario, $password, $con_password, $email)){
			$errors[] = "Debe llenar todos los campos";
		}
		
		#validando email
		if(!isEmail($email)){
			$errors[] = "Dirección de correo inválida";
		}
		
		#validando password
		if(!validaPassword($password, $con_password)){
			$errors[] = "Las contraseñas no coinciden";
		}		
		
		#validando si el usuario ya esta en uso
		if(usuarioExiste($usuario)){
			$errors[] = "El nombre de usuario $usuario ya existe";
		}

		#validando si el email ya esta en uso
		if(emailExiste($email)){
			$errors[] = "El correo electronico $email ya existe";
		}
		
		if(count($errors) == 0){
			
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			
			$arr = json_decode($response, TRUE);
			
			if($arr['success']){				
				$pass_hash = hashPassword($password);
				$token = generateToken();		
				
				$registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);			
				
				if($registro > 0){							
					$message = 'Usuario creado correctamente';
		
				 } 
				else{
					$errors[] = "Error al Registrar";
				}
				
			 }
			else{
				$errors[] = 'Error al comprobar Captcha';
			}
		}
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
    <link rel="stylesheet" href="css/styles.css"> <!-- estilos de espesificos de /my-accounut -->
    <link rel="stylesheet" href="css/responsive.css"> <!-- estilos de espesificos de /my-accounut -->
    <link rel="shortcut icon" href="../img/logo-vegetal-bioplant.png">
    <script src='https://www.google.com/recaptcha/api.js'></script> <!-- script del captcha -->


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

                    <div class="col-ms-12 col-md-8 col-lg-10 align-self-center">

                        <h2> REGISTRATE </h2>

						<div style="float:right; font-size: 15px; position: relative; top:-10px"><a style="color:#17a2b8;" href="login.php">Iniciar Sesi&oacute;n</a></div>

						<form class="formulario" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
							</div>
							
							<div class="d-flex justify-content-around">
								<label for="nombre" class="align-self-center control-label">Nombre:</label>
								<div class="col-ms-12 col-md-8 col-lg-10">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
								</div>
							</div>
							
							<div class="d-flex justify-content-around">
								<label for="usuario" class="align-self-center control-label">Usuario:</label>
								<div class="col-ms-12 col-md-8 col-lg-10">
									<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
								</div>
							</div>
							
							<div class="d-flex justify-content-around">
								<label for="password" class="align-self-center control-label">Password:</label>
								<div class="col-ms-12 col-md-8 col-lg-10">
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
							</div>
							
							<div class="d-flex justify-content-around">
								<label for="con_password" class="control-label">Confirmar Password:</label>
								<div class="col-ms-12 col-md-8 col-lg-10">
									<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
								</div>
							</div>
							
							<div class="d-flex justify-content-around">
								<label for="email" class="align-self-center control-label">Email:</label>
								<div class="col-ms-12 col-md-8 col-lg-10">
									<input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" required>
								</div>
							</div>
							
							<div class="d-flex justify-content-center">
								<label for="captcha" class=""></label>
								<div id="captcha" class="g-recaptcha" data-sitekey="6LcjYnsUAAAAACqu0qBSUcJ_WMjBDoqZ6dQelQSa"></div> <!-- Modificar -->
							</div>
							
							<div class="d-flex justify-content-center">                             
								<div class="" style="margin-top:20px">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button> 
								</div>
							</div>
                        </form>
                        
						<?php if(!empty($message)): ?>
						<p class="text-center"> <?=$message ?> </p>
                        <?php endif ?>
                        
                        <?php echo resultBlock($errors); ?>
                                            
                </div>
                <div class="filete"></div>
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