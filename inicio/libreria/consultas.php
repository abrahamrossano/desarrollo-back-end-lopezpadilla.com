<?php
class consultas {
	private $sql;
	private $serv;
	private $cate;
	private $busq;

	function consultas($sql){
		$this->sql = $sql;
	}

	function setServ($ser){
		$this->serv = $ser;
	}

	function setCate($cat){
		$this->cate = $cat;
	}

	function setBusq($bus){
		$this->busq = $bus;
	}

	function getMostrar(){
		$query = "SELECT producto.idproducto, producto.producto, producto.nomFoto, producto.nomPagina FROM producto WHERE producto.baja = false ORDER BY RAND()
		LIMIT 10 ";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getNumeros(){
		$query = sprintf("SELECT MAX(total_cate) as cate, MAX(total_pro) as pro FROM(SELECT count(producto.idproducto) AS total_cate, 0 AS
		total_pro FROM producto WHERE producto.baja = false AND producto.servicio = %s AND producto.idcategoria > 1 UNION SELECT 0 as
		total_cate, count(producto.idproducto) AS total_pro FROM producto WHERE producto.baja = false AND producto.servicio = %s AND producto.idcategoria = 1 GROUP BY producto.idcategoria) as final ",
			GetSQLValueString($this->serv,"int"),
			GetSQLValueString($this->serv,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getServicioEle(){
		$query = sprintf("SELECT servicio.idservicio, servicio.nomservicio FROM servicio WHERE servicio.idservicio = %s ",
			GetSQLValueString($this->serv,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getServCatEle(){
		$query = sprintf("SELECT servicio.idservicio, servicio.nomservicio, categoria.idcategoria, categoria.categoria FROM servicio, categoria
		WHERE servicio.idservicio = %s AND categoria.idcategoria = %s ",
			GetSQLValueString($this->serv,"int"),
			GetSQLValueString($this->cate,"int"));
		//echo $query . "<br>";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();

	}

	function getCategorias(){
		$query = sprintf("SELECT DISTINCT producto.idcategoria, categoria.categoria FROM producto INNER JOIN categoria ON (producto.idcategoria
		 = categoria.idcategoria) WHERE producto.baja = false AND producto.servicio = %s AND categoria.idcategoria > 1 GROUP BY producto.idcategoria, categoria.categoria ",
			 GetSQLValueString($this->serv,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getProductos(){
		$query = sprintf("SELECT DISTINCT producto.producto, producto.nomPagina FROM producto WHERE producto.servicio = %s AND
		producto.idcategoria = %s AND producto.baja = false ",
			 GetSQLValueString($this->serv,"int"),
			GetSQLValueString($this->cate,"int"));
		//echo "<br>" . $query . "<br>";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getBusqueda(){
		if(strlen($this->busq)> 0) {
			$query = sprintf("SELECT servicio.nomservicio, producto.producto, producto.nomPagina, producto.nomFoto FROM servicio
			INNER JOIN producto ON (servicio.idservicio = producto.servicio) WHERE producto.baja = false AND producto.producto LIKE %s
			ORDER BY producto.producto",
				GetSQLValueString($this->busq,"textLike"));

		} else {
			$query = "SELECT servicio.nomservicio, producto.producto, producto.nomPagina, producto.nomFoto FROM servicio
			INNER JOIN producto ON (servicio.idservicio = producto.servicio) WHERE producto.baja = false ORDER BY producto.producto ";
		}
		//echo $query . "<br>";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

}
?>
