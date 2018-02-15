<?php

 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/personal.php");

 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $usua= new personal($sql);

 if ($_POST["id"] > 0) {
	 $rst = $usua->delProfesional($_POST["id"]);
 }


 unset($sql);
 unset($usua);
?>
