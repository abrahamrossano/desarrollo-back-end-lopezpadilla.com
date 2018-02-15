<?php
 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/usuario.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new usuario($sql);
 if ($_POST["idUsuario"] > -1){
 	$dat = $usua->getInfoUsuario($_POST["idUsuario"]);
	$usuario = $dat[0];
	$titulo = "Modificar usuario";
 } else {
	$usuario= array("login"=>"", "nombreUsuario"=>"", "email"=>"");
	$titulo = "Agregar usuario";
 }
?>
<form id="forma" name="forma" method="post" action="guardarUsuario.php" >
<input type="hidden" id="idUsuario" name="idUsuario" value="<?=$_POST["idUsuario"]?>" />
<table width="450" border="0" align="center" cellpadding="2" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="3"><?=$titulo?></td>
	</tr>
	<tr>
		<td align="center" colspan="3">&nbsp;</td>
	</tr>
	<tr class="fila1" height="40">
		<td width="20" height="40" align="center">&nbsp;</td>
		<td width="129" align="left">Usuario&nbsp;:&nbsp;</td>
		<td width="297" height="40" align="left"><input type="text" id="login" name="login" class="campoTexto required" size="20" value="<?=$usuario["login"]?>" /></td>
	</tr>
	<?	if ($_POST["idUsuario"] <= -1) {  ?>
	<tr class="fila2">
	  <td align="center" height="40">&nbsp;</td>
	  <td align="left">Contrase&ntilde;a&nbsp;:&nbsp;</td>
	  <td align="left"><input type="text" id="contra" name="contra" class="campoTexto required" size="20" value="" /></td>
    </tr>
    <? } ?>
	<tr class="fila2">
		<td align="center" height="40">&nbsp;</td>
		<td align="left">Nombre&nbsp;:&nbsp;</td>
		<td align="left"><input type="text" id="nombre" name="nombre" class="campoTexto required" size="32" value="<?=$usuario["nombreUsuario"]?>" /></td>
	</tr>
	</tr>
	<tr class="fila1">
	  <td align="center" height="40">&nbsp;</td>
	  <td align="left">Correo electr&oacute;nico&nbsp;:</td>
	  <td align="left"><input type="text" id="correo" name="correo" class="campoTexto required" size="32" value="<?=$usuario["email"]?>" /></td>
    </tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="right"><input type="button" value="<?=$titulo?>" class="boton" onclick="enviaDatos('forma');"  /> &nbsp; &nbsp;<input type="button" value="Regresar" class="boton" onclick="regresar('http://<?=$_POST['ruta']?>')" /></td>
	</tr>
</table>
</form>
<?
unset($sql);
unset($usua);
?>