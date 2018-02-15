<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/contenido.php");
 
 cabecera(0);
 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $con= new contenido($sql);

 $dat= array("meta"=>$_POST["meta"],"descripcion"=>$_POST["descripcion"], "idcontenido"=>$_POST["idcontenido"]);
 $con->setDatos($dat);
 ?>
 <br><br><br><br>
 <form id="forma_1" name="forma_1" method="post" action="formContent.php">
 <p align='center' class='etiqueta'>
 <?php
 
 if ($_POST["idcontenido"] == -1){
 	$r = $con->insMeta();
	
	if($r == 0){
		echo "La meta se ha ingresado correctamente. <br><br>";
	}elseif($r == 1){
		echo "La meta'" . $_POST["nombre"] . "', ya se encuentra registrada en la base de datos. <br><br>";
	}elseif($r > 1){
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
	}
 } else {
 	$r = $con->actMeta();
 	if($r == 0){
		echo "La meta se ha modifcado correctamente. <br><br>";
	} else {
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
	}
 }
?>
<input type="submit" value="Regresar" class="boton" /></p>
<?php
 
echo "<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />";

unset($sql);
unset($con);
pie();
?>