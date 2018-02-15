<?php
 include_once("../../libreria/database.php");
 include_once("../../libreria/config.php");
 include_once("../../libreria/producto.php");
 
 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $pro= new producto($sql);
 
 if ($_POST["id"] > 0) {
 	$rst = $pro->eliminaProducto($_POST["id"]);
 }

 unset($sql);
 unset($pro);
?>