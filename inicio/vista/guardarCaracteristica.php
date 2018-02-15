<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/caracteristica.php");
 
 cabecera(0);
 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $car= new caracteristica($sql);

 $dat= array("nomcaracteristica"=>$_POST["nomcaracteristica"], "idcaracteristica"=>$_POST["idcaracteristica"],"idusuario"=>$_POST["idusuario"]);
 $car->setDatos($dat);
 ?>
 <br><br><br><br>
 <form id="forma_1" name="forma_1" method="post" action="formCaracteristica.php">
 <p align='center' class='etiqueta'><b>
 <?php
 
 if ($_POST["idcaracteristica"] == -1){
 	$r = $car->insCaracteristica();
	
	if($r == 0){
		echo "La caracteristica se ha ingresado correctamente. <br><br>";
	}elseif($r == 1){
		echo "El caracteristica '" . $_POST["nomcaracteristica"] . "', ya se encuentra registrado en la base de datos. <br><br>";
	}elseif($r > 1){
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
	}
 } else {
 	$r = $car->actCaracteristica();
 	if($r == 0){
		echo "La  caracteristica se ha modifcado correctamente. <br><br>";
	} else {
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
	}
 }
?></b>
<input type="submit" value="Regresar" class="boton" /></p>
<?php
 
echo "<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />";

unset($sql);
unset($usua);
pie();
?>