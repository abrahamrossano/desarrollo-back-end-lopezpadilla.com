<?php
 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/oferta.php");
 include_once("../../libreria/sesion.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $ofer= new oferta($sql);
 if ($_POST["idofertaSemana"] > -1){
 	$dat = $ofer->getInfoOferta($_POST["idofertaSemana"]);
	$ofer = $dat[0];
	$titulo = "Modificar oferta";
	$source1		= $ofer['fecInicio'];
	$fecInicio	= new DateTime($source1);
	$fecInicio=$fecInicio->format('Y-m-d');
	$source2	= $ofer['vigencia'];
	$fecFin		= new DateTime($source2);
	$fecFin=$fecFin->format('Y-m-d');

 } else {
	$ofer= array("descripcion"=>"","fecInicio"=>"","fecFin"=>"","actual"=>"");
	$titulo = "Agregar oferta";
	
 }
 $fecha_actual = date('Y/m/d');
?>
<form id="forma" name="forma" method="post" action="guardarOferta.php" enctype="multipart/form-data">
<input type="hidden" id="idofertaSemana" name="idofertaSemana" value="<?php echo $_POST["idofertaSemana"]?>" />
<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $_SESSION['idUsuario']?>" />


<table width="550" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="2"><?php echo $titulo?></td>
	</tr>
	<tr>
		<td align="center" colspan="2">&nbsp;</td>
	</tr>
	<tr class="fila1" height="40px">
		<td width="193" align="center">Descripci&oacute;n de la oferta &nbsp;:&nbsp;</td>
	  <td width="354" align="left"><input type="text" id="descripcion" name="descripcion" class="campoTexto required" size="20" value="<?php echo $ofer["descripcion"];?>" maxlength="45" /></td>
	</tr>
	<tr class="fila1" height="40px">
		<td width="193" align="center">Fecha Inicio de la oferta &nbsp;:&nbsp;</td>
		<td align="left">
		 <input type="text" id="fecInicio" name="fecInicio" class="required" readonly="false" value="<?php echo $fecInicio;?>" />
    	 <input type="button" id="calendarButton1" value="Fec Ini" onclick="fechaIni()" />
		</td>
	</tr>
	<tr class="fila1" height="40px">
		<td width="193" align="center">Fecha Fin de la oferta &nbsp;:&nbsp;</td>
		<td align="left">
		<input type="text" name="fecFin" id="fecFin" class="required" readonly="false"  value="<?php echo $fecFin;?>" />
    	 <input type="button" id="calendarButton2" value="Fec Fin" onclick="fechaFin()" />
		</td>
	</tr>
	<tr class="fila1" height="40px">
		<td width="193" align="center">Imagen de la oferta &nbsp;:&nbsp;</td>
		<td align="left">
		<input type="file" id="archivo" name="archivo" class="textoGral required"  />
		</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td align="right">
		<input type="hidden" name="fecha_actual" id="fecha_actual" value="<?php echo $fecha_actual; ?>">
		<input type="button" value="<?php echo $titulo?>" class="boton" onclick="guardarArchivoImagen();"  />
		</td>
		<td align="left"><input type="button" value="Regresar" class="boton" onclick="regresar('http://<?php echo $_POST['ruta']?>')" /></td>
	</tr>
</table>
</form>
<?php
unset($sql);
unset($ser);
?>