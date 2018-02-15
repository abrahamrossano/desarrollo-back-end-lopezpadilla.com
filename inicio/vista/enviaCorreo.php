<?php

	/* Recepcionamos los datos enviados asincr�nicamente */
	
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$sitio = $_POST['sitio'];
	$mensaje = $_POST['mensaje'];
	
	$desde = "atencion.clientes@phimmsa.com";
	
	/* Definimos el correo donde enviaremos el mensaje y el asunto */
	
	$destino = "zavaletavero@gmail.com";
	$asunto = "Contacto sitio Web";
	
	/* Definimos el formato del mensaje a enviar */
	
	$cuerpo = "<br><p style='font-family:Arial, Helvetica, sans-serif; font-size:13px;' align='left'>Apreciable " . $nombre . "</p>
	<p style='font-family:Arial, Helvetica, sans-serif; font-size:12px;' align='left'>
	Se ha realizado el envio de su solicitud como a continuaci&oacute;n se muestra:&nbsp;<br>
	<strong>Nombre: </strong>". $nombre ."<br />
	<strong>Correo: </strong>". $correo ."<br />
	<strong>Sitio Web: </strong>". $sitio ."<br />
	<strong>Mensaje: </strong>". $mensaje ."<br></p>
	<p style='font-family:Arial, Helvetica, sans-serif; font-size:12px;' align='left'>En breve uno de nuestros asesores lo contactar&aacute;.</p>
	<p style='font-family:Arial, Helvetica, sans-serif; font-size:12px;' align='left'>Gracias por su atenci&oacute;n.<br>
	Atentamente Perfiles Immsa<br><br>
	NOTA. Por favor NO responda a este mensaje, el correo ha sido generado por el sistema. </p>";
	
	/* Definimos las cabeceras del mensaje */
	
	$cabecera = "MIME-Version: 1.0\r\n";
	$cabecera .= "Content-type:text/html; charset=iso-8859-1\r\n";
	$cabecera .= "From: $desde\r\n";
	$cabecera .= "Reply-to: $correo\r\n";
	$cabecera .= "Cco: $destino\r\n";
	
	/* Enviamos v�a correo, devolviendo un mensaje en caso de �xito o falla */ 
	
	if(mail($correo, $asunto, $cuerpo, $cabecera)) {
		echo "<br><br><br><p class='gracias' align='center'>Su mensaje ha sido enviado. <br> <br><br>
		Gracias por confiar en nosotros. En breve uno de nuestros asesores lo contactar&aacute;.<br><br><br><br></p>";
	}
	else {
		echo "<br><br><br><p class='gracias' align='center'>Lo sentimos ha ocurrido un error<br><br><br>
		No se pudo enviar el mensaje. Int&eacute;ntelo nuevamente.<br><br><br><br></p>";
	}
?>
<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" align="left"></p>