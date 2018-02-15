<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/personal.php");

cabecera(0);

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new personal($sql);
 $listaUsu = $usua->getTodosPersonal();
 $clase = "fila1";

 $rutaForm  = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

?>
<br />&nbsp;
<br />&nbsp;
<br />&nbsp;
<br />
<div id="areaPersonal">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="5">Administraci&oacute;n de personal</td>
	</tr>
	<tr>
		<td align="center" colspan="5">&nbsp;</td>
	</tr>
	<tr class="fondoEncabezadoCliente">
		<td colspan="4" align="center" width="60px">&nbsp;</td>
		<td width="100px" align="center">Nombre</td>
		<td width="300px" align="center">Fecha de Registro</td>
	</tr>
	<?php
	foreach($listaUsu as $fila){
		$mens = "&iquest;Esta seguro de eliminar el personal elegido?";
	?>
	<tr class="<?=$clase?>">
		<td width="30px" align="center"><img src="../imagen/academico.png" style="cursor:pointer" onclick="showForma('areaPersonal', 'formaPerAca.php', 'idPersonal=<?=$fila["idPersonal"]?>&ruta=<?=$rutaForm?>');" width="25px" /></td>
		<td width="30px" align="center"><img src="../imagen/profesional.png" style="cursor:pointer" onclick="showForma('areaPersonal', 'formaPerExp.php', 'idPersonal=<?=$fila["idPersonal"]?>&ruta=<?=$rutaForm?>');" width="25px"/></td>

		<td width="30px" align="center"><img src="../imagen/modificar.png" style="cursor:pointer" onclick="showForma('areaPersonal', 'ajax/formaPersonal.php', 'idPersonal=<?=$fila["idPersonal"]?>&ruta=<?=$rutaForm?>');" /></td>
		<td width="30px" align="center"><img src="../imagen/eliminar.png" style="cursor:pointer" onclick="eliminar('<?=$mens?>', 'ajax/eliminaPersonal.php', <?=$fila["idPersonal"]?>);" /></td>
		<td align="left" width="350px"><?=$fila["nombre"]?></td>
		<td align="left" ><?=$fila["fechaReg"]?></td>
	</tr>
	<?php
		$clase = ($clase == "fila1") ? $clase = "fila2" : $clase = "fila1";
	}
	?>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" align="center"><input type="button" value="Agregar nuevo personal" class="boton" onclick="showForma('areaPersonal', 'ajax/formaPersonal.php', 'idPersonal=-1&ruta=<?=$rutaForm?>');" /></td>
	</tr>
</table>
</div>
<br /><br /><br />
<?php
unset($sql);
unset($usua);
pie();
?>
