<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/servicio.php");
 
 cabecera(0);
 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $ser= new servicio($sql);

 $dat= array("nomservicio"=>$_POST["nomservicio"],"descripcion"=>$_POST["descripcion"], "idservicio"=>$_POST["idservicio"]);
 $ser->setDatos($dat);
 ?>
 <br><br><br><br>
 <form id="forma_1" name="forma_1" method="post" action="formServicio.php">
 <p align='center' class='etiqueta'>
 <?php
 
 if ($_POST["idservicio"] == -1){
 	$r = $ser->insServicio();
	
	if($r == 0){
		echo "El servicio se ha ingresado correctamente. <br><br>";
	}elseif($r == 1){
		echo "El servicio '" . $_POST["nomservicio"] . "', ya se encuentra registrado en la base de datos. <br><br>";
	}elseif($r > 1){
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
	}
 } else {
 	$r = $ser->actServicio();
 	if($r == 0){
		echo "El servicio se ha modifcado correctamente. <br><br>";
	} else {
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
	}
 }
?>
<input type="submit" value="Regresar" class="boton" /></p>
<?php
 
echo "<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />";

unset($sql);
unset($usua);
pie();
?>