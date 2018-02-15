<?php
include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/personal.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new personal($sql);
 $listaUsu = $usua->getExpPro($_POST["idPersonal"]);
 $clase = "fila1";

 $ids=$_POST["idPersonal"];
 $rutaForm  = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

?>

<div id="areaPersonal">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="5">Administraci&oacute;n de experiencia profesional</td>
	</tr>
	<tr>
		<td align="center" colspan="5">&nbsp;</td>
	</tr>
	<tr class="fondoEncabezadoCliente">
		<td colspan="2" align="center" width="60px">&nbsp;</td>
		<td width="100px" align="center">Texto</td>
		<td width="300px" align="center">Año inicio</td>
		<td width="300px" align="center">Año fin</td>
	</tr>

	<?php
	$array = $listaUsu;
	if(empty($array)) {
		echo 'No hay ningun campo registrado';
		} else {

	foreach($listaUsu as $fila){
		$mens = "&iquest;Esta seguro de eliminar la experiencia profesional elegida?";
	?>
	<tr class="<?=$clase?>">

		<td width="30px" align="center"><img src="../imagen/modificar.png" style="cursor:pointer" onclick="showForma('areaPersonal', 'ajax/formaPersonalPro.php', 'idProfesional=<?=$fila["idProfesional"]?>&ruta=<?=$rutaForm?>');" /></td>

		<td width="30px" align="center"><img src="../imagen/eliminar.png" style="cursor:pointer" onclick="eliminar('<?=$mens?>', 'ajax/eliminaPersonalPro.php', <?=$fila["idProfesional"]?>);" /></td>
		<td align="left" width="350px"><?=$fila["texto"]?></td>
		<td align="left" ><?=$fila["anioIni"]?></td>
		<td align="left" ><?=$fila["anioFin"]?></td>
	</tr>
	<?php
		$clase = ($clase == "fila1") ? $clase = "fila2" : $clase = "fila1";
	}
	}
	?>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" align="center"><input type="button" value="Agregar nuevo registro" class="boton" onclick="showForma('areaPersonal', 'ajax/formaPersonalPro.php', 'idPersonal=<?=$ids?>&idProfesional=-1&ruta=<?=$rutaForm?>');" /></td>
	</tr>
</table>
</div>
<?php
unset($sql);
unset($usua);

?>
