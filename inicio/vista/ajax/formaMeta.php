<?php
 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/contenido.php");
 include_once("../../libreria/sesion.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $con= new contenido($sql);
 if ($_POST["idcontenido"] > -1){
 	$dat = $con->getInfoMeta($_POST["idcontenido"]);
	$ser = $dat[0];
	$titulo = "Modificar meta";
 } else {
	$ser= array("meta"=>"","descripcion"=>"");
	$titulo = "Agregar meta";
 }
 
?>
<form id="forma" name="forma" method="post" action="guardarMeta.php">
<input type="hidden" id="idcontenido" name="idcontenido" value="<?php echo $_POST["idcontenido"]?>" />
<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $_SESSION['idUsuario']?>" />
<table width="550" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="2"><?php echo $titulo?></td>
	</tr>
	<tr>
		<td align="center" colspan="2">&nbsp;</td>
	</tr>
	<tr class="fila1" height="40px">
		<td width="200px" align="left">&nbsp;Nombre de la meta &nbsp;:&nbsp;</td>
		<td align="left"><input type="text" id="meta" name="meta" class="campoTexto required" size="20" value="<?php echo $ser["meta"];?>" maxlength="45" /></td>
	</tr>
	<tr class="fila1" height="40px">
		<td align="left">&nbsp;Descripci&oacute;n de la meta &nbsp;:&nbsp;</td>
		<td align="left"><textarea id="descripcion" name="descripcion" class="campoTexto required" cols="45" rows="4"><?php echo $ser["descripcion"];?></textarea></td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input type="button" value="<?php echo $titulo?>" class="boton" onclick="enviaDatos('forma');"  />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" value="Regresar" class="boton" onclick="regresar('http://<?php echo $_POST['ruta']?>')" /></td>
	</tr>
</table>
</form>
<?php
unset($sql);
unset($con);
?>