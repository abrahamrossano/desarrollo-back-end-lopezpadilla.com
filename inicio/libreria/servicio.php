<?php
class servicio {
	private $sql;
	private $datos= array("nomservicio"=>"","descripcion"=>"", "idservicio"=>-1,"idusuario"=>"");
	
	function servicio($sql){
		$this->sql = $sql;
	}
	
	function setDatos($dat){
		foreach($this->datos as $k =>$v)
			$this->datos[$k]= $dat[$k];
	}

	function getTodosServicios(){
		$query = "SELECT servicio.idservicio,servicio.nomservicio FROM servicio WHERE servicio.baja = 0 ";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getInfoServicio($servicio){
		$query = sprintf("SELECT * FROM servicio WHERE servicio.baja = 0 AND servicio.idservicio = %s",
		GetSQLValueString($servicio,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function actServicio(){
		$query = sprintf("UPDATE servicio SET nomservicio = %s,descripcion = %s  WHERE idservicio = %s ",
			GetSQLValueString($this->datos["nomservicio"],"text"),
			GetSQLValueString($this->datos["descripcion"],"text"),
			GetSQLValueString($this->datos["idservicio"],"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}
			
		return $re;
	}
	
	function insServicio(){
		$re = 0;
		$query= sprintf("SELECT servicio.idservicio FROM servicio WHERE servicio.nomservicio LIKE %s AND servicio.baja = false ", 
				GetSQLValueString($this->datos["nomservicio"],"text"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if(count($res) == 0){
			//al no existir se debe insertar 
			$ins = sprintf("INSERT INTO servicio (idusuario,fechaAlta,nomservicio,descripcion,baja) VALUES (%s,NOW(),%s,%s, false) ",
				GetSQLValueString($this->datos["idusuario"],"int"),
				GetSQLValueString($this->datos["nomservicio"],"text"),
				GetSQLValueString($this->datos["descripcion"],"text"));
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