<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/personal.php");

 cabecera(0);
  $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new personal($sql);

 $dat= array("texto"=> $_POST["texto"],"anioIni"=> $_POST["anioIni"],"anioFin"=> $_POST["anioFin"],"orden"=> $_POST["orden"],"idPersonal"=> $_POST["idPersonal"],"idProfesional"=> $_POST["idProfesional"]);
 $usua->setDatos3($dat);
 ?>
 <br /><br /><br /><br />
 <form id="forma_1" name="forma_1" method="post" action="formPersonal.php">
	<p align="center" class="etiqueta">
 <?php

 if ($_POST["idProfesional"] == -1){
	 $r = $usua->insProfesional();

	if($r == 0){
		echo "La experiencia profesional se ha ingresado correctamente. <br><br>";
	}else if($r == 1){
		echo "La experiencia profesional " . $_POST["texto"] . ", ya se encuentra registrada en la base de datos. <br><br>" ;
	}else if($r > 1){
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>" ;
	}
 } else {
	 $r = $usua->actProfesional();
	 if($r == 0){
		echo "La experiencia profesional se ha modifcado correctamente. <br><br>";
	} else {
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
	}
 }
 ?>
 <input type="submit" value="Regresar" class="boton" /></p></form>
 <br />&nbsp;<br />&nbsp;<br />&nbsp;<br />
<?
unset($sql);
unset($usua);
pie();
?>
