<?php
class personal{
	private $sql;
	private $datos= array("nombre"=>"", "imagenSmall"=>"", "imagen"=>"", "orden"=>"", "objetivo"=>"", "idPersonal"=>-1);

	private $datos2= array("texto"=>"", "anioIni"=>"", "anioFin"=>"","orden"=>"", "idPersonal"=>"", "idEducacion"=>-1);

	private $datos3= array("texto"=>"", "anioIni"=>"", "anioFin"=>"","orden"=>"", "idPersonal"=>"", "idProfesional"=>-1);

	function personal($sql){
		$this->sql = $sql;
	}

	function setDatos($dat){
		foreach($this->datos as $k =>$v)
			$this->datos[$k]= $dat[$k];
	}

	function setDatos2($dato){
		foreach($this->datos2 as $kk =>$vv)
			$this->datos2[$kk]= $dato[$kk];
	}

	function setDatos3($datox){
		foreach($this->datos3 as $kkk =>$vvv)
			$this->datos3[$kkk]= $datox[$kkk];
	}

	function getTodosPersonal(){
		$query = "SELECT personal.idPersonal, personal.nombre, personal.fechaReg FROM personal WHERE baja = false order by orden";
		$this->sql->setUtf8();
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getInfoPersonal($usu){
		$query = sprintf("SELECT personal.nombre, personal.imagenSmall,personal.imagen, personal.orden, personal.objetivo FROM personal WHERE personal.baja = false AND personal.idPersonal = %s ",
		GetSQLValueString($usu,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function actPersonal(){
		$query = sprintf("UPDATE personal SET nombre = %s, imagenSmall = %s, imagen = %s, orden = %s, objetivo = %s WHERE idPersonal = %s ", GetSQLValueString($this->datos["nombre"],"text"), GetSQLValueString($this->datos["imagenSmall"],"text"), GetSQLValueString($this->datos["imagen"],"text"),
						 GetSQLValueString($this->datos["orden"],"int"), GetSQLValueString($this->datos["objetivo"],"text"), GetSQLValueString($this->datos["idPersonal"],"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}

		return $re;
	}

	function delPersonal($usu){
		$query = sprintf("UPDATE personal SET baja = true WHERE idPersonal = %s ",
			GetSQLValueString($usu,"int"));
		$this->sql->setQuery($query);
		$this->sql->query();
		if ($this->sql->errorNum==0) {
			$re = 0;
		} else {
			$re = 1;
		}

		return $res;
	}

	function insPersonal(){
		$re = 0;
		//Busamos si el usuario no se sido dado de alta previamente.
		$query= sprintf("SELECT personal.idPersonal FROM personal WHERE personal.nombre = %s AND personal.baja = false ",
				GetSQLValueString($this->datos["nombre"],"text"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if(count($res) == 0){
			//al no existir se debe insertar el usuario
			$ins = sprintf("INSERT INTO personal(nombre, imagenSmall, imagen, orden, objetivo, fechaReg, baja) VALUES (%s, CONCAT('assets/img/equipo/small/', %s), CONCAT('assets/img/equipo/medium/', %s), %s, %s, NOW(), false)",
				GetSQLValueString($this->datos["nombre"],"text"),
				GetSQLValueString($this->datos["imagenSmall"],"text"),
				GetSQLValueString($this->datos["imagen"],"text"),
				GetSQLValueString($this->datos["orden"],"int"),
				GetSQLValueString($this->datos["objetivo"],"text"),
				GetSQLValueString($this->datos["idPersonal"],"int"));

			$this->sql->setQuery($ins);
			$this->sql->query();

			if ($this->sql->errorNum==0){
				$re = 0;
			}else{
				$re = 2;
			}
		} else {
			$re = 1;
		}

		return $re;
	}

	function insNvoPro($id){
			$ins = "insert into profesional(anioIni, anioFin, texto, orden, fechaReg, baja, idPersonal) values (0, 0, '', 0, now(), false, '$id')";

			$this->sql->setQuery($ins);
			$this->sql->query();
	}

	function getExpPro($usu){
		$query = sprintf("select PR.idProfesional, PR.texto, PR.anioIni, PR.anioFin, PR.idPersonal from profesional as PR where baja = false and idPersonal = %s ",
		GetSQLValueString($usu,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();

	}

	function getExpAca($usu){
		$query = sprintf("select  ED.idEducacion, ED.texto, ED.anioIni, ED.anioFin, ED.idPersonal from educacion as ED where baja = false and idPersonal = %s ",
		GetSQLValueString($usu,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();

	}

	function getInfoProfesional($usu){
		$query = sprintf("select PR.idProfesional, PR.texto, PR.anioIni, PR.anioFin, PR.orden, PR.idPersonal from profesional as PR where baja = false and idProfesional = %s ",
		GetSQLValueString($usu,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getInfoAcademica($usu){
		$query = sprintf("select  ED.idEducacion, ED.texto, ED.anioIni, ED.anioFin, ED.orden, ED.idPersonal from educacion as ED where baja = false and idEducacion = %s ",
		GetSQLValueString($usu,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

function actEducacion(){
		$query = sprintf("UPDATE educacion SET texto = %s, anioIni = %s, anioFin = %s, orden = %s WHERE idEducacion = %s ",
			GetSQLValueString($this->datos2["texto"],"text"),
			GetSQLValueString($this->datos2["anioIni"],"int"),
			GetSQLValueString($this->datos2["anioFin"],"int"),
			GetSQLValueString($this->datos2["orden"],"int"),
			GetSQLValueString($this->datos2["idEducacion"],"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}

		return $re;
	}

	function delEducacion($usu){
		$query = sprintf("UPDATE educacion SET baja = true WHERE idEducacion = %s ",
			GetSQLValueString($usu,"int"));
		$this->sql->setQuery($query);
		$this->sql->query();
		if ($this->sql->errorNum==0) {
			$re = 0;
		} else {
			$re = 1;
		}

		return $res;
	}

	function insEducacion(){
		$re = 0;
		//Busamos si el usuario no se sido dado de alta previamente.
		$query= sprintf("SELECT idEducacion FROM educacion WHERE texto = %s AND baja = false AND idPersonal = %s",
				GetSQLValueString($this->datos2["texto"],"text"),	GetSQLValueString($this->datos2["idPersonal"],"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if(count($res) == 0){
			//al no existir se debe insertar el usuario
			$ins = sprintf("INSERT INTO educacion (texto, anioIni, anioFin, orden, fechaReg, baja, idPersonal) VALUES (%s, %s, %s, %s, NOW(), false, %s)",
				GetSQLValueString($this->datos2["texto"],"text"),
				GetSQLValueString($this->datos2["anioIni"],"int"),
				GetSQLValueString($this->datos2["anioFin"],"int"),
				GetSQLValueString($this->datos2["orden"],"int"),
				GetSQLValueString($this->datos2["idPersonal"],"int"));

			$this->sql->setQuery($ins);
			$this->sql->query();

			if ($this->sql->errorNum==0){
				$re = 0;
			}else{
				$re = 2;
			}
		} else {
			$re = 1;
		}

		return $re;
	}

	function actProfesional(){
		$query = sprintf("UPDATE profesional SET texto = %s, anioIni = %s, anioFin = %s, orden = %s WHERE idProfesional = %s ",
			GetSQLValueString($this->datos3["texto"],"text"),
			GetSQLValueString($this->datos3["anioIni"],"int"),
			GetSQLValueString($this->datos3["anioFin"],"int"),
			GetSQLValueString($this->datos3["orden"],"int"),
			GetSQLValueString($this->datos3["idProfesional"],"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}

		return $re;
	}

	function delProfesional($usu){
		$query = sprintf("UPDATE profesional SET baja = true WHERE idProfesional = %s ",
			GetSQLValueString($usu,"int"));
		$this->sql->setQuery($query);
		$this->sql->query();
		if ($this->sql->errorNum==0) {
			$re = 0;
		} else {
			$re = 1;
		}

		return $res;
	}

	function insProfesional(){
		$re = 0;
		//Busamos si el usuario no se sido dado de alta previamente.
		$query= sprintf("SELECT idProfesional FROM profesional WHERE texto = %s AND baja = false AND idPersonal = %s",
				GetSQLValueString($this->datos3["texto"],"text"),	GetSQLValueString($this->datos3["idPersonal"],"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if(count($res) == 0){
			//al no existir se debe insertar el usuario
			$ins = sprintf("INSERT INTO profesional (texto, anioIni, anioFin, orden, fechaReg, baja, idPersonal) VALUES (%s, %s, %s, %s, NOW(), false, %s)",
				GetSQLValueString($this->datos3["texto"],"text"),
				GetSQLValueString($this->datos3["anioIni"],"int"),
				GetSQLValueString($this->datos3["anioFin"],"int"),
				GetSQLValueString($this->datos3["orden"],"int"),
				GetSQLValueString($this->datos3["idPersonal"],"int"));

			$this->sql->setQuery($ins);
			$this->sql->query();

			if ($this->sql->errorNum==0){
				$re = 0;
			}else{
				$re = 2;
			}
		} else {
			$re = 1;
		}

		return $re;
	}
}
?>
