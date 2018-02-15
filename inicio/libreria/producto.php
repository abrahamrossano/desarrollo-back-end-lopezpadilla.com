<?php
class producto{
	private $sql;
	private $datos= array("usuario"=>"","servicio"=>"","categoria"=>"","producto"=>"", "descripcion"=>"","nomPagina"=>"","analitics"=>"","idproducto"=>"");
	
	function producto($sql){
		$this->sql = $sql;
	}
	
	function setDatos($dat){
		foreach($this->datos as $k =>$v)
			$this->datos[$k]= $dat[$k];
	}
	
	function setNombre($cadena){
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç",
		"Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã\"","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã\"","Ã‹","Ñ","à","è","ì","ò","ù", "/", "#");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C",
		"a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E","N","a","e","i","o","u", "", "");
		//quitamos los acentos
		$texto = str_replace($no_permitidas, $permitidas ,$cadena);
		//quitamos los epacios en blanco y los convertimos a _
		$texto = str_replace(" ", "_", $texto);
		return $texto;
	}
	
	function getProducto(){
		$pro = $this->datos["idproducto"];
		return $pro;
	}
	
	function getTodosServicios(){
		$query = "SELECT servicio.idservicio,servicio.nomservicio FROM servicio WHERE servicio.baja = false ";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getTodosCategorias(){
		$query = "SELECT categoria.idcategoria,categoria.categoria FROM categoria WHERE categoria.baja = false ";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getTodosCaracteristicas($pro){
		$query = sprintf("SELECT * FROM (SELECT caracteristicas.idcaracteristica, caracteristicas.caracteristica, '' AS descripcion FROM caracteristicas WHERE
		caracteristicas.baja = false AND caracteristicas.idcaracteristica NOT IN (SELECT productocar.caracteristica FROM productocar WHERE productocar.producto = %s
		 AND productocar.baja = false) UNION SELECT caracteristicas.idcaracteristica, caracteristicas.caracteristica, productocar.descripcion FROM
		 caracteristicas INNER JOIN productocar ON (caracteristicas.idcaracteristica = productocar.caracteristica) WHERE caracteristicas.baja = false AND 
		 productocar.baja = false AND productocar.producto = %s) as final ORDER BY caracteristica ",
		 	 GetSQLValueString($pro,"int"),
			 GetSQLValueString($pro,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getInfoProducto($pro){
		$query = sprintf("SELECT producto.servicio, producto.idcategoria, producto.producto, producto.descripcion, producto.nomFoto, 
		producto.analitics FROM producto WHERE producto.baja = false AND producto.idproducto = %s " ,
			 GetSQLValueString($pro,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();	
	}
	
	function getMostrarProd($pro){
		$query = sprintf("SELECT DISTINCT producto.idproducto, servicio.idservicio, categoria.idcategoria, producto.producto, servicio.nomservicio, 
		categoria.categoria, producto.descripcion, producto.nomFoto, producto.analitics, GROUP_CONCAT(CONCAT(caracteristicas.caracteristica, '|@|', 
		productocar.descripcion) ORDER BY caracteristicas.caracteristica SEPARATOR '/*-*/') AS nomCarac FROM servicio INNER JOIN producto ON (servicio.idservicio = 
		producto.servicio) INNER JOIN categoria ON (producto.idcategoria = categoria.idcategoria) INNER JOIN productocar ON (producto.idproducto = 
		productocar.producto) INNER JOIN caracteristicas ON (caracteristicas.idcaracteristica = productocar.caracteristica) WHERE producto.baja = false AND 
		productocar.baja = false AND producto.idproducto = %s GROUP BY producto.idproducto, servicio.idservicio, categoria.idcategoria, producto.producto, 
		servicio.nomservicio, categoria.categoria, producto.descripcion, producto.nomFoto, producto.analitics ",
		 	GetSQLValueString($pro,"int"));
		//echo $query . "<br>";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();	
	}
	
	function getTodosMostrar(){
		$query = "SELECT DISTINCT producto.idproducto, producto.producto, servicio.nomservicio, categoria.categoria, MAX(producto.descripcion) as descripcion,
		producto.nomFoto, GROUP_CONCAT(CONCAT(caracteristicas.caracteristica, '|@|', productocar.descripcion) SEPARATOR '/*-*/') AS nomCarac FROM servicio
		INNER JOIN producto ON (servicio.idservicio = producto.servicio) INNER JOIN categoria ON (producto.idcategoria = categoria.idcategoria) INNER JOIN
		 productocar ON (producto.idproducto = productocar.producto) INNER JOIN caracteristicas ON (caracteristicas.idcaracteristica = productocar.caracteristica)
		 WHERE producto.baja = false AND productocar.baja = false GROUP BY producto.idproducto, producto.producto, servicio.nomservicio, categoria.categoria,
		 producto.nomFoto ORDER BY producto.producto ";
		 //echo $query . "<br>";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function nombreFoto($pro, $nombre){
		$update = sprintf("UPDATE producto SET nomFoto = %s WHERE idproducto = %s ",
			GetSQLValueString($nombre,"text"),
			GetSQLValueString($pro,"int"));
		$this->sql->setQuery($update);
		$this->sql->query();

		if ($this->sql->errorNum==0) {
			$re = 1;
		}else {
			$re = 0;
		}
		
		return $re;
	}
	
	function insertarProducto(){
		$ins = sprintf("INSERT INTO producto (idusuario, servicio, idcategoria, producto, fechaAlta, baja, descripcion, nomPagina, analitics) 
		VALUES (%s, %s, %s, %s, NOW(), false, %s, %s, %s) ",
			GetSQLValueString($this->datos["usuario"],"int"),
			GetSQLValueString($this->datos["servicio"],"int"),
			GetSQLValueString($this->datos["categoria"],"int"),
			GetSQLValueString($this->datos["producto"],"text"),
			GetSQLValueString($this->datos["descripcion"],"text"),
			GetSQLValueString($this->datos["nomPagina"], "text"),
			GetSQLValueString($this->datos["analitics"], "text"));
		$this->sql->setQuery($ins);
		$this->sql->query();

		if ($this->sql->errorNum==0) {
			$re = $this->sql->getid();
			$this->datos["idproducto"] = $re;
		}else {
			$re = 0;
		}
		
		return $re;
	}
	
	function actualizaProducto(){
		$udpate = sprintf("UPDATE producto SET idusuario = %s, servicio = %s, idcategoria = %s, producto = %s, fechaAlta = NOW(), 
		descripcion = %s, analitics = %s WHERE idproducto = %s ",
			GetSQLValueString($this->datos["usuario"],"int"),
			GetSQLValueString($this->datos["servicio"],"int"),
			GetSQLValueString($this->datos["categoria"],"int"),
			GetSQLValueString($this->datos["producto"],"text"),
			GetSQLValueString($this->datos["descripcion"],"text"),
			GetSQLValueString($this->datos["analitics"], "text"),
			GetSQLValueString($this->datos["idproducto"],"int"));
		$this->sql->setQuery($udpate);
		$this->sql->query();
		if ($this->sql->errorNum==0) {
			$re = 1;
		}else {
			$re = 0;
		}
		
		return $re;
	}
	
	function eliminaProducto($producto){
		//eliminamos los hijos en caso de existir
		$elimina = sprintf("UPDATE productocar SET baja = true, fecBaja = NOW() WHERE producto = %s ",
				GetSQLValueString($producto,"int"));		
		$this->sql->setQuery($elimina);
		$this->sql->query();
		if ($this->sql->errorNum==0) {
			//eliminamos al padre para que no exista ya el producto...
			$elimina = sprintf("UPDATE producto SET baja = true, fechaBaja = NOW() WHERE idproducto = %s ",
				GetSQLValueString($producto,"int"));
			$this->sql->setQuery($elimina);
			$this->sql->query();
			$rt = ($this->sql->errorNum==0) ? $rt = 0 : $rt = 1;
		} else {
			$rt = 1;
		}
			
		return $rt;
	}
	
	function insertarCaract($carac, $forma){
		$re = 1;
		if (count($carac) > 0){
			//damos de baja las caracteristicas que tiene actualmente... 
			$elimina = sprintf("UPDATE productocar SET baja = true, fecBaja = NOW() WHERE producto = %s ",
				GetSQLValueString($this->datos["idproducto"],"int"));
			//echo $elimina . "<br>";
			$this->sql->setQuery($elimina);
			$this->sql->query();
			
			foreach($carac as $ca){
				$query = sprintf("SELECT productocar.idproductocar FROM productocar WHERE productocar.producto = %s AND productocar.caracteristica = %s ",
					GetSQLValueString($this->datos["idproducto"],"int"),
					GetSQLValueString($ca,"int"));
				//echo $query . "<br>";
				$this->sql->setQuery($query);
				$res=$this->sql->loadMatrixAssoc();
				
				$des = $forma["nomCar_" . $ca];
				if(count($res) == 0){
					//no existe la caracteristica entonces se inserta.....
					$inserta = sprintf("INSERT INTO productocar (producto, caracteristica, descripcion, fecRegistro, usuario, baja) 
					VALUES (%s, %s, %s, NOW(), %s, false) ",
						GetSQLValueString($this->datos["idproducto"],"int"),
						GetSQLValueString($ca,"int"),
						GetSQLValueString($des,"text"),
						GetSQLValueString($this->datos["usuario"],"int"));
					//echo $inserta . "<br>";
					$this->sql->setQuery($inserta);
					$this->sql->query();
					
					if ($this->sql->errorNum==0)
						$re = 0;
					else
						break;
				
				}elseif (count($res) > 0) {
					$actual = $res[0];
					$actua = sprintf("UPDATE productocar SET descripcion = %s, fecRegistro = NOW(), usuario = %s, baja = false, fecBaja = NULL 
					WHERE idproductocar = %s ",
						GetSQLValueString($des,"text"),
						GetSQLValueString($this->datos["usuario"],"int"),
						GetSQLValueString($actual["idproductocar"],"int"));
					//echo $actua. "<br><br>";
					$this->sql->setQuery($actua);
					$this->sql->query();
					
					if ($this->sql->errorNum==0)
						$re = 0;
					else
						break;
				}
			}
		}
		
		return $re;
	}
	
	
}
?>