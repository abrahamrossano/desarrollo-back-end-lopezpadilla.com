<?php
class contacto {
	private $sql;
	private $datos= array("nombre"=>"", "cargo"=>"", "empresa"=>"", "telefono"=>"","fax"=>"","correo"=>"","sitio"=>"","tipo"=>"","contacto"=>"","conoce"=>"","caracteristicas"=>"");
	private $ids;
	
	function contacto($sql){
		$this->sql = $sql;
	}
	
	function setDatos($dat){
		foreach($this->datos as $k =>$v)
			$this->datos[$k]= $dat[$k];
	}
	
	function getCargos(){
		$query = "SELECT DISTINCT cargo.idcargo, cargo.cargo FROM cargo WHERE cargo.baja = false ";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getFormaCon(){
		$query = "SELECT formacontacto.idformaContacto, formacontacto.tipoContacto FROM formacontacto WHERE formacontacto.baja = false ";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function getMedio(){
		$query = "SELECT envio.idenvio, envio.tipo, envio.correo FROM envio WHERE envio.baja = false ";
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function insContacto(){
		$query = sprintf("INSERT INTO contacto (idcargo, nombre, empresa, telefono, fax, correo, sitioWeb, organizacion, idformaContacto, conocio, comentario, fecAlta, baja) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW(), false) ",
			GetSQLValueString($this->datos["cargo"],"int"),
			GetSQLValueString($this->datos["nombre"],"text"),
			GetSQLValueString($this->datos["empresa"],"text"),
			GetSQLValueString($this->datos["telefono"],"text"),
			GetSQLValueString($this->datos["fax"],"text"),
			GetSQLValueString($this->datos["correo"],"text"),
			GetSQLValueString($this->datos["sitio"],"text"),
			GetSQLValueString($this->datos["tipo"],"text"),
			GetSQLValueString($this->datos["contacto"],"int"),
			GetSQLValueString($this->datos["conoce"],"int"),
			GetSQLValueString($this->datos["caracteristicas"],"text"));
			//echo $query . "<br>";
			$this->sql->setQuery($query);
			$this->sql->query();
			if ($this->sql->errorNum==0) {
				$re = 0;
				$res = $this->sql->getid();
				$this->ids = $res;
			} else {
				$re = 1;
			}
		return $re;
	}
	
	function getDatos(){
		$query = sprintf("SELECT cargo.cargo, contacto.nombre, contacto.empresa, contacto.telefono, contacto.fax, contacto.correo, contacto.sitioWeb, envio.tipo, 
		contacto.organizacion, contacto.comentario, formacontacto.tipoContacto FROM cargo INNER JOIN contacto ON (cargo.idcargo = contacto.idcargo) INNER JOIN 
		formacontacto ON (contacto.idformaContacto = formacontacto.idformaContacto) INNER JOIN envio ON (contacto.conocio = envio.idenvio) WHERE contacto.baja 
		= false AND contacto.idcontacto = %s ",
			GetSQLValueString($this->ids,"int"));
		$this->sql->setQuery($query);
		$res=$this->sql->loadMatrixAssoc();
		if ($this->sql->errorNum==0)
			return $res;
		else
			return array();
	}
	
	function enviaCorreo(){
		$lst = $this->getDatos();
		$cuerpo = "";
		
		if(count($lst) > 0) {
			$ele = $lst[0];
			//se arma el envió del correo de contacto...
			$correo = $ele['correo'];
					
			$nombre = "";
			if($ele["cargo"] != "Otro"){
				$nombre = $ele["cargo"] . " " . $ele["nombre"];
			} else {
				$nombre = $ele["nombre"];
			}
						
			$cuerpo = "<br>
			<p align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'>Apreciable " . $nombre . "</p>
			<p align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
			Se ha realizado el envi&oacute; de su solicitud de informaci&oacute;n como a continuaci&oacute;n se muestra:&nbsp;</p>
			<table width='70%' align='left' border='0' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
				<tr>
					<td width='12%'><strong>Empresa: </strong></td>
					<td width='58%'>" . $ele['empresa'] . "</td>
				</tr>
				<tr>
					<td><strong>Telefono: </strong></td>
					<td>" . $ele['telefono'] . "</td>
				</tr>";
			
			if (strlen($ele['fax']) > 2) {
				$cuerpo .="<tr><td><strong>Fax: </strong></td><td>" . $ele['fax'] . "</td></tr>";
			}
				
			$cuerpo .="
				<tr>
					<td><strong>Correo: </strong></td>
					<td><a href=\"mailto:" . $correo . "\">" . $correo . "</a></td>
				</tr>
				<tr>
					<td><strong>Sitio Web: </strong></td>
					<td>" . $ele['sitioWeb'] . "</td>
				</tr>
				<tr>
					<td><strong>Tipo de organizaci&oacute;n: </strong></td>
					<td>" . $ele['organizacion'] ."</td>
				</tr>
				<tr>
					<td><strong>Forma de contacto: </strong></td>
					<td>" . $ele['tipoContacto'] . "</td>
				</tr>
				<tr>
					<td><strong>Origen: </strong></td>
					<td>" . $ele['tipo'] . "</td>
				</tr>
				<tr>
					<td><strong>Mensaje: </strong></td>
					<td>" . $ele['comentario'] . "</td>
				</tr>
			</table>
			<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
			<p align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
			En breve uno de nuestros asesores lo contactar&aacute;. Gracias por su atenci&oacute;n.</p>
			<p align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
			ATENTAMENTE.<br> <b>PERFIHERRAJES IMMSA</b><br><br>
			NOTA. Por favor NO responda a este mensaje, el correo ha sido generado por el sistema. </p>";

			
		}
		
		return $cuerpo;
	}
}

?>
