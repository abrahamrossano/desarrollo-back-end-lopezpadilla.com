<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/usuario.php");

 cabecera(0);
  $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new usuario($sql);

 //se inserta nueva registro!....

	 $dat= array("login"=> $_POST["login"], "nombre"=>$_POST["nombre"], "email"=>$_POST["correo"], "passwd"=> $_POST["contra"],"idUsuario"=> $_POST["idUsuario"]);
	 $usua->setDatos($dat);

 ?>
 <br /><br /><br /><br />
 <form id="forma_1" name="forma_1" method="post" action="formUsers.php">
	<p align="center" class="etiqueta">
 <?php


 if ($_POST["idUsuario"] == -1){
	 $r = $usua->insUsuario();

	if($r == 0){
		echo "El usuario se ha ingresado correctamente. <br><br>";
	}elseif($r == 1){
		echo "El usuario " . $_POST["login"] . ", ya se encuentra registrado en la base de datos. <br><br>" ;
	}elseif($r > 1){
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>" ;
	}
 } else {
	 $r = $usua->actUsuario();
	 if($r == 0){
		echo "El usuario se ha modifcado correctamente. <br><br>";
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
