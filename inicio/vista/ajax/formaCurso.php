<?php
 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/curso.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $curs= new curso($sql);
 if ($_POST["idcursos"] > -1){
 	$dat = $curs->getInfoCurso($_POST["idcursos"]);
	$curso = $dat[0];
	$titulo = "Modificar curso";
 } else {
	$curso= array("nombre"=>"");
	$titulo = "Agregar curso";
 }
?>
<form id="forma" name="forma" method="post" action="guardarCurso.php">
<input type="hidden" id="idcursos" name="idcursos" value="<?=$_POST["idcursos"]?>" />
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="2"><?=$titulo?></td>
	</tr>
	<tr>
		<td align="center" colspan="2">&nbsp;</td>
	</tr>
	<tr class="fila1" height="40px">
		<td width="200px" align="center">Nombre&nbsp;:&nbsp;</td>
		<td align="left"><input type="text" id="nombre" name="nombre" class="campoTexto required" size="20" value="<?=$curso["nombre"]?>" /></td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td align="right"><input type="button" value="<?=$titulo?>" class="boton" onclick="enviaDatos('forma');"  /></td>
		<td align="left"><input type="button" value="Regresar" class="boton" onclick="regresar('http://<?=$_POST['ruta']?>')" /></td>
	</tr>
</table>
</form>
<?
unset($sql);
unset($curs);
?>