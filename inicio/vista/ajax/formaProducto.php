<?php
 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/producto.php");
 include_once("../../libreria/sesion.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $pro= new producto($sql);
 $lstSer = $pro->getTodosServicios();
 $lstCat = $pro->getTodosCategorias();
 $lstCar = $pro ->getTodosCaracteristicas($_POST["idproducto"]);
 if ($_POST["idproducto"] > -1){
 	$dato = $pro->getInfoProducto($_POST["idproducto"]);
	$dat = $dato[0];
	$titulo = "Modificar producto";
 } else {
	$dat= array("servicio"=>"", "idcategoria"=>"", "producto"=>"", "descripcion"=>"", "nomFoto"=>"", "analitics"=>"");
	$titulo = "Agregar producto";
 }
 
?>
<form id="forma" name="forma" method="post" action="guardarProducto.php" enctype="multipart/form-data">
<input type="hidden" id="idproducto" name="idproducto" value="<?php echo $_POST["idproducto"]?>" />
<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $_SESSION['idUsuario']?>" />
<table width="900" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="2"><?php echo $titulo?></td>
	</tr>
	<tr>
		<td align="center" colspan="2">&nbsp;</td>
	</tr>
	<tr class="fila1">
		<td width="250px" align="left" height="30px">Nombre del producto &nbsp;:&nbsp;</td>
		<td align="left">
		<input type="text" id="producto" name="producto" class="campoTexto required" size="45" value="<?=$dat["producto"];?>" maxlength="200" /></td>
	</tr>
	<tr class="fila2">
		<td align="left" height="30px">Servicio al que pertenece &nbsp;:&nbsp;</td>
		<td align="left"><select id="servicio" name="servicio" class="campoSelect validate-selection">
			<option value="0">Seleccione ..</option>
			<?
			foreach($lstSer as $ser) {
				if ($ser["idservicio"] == $dat["servicio"]){
					$selser = "selected='selected'";
				}else {
					$selser = "";
				}
				echo "<option value='" . $ser["idservicio"] . "' " . $selser . ">". $ser["nomservicio"]."</option>";
			}?>
		</select></td>
	</tr>
	<tr class="fila1">
		<td align="left" height="30px">Categor&iacute;a a la que pertenece &nbsp;:&nbsp;</td>
		<td align="left"><select id="categoria" name="categoria" class="campoSelect validate-selection">
			<option value="0">Seleccione ..</option>
			<?
			foreach($lstCat as $cat){
				if ($cat["idcategoria"] == $dat["idcategoria"]){
					$selcat = "selected='selected'";
				}else {
					$selcat = "";
				}
				
				echo "<option value='" . $cat["idcategoria"] . "' " . $selcat . ">" . $cat["categoria"] . "</option>";
			}
			?>
		</select></td>
	</tr>
	<tr class="fila2">
		<td align="left" valign="top"><br>Caracter&iacute;sticas que posee el producto&nbsp;:&nbsp;</td>
		<td align="left"><table cellpadding="0" cellspacing="1" align="center" border="0" width="99%">
			<tr class="fondoEncabezadoCliente">
				<td width="30px" align="center">&nbsp;</td>
				<td width="140px" align="center">Nombre</td>
				<td align="center">Descripci&oacute;n</td>
			</tr>
		<?
		$a = 1;
		foreach($lstCar as $car){
			$cas = ($a==1) ? $cas = "class='validate-one-required-col'" : $cas = ""; 
			
			if(strlen($car["descripcion"]) > 1){
				$selval = "checked='checked'";
				$valval = "";
			} else {
				$selval = "";
				$valval = "disabled='disabled'";
			}
			
		?>
			<tr>
				<td align="center"><input type="checkbox" id="carac_<?=$car["idcaracteristica"]?>" name="caracteristica[]" value="<?=$car["idcaracteristica"]?>" onClick="desactiva(this.checked, <?=$car["idcaracteristica"]?>)" <?=$cas?> <?=$selval?>/></td>
				<td align="center">&nbsp;<?=$car["caracteristica"]?></td>
				<td><textarea id="nomCar_<?=$car["idcaracteristica"]?>" name="nomCar_<?=$car["idcaracteristica"]?>" class="campoTexto" rows="1" cols="36" <?=$valval?>><?=$car["descripcion"]?></textarea></td>
			</tr>
		<?
			$a++;
		}
		?>
		</table></td>
	</tr>
	<tr class="fila1">
		<td align="left">Descripci&oacute;n general del producto&nbsp;:&nbsp;</td>
		<td align="left"><textarea id="descripcion" name="descripcion"><?=$dat["descripcion"];?></textarea></td>
	</tr>
	<tr class="fila2">
		<td align="left" height="40px">Imagen del producto&nbsp;:&nbsp;</td>
		<td align="left"><div id="ar_arch">
		<?
		if ($_POST["idproducto"] > -1){
		?>
		&nbsp;<img src="../imagenProducto/<?=$dat["nomFoto"]?>" width="120" height="120" />&nbsp;&nbsp;
        <a class="vinculo" onclick="subirArc('ar_arch')">Actualizar imagen</a>
		<?
		} else {
		?>
			<input type="file" id="archivo" name="archivo" class="required">
		<? }
		?>
		</div></td>
	</tr>
    <tr class="fila1">
    	<td align="left" >Codigo de Google Analitics&nbsp;:&nbsp;</td>
        <td align="left"><textarea id="analitics" name="analitics" rows="7" cols="60"><?=$dat["analitics"];?></textarea></td>
    </tr>
	<tr>
		<td colspan="2" height="30px">&nbsp;</td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input type="button" value="<?=$titulo?>" class="boton" onClick="enviaDatos('forma');"  />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" value="Regresar" class="boton" onClick="regresar('http://<?php echo $_POST['ruta']?>')" /></td>
	</tr>
</table>
</form>
<?php
unset($sql);
unset($ser);
?>