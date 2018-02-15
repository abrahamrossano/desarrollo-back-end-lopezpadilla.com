<?php
class oferta {
	private $sql;
	private $datos= array("descripcion"=>"","fecInicio"=>"","fecFin"=>"","actual"=>-1, "idofertaSemana"=>-1,"idusuario"=>"","extension"=>"");
	
	function oferta($sql){
		$this->sql = $sql;
	}
	
	function setDatos($dat){
		foreach($this->datos as $k =>$v)
			$this->datos[$k]= $dat[$k];
	}

	function getTodosOfertas(){
		$query = "SELECT ofertasemana.idofertaSemana,ofertasemana.fecInicio,ofertasemana.vigencia,ofertasemana.descripcion,ofertasemana.actual FROM ofertasemana WHERE ofertasemana.baja = 0";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getTodosOfertasVigentes(){
		$query = "SELECT 
  ofertasemana.idofertaSemana,
  ofertasemana.fecInicio,
  ofertasemana.vigencia,
  ofertasemana.descripcion,
  ofertasemana.actual,
  ofertasemana.extension
FROM
  ofertasemana
WHERE
  ofertasemana.baja = 0 AND 
  now() BETWEEN ofertasemana.fecInicio AND ofertasemana.vigencia";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getInfoOferta($oferte){
		$query = sprintf("SELECT ofertasemana.idofertaSemana,ofertasemana.fecInicio,ofertasemana.vigencia,ofertasemana.descripcion,ofertasemana.actual FROM ofertasemana WHERE ofertasemana.baja = 0 AND ofertasemana.idofertaSemana = %s",
		GetSQLValueString($oferte,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function actOferta(){
		$query = sprintf("UPDATE ofertasemana SET descripcion = %s,fecInicio = %s,vigencia=%s,actual=1  WHERE idofertaSemana = %s ",
			GetSQLValueString($this->datos["descripcion"],"text"),
			GetSQLValueString($this->datos["fecInicio"],"text"),
			GetSQLValueString($this->datos["fecFin"],"text"),
			GetSQLValueString($this->datos["idofertaSemana"],"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}
			
		return $re;
	}
	
	function insOferta(){
		$re = 0;
			$ins = sprintf("INSERT INTO ofertasemana (idusuario,fecAlta,fecInicio,vigencia,descripcion,actual,baja,extension) VALUES (%s,NOW(),%s,%s,%s,1,false,%s) ",
				GetSQLValueString($this->datos["idusuario"],"int"),
				GetSQLValueString($this->datos["fecInicio"],"text"),
				GetSQLValueString($this->datos["fecFin"]." 23:59:59","text"),
				GetSQLValueString($this->datos["descripcion"],"text"),
				GetSQLValueString($this->datos["extension"],"text"));
			//echo $ins . "<br>";
			$this->sql->setQuery($ins);
			$this->sql->query();

			if ($this->sql->errorNum==0)
				$re = 0;
			else
				$re = 2;
		
		return $re;
	}
	
	function obtenOferta(){
			$re = 0;
			$rs = mysql_query("SELECT MAX(idofertaSemana) AS id FROM ofertasemana");
			if ($row = mysql_fetch_row($rs))
			{
				$id = trim($row[0]);
			}
				$re = $id;
		
		return $re;
	}
	
	function elimOferta($idOferta){
		$query = sprintf("UPDATE ofertasemana SET baja=1  WHERE idofertaSemana = %s ",
			GetSQLValueString($elimOferta,"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}
			
		return $re;
	}
}

?>