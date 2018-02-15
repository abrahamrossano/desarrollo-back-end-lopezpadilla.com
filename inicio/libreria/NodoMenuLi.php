<?php
/*
include_once("clases/NodoMenuUl.php");
include_once("clases/NodoMenuLiga.php");
*/
class NodoMenuLi {
	var $liga;
	var $nodoUl;
	var $clase;
	var $activo;
	var $identificador;
	
	function NodoMenuLi($liga, $identificador, $clase="", $activo=false, $nodoUl=NULL ) {		
		$this->liga = $liga;
		$this->nodoUl = $nodoUl;
		$this->clase = $clase;
		$this->activo = $activo;
		$this->identificador = $identificador;
	}

	function setNodosUl($nodoUl) {
		$this->nodoUl = $nodoUl;
	}

	function getNodosUl() {
		return $this->nodoUl;
	}
	
	function getIdentificador(){
		return $this->identificador;
	}
	function toString() {
		$cad ="";
		$cad = "<li ";
		if($this->activo) {
			$cad= $cad . " class=\"current";
			if($this->clase!= "")
				$cad = $cad . " " . $this->clase;
			
			$cad = $cad ."\" ";
		}

		if($this->clase != "")
			$cad = $cad . "class=\"" . $this->clase . "\" ";

		$cad = $cad . ">";
		if ($this->liga != "")
			$cad = $cad . $this->liga->toString(); 
		
		if( $this->nodoUl != NULL){
			foreach ($this->nodoUl as $ul)
				$cad = $cad . $ul->toString(); 
		}
		
		$cad = $cad . "</li>";
		return $cad;
	}
	
	function marcaActivo(){		
		if (!$this->activo){
			if($this->liga->getClase() != ""){
					$this->liga->setClase($this->liga->getClase()."-1");
			}			
			$this->activo = true;
		}
			
	}

	function desmarca(){	
		$this->activo= false;
		
		if ($this->liga->getClase() != ""){
			$cad =str_replace("-1","",$this->liga->getClase());// remplase
			$this->liga->setClase($cad);
		}
		if ($this->nodoUl != NULL){
			foreach($this->nodoUl as $ul)
				$ul->demarcaTodos();
		}
	}
		
}

?>