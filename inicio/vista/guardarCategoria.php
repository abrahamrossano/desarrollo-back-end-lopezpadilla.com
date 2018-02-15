<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/categoria.php");
 
 cabecera(0);
 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $cat= new categoria($sql);

 $dat= array("nomcategoria"=> $sql->real_escape_string($_POST["nomcategoria"]),"idcategoria"=> $sql->real_escape_string($_POST["idcategoria"]));
 $cat->setDatos($dat);
 ?>
 <br><br><br><br>
 <form id="forma_1" name="forma_1" method="post" action="formCategoria.php">
 <p align='center' class='etiqueta'>
 <?php
 
 if ($_POST["idcategoria"] == -1){
 	$r = $cat->insCategoria();
	
	if($r == 0){
		echo "La categoria se ha ingresado correctamente. <br><br>";
	}elseif($r == 1){
		echo "La categoria '" . $_POST["nomcategoria"] . "', ya se encuentra registrado en la base de datos. <br><br>";
	}elseif($r > 1){
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
	}
 } else {
 	$r = $cat->actCategoria();
 	if($r == 0){
		echo "La categoria se ha modifcado correctamente. <br><br>";
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