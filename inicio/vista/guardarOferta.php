<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/oferta.php");
 
 cabecera(0);
 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $ofer= new oferta($sql);
 ?>
 <br><br><br><br>
 <form id="forma_1" name="forma_1" method="post" action="formOferta.php">
 <p align='center' class='etiqueta'>
 <?php
 
 if ($_POST["idofertaSemana"] == -1){
 $extension = end(explode(".", $_FILES["archivo"]["name"]));
  $dat= array("descripcion"=>$_POST["descripcion"],"fecInicio"=>$_POST["fecInicio"], "fecFin"=>$_POST["fecFin"],"idusuario"=>$_POST["idusuario"],"idofertaSemana"=>$_POST["idofertaSemana"],"extension"=>$extension);
 $ofer->setDatos($dat);
 
 	$r = $ofer->insOferta();
	
	if($r == 0){
		$id = $ofer->obtenOferta();
		
		$extension = end(explode(".", $_FILES["archivo"]["name"]));
		$nomArchivoSubido=$id.".".$extension;
		
		$destino="../imagenOferta/".$nomArchivoSubido;
				if (copy($_FILES['archivo']['tmp_name'],$destino)) 
					{
						echo "La oferta se ha ingresado correctamente. <br><br>";
					} 
				else
					{	
					$r = $ofer->elimOferta($id);
						echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
					}	
		
		
	}elseif($r == 1){
		echo "La oferta '" . $_POST["descripcion"] . "', ya se encuentra registrado en la base de datos. <br><br>";
	}elseif($r > 1){
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
	}
 } else {
 $dat= array("descripcion"=>$_POST["descripcion"],"fecInicio"=>$_POST["fecInicio"], "fecFin"=>$_POST["fecFin"],"idusuario"=>$_POST["idusuario"],"idofertaSemana"=>$_POST["idofertaSemana"],"extension"=>"");
 $ofer->setDatos($dat);
 	$r = $ofer->actOferta();
 	if($r == 0){
			
			/*
			$extension = end(explode(".", $_FILES["archivo"]["name"]));
			$nomArchivoSubido=$_POST["idofertaSemana"].".".$extension;
			$destino="../imagenOferta/".$nomArchivoSubido;
			
				if (copy($_FILES['archivo']['tmp_name'],$destino)) 
					{
						echo "La oferta se ha modifcado correctamente. <br><br>";
					} 
				else	
					{
			*/		
		echo "La oferta se ha modifcado correctamente. <br><br>";
	//}
		
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