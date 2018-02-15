<?php 
session_start();

//***********************************************************************************
//************** Funci�n: usuarioValido
//************** verifica que existe la variale de srsi�n nombre Usuario
//***********************************************************************************
function usuarioValido()
{
	global $_SESSION;
	return isset($_SESSION['nombreUsuario']);
}
//***********************************************************************************
//************** Funci�n: loginValido
//************** si el usuario no ha ingresado por login no permitir la entrada al sistema
//***********************************************************************************

 

function loginValido(){
global $_SESSION;

	if (!usuarioValido())
	{	
		session_destroy();
		header("Location:../index.php");
		exit; 
	}		
}

function paginaValida($arr)
{
	

	$arr_pag=explode("/",$_SERVER['SCRIPT_FILENAME']);
	$url=explode(".php",$arr_pag[count($arr_pag)-1]);
	$pagina=$url[0];	
//	print_r($arr);
//	echo "Pagina: ".$pagina;
	if (!(in_array($pagina,$arr,true)))		
		//die("no tienes permisos");
	   header("Location: index.php");
		
}

function nomUsuario()
{
	return $_SESSION['nombrePersona'];
}


?>
