<?php
class Menu {
	var $menu;
	private $marcados=array();
	private $estiloAux;
	private $ligas=array();

	function Menu(){
		$this->menu = new NodoMenuUl("","", NULL, "menu");
	}

	function getMenu() {
		return $this->menu;
	}

	function toString(){
		return $this->menu->toString();
	}

	function iniciaMenu($idMenu,$sql){
		$this->menu->setNodosLi($this->getPadres($idMenu,$sql));
		$this->menu->setEstilo($this->estiloAux);
	}

	function iniciaMenu2(){
		/// Menu Principal
		   /*$li[0]= new NodoMenuLi(new NodoMenuLiga("formServicio.php","Servicio",""),"0","node");
		$li[1]= new NodoMenuLi(new NodoMenuLiga("formCategoria.php","Categoria",""),"1","node");
		$li[2]= new NodoMenuLi(new NodoMenuLiga("formCaracteristica.php","Caracteristica",""),"2","node");
		$li[3]= new NodoMenuLi(new NodoMenuLiga("formSegui.php","Productos",""),"3","node");
		$li[4]= new NodoMenuLi(new NodoMenuLiga("formOferta.php","Oferta de la semana",""),"4","node");
		$li[5]= new NodoMenuLi(new NodoMenuLiga("formUsers.php","Contacto",""),"5","node");
		$li[6]= new NodoMenuLi(new NodoMenuLiga("formSalir.php","Salir",""),"6","node");*/

		$li[0]= new NodoMenuLi(new NodoMenuLiga("formCategoria.php","Categoria",""),"0","node");
		$li[1]= new NodoMenuLi(new NodoMenuLiga("formEntrada.php","Novedades",""),"1","node");
		$li[2]= new NodoMenuLi(new NodoMenuLiga("formPersonal.php","Personal",""),"2","node");
		$li[6]= new NodoMenuLi(new NodoMenuLiga("formUsers.php","Usuarios",""),"3","node");
		$li[7]= new NodoMenuLi(new NodoMenuLiga("formSalir.php","Salir",""),"4","node");

		/// 1er Menu
		/*$ul[0]=new NodoMenuUl("","");
		$liaux[]= new NodoMenuLi(new NodoMenuLiga("inicio.php","Usuarios", "icon-16-cpanel"),"");
		$liaux[]= new NodoMenuLi(new NodoMenuLiga("inicio.php","Contrase&ntilde;a", "icon-16-cpanel"),"");
		$liaux[]= new NodoMenuLi(new NodoMenuLiga("inicio.php","Salir", "icon-16-cpanel"),"");

		$ul[0]->setNodosLi($liaux);
		$li[0]->setNodosUl($ul);
		$ul=NULL;
		$liaux=NULL;

		/// 2do Menu
		$ul[0]=new NodoMenuUl("","");
		$liaux[]= new NodoMenuLi(new NodoMenuLiga("inicio.php","Recetario", "icon-16-cpanel"),"");
		$liaux[]= new NodoMenuLi(new NodoMenuLiga("inicio.php","Receta", "icon-16-cpanel"),"");
		$liaux[]= new NodoMenuLi(new NodoMenuLiga("inicio.php","Ingredientes", "icon-16-cpanel"),"");
		$liaux[]= new NodoMenuLi(new NodoMenuLiga("inicio.php","Utensilios", "icon-16-cpanel"),"");
		$ul[0]->setNodosLi($liaux);
		$li[1]->setNodosUl($ul);
		$ul=NULL;
		$liaux=NULL;*/

		   $this->menu->setNodosLi($li);
	}

	function desmarca(){
		$this->menu->demarcaTodos();
	}

	function marca($iden){
		$this->menu->demarcaTodos();
		$cad =$this->menu->marcar($iden);
		return $cad;
	}


