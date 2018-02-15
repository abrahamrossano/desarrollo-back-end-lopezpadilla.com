<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/entrada.php");

cabecera(0);

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new entrada($sql);
 $listaUsu = $usua->getTodasEntradas();
 $clase = "fila1";

 $rutaForm  = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

?>
<br />&nbsp;
<br />&nbsp;
<br />&nbsp;
<br />
<div id="areaEntrada">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="5">Administraci&oacute;n de novedades</td>
	</tr>
	<tr>
		<td align="center" colspan="5">&nbsp;</td>
	</tr>
	<tr class="fondoEncabezadoCliente">
		<td colspan="2" align="center" width="60px">&nbsp;</td>
		<td width="100px" align="center">T&iacute;tulo</td>
		<td width="300px" align="center">Autor</td>
		<td width="290px" align="center">Fecha registro</td>
	</tr>
	<?php
	foreach($listaUsu as $fila){
		$mens = "&iquest;Esta seguro de eliminar la novedad elegida?";
	?>
	<tr class="<?=$clase?>">
		<td width="30px" align="center"><img src="../imagen/modificar.png" style="cursor:pointer" onclick="showForma('areaEntrada', 'ajax/formaEntrada.php', 'idEntrada=<?=$fila["idEntrada"]?>&ruta=<?=$rutaForm?>');" /></td>
		<td width="30px" align="center"><img src="../imagen/eliminar.png" style="cursor:pointer" onclick="eliminar('<?=$mens?>', 'ajax/eliminaEntrada.php', <?=$fila["idEntrada"]?>);" /></td>
		<td align="center"><?=$fila["titulo"]?></td>
		<td align="left"><?=$fila["autor"]?></td>
		<td align="left"><?=$fila["fechaReg"]?></td>
	</tr>
	<?php
		$clase = ($clase == "fila1") ? $clase = "fila2" : $clase = "fila1";
	}
	?>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" align="center"><input type="button" value="Agregar novedad" class="boton" onclick="showForma('areaEntrada', 'ajax/formaEntrada.php', 'idEntrada=-1&ruta=<?=$rutaForm?>');" /></td>
	</tr>
</table>
</div>
<br /><br /><br />
<?php
unset($sql);
unset($usua);
pie();
?>
