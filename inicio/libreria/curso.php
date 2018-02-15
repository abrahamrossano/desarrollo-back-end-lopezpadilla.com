<?php
class curso {
	private $sql;
	private $datos= array("nombre"=>"", "idcursos"=>-1);
	
	function curso($sql){
		$this->sql = $sql;
	}
	
	function setDatos($dat){
		foreach($this->datos as $k =>$v)
			$this->datos[$k]= $dat[$k];
	}

	function getTodosCursos(){
		$query = "SELECT cursos.idcursos, cursos.nombre FROM cursos WHERE cursos.baja = false ";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getInfoCurso($cur){
		$query = sprintf("SELECT cursos.idcursos, cursos.nombre FROM cursos WHERE cursos.baja = false AND cursos.idcursos = %s ",
		GetSQLValueString($cur,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function actCurso(){
		$query = sprintf("UPDATE cursos SET nombre = %s WHERE idcursos = %s ",
			GetSQLValueString($this->datos["nombre"],"text"),
			GetSQLValueString($this->datos["idcursos"],"int"));
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
			} else {
				$re = 1;
			}
			
		return $re;
	}
	
	function insCurso(){
		$re = 0;
		//Busamos si el usuario no se sido dado de alta previamente.
		$query= sprintf("SELECT cursos.idcursos FROM cursos WHERE cursos.nombre LIKE %s AND cursos.baja = false ", 
				GetSQLValueString($this->datos["nombre"],"text"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if(count($res) == 0){
			//al no existir se debe insertar el usuario
			$ins = sprintf("INSERT INTO cursos (nombre, baja, fecregistro) VALUES (%s, false, NOW()) ",
				GetSQLValueString($this->datos["nombre"],"text"));
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

   function getCursosActuales()
   {  $query= sprintf("SELECT 
					  promocion.idpromocion, 
					  cursos.nombre
					FROM
					  cursos
					  INNER JOIN promocion ON (cursos.idcursos = promocion.curso)
					  INNER JOIN periodo ON (promocion.periodo = periodo.idperiodo)
					WHERE
					  promocion.baja = false AND 
					  periodo.vigente = true");
	  $this->sql->setQuery($query);
	  $res=$this->sql->loadMatrixAssoc();
		
	  return $res;	
		
   }
}

?>