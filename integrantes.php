<?php
	$link_activo = "integrantes";
	include_once("inicio/libreria/database.php");
	include_once("inicio/libreria/config.php");
	include_once("inicio/libreria/perfiles.php");
	include 'inc/header.inc';

	$sql = new database(HOST, USER, PASSWD, DATABASE);
	 $per = new perfiles($sql);
	 $abo = $per->getPerfiles(0);
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
										<h2 class="title"><span class="first">nuestros </span>abogados</h2>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-7 post fadeInRight">
										<div class="text">Nuestra mayor prioridad es brindarle a nuestros clientes un trato personalizado, ya que consideramos imprescindible el intercambio continuo de información entre la Firma y sus clientes.</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- BLOCK "TYPE 4" -->
			<div class="block type-4">
				<div class="container">
					<div class="row">
						<!-- <div class="block-header col-xs-12">
							<div class="block-header-wrapper">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-5 post fadeInLeft">
										<h2 class="title white"><span class="first">nuestros</span>abogados</h2>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-7 post fadeInRight white">
										<div class="text white text-justify">Nuestra mayor prioridad es brindarle a nuestros clientes un trato personalizado, ya que consideramos imprescindible el intercambio continuo de información entre la Firma y sus clientes, a fin de identificar con más claridad posibles problemas o mejores áreas de planeación estratégica en relación con sus negocios, lo cual crea un mayor ambiente de confianza.</div>
									</div>
								</div>
							</div>
						</div> -->
					</div>
					<div class="row team">
						<?php
							foreach($abo as $lsta){
						?>
						<div class="icon-entry col-sm-6 col-md-3 post fadeInLeft">
							<form id="law_<?php echo $lsta['idpersonal'];?>" name="law_<?php echo $lsta['idpersonal']; ?>" method="post" action="integrantest.php">
							<input type="hidden" name="idpersonal" value="<?php echo $lsta['idpersonal']; ?>">
							<img class="corner-rounding" src="<?php echo $lsta['imagenSmall']?>" alt="">
							<div class="content">
								<div class="information">
									<h3 class="name white"><?php echo $lsta['nombre']?></h3>
									<!--<div class="job white">Licenciado</div>-->
								</div>
								<div class="text white text-justify">
									<?php echo $lsta['texto'];	?>
								</div>
								<span class="button"><a class="border-black" href="javascript:{}" onclick="document.law_<?php echo $lsta['idpersonal'];?>.submit();">Perfil completo</a></span>
							</div>
							</form>
						</div>
						<?php
							}
						?>
					</div>

				</div>
			</div>

<?php include 'inc/footer.inc'; ?>
