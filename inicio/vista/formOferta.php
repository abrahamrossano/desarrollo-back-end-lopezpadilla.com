<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/oferta.php");

 cabecera(1);

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $ofer= new oferta($sql);
 $listaOfertas = $ofer->getTodosOfertas();
 $clase = "fila1";
 
 $rutaForm  = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$fecha_actual = date('Y-m-d');
?>

<br />&nbsp;
<br />&nbsp;
<br />&nbsp;
<br />
<div id="areaServicio">
<table width="580px" border="0" align="center" cellpadding="2" cellspacing="1">
	<tr>
		<td align="center" class="textoContacto" colspan="5">Administraci&oacute;n de ofertas</td>
	</tr>
	<tr>
		<td align="center" colspan="5">&nbsp;</td>
	</tr>
	<tr class="fondoEncabezadoCliente">
		<td align="center" width="40px">&nbsp;</td>
		<td align="center" width="250px">Descrpci&oacute;n</td>
		<td align="center" width="120px">Incio Oferta</td>
		<td align="center" width="120px">Fin Oferta</td>
		<td align="center" width="50px">Vigente</td>
	</tr>
	<?php
	foreach($listaOfertas as $fila){
	?>
	<tr class="<?php echo $clase?>">
		<td width="40px" align="center"><img src="../imagen/modificar.png" style="cursor:pointer" onClick="showForma('areaServicio', 'ajax/formaOferta.php', 'idofertaSemana=<?php echo $fila["idofertaSemana"]?>&ruta=<?php echo $rutaForm?>');" /></td>
		<td align="left"><?php echo $fila["descripcion"]?></td>
		<td align="left">
			<?php
			$source1		= $fila['fecInicio'];
			$fecInicio	= new DateTime($source1);
			echo $fecInicio->format('Y-m-d')
			?>
		</td>
		<td align="left">
			<?php
			$source2		= $fila['vigencia'];
			$fecFin			= new DateTime($source2);
			echo $fecFin->format('Y-m-d')
			?>
		</td>
		<td align="left">
			<?php 
				if ($fecha_actual<=$fila["vigencia"]) 
				{
					$actual="Si";
				}
				else
				{
					$actual="No";
				}
				echo $actual;
			?>
			</td>
	</tr>
	<?php
		$clase = ($clase == "fila1") ? $clase = "fila2" : $clase = "fila1";  
	}	
	?>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" align="center"><input type="button" value="Agregar nueva oferta" class="boton" onClick="showForma('areaServicio', 'ajax/formaOferta.php', 'idofertaSemana=-1&ruta=<?php echo $rutaForm?>');" /></td>
	</tr>
</table>
</div>
<br /><br /><br />
<?php
unset($sql);
unset($usua);
pie();
?>