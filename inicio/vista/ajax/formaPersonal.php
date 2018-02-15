<?php
	include_once("../../libreria/database.php");
	include_once("../../libreria/config.php");
	include_once("../../libreria/personal.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new personal($sql);
 if ($_POST["idPersonal"] > -1){
	 $dat = $usua->getInfoPersonal($_POST["idPersonal"]);
	$usuario = $dat[0];
	$titulo = "Modificar personal";

 } else {
	$usuario= array("nombre"=>"", "imagenSmall"=>"", "imagen"=>"", "orden"=>"", "objetivo"=>"", "idPersonal"=>-1);
	$titulo = "Agregar personal";

 }
?>
<form id="forma" name="forma" method="post" action="guardarPersonal.php" enctype="multipart/form-data">
<input type="hidden" id="idPersonal" name="idPersonal" value="<?=$_POST["idPersonal"]?>" />

<table width="450" border="0" align="center" cellpadding="2" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="3"><?=$titulo?></td>
	</tr>
	<tr>
		<td align="center" colspan="3">&nbsp;</td>
	</tr>
	<tr class="fila1" height="40">
		<td width="20" height="40" align="center">&nbsp;</td>
		<td width="129" align="left">Nombre&nbsp;:&nbsp;</td>
		<td width="297" height="40" align="left"><input type="text" id="nombre" name="nombre" class="campoTexto required" size="20" value="<?=$usuario["nombre"]?>" /></td>
	</tr>

	<tr class="fila2">
		<td align="center" height="40">&nbsp;</td>
		<td align="left">imagenSmall&nbsp;:&nbsp;</td>
		<td align="left"><input type="file" id="imagenSmall" name="imagenSmall"/><?php
				if ($_POST["idPersonal"] > -1){ ?>
		  <br />La imagen pequeña guardada es: <?=$usuario["imagenSmall"]?>
			<input type="hidden" name="imgS" id="imgS" value="<?=$usuario["imagenSmall"]?>">
			<?php }else{ ?>
			<input type="hidden" name="imgS" id="imgS" value="0"><?php }?>
		</td>
	</tr>

	<tr class="fila1">
		<td align="center" height="40">&nbsp;</td>
		<td align="left">imagen&nbsp;:&nbsp;</td>
		<td align="left"><input type="file" id="imagen" name="imagen"  />
			<?php
				if ($_POST["idPersonal"] > -1){ ?>
		  <br />La imagen guardada es: <?=$usuario["imagen"]?>
			<input type="hidden" name="img" id="img" value="<?=$usuario["imagen"]?>">
			<?php }else{ ?>
			<input type="hidden" name="img" id="img" value="0"><?php }?>
		</td>
	</tr>

	<tr class="fila2">
	  <td align="center" height="40">&nbsp;</td>
	  <td align="left">orden:</td>
	  <td align="left"><input type="text" id="orden" name="orden" class="campoTexto required" size="32" value="<?=$usuario["orden"]?>" /></td>
	</tr>

	<tr class="fila1">
		<td align="center" height="40">&nbsp;</td>
		<td align="left">Objetivo&nbsp;:&nbsp;</td>
		<td align="left"><textarea name="objetivo" id="objetivo" rows="10" cols="50" class="campoTexto required" ><?=$usuario["objetivo"]?></textarea>
		</td>
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
