<?php 

$link_activo = "contacto";

include 'inc/header.inc'; 

?>
			
			<!-- BLOCK "TYPE 3" -->		
			<div class="block type-3">
				<!-- <img class="center-image" src="assets/img/background-7.jpg" alt="" /> -->
				<div class="container">
					<div class="row">
						<div class="block-header col-xs-12">
							<div class="block-header-wrapper">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-5 post fadeInLeft">
										<h2 class="title"><span class="first">nuestro</span>Contacto</h2>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-7 post fadeInRight">
										<!-- <div class="text">Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing</div>-->
									</div> 
								</div>
							</div>
						</div>
					</div>
					<div class="row content-block">
						<div class="col-sm-12 col-md-4 address-info">
							<h3 class="title">Información adicional</h3>
							<div class="text text-justify">
								<p>Ponemos a su disposición la siguiente información para que puedar estar en contacto con nosotros.</p>
								<p>Lo esperamos con gusto.</p>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 contact-wrapper">
							<div class="contact-entry">
								<div class="contact-icon"><img src="assets/img/c-address.png" alt=""></div>
								<div class="description">
									<div class="title">Dirección</div>
									<div class="text">Viena Nº 161. Esq. Mina<br>Col. Del Carmen Coyoacán<br>Del. Coyoacán<br>México DF<br>CP 04100</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 contact-wrapper">
							<div class="contact-entry">
								<div class="contact-icon"><img src="assets/img/c-phone.png" alt=""></div>
								<div class="description">
									<div class="title">Teléfono</div>
									<div class="text">Oficina: <a href="tel:+5233857090">(55) 5659 3041</a></div>
								</div>								
							</div>
							<div class="contact-entry">
								<div class="contact-icon"><img src="assets/img/c-email.png"  alt=""></div>
								<div class="description">
									<div class="title">E-mail</div>
									<div class="text"><a href="mailto:info@lopezpadilla.com">info@lopezpadilla.com</a></div>
								</div>								
							</div>					
						</div>						
					</div>
				</div>
			</div>
			
			<!-- BLOCK "TYPE 2" -->		
			<div class="block type-2">
				<div class="container">
					<div class="row">
						<div class="breadcrumbs post fadeInUp col-xs-12">
							<!-- <ul>
								<li><a href="#">Home</a></li>
								<li>Contact</li>							
							</ul> -->
						</div>
					</div>				
					<div class="row">
						<div class="block-header col-xs-12">
							<div class="block-header-wrapper">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-5 post animated fadeInLeft">
										<h2 class="title"><span class="first">Formulario</span>de contacto</h2>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-7 post animated fadeInRight">
										<div class="text">Puedes ponerte en contacto directamente con nosostros por medio del siguiente formulario.</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row post animated fadeInUp">
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
							<img class="img-responsive center-block" src="assets/img/contact-from.png" alt="">
						</div>
						<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 form-block">
							<form onSubmit="return submitForm();" action="./" method="post" name="contactform" id="contact-form">
								<div class="form-text">Los campos <span class="text-blue">(*)</span> son obligatorios. Acomplete el formulario y pronto nos pondremos en contacto con usted.</div>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<input class="form-input" name="name" type="text" required="" placeholder="Nombre *">
									</div>
									<div class="col-xs-12 col-sm-6">
										<input class="form-input" name="email" type="text" required="" placeholder="E-mail *">									
									</div>
									<div class="col-xs-12 col-sm-6">
										<input class="form-input" name="phone" type="text" required="" placeholder="Teléfono *">
									</div>
									<div class="col-xs-12 col-sm-6">
										<input class="form-input" name="subject" type="text" required="" placeholder="Asunto *">									
									</div>									
									<div class="col-xs-12">
										<textarea class="form-input" name="message" placeholder="Mensaje"></textarea>									
									</div>
									<div class="col-xs-12">
										<span class="button"><button class="submit" type="submit">Enviar</button></span>
										<span class="success"></span>
									</div>									
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
            <div class="mapa">
                <div id="map-canvas" data-lat="19.3558529" data-lng="-99.1671744" data-zoom="15">

                </div>
                <div class="addresses-block">
                    <a data-lat="19.3558529" data-lng="-99.1671744" data-string="Bufete López Padilla"></a>
                </div>
            </div>			
			
<?php include 'inc/footer2.inc'; ?>