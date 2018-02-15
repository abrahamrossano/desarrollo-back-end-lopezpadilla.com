<?php
session_start();
include("libreria/login.php");

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:: ADMINISTRACION DEL SITIO - LOPEZ PADILLA ::.</title>
<style>
body{margin: 0 0 0 0}
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td height="53" background="imagen/fondoInicio.jpg">&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td align="center"><table border="0" width="620" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="250" align="center"><img src="../imagenes/index_02.jpg" border="0" /></td>
		<td width="20">&nbsp;</td>
		<td width="1" background="imagen/puntoGris.jpg"><img src="imagen/puntoGris.jpg" border="0" /></td>
		<td width="20">&nbsp;</td>
		<td><!-- aqui inicia -->

		<?php
			pideDatos($banderaForma);
		?>
		</td>
	  </tr>
	</table>
	  <br />
	  <p style="font-family:Arial, Helvetica, sans-serif; font-size:11px" align="center">Acceso exclusivo s&oacute;lo para personal del buffete</p></td>
  </tr>
</table>
</body>
</html>
