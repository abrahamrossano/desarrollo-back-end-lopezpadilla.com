<?php
	$link_activo = "index";
	include_once("inicio/libreria/database.php");
	 include_once("inicio/libreria/config.php");
	 include_once("inicio/libreria/perfiles.php");
	include 'inc/header.inc';

	$sql = new database(HOST, USER, PASSWD, DATABASE);
	 $per = new perfiles($sql);
	 $abo = $per->getPerfilesLimit2();
?>
			<!-- BLOCK "TYPE 1" -->
			<div class="block type-1 post fadeIn">
				<img class="center-image" src="assets/img/slide1.jpg" alt="">
				<div class="main-slider">
					<div class="swiper-container" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
						<div class="swiper-wrapper">

							<div class="swiper-slide">
								<img class="center-image" src="assets/img/slide1.jpg" alt="">
								<div class="container">
									<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 vertical-align">
										<p class="slide-name">servicios jurídicos</p>
										<p class="slide-title">Bufete López Padilla</p>
										<p class="slide-text">Nuestro Despacho está conformado por profesionistas del más alto nivel, caracterizados por su apego a los más estrictos estándares de calidad, ética, profesionalismo y trato personalizado al cliente que el mercado jurídico puede ofrecer.</p>
									</div>
								</div>
							</div>

							<div class="swiper-slide">
								<img class="center-image" src="assets/img/slide2.jpg" alt="">
								<div class="container">
									<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 vertical-align">
										<p class="slide-name">servicios jurídicos</p>
										<p class="slide-title">Bufete López Padilla</p>
										<p class="slide-text">Nuestras áreas de especialización las constituyen el Derecho Fiscal y el Derecho Administrativo, ramas respecto de las cuales ofrecemos servicios de consultoría, asesoría, planeación, litigio y representación ante las diversas autoridades administrativas y fiscales.</p>
									</div>
								</div>
							</div>

							<div class="swiper-slide">
								<img class="center-image" src="assets/img/slide3.jpg" alt="">
								<div class="container">
									<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 vertical-align">
										<p class="slide-name">servicios jurídicos</p>
										<p class="slide-title">Bufete López Padilla</p>
										<p class="slide-text">Nuestra mayor prioridad es brindarle a nuestros clientes un trato personalizado, ya que consideramos imprescindible el intercambio continuo de información entre la Firma y sus clientes.</p>
									</div>
								</div>
							</div>


						</div>

						<div class="container arrows">
							<div class="slider-arrow left hidden-xs"><img src="assets/img/arrow-left.png" alt=""></div>
							<div class="slider-arrow right hidden-xs"><img src="assets/img/arrow-right.png" alt=""></div>
						</div>
						<div class="pagination"></div>
					</div>
				</div>
			</div>

			<!-- BLOCK "TYPE 2" -->
			<div class="block type-2">
				<div class="container">
					<div class="row">
						<div class="block-header col-xs-12">
							<div class="block-header-wrapper">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-5 post animated fadeInLeft">
										<h2 class="title"><span class="first">NUESTROS</span>servicios</h2>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-7 post animated fadeInRight">
										<div class="text">Nuestro Despacho está conformado por profesionistas del más alto nivel, caracterizados por su apego a los más estrictos estándares de calidad, ética, profesionalismo y trato personalizado al cliente que el mercado jurídico puede ofrecer.</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row post animated fadeInUp">
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
							<img class="img-responsive center-block" src="assets/img/law-block.png" alt="">
						</div>
						<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 icon-blocks">
							<div class="row">
								<div class="col-xs-12 col-sm-6 services">
									<ul class="styled style-3">
										<li class="text text-justify">Nuestras áreas de especialización la constituyen el Derecho Fiscal, el Derecho Administrativo y Comercio Exterior, ramas respecto de las cuales ofrecemos servicios de consultoría, asesoría, planeación, litigio y representación ante las diversas autoridades administrativas y fiscales.</li>
									</ul>
								</div>
								<div class="col-xs-12 col-sm-6 services">
									<ul class="styled style-3">
										<li class="text text-justify">Nuestra mayor prioridad es brindarle a nuestros clientes un trato personalizado, ya que consideramos imprescindible el intercambio continuo de información entre la Firma y sus clientes.</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6 services">
									<ul class="styled style-3">
										<li class="text text-justify">Nuestros servicios se caracterizan por apegarse a los más estrictos patrones de ética profesional, los cuales identifican a cada uno de nuestros miembros. </li>
									</ul>
								</div>
								<div class="col-xs-12 col-sm-6 services">
									<ul class="styled style-3">
										<li class="text text-justify">Bufete López Padilla presta diversas clases de servicios legales que comprenden la asesoría, consultoría y litigio en el ámbito fiscal, administrativo y de comercio exterior. A continuación presentamos una semblanza de los mismos. </li>
									</ul>
								</div>
							</div>
							<div class="row text-center">
								<span class="button"><a href="servicios.php">conoce todos nuestros servicios</a></span>
							</div>
						</div>
					</div>

				</div>
			</div>

			<!-- BLOCK "TYPE 4" -->
			<div class="block type-4 white">
				<div class="container">
					<div class="row">
						<div class="block-header col-xs-12">
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
						</div>
					</div>

					<div class="row team">
						<?php
							foreach($abo as $lsta){
						?>
						<div class="icon-entry col-sm-6 col-md-4 post fadeInLeft">
							<img class="corner-rounding" src="<?php echo $lsta['imagenSmall']?>" alt="">
							<div class="content">
								<div class="information">
									<h3 class="name white"><?php echo $lsta['nombre']?></h3>
									<!--<div class="job white">Licenciado</div>-->
								</div>
								<div class="text white text-justify">
									<?php echo $lsta['texto'];	?>
								</div>
							</div>
						</div>
						<?php
							}
						?>
					</div>
					<div class="row text-center">
						<span class="button"><a class="border-black" href="integrantes.php">todos los integrantes</a></span>
					</div>

				</div>
			</div>

			<!-- BLOCK "TYPE 3" -->
			<div class="block type-3">
				<div class="container">
					<div class="row">
						<div class="block-header col-xs-12">
							<div class="block-header-wrapper">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-5 post fadeInLeft">
										<h2 class="title"><span class="first">nuestros</span>beneficios</h2>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-7 post fadeInRight">
										<div class="text text-justify">Bufete López Padilla presta diversas clases de servicios legales que comprenden la asesoría, consultoría y litigio en el ámbito fiscal, administrativo y de comercio exterior. A continuación presentamos una semblanza de los mismos.</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row content-block post fadeInUp">
						<div class="col-xs-12 col-sm-6">
							<h3 class="title text-justify">consultoria fiscal y administrativa</h3>
							<div class="text text-justify">
								<p>Los servicios de asesoría que presta la firma comprenden un espectro muy amplio, entre los que podemos citar los siguientes:</p>
								<ul class="text-justify">
									<li>Auditorías y/o revisiones por las autoridades fiscales.</li>
									<li>Interpretación y aplicación de tratados para evitar la doble tributación.</li>
									<li>Operaciones entre parte relacionadas (precios de transferencia), tanto nacionales como internacionales.</li>
									<li>Inversiones en jurisdicciones extranjeras, ya sean de tipo personal, o bien, empresarial.</li>
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<h3 class="title">litigio fiscal y administrativo</h3>
							<div class="text text-justify">
								<p>La práctica litigiosa comprende recursos administrativos ante la propia autoridad, juicios de nulidad ante el Tribunal Federal de Justicia Fiscal y Administrativa, Tribunal de lo Contencioso Administrativo del Distrito Federal y de los distintos Estados de la República, así como juicios de amparo ventilados ante las distintas instancias del Poder Judicial de la Federación.</p>
								<p>Las controversias en que se participa, comprenden tanto la defensa frente a la liquidación de créditos fiscales, como las resoluciones adversas a los intereses de nuestros clientes que dicten las autoridades fiscales en las distintas instancias iniciadas por los contribuyentes, así como la interposición de juicios de amparo indirecto en contra de leyes que sean inconstitucionales, obteniendo la devolución de las cantidades pagadas indebidamente, en su caso.</p>
							</div>
						</div>
					</div>

				</div>
			</div>

<?php include 'inc/footer.inc'; ?>
