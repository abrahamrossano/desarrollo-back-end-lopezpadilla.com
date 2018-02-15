<?php
 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/categoria.php");
 include_once("../../libreria/sesion.php");
 
 $sql= new database(HOST, USER, PASSWD, DATABASE);
 
 $cat= new categoria($sql);
 if ($_POST["idcategoria"] > -1){
 	$dat = $cat->getInfoCategoria($_POST["idcategoria"]);
	$cat = $dat[0];
	$titulo = "Modificar categoria";
 } else {
	$cat= array("nombre"=>"");
	$titulo = "Agregar categoria";
	$idser	= 0;
 }

?>
<form id="forma" name="forma" method="post" action="guardarCategoria.php">
<input type="hidden" id="idcategoria" name="idcategoria" value="<?php echo $_POST["idcategoria"]?>" />
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="2"><?php echo $titulo?></td>
	</tr>
	<tr>
		<td align="center" colspan="2">&nbsp;</td>
	</tr>
	<tr class="fila1" height="40px">
		<td width="200px" align="center">Nombre de la categoria &nbsp;:&nbsp;</td>
		<td align="left"><input type="text" id="nomcategoria" name="nomcategoria" class="campoTexto required" size="20" value="<?php echo html_entity_decode($cat["nombre"]);?>" maxlength="45" /></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
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