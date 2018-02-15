<?php

	include_once("inicio/libreria/database.php");
	include_once("inicio/libreria/config.php");
	include_once("inicio/libreria/novedades.php");
	include 'inc/header.inc';

	$sql = new database(HOST, USER, PASSWD, DATABASE);
	$nov = new novedades($sql);
	$law = $_POST['idEntrada'];
	$uno = $nov->getNovedad($law);
	$uno = $uno[0];
	$pub = $nov->getNovedadesLimit($law);

?>

			<!-- BLOCK "TYPE 3" -->
			<div class="block type-3">
				<!-- <img class="center-image" src="assets/img/background-blog-v1.jpg" alt="" /> -->
				<div class="container">
					<div class="row">
						<div class="block-header col-xs-12">
							<div class="block-header-wrapper">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-5 post fadeInLeft">
										<h2 class="title"><span class="first">Novedades y </span>blog</h2>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-7 post fadeInRight">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- BLOG -->
			<div class="container blog-wrapper">
				<div class="row">
					<div class="breadcrumbs post fadeInUp col-xs-12">
					</div>
				</div>
				<div class="blog-entry post fadeInUp blog-detail">
					<h1 class="title"><?php echo $uno['titulo'];?></h1>
					<div class="data-column clearfix"></div>
					<div class="content">
						<img class="pull-left img-responsive img-rounding" src="uploads/<?php echo $uno['imagen'];?>" alt="" style="width:466px; height:361px;">
						<p class="text text-justify"><?php echo $uno['texto'];?></p>

						<center><embed src="uploads/<?php echo $uno['archivo'];?>" width="700px" height="600px">
							</center>
						<div class="author">Autor: <?php echo $uno['autor'];?></div>
					</div>
				</div>

				<div class="popular-post">
					<h3 class="title post fadeInUp highlight">Entradas destacadas</h3>
					<div class="row">

					<!-- Entrada destacada -->
						<?php
						foreach($pub as $lst){ ?>
						<div class="post fadeInLeft col-xs-12 col-sm-12 col-md-4">
							<form id="law_<?php echo $lst['idEntrada'];?>" name="law_<?php echo $lst['idEntrada']; ?>" method="post" action="blog-detail.php">
								<input type="hidden" name="idEntrada" value="<?php echo $lst['idEntrada']; ?>">
							<div class="blog-post left">
								<img class="corner-rounding" src="uploads/<?php echo $lst['imagen']?>" alt="" style="width:300px; height:200px;">
								<div class="content">
									<div class="title"><?php echo $lst['titulo']?></div>
									<div class="text"><span class="button"><a href="javascript:{}" onclick="document.law_<?php echo $lst['idEntrada'];?>.submit();">Leer más</a></span>
									</div>
								</div>
								</div>
							</form>
							</div>
						<?php } ?>
						</div>

					<!-- Entrada destacada -->

					</div>
				</div>
<?php include 'inc/footer.inc'; ?>
