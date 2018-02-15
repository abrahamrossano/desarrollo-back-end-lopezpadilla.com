<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/categoria.php");

 cabecera(1);

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $cat= new categoria($sql);
 $listaCategorias = $cat->getTodosCategorias();
 $clase = "fila1";
 
 $rutaForm  = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
?>
<br />&nbsp;
<br />&nbsp;
<br />&nbsp;
<br />
<div id="areaCategoria">
<table width="350px" border="0" align="center" cellpadding="2" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="2">Administraci&oacute;n de categorias</td>
	</tr>
	<tr>
		<td align="center" colspan="2">&nbsp;</td>
	</tr>
	<tr class="fondoEncabezadoCliente">
		<td align="center" width="40px">&nbsp;</td>
		<td align="center" width="310px">Nombre</td>
	</tr>
	<?php
	foreach($listaCategorias as $fila){
	?>
	<tr class="<?php echo $clase?>">
		<td width="40px" align="center"><img src="../imagen/modificar.png" style="cursor:pointer" onClick="showForma('areaCategoria', 'ajax/formaCategoria.php', 'idcategoria=<?php echo $fila["idcategoria"]?>&ruta=<?php echo $rutaForm?>');" /></td>
		<td align="left"><?php echo html_entity_decode($fila["nombre"]);?></td>
	</tr>
	<?php
		$clase = ($clase == "fila1") ? $clase = "fila2" : $clase = "fila1";  
	}	
	?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="button" value="Agregar nueva categoria" class="boton" onClick="showForma('areaCategoria', 'ajax/formaCategoria.php', 'idcategoria=-1&ruta=<?php echo $rutaForm?>');" /></td>
	</tr>
</table>
</div>
<br /><br /><br />
<?php
unset($sql);
unset($usua);
pie();
?>