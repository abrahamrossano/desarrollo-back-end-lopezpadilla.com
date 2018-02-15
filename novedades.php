<?php
	$link_activo = "novedades";
	include_once("inicio/libreria/database.php");
	include_once("inicio/libreria/config.php");
	include_once("inicio/libreria/novedades.php");
	include 'inc/header.inc';

	$sql = new database(HOST, USER, PASSWD, DATABASE);
	$nov = new novedades($sql);
	$abo = $nov->getNovedades(0);

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
										<div class="text"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container blog-wrapper">
				<div class="row">
					<div class="breadcrumbs col-xs-12">
<!-- 						<ul>
							<li><a href="#">Home</a></li>
							<li>Blog</li>
						</ul> -->
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 blog-inline">

						<!-- Nueva entrada -->
						<?php
							foreach($abo as $lsta){
						?>

						<div class="blog-entry">
							<div class="row">
								<form id="law_<?php echo $lsta['idEntrada'];?>" name="law_<?php echo $lsta['idEntrada']; ?>" method="post" action="blog-detail.php">
							<input type="hidden" name="idEntrada" value="<?php echo $lsta['idEntrada']; ?>">
								<div class="col-sm-12 col-md-7">
									<div class="image-column">
										<a href="#">
											<img class="img-responsive" src="uploads/<?php echo $lsta['imagen']?>" alt="">
										</a>
									</div>
								</div>
								<div class="col-sm-12 col-md-5">
									<div class="content">
										<a class="title" href="#"><?php echo $lsta['titulo']?></a>
										<div class="author">Autor: <?php echo $lsta['autor']?></div>
										<div class="description"><?php echo $lsta['texto']?></div>
										<span class="button"><a href="javascript:{}" onclick="document.law_<?php echo $lsta['idEntrada'];?>.submit();">Leer más</a></span>
									</div>
								</div>
								</form>
							</div>

						</div>
						<?php
							}
						?>
					<!-- /Nueva entrada -->


					<!-- Paginas -->
						<!-- <div class="pagination">
						  <ul>
							<li class="previous"><a href="#"></a></li>
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">...</a></li>
							<li><a href="#">10</a></li>
							<li class="next"><a href="#"></a></li>
						  </ul>
						</div>
						-->
					</div>
				</div>
			</div>

<?php include 'inc/footer.inc'; ?>
