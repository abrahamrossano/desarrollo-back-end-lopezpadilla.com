<?php
class novedades {
	private $sql;

	function novedades($sql){
		$this->sql = $sql;
	}


	function getNovedades($excepto = 0){
		$aux = "";
		if($excepto > 0){
			$aux = " AND EN.idEntrada <> " . $excepto;
		}

		$query = "SELECT EN.idEntrada, EN.titulo, EN.texto, EN.imagen, EN.autor FROM entrada as EN WHERE EN.baja = 0" . $aux;
		$this->sql->setUtf8();
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getNovedadesLimit($excepto = 0){
		$aux = "";
		if($excepto > 0){
			$aux = " AND EN.idEntrada <> " . $excepto;
		}

		$query = "SELECT EN.idEntrada, EN.titulo, EN.texto, EN.imagen, EN.autor FROM entrada as EN WHERE EN.baja = 0" . $aux ." order by rand() LIMIT 3";
		$this->sql->setUtf8();
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getNovedad($persona){
		$query = "SELECT EN.titulo, EN.texto, EN.imagen, EN.autor, EN.archivo FROM entrada as EN WHERE EN.baja = 0 AND EN.idEntrada = " . $persona . " ";
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
