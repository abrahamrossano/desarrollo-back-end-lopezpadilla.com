<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/contenido.php");

 cabecera(1);

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $con= new contenido($sql);
 $listaMetas = $con->getTodasMetas();
 $clase = "fila1";
 
 $rutaForm  = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

?>
<br />&nbsp;
<br />&nbsp;
<br />&nbsp;
<br />
<div id="areaMetas">
<table width="580px" border="0" align="center" cellpadding="2" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="3">Administraci&oacute;n de contenido - Metas</td>
	</tr>
	<tr>
		<td align="center" colspan="3">&nbsp;</td>
	</tr>
	<tr class="fondoEncabezadoCliente">
		<td align="center" width="40px">&nbsp;</td>
		<td align="center" width="130px">Meta</td>
		<td align="center" width="410px">Descripci&oacute;n</td>
	</tr>
	<?php
	foreach($listaMetas as $fila){
		$desc = str_replace(",", ", ", $fila["descripcion"]);
	?>
	<tr class="<?=$clase?>">
		<td width="40px" align="center"><img src="../imagen/modificar.png" style="cursor:pointer" onClick="showForma('areaMetas', 'ajax/formaMeta.php', 'idcontenido=<?php echo $fila["idcontenido"]?>&ruta=<?php echo $rutaForm?>');" /></td>
		<td align="center"><? echo $fila["meta"]?></td>
		<td align="left"><?php echo $desc?></td>
	</tr>
	<?php
		$clase = ($clase == "fila1") ? $clase = "fila2" : $clase = "fila1";  
	}	
	?>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="center"><input type="button" value="Agregar nueva meta" class="boton" onClick="showForma('areaMetas', 'ajax/formaMeta.php', 'idcontenido=-1&ruta=<?php echo $rutaForm?>');" /></td>
	</tr>
</table>
</div>
<br /><br /><br />
<?php
unset($sql);
unset($usua);
pie();
?>