<?php


class NodoMenuLiga {
	var $liga;
	var $clase;
	var $textoLiga;
	var $nVentana;
	
	function NodoMenuLiga($liga="", $textoLiga="", $clase="", $nVentana=0 ){
		$this->liga= $liga;
		$this->clase= $clase;
		$this->textoLiga= $textoLiga;
		$this->nVentana= $nVentana;
	}
	
	function getClase(){
		return $this->clase;		
	}

	function setClase($clase){
		$this->clase= $clase;
	}
	
	function toString(){
		$cad= "<a href=\"".$this->liga."\" ";
		if ($this->clase != ""){
			$cad = $cad." class=\"".$this->clase."\" ";
		}		
		if ($this->nVentana == 1){
			$cad = $cad." target=\"_blank\" ";
		}
		$cad= $cad.">".$this->textoLiga." </a>";
		return $cad; 
	}

}
?>