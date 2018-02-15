<?php
include_once("libreria/database.php");
include_once("libreria/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: COMPROBACION:.</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php

$sql= new database(HOST, USER, PASSWD, DATABASE);

$query = "SELECT producto.idproducto, producto.producto, producto.nomFoto, producto.nomPagina FROM producto WHERE producto.baja = false";
$sql->setQuery($query);
$result = $sql->loadMatrixAssoc();
?>
<table cellpadding="1" cellspacing="0" align="center" border="1" width="900px">
<tr class="fondoEncabezado" align="center" height="40px">
	<td width="40px">Num</td>
    <td>Producto</td>
    <td>Imagen</td>
</tr>
<?
if($sql->getnumrows() > 0) {
	foreach($result as $lst) {
?>
<tr>
	<td align="center"><?=$lst["idproducto"]?></td>
    <td align="left"><a href="../productos/<?=$lst["nomPagina"]?>" target="_blank"><?=$lst["producto"]?></a></td>
    <td align="left"><img src="imagenProducto/<?=$lst["nomFoto"]?>" width="100px" height="100px" /></td>
</tr>
<?
	}
}
?>
</table>
</body>
</html>