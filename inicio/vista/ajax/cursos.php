<?php
 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/seguimiento.php");
 
 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $seg= new seguimiento($sql);
 $seg->setPeriodo($_POST["periodo"]);
 $listaCur = $seg->getCursos();

 ?>
<select id="curso" name="curso" class="campoTexto validate-selection">
	<option value="0">Seleccione ..</option>
	<option value="-1">TODOS</option>
	<?
	foreach($listaCur as $cur){
		echo "<option value='" . $cur["idpromocion"] . "'>" . $cur["nombre"] . "</option>";
	}
	?>
</select>
<?
unset($sql);
unset($seg);
?>