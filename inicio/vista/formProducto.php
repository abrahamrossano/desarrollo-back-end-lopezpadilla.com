<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/producto.php");

 cabecera(2);

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $pro= new producto($sql);
 $listaProd = $pro->getTodosMostrar();
 $clase = "fila1";
 
 $rutaForm  = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
?>
<br />&nbsp;
<br />&nbsp;
<br />&nbsp;
<br />
<div id="areaServicio">
<table width="790px" border="0" align="center" cellpadding="2" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="4">Administraci&oacute;n de Productos</td>
	</tr>
	<tr>
		<td align="center" colspan="4">&nbsp;</td>
	</tr>
	<tr class="fondoEncabezadoCliente">
		<td align="center" colspan="2">&nbsp;</td>
        <td align="center" width="350px">Producto - Informaci&oacute;n</td>
        <td align="center" width="150px">Imagen</td>
	</tr>
	<?php
	foreach($listaProd as $fila){
		$mens = "&iquest;Esta seguro de eliminar el producto elegido?";
	?>
	<tr class="<?=$clase?>">
		<td width="20px" align="center"><img src="../imagen/modificar.png" style="cursor:pointer" onClick="showFormaView('areaServicio', 'ajax/formaProducto.php', 'idproducto=<?=$fila["idproducto"]?>&ruta=<?= $rutaForm?>');" alt="Editar producto" title="Editar producto" /></td>
        <td width="20px" align="center"><img src="../imagen/eliminar.png" style="cursor:pointer" onclick="eliminar('<?=$mens?>', 'ajax/eliminaProd.php', <?=$fila["idproducto"]?>);" alt="Eliminar producto" title="Eliminar producto" /></td>
        <td align="left"><table cellpadding="0" cellspacing="0" align="center" border="0" width="98%">
        	<tr>
            	<td align="center" colspan="2"><b><? echo $fila["producto"]?></b></td>
           	</tr>
            <tr>
            	<td align="left" width="100px" valign="top"><b>Servicio&nbsp;:&nbsp;</b></td>
                <td align="left"><?=$fila["nomservicio"]?></td>
            </tr>
			<?
			if ($fila["categoria"] != "No aplica") {
			?>
            <tr>
            	<td align="left" valign="top"><b>Categor&iacute;a&nbsp;:&nbsp;</b></td>
                <td align="left"><?=$fila["categoria"]?></td>
            </tr>
            <?
			}
			
            if (strlen($fila["descripcion"]) > 2){
			?>
            <tr>
            	<td align="left" valign="top"><b>Descripci&oacute;n&nbsp;:&nbsp;</b></td>
                <td align="left"><? echo html_entity_decode($fila["descripcion"])?></td>
            </tr>
            <?	
			}
			
			$arr_uno = explode('/*-*/', $fila["nomCarac"]);
			foreach($arr_uno as $arr){
				$ar = explode('|@|', $arr);
			?>
            <tr>
            	<td align="left" valign="top"><b><?=$ar[0]?>&nbsp;:&nbsp;</b></td>
                <td align="left"><?=$ar[1]?></td>
            </tr>
            <?	
			}
			?>
        </table></td>
        <td align="center"><img src="../imagenProducto/<?=$fila["nomFoto"]?>" width="120" height="140" /></td>
	</tr>
	<?php
		$clase = ($clase == "fila1") ? $clase = "fila2" : $clase = "fila1";  
	}	
	?>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4" align="center"><input type="button" value="Agregar nuevo producto" class="boton" onClick="showFormaView('areaServicio', 'ajax/formaProducto.php', 'idproducto=-1&ruta=<?php echo $rutaForm?>');" /></td>
	</tr>
</table>
</div>
<br /><br /><br />
<?php
unset($sql);
unset($pro);
pie();
?>