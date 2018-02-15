		</div>
	</div>						

	
	<footer>
		<div class="container">
			<div class="row text-center white">
			<p>Copyright © <?php echo date("Y"); ?> López Padilla. Todos los derechos reservados.</p>
			</div>
		</div>
	</footer>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/idangerous.swiper.min.js"></script>
	<script src="assets/js/jquery.viewportchecker.js"></script>
	<script src="assets/js/jquery.scrollUp.min.js"></script>		
	<script src="assets/js/isotope.pkgd.min.js"></script>
	<script src="assets/js/jquery.circliful.min.js"></script>
	<!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=es"></script> -->
	<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyCQta4ybElP11RHW44rBIXc463OSIqtgvk&sensor=true_OR_false"></script>		
	<script src="assets/js/map.js"></script>		
	<script src="assets/js/global.js"></script>
	<script >
	function submitForm() {
			$.ajax({type:'POST', url:'email-action.php', data:$('#contact-form').serialize(), success: function(response) {
			   $('.submit').html('enviar');
			   $('.success').html('Su mensaje fue enviado exitosamente');
			   document.contactform.reset();                                 
			}});                
			return false;
		}       
	</script>
  </body>
</html>