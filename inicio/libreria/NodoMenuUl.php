<?php
/*
include_once("clases/NodoMenuLi.php");
*/
class NodoMenuUl {
	var $clase;
	var $estilo;	
	var $nodosLi;
	var $id;
	
	function NodoMenuUl($clase, $estilo, $nodosLi=NULL, $id ="") {		
		$this->clase = $clase;
		$this->estilo = $estilo;
		$this->nodosLi = $nodosLi;
		$this->id = $id;
	}

	function setClase($clase) {
		$this->clase = $clase;
	}
	function setEstilo($estilo) {
		$this->estilo = $estilo;
	}
/*	public String getClase() {
		return $clase;
	}
	
	public String getEstilo() {
		return estilo;
	}
	
	public List<NodoMenuLi> getNodosLi() {
		return nodosLi;
	}
	*/
	
	function setNodosLi($nodosLi) {
		$this->nodosLi = $nodosLi;
	}
	
	
	function toString() {
		$cad="";
		$cad= "<ul ";
		if ( $this->id!= "")
			$cad = $cad . " id=\"" . $this->id . "\" ";
		if ( $this->clase!= "")
			$cad = $cad . " class=\"" . $this->clase . "\" ";
		if ( $this->estilo != "")
			$cad = $cad . " style=\"" . $this->estilo . "\" ";		
		$cad = $cad . " >";
		if($this->nodosLi != NULL){
			foreach($this->nodosLi as $li){
				$cad= $cad . $li->toString();		
			}
		}
		
		$cad= $cad . "</ul>";
		//echo "aqui";
		return $cad;
	}
	
	function demarcaTodos(){
	
		if($this->nodosLi != NULL){
			foreach($this->nodosLi as $li)
				$li->desmarca();
		}
	
	}
	
	function marcar($identificador){
		$res = false;
		if($this->nodosLi != NULL){
			foreach($this->nodosLi as $li){
				$cad=$li->getIdentificador();
				if(strcmp($cad, $identificador)==0){
					$li->marcaActivo();
					$res = true;
					break;
				}
				if($li->getNodosUl() != NULL){
					foreach($li->getNodosUl() as $ul){
						$res = $ul->marcar($identificador);
						if($res){
							$li->marcaActivo();
							break;
						}
					}
					if ($res) break;
				}
			}
		}
		return  $res;//$cad . " - " . $identificador . " - " .strcmp($cad, $identificador);
	}
}


?>