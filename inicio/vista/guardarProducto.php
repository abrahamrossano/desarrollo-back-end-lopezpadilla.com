<?php
 include_once("../libreria/armado.php");
 include_once("../libreria/database.php");
 include_once("../libreria/config.php");
 include_once("../libreria/producto.php");
 include_once("../libreria/creacion.php");
 
 cabecera(0);
 $sql= new database(HOST, USER, PASSWD, DATABASE);
 $arc = new crearArchivo();
 $prod= new producto($sql);
 $nomArc = $prod->setNombre($_POST["producto"]);

 $dat = array("usuario"=>$_POST["idusuario"],"servicio"=>$_POST["servicio"],"categoria"=>$_POST["categoria"],"producto"=>$_POST["producto"], "descripcion"=>$_POST["descripcion"],"nomPagina"=>$nomArc.".php","analitics"=>$_POST["analitics"],"idproducto"=>$_POST["idproducto"]);
 $prod->setDatos($dat);
 ?>
 <br><br><br><br>
 <form id="forma_1" name="forma_1" method="post" action="formProducto.php">
 <p align='center' class='etiqueta'><b>
 <?php
 
 if ($_POST["idproducto"] == -1){
 	$r = $prod->insertarProducto();
	
	if($r > 0){
		$id = $prod->getProducto();
		$re = $prod->insertarCaract($_POST["caracteristica"], $_POST);
		
		if ($re == 0){
			$extension = end(explode(".", $_FILES["archivo"]["name"]));
			$nomArchivoSubido = $nomArc.".".$extension;
			
			$destino="../imagenProducto/".$nomArchivoSubido;
			if (copy($_FILES['archivo']['tmp_name'],$destino))  {
				$rf = $prod->nombreFoto($id, $nomArchivoSubido);
				$arc->setNombre(PATH_PRO . "/" . $nomArc);
				$arc->setProducto($id);
				if (strlen($_POST["analitics"]) > 1) {
					$arc->setAnalitics("ok");
				}
				$arc->setTitle("..:: PERFILES Y HERRAJES PHIMMSA ::..");
				$arc->addJs('../js/utils.js', FALSE);
				$arc->addJs('../js/prototype.js', FALSE);
				$arc->addJs('../js/validation.js', FALSE);
				$arc->addCss('../css/style.css', false);
				$arc->crear();
				$arc->writePHP();
				$arc->write();
				$arc->cuerpo();
				$arc->cerrarPHP();
				$arc->cerrar();
				echo "El producto se ha ingresado correctamente. <br><br>";
			}  else {
				$r = $prod->eliminaProducto($id);
				echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
			}	
		}else {
			echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
		}
		
	}elseif($r == 0){
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
	}
 } else {
 	$r = $prod->actualizaProducto();
	
	if($r > 0){
		$re = $prod->insertarCaract($_POST["caracteristica"], $_POST);
		if ($re == 0){
			if ($_FILES['archivo']['name'] != "" && $_FILES['archivo']['size'] != 0){ 
				$extension = end(explode(".", $_FILES["archivo"]["name"]));
				$nomArchivoSubido = $nomArc . "." . $extension;
				
				$destino="../imagenProducto/".$nomArchivoSubido;
				if (copy($_FILES['archivo']['tmp_name'],$destino))  {
					$rf = $prod->nombreFoto($_POST["idproducto"], $nomArchivoSubido);
					$arc->setNombre(PATH_PRO . "/" . $nomArc);
					$arc->setProducto($_POST["idproducto"]);
					if (strlen($_POST["analitics"]) > 1) {
						$arc->setAnalitics("ok");
					}
					$arc->setTitle("..:: PERFILES Y HERRAJES PHIMMSA ::..");
					$arc->addJs('../js/utils.js', FALSE);
					$arc->addJs('../js/prototype.js', FALSE);
					$arc->addJs('../js/validation.js', FALSE);
					$arc->addCss('../css/style.css', false);
					$arc->crear();
					$arc->writePHP();
					$arc->write();
					$arc->cuerpo();
					$arc->cerrarPHP();
					$arc->cerrar();
					echo "El producto se ha modifcado correctamente. <br><br>";
				}  else {
					echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
				}
			} else {
				echo "El productos se ha modifcado correctamente. <br><br>";
			}	
		}else {
			echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
		}
		
	} elseif($r == 0) {
		echo "Lo sentimos ha ocurrido un error, vuelva a intentarlo. <br><br>";
	}
 }
?></b>
<input type="submit" value="Regresar" class="boton" /></p>
<?php
 
echo "<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />";

unset($sql);
unset($prod);
unset($arc);
pie();
?>