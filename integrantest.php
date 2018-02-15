<?php
	$link_activo = "integrantes";
	include_once("inicio/libreria/database.php");
	 include_once("inicio/libreria/config.php");
	 include_once("inicio/libreria/perfiles.php");
	include 'inc/header.inc';

	$sql = new database(HOST, USER, PASSWD, DATABASE);
	 $per = new perfiles($sql);
	 $law = $_POST['idpersonal'];
	 $uno = $per->getPersonal($law);
	 $uno = $uno[0];
	 $dos = $per->getEducacion($law);
	 $tre = $per->getProfesional($law);
	 $abo = $per->getPerfiles($law);
	 $lim = $per->getPerfilesLimit($law);

?>

			<!-- BLOCK "TYPE 3" -->
			<div class="block type-3">
				<!-- <img class="center-image" src="assets/img/background-blog-v2.jpg" alt="" /> -->
				<div class="container">
					<div class="row">
						<div class="block-header col-xs-12">
							<div class="block-header-wrapper">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-5 post fadeInLeft">
										<h2 class="title"><span class="first">Nuestros </span>abogados</h2>
									</div>
									<!--<div class="col-xs-12 col-sm-6 col-md-7 post fadeInRight">
										<div class="text">Nuestra mayor prioridad es brindarle a nuestros clientes un trato personalizado, ya que consideramos imprescindible el intercambio continuo de información entre la Firma y sus clientes.</div>
									</div>-->
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
				<!-- Servicio #1 -->
				<div class="blog-entry post fadeInUp blog-detail">
					<h1 class="title"><?php echo $uno['nombre'];?></h1>
					<div class="content">
						<div class="col-xs-12 col-sm-5">
							<img class="pull-left img-responsive img-rounding" src="<?php echo $uno['imagen'];?>" alt="">
						</div>

						<div class="col-xs-12 col-sm-7">
							<!-- Para el rubro de educacion -->
							<h2>Experiencia acad&eacute;mica</h2>
							<ul class="styled style-3 text-justify">
								<?php foreach($dos as $key){
									$interval = "";
									if((int) $key['anioIni'] > 0){
										$interval .= $key['anioIni'] . " " ;
									}

									if((int) $key['anioFin'] > 0){
										$interval .= " - " . $key['anioFin'];
									}

									if(strlen($interval) > 2){
										$interval .= "<br/>";
									}
								?>
								<li><b><?php echo $interval; ?> </b><?php echo $key['texto']?></li>
								<?php
								}?>
							</ul>
							<!-- ********************************* -->
							<br/>
							<!-- Para el rubro de la experiencia profesional -->
							<h2>Experiencia profesional</h2>
							<ul class="styled style-3 text-justify">
								<?php foreach($tre as $val){
									$interval = "";
									if((int) $val['anioIni'] > 0){
										$interval .= $val['anioIni'] . " " ;
									}

									if((int) $val['anioFin'] > 0){
										$interval .= " - " . $val['anioFin'];
									}

									if(strlen($interval) > 2){
										$interval .= "<br/>";
									}
								?>
								<li><b><?php echo $interval; ?> </b><?php echo $val['texto']?></li>
								<?php
								}?>
							</ul>
							<!-- ********************************* -->
						</div>
					</div>
				</div>
				<!-- ./ Servicio #1 -->
			</div>
		</div>

	</div>


<div class="block type-4 white">
				<div class="container">
					<div class="row">
						<div class="block-header col-xs-12">
							<div class="block-header-wrapper">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-5 post fadeInLeft animated">
										<h2 class="title white"><span class="first">nuestro </span>equipo</h2>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-7 post fadeInRight white animated">
										<div class="text white">Nuestra mayor prioridad es brindarle a nuestros clientes un trato personalizado, ya que consideramos imprescindible el intercambio continuo de información entre la Firma y sus clientes, a fin de identificar con más claridad posibles problemas o mejores áreas de planeación estratégica en relación con sus negocios, lo cual crea un mayor ambiente de confianza.</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row team">
						<?php foreach($lim as $lst){
						?>
						<div class="icon-entry col-sm-6 col-md-3 post fadeInLeft animated">
							<form id="law_<?php echo $lst['idpersonal'];?>" name="law_<?php echo $lst['idpersonal']; ?>" method="post" action="integrantest.php">
							<input type="hidden" name="idpersonal" value="<?php echo $lst['idpersonal']; ?>">
								<img class="corner-rounding" src="<?php echo $lst['imagenSmall']?>"  alt="">
								<div class="content">
									<div class="information">
										<h3 class="name white"><?php echo $lst['nombre'];?></h3>
									</div>
								</div>
								<div class="text white text-justify">
										<?php echo $lst['texto'];	?>
								</div>
								<span class="button"><a class="border-black" href="javascript:{}" onclick="document.law_<?php echo $lst['idpersonal'];?>.submit();">Perfil completo</a></span>
							</form>
						</div>
						<?php
						}?>
					</div>
<?php include 'inc/footer.inc'; ?>
