<?php
 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/servicio.php");
 include_once("../../libreria/sesion.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $ser= new servicio($sql);
 if ($_POST["idservicio"] > -1){
 	$dat = $ser->getInfoServicio($_POST["idservicio"]);
	$ser = $dat[0];
	$titulo = "Modificar servicio";
 } else {
	$ser= array("nomservicio"=>"","descripcion"=>"");
	$titulo = "Agregar servicio";
 }
 
?>
<form id="forma" name="forma" method="post" action="guardarServicio.php">
<input type="hidden" id="idservicio" name="idservicio" value="<?php echo $_POST["idservicio"]?>" />
<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $_SESSION['idUsuario']?>" />


<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="2"><?php echo $titulo?></td>
	</tr>
	<tr>
		<td align="center" colspan="2">&nbsp;</td>
	</tr>
	<tr class="fila1" height="40px">
		<td width="200px" align="center">Nombre del servicio &nbsp;:&nbsp;</td>
		<td align="left"><input type="text" id="nomservicio" name="nomservicio" class="campoTexto required" size="20" value="<?php echo $ser["nomservicio"];?>" maxlength="45" /></td>
	</tr>
	<tr class="fila1" height="40px">
		<td width="200px" align="center">Descripci&oacute;n del servicio &nbsp;:&nbsp;</td>
		<td align="left"><input type="text" id="descripcion" name="descripcion" class="campoTexto required" size="20" value="<?php echo $ser["descripcion"];?>" maxlength="120" /></td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td align="right"><input type="button" value="<?php echo $titulo?>" class="boton" onclick="enviaDatos('forma');"  /></td>
		<td align="left"><input type="button" value="Regresar" class="boton" onclick="regresar('http://<?php echo $_POST['ruta']?>')" /></td>
	</tr>
</table>
</form>
<?php
unset($sql);
unset($ser);
?>