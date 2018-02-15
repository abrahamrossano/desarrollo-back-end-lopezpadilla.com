<?php
   include_once("database.php");
   include_once("config.php");
   include_once("JLog.php");

 @$usuario 		= $_POST['cuenta'];
 @$contrasenia  = $_POST['pass'];
 
 $contrasenia 	= md5($contrasenia);
 $banderaForma  = 0;
 
 if (isset($_POST['cuenta']) && isset($_POST['pass']))
  {   $datosUsuario= verificaUsuario($usuario, $contrasenia);

      if ($datosUsuario == "N") 
       { $banderaForma = 1;
	   }
	  else
	   { $banderaForma = 2;
	
	     // reenviar y cargar variables de sesión		 
		 $_SESSION['idUsuario'] 	= $datosUsuario[0];
		 $_SESSION['nombreUsuario'] = $datosUsuario[1];
		 $_SESSION['nombrePersona'] = $datosUsuario[2];
		 $_SESSION['emailAviso'] 	= $datosUsuario[3];
		 
		 
		 include_once("menu.php");
		 include_once("NodoMenuUl.php");
		 include_once("NodoMenuLi.php");
		 include_once("NodoMenuLiga.php");

		 
		 $menu =new Menu();
		 $menu->iniciaMenu2();

		 $_SESSION['menu'] = $menu;
	   } 
  }
  
if (($banderaForma == 0)  || ($banderaForma == 1))  { 
	//pideDatos($banderaForma);
}else{ 
	header("Location:vista/index.php");
}
 

 //****************************************************************************************************************
 //******** Función: usuarioValido
 //******** Recibe: el usuario y contraseña a ser validadas
 //******** Devuelve: idUsuario, perfil, nombre de usuario y nombre completo desparados por "_"
 //****************************************************************************************************************
 function verificaUsuario($usuario, $contrasenia)
 { 
 
   $sql= new database(HOST, USER, PASSWD, DATABASE);
   $query = sprintf("SELECT idusuario, login, nombreUsuario, email FROM usuario WHERE login=%s AND password=%s AND baja=false",
   GetSQLValueString($usuario, "text"),
   GetSQLValueString($contrasenia, "text"));
   $sql->setQuery($query);
   $result = $sql->loadMatrixAssoc();
   if($sql->getnumrows() != 0)
    {   $result_usr= $result[0];
	   $sql->close();
	   return array($result_usr['idusuario'], $result_usr['login'], $result_usr['nombreUsuario'],$result_usr['email'],$result_usr['idUsuario']);	    
	}
   else	
    {
	$sql->close();
	return "N";
	}
 }

function pideDatos($bandera){
?>

<script>
function validaForma(forma){
	if(forma.cuenta.value.length == 0 ){
		alert("Ingrese el usuario");
		forma.cuenta.focus();
		return false;
	}
	
	if(forma.pass.value.length == 0 ) {
		alert("Ingrese el password");
		forma.pass.focus();
		return false;
	}
	
	return true;
}
</script>
          <form id="forma" name="forma" method="post" action="" onSubmit="return validaForma(this)">
           <table width="100%" height="100%" border="0" align="left" cellpadding="0" cellspacing="5">
            <tr valign="top">
              <td height="100%" class="textgral linetotal"><p align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"> <strong>PROPORCIONE SUS DATOS DE ACCESO</strong></p>
                <center>
                  <table border="0">
<?php
   if ($bandera == 1){ 
?>
                 <tr>
                   <td height="24" align="center" colspan="2" class="textoGralRojo">
                   Usuario o password incorrecto <br />&nbsp;</td>
                 </tr>
<?php
   }
?>
                    <tr>
                      <td><font face="Arial" size="2">Usuario:</font></td>
                      <td><input name="cuenta" type="text" class="inputype"  size="30" maxlenght="40" /></td>
                    </tr>
                    <tr>
                      <td><font face="Arial" size="2">Password:</font></td>
                      <td><input name="pass" type="password" class="inputype" size="15" maxlenght="15" /></td>
                    </tr>
                    <tr>
                      <td><input type="submit" value="Ingresar" class="buttons" /></td>
                      <td><input type="reset" value="Borrar" class="buttons" /></td>
                    </tr>
                  </table>
                </center></td>
            </tr>
          </table>
</form>
<?php
}

?>