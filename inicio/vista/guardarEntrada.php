<?php

	include_once("../libreria/armado.php");
	include_once("../libreria/database.php");
	include_once("../libreria/config.php");
	include_once("../libreria/entrada.php");

	cabecera(0);
	$sql= new database(HOST, USER, PASSWD, DATABASE);
	$usua= new entrada($sql);

	$img = $_POST["img"];
	$arc = $_POST["arc"];

	//subida de archivo PDF
	$destino = '../../uploads/';
	$origen = $_FILES['archivo']['tmp_name'];
	$name=$_FILES['archivo']['name'];
	$error=$_FILES['archivo']['error'];
	move_uploaded_file( $origen, $destino.$name );

	//subida de imagen
	$destino2 = '../../uploads/';
	$origen2 = $_FILES['imagen']['tmp_name'];
	$name2=$_FILES['imagen']['name'];
	$error2=$_FILES['imagen']['error'];
	move_uploaded_file( $origen2, $destino2.$name2);

	//datos a ingresar / actualizar
	if($error != 4 && $error2 != 4){
		$dat= array("titulo"=> $_POST["titulo"], "texto"=>$_POST["texto"], "archivo"=>$name, "imagen"=> $name2, "autor"=>$_POST["autor"] , "idEntrada"=>$_POST["idEntrada"]);
	}
	if($error != 4 && $error2 == 4){
		$dat= array("titulo"=> $_POST["titulo"], "texto"=>$_POST["texto"], "archivo"=>$name, "imagen"=> $img, "autor"=>$_POST["autor"] , "idEntrada"=>$_POST["idEntrada"]);
	}
	if($error == 4 && $error2 != 4){
		$dat= array("titulo"=> $_POST["titulo"], "texto"=>$_POST["texto"], "archivo"=>$arc, "imagen"=> $name2, "autor"=>$_POST["autor"] , "idEntrada"=>$_POST["idEntrada"]);
	}
	if($error == 4 && $error2 == 4){
		$dat= array("titulo"=> $_POST["titulo"], "texto"=>$_POST["texto"], "archivo"=>$arc, "imagen"=> $img, "autor"=>$_POST["autor"] , "idEntrada"=>$_POST["idEntrada"]);
	}



	$usua->setDatos($dat);

 ?>
 <br /><br /><br /><br />
 <form id="forma_1" name="forma_1" method="post" action="formEntrada.php">
	<p align="center" class="etiqueta">
 <?php


 if ($_POST["idEntrada"] == -1){
	 $r = $usua->insEntradas();

	if($r == 0){
		echo "La novedad se ha ingresado correctamente. <br><br>";
	}elseif($r == 1){
		echo "La novedad " . $_POST["titulo"] . ", ya se encuentra registrada en la base de datos. <br><br>" ;
	}elseif($r > 1){
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>" ;
	}
 } else {
	 $r = $usua->actEntradas();
	 if($r == 0){
		echo "La novedad se ha modifcado correctamente. <br><br>";
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
