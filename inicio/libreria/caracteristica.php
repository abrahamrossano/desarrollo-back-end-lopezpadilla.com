<?php
class caracteristica {
	private $sql;
	private $datos= array("nomcaracteristica"=>"","idcaracteristica"=>-1,"idusuario"=>"");
	
	function caracteristica($sql){
		$this->sql = $sql;
	}
	
	function setDatos($dat){
		foreach($this->datos as $k =>$v)
			$this->datos[$k]= $dat[$k];
	}

	function getTodosCaracteristicas(){
		$query = "SELECT caracteristicas.idcaracteristica,caracteristicas.caracteristica FROM caracteristicas WHERE caracteristicas.baja = 0 ORDER BY caracteristicas.caracteristica";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getInfoCaracteristica($caracteristica){
		$query = sprintf("SELECT * FROM caracteristicas WHERE caracteristicas.baja = 0 AND caracteristicas.idcaracteristica = %s",
		GetSQLValueString($caracteristica,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function actCaracteristica(){
		$query = sprintf("UPDATE caracteristicas SET caracteristica = %s  WHERE idcaracteristica = %s ",
			GetSQLValueString($this->datos["nomcaracteristica"],"text"),
			GetSQLValueString($this->datos["idcaracteristica"],"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}
			
		return $re;
	}
	
	function insCaracteristica(){
		$re = 0;
		$query= sprintf("SELECT caracteristicas.idcaracteristica FROM caracteristicas WHERE caracteristicas.caracteristica LIKE %s AND caracteristicas.baja = false ", 
				GetSQLValueString($this->datos["nomcaracteristica"],"text"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if(count($res) == 0){
			//al no existir se debe insertar 
			$ins = sprintf("INSERT INTO caracteristicas (caracteristica,idusuario,fecRegistro,baja) VALUES (%s,%s,NOW(), false) ",
				GetSQLValueString($this->datos["nomcaracteristica"],"text"),
				GetSQLValueString($this->datos["idusuario"],"int"));
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