<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/personal.php");

 cabecera(0);
  $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new personal($sql);

	$img = $_POST["img"];
	$imgS = $_POST["imgS"];

	//subida de imagen pequeña
	$destino = '../../assets/img/equipo/small/';
	$origen = $_FILES['imagenSmall']['tmp_name'];
	$name=$_FILES['imagenSmall']['name'];
	$error=$_FILES['imagenSmall']['error'];
	move_uploaded_file( $origen, $destino.$name );

	//subida de imagen mediana
	$destino2 = '../../assets/img/equipo/medium/';
	$origen2 = $_FILES['imagen']['tmp_name'];
	$name2=$_FILES['imagen']['name'];
	$error2=$_FILES['imagen']['error'];
	move_uploaded_file( $origen2, $destino2.$name2);

	//datos a ingresar / actualizar
	if($error != 4 && $error2 != 4){
		$dat= array("nombre"=> $_POST["nombre"],"imagenSmall"=> $name,"orden"=> $_POST["orden"],"objetivo"=> $_POST["objetivo"],"imagen"=> $name2,"idPersonal"=> $_POST["idPersonal"]);
	}
	if($error != 4 && $error2 == 4){
		$dat= array("nombre"=> $_POST["nombre"],"imagenSmall"=> $name,"orden"=> $_POST["orden"],"objetivo"=> $_POST["objetivo"],"imagen"=> $img,"idPersonal"=> $_POST["idPersonal"]);
	}
	if($error == 4 && $error2 != 4){
		$dat= array("nombre"=> $_POST["nombre"],"imagenSmall"=> $imgS,"orden"=> $_POST["orden"],"objetivo"=> $_POST["objetivo"],"imagen"=> $name2,"idPersonal"=> $_POST["idPersonal"]);
	}
	if($error == 4 && $error2 == 4){
		$dat= array("nombre"=> $_POST["nombre"],"imagenSmall"=> $imgS,"orden"=> $_POST["orden"],"objetivo"=> $_POST["objetivo"],"imagen"=> $img,"idPersonal"=> $_POST["idPersonal"]);
	}
 $usua->setDatos($dat);
 ?>
 <br /><br /><br /><br />
 <form id="forma_1" name="forma_1" method="post" action="formPersonal.php">
	<p align="center" class="etiqueta">

 <?php
 if ($_POST["idPersonal"] == -1){
	 $r = $usua->insPersonal();
	 //$a = $usua->insNvoPro($_POST["idPersonal"]);
	 //$b = $usua->insNvoAca();

	if($r == 0){
		echo "El personal se ha ingresado correctamente. <br><br>";
	}else if($r == 1){
		echo "El personal " . $_POST["nombre"] . ", ya se encuentra registrado en la base de datos. <br><br>" ;
	}else if($r > 1){
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>" ;
	}
 } else {
	 $r = $usua->actPersonal();
	 if($r == 0){
		echo "El personal se ha modifcado correctamente. <br><br>";
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
