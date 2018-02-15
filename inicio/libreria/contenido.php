<?php
class contenido {
	private $sql;
	private $datos= array("meta"=>"","descripcion"=>"", "idcontenido"=>-1,"idusuario"=>"");
	
	function contenido($sql){
		$this->sql = $sql;
	}
	
	function setDatos($dat){
		foreach($this->datos as $k =>$v)
			$this->datos[$k]= $dat[$k];
	}

	function getTodasMetas(){
		$query = "SELECT contenido.idcontenido, contenido.meta, contenido.descripcion FROM contenido WHERE contenido.baja = 0 ";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getInfoMeta($idcont){
		$query = sprintf("SELECT * FROM contenido WHERE contenido.baja = 0 AND contenido.idcontenido = %s",
		GetSQLValueString($idcont,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function actMeta(){
		$query = sprintf("UPDATE contenido SET meta = %s,descripcion = %s  WHERE idcontenido = %s ",
			GetSQLValueString($this->datos["meta"],"text"),
			GetSQLValueString($this->datos["descripcion"],"text"),
			GetSQLValueString($this->datos["idcontenido"],"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}
			
		return $re;
	}
	
	function insMeta(){
		$re = 0;
		$query= sprintf("SELECT contenido.idcontenido FROM contenido WHERE contenido.meta LIKE %s AND contenido.baja = false ", 
				GetSQLValueString($this->datos["meta"],"text"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if(count($res) == 0){
			//al no existir se debe insertar 
			$ins = sprintf("INSERT INTO contenido (meta,descripcion,fecRegistro,baja) VALUES (%s,%s,NOW(),false) ",
				GetSQLValueString($this->datos["meta"],"text"),
				GetSQLValueString($this->datos["descripcion"],"text"));
			//echo $ins . "<br>";
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