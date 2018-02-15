<?php

 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/entrada.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new entrada($sql);

 if ($_POST["id"] > 0) {
	 $rst = $usua->delEntradas($_POST["id"]);
 }


 unset($sql);
 unset($usua);
?>
