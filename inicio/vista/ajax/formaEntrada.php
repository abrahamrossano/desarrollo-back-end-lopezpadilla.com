<?php
 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/entrada.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new entrada($sql);
 if ($_POST["idEntrada"] > -1){
	 $dat = $usua->getInfoEntradas($_POST["idEntrada"]);
	$usuario = $dat[0];
	$titulo = "Modificar novedad";
 } else {
	$usuario= array("titulo"=>"", "texto"=>"", "archivo"=>"","imagen"=>"","autor"=>"");
	$titulo = "Agregar novedad";
 }
?>
<form id="forma" name="forma" method="post" action="guardarEntrada.php" enctype="multipart/form-data">
<input type="hidden" id="idEntrada" name="idEntrada" value="<?=$_POST["idEntrada"]?>" />
<table width="450" border="0" align="center" cellpadding="2" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="3"><?=$titulo?></td>
	</tr>
	<tr>
		<td align="center" colspan="3">&nbsp;</td>
	</tr>
	<tr class="fila1" height="40">
		<td width="20" height="40" align="center">&nbsp;</td>
		<td width="129" align="left">T&iacute;tulo&nbsp;:&nbsp;</td>
		<td width="297" height="40" align="left"><input type="text" id="titulo" name="titulo" class="campoTexto required" size="30" value="<?=$usuario["titulo"]?>" /></td>
	</tr>

	<tr class="fila2">
		<td align="center" height="40">&nbsp;</td>
		<td align="left">Descripción&nbsp;:&nbsp;</td>
		<td align="left">
			<textarea id="texto" name="texto" rows="10" cols="33" class="campoTexto required"><?=$usuario["texto"]?></textarea>
			</td>
	</tr>

	<tr class="fila1">
	  <td align="center" height="40">&nbsp;</td>
	  <td align="left">Archivo PDF&nbsp;:</td>
	  <td align="left"><input type="file" id="archivo" name="archivo" />
		  <?php
				if ($_POST["idEntrada"] > -1){ ?>
		  <br />El archivo PDF guardado es: <?=$usuario["archivo"]?>
			<input type="hidden" name="arc" id="arc" value="<?=$usuario["archivo"]?>">
			<?php }else{ ?>
			<input type="hidden" name="arc" id="arc" value="0"><?php }?>
		</td>
	</tr>
	<tr class="fila2">
		<td align="center" height="40">&nbsp;</td>
		<td align="left">Imagen&nbsp;:&nbsp;</td>
		<td align="left"><input type="file" id="imagen" name="imagen"  />
			<?php
				if ($_POST["idEntrada"] > -1){ ?>
		  <br />La imagen guardada es: <?=$usuario["imagen"]?>
			<input type="hidden" name="img" id="img" value="<?=$usuario["imagen"]?>">
			<?php }else{ ?>
			<input type="hidden" name="img" id="img" value="0"><?php }?>
		</td>
	</tr>
	<tr class="fila1">
		<td align="center" height="40">&nbsp;</td>
		<td align="left">Autor&nbsp;:&nbsp;</td>
		<td align="left">
			<input type="text" id="autor" name="autor" class="campoTexto required" size="30" value="<?=$usuario["autor"]?>" />
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
