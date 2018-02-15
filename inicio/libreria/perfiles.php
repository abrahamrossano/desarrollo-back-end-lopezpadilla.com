<?php
class perfiles {
	private $sql;

	function perfiles($sql){
		$this->sql = $sql;
	}


	function getPerfiles($excepto = 0){
		$aux = "";
		if($excepto > 0){
			$aux = " AND PE.idPersonal <> " . $excepto;
		}

		$query = "SELECT PE.nombre, PE.imagenSmall, ED.texto, ED.idpersonal FROM educacion as ED " .
			"INNER JOIN personal PE ON (PE.idPersonal = ED.idPersonal) " .
			"INNER JOIN (SELECT MAX(EE.orden) as orden, EE.idpersonal FROM educacion EE WHERE baja = 0 GROUP BY EE.idpersonal) AS MA " .
			"ON (MA.idPersonal = ED.idPersonal AND MA.orden = ED.orden) WHERE PE.baja = 0 " . $aux . " ORDER BY PE.orden ";
		$this->sql->setUtf8();
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getPerfilesLimit(){
		$query = "SELECT PE.nombre, PE.imagenSmall, ED.texto, ED.idpersonal FROM educacion as ED " .
			"INNER JOIN personal PE ON (PE.idPersonal = ED.idPersonal) " .
			"INNER JOIN (SELECT MAX(EE.orden) as orden, EE.idpersonal FROM educacion EE WHERE baja = 0 GROUP BY EE.idpersonal) AS MA " .
			"ON (MA.idPersonal = ED.idPersonal AND MA.orden = ED.orden) WHERE PE.baja = 0 ORDER BY rand(PE.orden) LIMIT 4";
		$this->sql->setUtf8();
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getPerfilesLimit2(){
		$query = "SELECT PE.nombre, PE.imagenSmall, ED.texto, ED.idpersonal FROM educacion as ED " .
			"INNER JOIN personal PE ON (PE.idPersonal = ED.idPersonal) " .
			"INNER JOIN (SELECT MAX(EE.orden) as orden, EE.idpersonal FROM educacion EE WHERE baja = 0 GROUP BY EE.idpersonal) AS MA " .
			"ON (MA.idPersonal = ED.idPersonal AND MA.orden = ED.orden) WHERE PE.baja = 0 ORDER BY PE.orden LIMIT 3";
		$this->sql->setUtf8();
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getPersonal($persona){
		$query = "SELECT nombre, imagen, objetivo FROM personal WHERE baja = 0 AND idpersonal = " . $persona . " ";
		$this->sql->setUtf8();
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getEducacion($persona){
		$query = "SELECT anioIni, anioFin, texto FROM educacion WHERE baja = 0 AND idpersonal = " . $persona . " ORDER BY orden";
		$this->sql->setUtf8();
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getProfesional($persona){
		$query = "SELECT anioIni, anioFin, texto FROM profesional WHERE baja = 0 AND idpersonal = " .  $persona . " ORDER BY orden";
		$this->sql->setUtf8();
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

}
?>
