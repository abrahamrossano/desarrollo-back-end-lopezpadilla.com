<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/caracteristica.php");

 cabecera(0);

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $car= new caracteristica($sql);
 $listaCaracteristicas = $car->getTodosCaracteristicas();
 $clase = "fila1";
 
 $rutaForm  = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

?>

<br />&nbsp;
<br />&nbsp;
<br />&nbsp;
<br />
<div id="areaServicio">
<table width="450px" border="0" align="center" cellpadding="2" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="2">Administraci&oacute;n de caracteristicas</td>
	</tr>
	<tr>
		<td align="center" colspan="2">&nbsp;</td>
	</tr>
	<tr class="fondoEncabezadoCliente">
		<td align="center" width="40px">&nbsp;</td>
		<td align="center" width="410px">Nombre</td>
	</tr>
	<?php
	foreach($listaCaracteristicas as $fila){
	?>
	<tr class="<?php echo $clase?>">
		<td width="40px" align="center"><img src="../imagen/modificar.png" style="cursor:pointer" onClick="showForma('areaServicio', 'ajax/formaCaracteristica.php', 'idcaracteristica=<?php echo $fila["idcaracteristica"]?>&ruta=<?php echo $rutaForm?>');" /></td>
		<td align="left"><?php echo $fila["caracteristica"]?></td>
	</tr>
	<?php
		$clase = ($clase == "fila1") ? $clase = "fila2" : $clase = "fila1";  
	}	
	?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="button" value="Agregar nueva caracteristica" class="boton" onClick="showForma('areaServicio', 'ajax/formaCaracteristica.php', 'idcaracteristica=-1&ruta=<?php echo $rutaForm?>');" /></td>
	</tr>
</table>
</div>
<br /><br /><br />
<?php
unset($sql);
unset($usua);
pie();
?>