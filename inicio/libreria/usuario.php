<?php
class usuario{
	private $sql;
	private $datos= array("login"=>"", "nombre"=>"", "email"=>"","passwd"=>"","idUsuario"=>-1);

	function usuario($sql){
		$this->sql = $sql;
	}

	function setDatos($dat){
		foreach($this->datos as $k =>$v)
			$this->datos[$k]= $dat[$k];
	}

	function getTodosUsuarios(){
		$query = "SELECT usuario.idUsuario, usuario.login, usuario.nombreUsuario, usuario.email FROM usuario WHERE baja = false AND usuario.login <> 'admin' ";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function getInfoUsuario($usu){
		$query = sprintf("SELECT usuario.login, usuario.nombreUsuario, usuario.email FROM usuario WHERE usuario.baja = false AND usuario.idUsuario = %s ",
		GetSQLValueString($usu,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}

	function actUsuario(){
		$query = sprintf("UPDATE usuario SET login = %s, nombreUsuario = %s, email = %s WHERE idUsuario = %s ",
			GetSQLValueString($this->datos["login"],"text"),
			GetSQLValueString($this->datos["nombre"],"text"),
			GetSQLValueString($this->datos["email"],"text"),
			GetSQLValueString($this->datos["idUsuario"],"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}

		return $re;
	}

	function delUsuario($usu){
		$query = sprintf("UPDATE usuario SET baja = true WHERE idUsuario = %s ",
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

	function insUsuario(){
		$re = 0;
		//Busamos si el usuario no se sido dado de alta previamente.
		$query= sprintf("SELECT usuario.idUsuario FROM usuario WHERE usuario.login = %s AND usuario.baja = false ",
				GetSQLValueString($this->datos["login"],"text"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if(count($res) == 0){
			//al no existir se debe insertar el usuario
			$ins = sprintf("INSERT INTO usuario (login, password, nombreUsuario, email, baja, fechaReg) VALUES (%s, md5(%s), %s, %s, false, NOW()) ",
				GetSQLValueString($this->datos["login"],"text"),
				GetSQLValueString($this->datos["passwd"],"text"),
				GetSQLValueString($this->datos["nombre"],"text"),
				GetSQLValueString($this->datos["email"],"text"));

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
