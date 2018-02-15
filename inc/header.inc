<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bufete López Padilla</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/idangerous.swiper.css" rel="stylesheet">
	<link href="assets/css/animate.css" rel="stylesheet">
	<link href="assets/css/jquery.circliful.css" rel="stylesheet">		
	<link href="assets/css/style.css" rel="stylesheet">

    <link rel="shortcut icon" href="assets/img/favicon.ico" />	

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="header-moved">

    <!-- LOADER -->
    <div id="loader-wrapper">
        <div class="loader-content">
            <img src="assets/img/gavel.gif" alt="">
            <div class="title">Cargando...</div>
        </div>
    </div>

	<header>
		<div class="top-line hidden-xs">
			<div class="container">
				<div class="contact">
					<span><img src="assets/img/email.png" alt=""><a href="mailto:e-mail@MyLawyer.com">info@lopezpadilla.com</a></span>
					<span><img src="assets/img/phone.png" alt=""><a href="tel:5233857090">(55) 5659 3041</a></span>
				</div>
				<div class="social">
					<a target="_blank" href="https://www.facebook.com/BufeteLopezPadillaSC/"><img src="assets/img/facebook.png" alt=""></a>		
					<a target="_blank" href="https://www.linkedin.com/company/bufete-lopez-padilla?trk=prof-following-company-logo"><img src="assets/img/linked-in.png" alt=""></a>
				</div>
			</div>
		</div>
		<nav>
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a id="logo" class="clearfix" href="index.php"><img src="assets/img/logo.png" alt=""></a>
			</div>
			<?php include 'menu.php' ?>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="<?php echo $index ?>"><a href="index.php">Inicio</a></li>
					<li class="<?php echo $integrantes ?>"><a href="integrantes.php">Integrantes</a></li>
					<li class="<?php echo $servicios ?>"><a href="servicios.php">Servicios</a></li>
					<li class="<?php echo $novedades ?>"><a href="novedades.php">Novedades</a></li>
					<li class="<?php echo $newsletter ?>"><a href="newsletter.php">Newsletter</a></li>
					<li class="<?php echo $contacto ?>"><a href="contacto.php">Contacto</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		  </div>
		</nav>	
	</header>
	
	<div id="content-wrapper">
		<div class="blocks-container">