	function getPadres($idMenu,$sql){
		$query =sprintf("
		SELECT
		  padres.idopcionSistema,
		  padres.descripcion,
		  padres.liga,
		  padres.clase,
		  padres.idhtml,
		  padres.prioridad,
		  padres.nVentana
		FROM
		  perfilopcion
		  INNER JOIN opcionsistema ON (opcionsistema.idopcionSistema = perfilopcion.idOpcionSistema)
		  INNER JOIN opcionsistema padres ON (opcionsistema.antecesor = padres.idopcionSistema)
		WHERE
		 perfilopcion.idPerfil = %s
		GROUP BY
		  padres.prioridad

		UNION all

		SELECT
		  opcionsistema.idopcionSistema,
		  opcionsistema.descripcion,
		  opcionsistema.liga,
		  opcionsistema.clase,
		  opcionsistema.idhtml,
		  opcionsistema.prioridad,
		  opcionsistema.nVentana
		FROM
		  perfilopcion
		  INNER JOIN opcionsistema ON (opcionsistema.idopcionSistema = perfilopcion.idOpcionSistema)
		  AND (opcionsistema.antecesor = 0)
		WHERE
		  perfilopcion.idPerfil = %s
		GROUP BY
		  opcionsistema.prioridad

		ORDER BY
		  prioridad

		  ",
		GetSQLValueString($idMenu,"int"),
		GetSQLValueString($idMenu,"int"));
		//echo $query;
		$sql->setQuery($query);
		$result = $sql->loadMatrixAssoc();
		$li= array();
		$i=0;
		$total = $sql->getnumrows();
		foreach($result as $r){
			$li[$i] = new NodoMenuLi(new NodoMenuLiga($r["liga"],$r["descripcion"],$r["clase"],$r["nVentana"]),"",$r["clase"]);
			$li[$i]->setNodosUl($this->getHijos($idMenu,$r["idopcionSistema"],$total,$sql));
			$i++;
			$this->ligas[] = $r["liga"];
		}
		return $li;
	}

	function getHijos($idMenu,$idPadre,$total,$sql){
		$query=sprintf("
		SELECT
		  opcionsistema.descripcion,
		  opcionsistema.liga,
		  opcionsistema.clase,
		  opcionsistema.idhtml,
		  opcionsistema.idopcionSistema,
		  opcionsistema.nVentana
		FROM
		  perfilopcion
		  INNER JOIN opcionsistema ON (perfilopcion.idopcionsistema = opcionsistema.idopcionSistema)
		WHERE
		  perfilopcion.idperfil = %s AND
		  opcionsistema.antecesor = %s
		ORDER BY
		  opcionsistema.prioridad",
		GetSQLValueString($idMenu,"int"),
		GetSQLValueString($idPadre,"int"));
		$sql->setQuery($query);
		$result = $sql->loadMatrixAssoc();
		$li= array();
		$ul[0]=new NodoMenuUl("","");
		$i=0;
		foreach($result as $r){
			$li[$i] = new NodoMenuLi(new NodoMenuLiga($r["liga"],$r["descripcion"],$r["clase"],$r["nVentana"]),"");
			$i++;
			$this->ligas[] = $r["liga"];
		}
		$ul[0]->setNodosLi($li);
		return $ul;

	}


	function esValidaOpcion(){

		if(!$this->checaOpcionValida()){
			header("Location:../vista/salir.php");
		}
		/*echo "<pre>";
		print_r($this->ligas);
		echo "</pre>";*/
	}

	function checaOpcionValida(){

		$opcion = explode("/",$_SERVER["SCRIPT_NAME"]);
		$idOp = count($opcion)-1;
		$op = $opcion[$idOp];
		//echo $op."<br>";
		if (in_array($op,$this->ligas)){
			return true;
		}else{
			if(isset($_SERVER["HTTP_REFERER"])) {
				$opcion = explode("/",$_SERVER["HTTP_REFERER"]);
				$idOp = count($opcion)-1;
				$op = $opcion[$idOp];
				//echo $op."<br>";
				if(in_array($op,$this->ligas)){
					return true;
				}
			}

		}
		return false;
	}
}


?>
