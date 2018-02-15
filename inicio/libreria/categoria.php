<?php
class categoria {
	private $sql;
	private $datos= array("nomcategoria"=>"", "idcategoria"=>-1);
	
	function categoria($sql){
		$this->sql = $sql;
	}
	
	function setDatos($dat){
		foreach($this->datos as $k =>$v)
			$this->datos[$k]= $dat[$k];
	}

	function getTodosCategorias(){
		$query = "SELECT categoria.idcategoria, categoria.nombre FROM categoria WHERE categoria.baja = 0 ";
		$this->sql->setUtf8();
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getInfoCategoria($categoria){
		$query = sprintf("SELECT categoria.idcategoria,categoria.nombre FROM categoria WHERE categoria.baja = 0 AND categoria.idcategoria = %s",
		GetSQLValueString($categoria,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function actCategoria(){
		$query = sprintf("UPDATE categoria SET nombre = %s WHERE idcategoria = %s ",
			GetSQLValueString($this->datos["nomcategoria"],"text"),
			GetSQLValueString($this->datos["idcategoria"],"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}
			
		return $re;
	}
	
	function insCategoria(){
		$re = 0;

		$query= sprintf("SELECT categoria.idcategoria FROM categoria WHERE categoria.nombre LIKE %s AND categoria.baja = false ", 
				GetSQLValueString($this->datos["nomcategoria"],"text"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if(count($res) == 0){
			//al no existir se debe insertar 
			$ins = sprintf("INSERT INTO categoria (nombre, fechaReg, baja) VALUES (%s,NOW(),false) ",
				GetSQLValueString($this->datos["nomcategoria"],"text"));
			$this->sql->setQuery($ins);
			$this->sql->query();

			if ($this->sql->errorNum==0)
				$re = 0;
			else
				$re = 2;
			
		} else {
			$re = 1;
		}
		
		return $re;
	}
}

?>