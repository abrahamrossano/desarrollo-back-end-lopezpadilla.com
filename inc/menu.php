<?php

switch ($link_activo) {
	case 'index':
			$index = "active";
			$integrantes = "";
			$servicios = "";
			$novedades = "";
			$newsletter = "";
			$contacto = "";
		break;
	
	case 'integrantes':
			$index = "";
			$integrantes = "active";
			$servicios = "";
			$novedades = "";
			$newsletter = "";
			$contacto = "";
		break;

	case 'servicios':
			$index = "";
			$integrantes = "";
			$servicios = "active";
			$novedades = "";
			$newsletter = "";
			$contacto = "";
		break;

	case 'novedades':
			$index = "";
			$integrantes = "";
			$servicios = "";
			$novedades = "active";
			$newsletter = "";
			$contacto = "";
		break;

	case 'newsletter':
			$index = "";
			$integrantes = "";
			$servicios = "";
			$novedades = "";
			$newsletter = "active";
			$contacto = "";
		break;		

	case 'contacto':
			$index = "";
			$integrantes = "";
			$servicios = "";
			$novedades = "";
			$newsletter = "";
			$contacto = "active";
		break;	
}

?>