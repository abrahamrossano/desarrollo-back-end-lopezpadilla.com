<?php
	include_once("../../libreria/database.php");
	include_once("../../libreria/config.php");
	include_once("../../libreria/personal.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new personal($sql);

$ids=$_POST["idPersonal"];
 if ($_POST["idEducacion"] > -1){
	 $dat = $usua->getInfoAcademica($_POST["idEducacion"]);
	$usuario = $dat[0];
	$titulo = "Modificar experiencia academica";

 } else {
	$usuario= array("texto"=>"", "anioIni"=>"", "anioFin"=>"","orden"=>"", "idPersonal"=>$_POST["idPersonal"], "idEducacion"=>-1);
	$titulo = "Agregar experiencia academica";
 }

?>
<form id="forma" name="forma" method="post" action="guardarPersonalAca.php" enctype="multipart/form-data">
<input type="hidden" id="idEducacion" name="idEducacion" 	value="<?=$usuario["idEducacion"] ?> "/>
	<input type="hidden" id="idPersonal" name="idPersonal" value="<?=$usuario["idPersonal"]?>" />
<table width="450" border="0" align="center" cellpadding="2" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="3"><?=$titulo?></td>
	</tr>
	<tr>
		<td align="center" colspan="3">&nbsp;</td>
	</tr>
	<tr class="fila1" height="40">
		<td width="20" height="40" align="center">&nbsp;</td>
		<td width="129" align="left">Texto&nbsp;:&nbsp;</td>
		<td width="297" height="40" align="left"><textarea name="texto" id="texto" rows="10" cols="30" class="campoTexto required" ><?=$usuario["texto"]?></textarea></td>
	</tr>

	<tr class="fila2">
		<td align="center" height="40">&nbsp;</td>
		<td align="left">Año inicio&nbsp;:&nbsp;</td>
		<td align="left"><input type="text" id="anioIni" name="anioIni" class="campoTexto required" size="40" value="<?=$usuario["anioIni"]?>" /></td>
	</tr>

	<tr class="fila1">
		<td align="center" height="40">&nbsp;</td>
		<td align="left">Año fin&nbsp;:&nbsp;</td>
		<td align="left"><input type="text" id="anioFin" name="anioFin" class="campoTexto required" size="40" value="<?=$usuario["anioFin"]?>" />
		</td>
	</tr>

	<tr class="fila2">
		<td align="center" height="40">&nbsp;</td>
		<td align="left">Orden&nbsp;:&nbsp;</td>
		<td align="left"><input type="text" id="orden" name="orden" class="campoTexto required" size="40" value="<?=$usuario["orden"]?>" /></td>
	</tr>

	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="right"><input type="button" value="<?=$titulo?>" class="boton" onclick="enviaDatos('forma');"  /> &nbsp; &nbsp;</td>
	</tr>
</table>
</form>
<?
unset($sql);
unset($usua);
?>
