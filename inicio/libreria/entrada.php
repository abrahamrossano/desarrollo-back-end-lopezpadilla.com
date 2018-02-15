<?php
class entrada{
	private $sql;
	private $datos= array("titulo"=>"", "texto"=>"", "archivo"=>"","imagen"=>"","autor"=>"","idEntrada"=>-1);

	function entrada($sql){
		$this->sql = $sql;
	}

	function setDatos($dat){
		foreach($this->datos as $k =>$v)
			$this->datos[$k]= $dat[$k];
	}

	function getTodasEntradas(){
		$query = "SELECT entrada.idEntrada,entrada.titulo, entrada.autor, entrada.fechaReg FROM entrada WHERE baja = false";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getInfoEntradas($usu){
		$query = sprintf("SELECT entrada.titulo, entrada.texto, entrada.archivo, entrada.imagen, entrada.autor FROM entrada WHERE baja = false AND entrada.idEntrada = %s ",
		GetSQLValueString($usu,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function actEntradas(){
		$query = sprintf("UPDATE entrada SET titulo = %s, texto = %s, archivo = %s, imagen = %s, autor = %s WHERE idEntrada = %s ",
			GetSQLValueString($this->datos["titulo"],"text"),
			GetSQLValueString($this->datos["texto"],"text"),
			GetSQLValueString($this->datos["archivo"],"text"),
			GetSQLValueString($this->datos["imagen"],"text"),
			GetSQLValueString($this->datos["autor"],"text"),
			GetSQLValueString($this->datos["idEntrada"],"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}

		return $re;
	}

	function delEntradas($usu){
		$query = sprintf("UPDATE entrada SET baja = true WHERE idEntrada = %s ",
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

	function insEntradas(){
		$re = 0;
		//Busamos si el usuario no se sido dado de alta previamente.
		$query= sprintf("SELECT entrada.idEntrada FROM entrada WHERE entrada.titulo = %s AND entrada.baja = false ",
				GetSQLValueString($this->datos["titulo"],"text"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if(count($res) == 0){
			//al no existir se debe insertar el usuario
			$ins = sprintf("INSERT INTO entrada (titulo, texto, archivo, imagen, autor, fechaReg, baja) VALUES (%s, %s, %s, %s, %s, NOW(), false) ",
				GetSQLValueString($this->datos["titulo"],"text"),
				GetSQLValueString($this->datos["texto"],"text"),
				GetSQLValueString($this->datos["archivo"],"text"),
				GetSQLValueString($this->datos["imagen"],"text"),
				GetSQLValueString($this->datos["autor"],"text"));

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
