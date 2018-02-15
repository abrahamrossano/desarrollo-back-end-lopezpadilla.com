<?php
 date_default_timezone_set('Etc/UTC');
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/contacto.php");
 require_once '../libreria/correo/PHPMailerAutoload.php';
 
 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $con= new contacto($sql);
 
 $arr = explode("|*|", $_POST["conoce"]);

 $dat = array("nombre"=>$_POST["nombre"], "cargo"=>$_POST["cargo"], "empresa"=>$_POST["empresa"], "telefono"=>$_POST["telefono"],"fax"=>$_POST["fax"],"correo"=>$_POST["correo"],"sitio"=>$_POST["sitio"],"tipo"=>$_POST["tipo"],"contacto"=>$_POST["contacto"],"conoce"=>$arr[0],"caracteristicas"=>$_POST["caracteristica"]);

 
 $con->setDatos($dat);
 $r = $con->insContacto();
 if($r == 0){
	 
	$cuerpo =$con->enviaCorreo();
	
	
	// de la clase de Gmail
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 2;
	//$mail->Debugoutput = 'html';
	$mail->Host = gethostbyname('phimmsa.com.mx');
	$mail->Port = 465;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "aclientes@phimmsa.com.mx";
	$mail->Password = "Immsa123";
	
	$correo = "zavaletavero@gmail.com";
	
	$mail->setFrom('veronica.babines@distribuidoraamga.com', 'Atención a clientes');
	$mail->addAddress($correo, '');
	$mail->Subject = 'Contacto sitio Web phimmsa';
	$mail->msgHTML($cuerpo);
	$mail->send();
	
	if($re == 0) {
?>
<br /><br /><br />
<table width="100%" border="0" align="center">
	<tr>
    	<td align="center"><strong><span class="slogan"><b>&iexcl;Gracias por su registro!</b></span></strong></td>
  	</tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="center"><span class="titulos" style="text-align:center">En breve recibir&aacute; la informaci&oacute;n que ha solicitado.</span></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td align="center"><span class="titulos" style="text-align:center"><span class='slogan'><b>Importante:</b></span> Si no encuentra nuestro mensaje en la bandeja de entrada de su correo electr&oacute;nico, 
             le sugerimos <Br />revisar la bandeja de correo no deseado o SPAM.</span></td>
  	</tr>
    <tr>
    	<td>&nbsp;</td>
 	</tr>
    <tr>
    	<td align="center"><strong><a href="contacto.php" class="link" style="font-size:14px">Regresar al Formulario</a></strong></td>
  	</tr>
</table>
<br /><br /><br /><br /><br /><br /><br />
<?
	} else {
?>
<br /><br /><br /><br /><br /><br />
<p class="titulos" style="text-align:center"><b>Lo sentimos ha ocurrido un error, favor de intentarlo nuevamente.</b></p><br />
<p align="center"><strong><a href="contacto.php" class="link" style="font-size:14px">Regresar al Formulario</a></strong></p>
<br /><br /><br /><br /><br /><br />
<?
	}
}

unset($sql);
unset($con);
unset($mail);
?>