<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/usuario.php");

cabecera(0);

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new usuario($sql);
 $listaUsu = $usua->getTodosUsuarios();
 $clase = "fila1";

 $rutaForm  = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

?>
<br />&nbsp;
<br />&nbsp;
<br />&nbsp;
<br />
<div id="areaUsua">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="5">Administraci&oacute;n de usuarios</td>
	</tr>
	<tr>
		<td align="center" colspan="5">&nbsp;</td>
	</tr>
	<tr class="fondoEncabezadoCliente">
		<td colspan="2" align="center" width="60px">&nbsp;</td>
		<td width="100px" align="center">Usuario</td>
		<td width="300px" align="center">Nombre</td>
		<td width="290px" align="center">Correo electr&oacute;nico</td>
	</tr>
	<?php
	foreach($listaUsu as $fila){
		$mens = "&iquest;Esta seguro de eliminar el usuario elegido?";
	?>
	<tr class="<?=$clase?>">
		<td width="30px" align="center"><img src="../imagen/modificar.png" style="cursor:pointer" onclick="showForma('areaUsua', 'ajax/formaUsuario.php', 'idUsuario=<?=$fila["idUsuario"]?>&ruta=<?=$rutaForm?>');" /></td>
		<td width="30px" align="center"><img src="../imagen/eliminar.png" style="cursor:pointer" onclick="eliminar('<?=$mens?>', 'ajax/eliminaUser.php', <?=$fila["idUsuario"]?>);" /></td>
		<td align="center"><?=$fila["login"]?></td>
		<td align="left"><?=$fila["nombreUsuario"]?></td>
		<td align="left"><?=$fila["email"]?></td>
	</tr>
	<?php
		$clase = ($clase == "fila1") ? $clase = "fila2" : $clase = "fila1";
	}
	?>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" align="center"><input type="button" value="Agregar nuevo usuario" class="boton" onclick="showForma('areaUsua', 'ajax/formaUsuario.php', 'idUsuario=-1&ruta=<?=$rutaForm?>');" /></td>
	</tr>
</table>
</div>
<br /><br /><br />
<?php
unset($sql);
unset($usua);
pie();
?>
