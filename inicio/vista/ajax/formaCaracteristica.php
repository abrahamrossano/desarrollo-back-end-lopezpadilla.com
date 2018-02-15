<?php
 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/caracteristica.php");
 include_once("../../libreria/sesion.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $car= new caracteristica($sql);
 if ($_POST["idcaracteristica"] > -1){
 	$dat = $car->getInfoCaracteristica($_POST["idcaracteristica"]);
	$ser = $dat[0];
	$titulo = "Modificar caracteristica";
 } else {
	$car= array("nomcaracteristica"=>"");
	$titulo = "Agregar caracteristica";
 }
 
?>
<form id="forma" name="forma" method="post" action="guardarCaracteristica.php">
<input type="hidden" id="idcaracteristica" name="idcaracteristica" value="<?php echo $_POST["idcaracteristica"]?>" />
<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $_SESSION['idUsuario']?>" />


<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="2"><?php echo $titulo?></td>
	</tr>
	<tr>
		<td align="center" colspan="2">&nbsp;</td>
	</tr>
	<tr class="fila1" height="40px">
		<td width="200px" align="center">Nombre de la caracteristica &nbsp;:&nbsp;</td>
		<td align="left"><input type="text" id="nomcaracteristica" name="nomcaracteristica" class="campoTexto required" size="20" value="<?php echo $ser["caracteristica"];?>" maxlength="60" /></td>
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