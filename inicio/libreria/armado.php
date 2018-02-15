<?php
require_once("../libreria/menu.php");
require_once("../libreria/NodoMenuUl.php");
require_once("../libreria/NodoMenuLi.php");
require_once("../libreria/NodoMenuLiga.php");

include_once("sesion.php");

loginValido();

function cabecera($opc){

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:: ADMINISTRACION DEL SITIO - PHIMMSA ::.</title>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<script src="../js/prototype.js" language="javascript"></script>
<script src="../js/validation.js" language="javascript"></script>
<script src="../js/utils.js" language="javascript"></script>
<?php
if ($opc == 1) {
?>
<!-- Para el calendario  VBZ 2014-01-24  ********************************************************** -->
<script type="text/javascript" src="../js/calendarview-1.2/javascripts/calendarview.js"></script>
<link type="text/css" rel="stylesheet" href="../js/calendarview-1.2/stylesheets/calendarview.css" />
<!-- ************************************************************************************************ --->
<?
}elseif ($opc == 2){
?>
<!-- Para el tinymce  VBZ 2014-03/18  ********************************************************** -->
<script type="text/javascript" src="../js/tinymce/tinymce.min.js"></script>
<!-- ************************************************************************************************ --->

<?php
}
?>
</head>
<body>
<div align="center">
 <div id="principal">
   <div id="border-top" class="h_blue">
    <div>
     <div></div>
    </div>
   </div>
   <div id="header-box">
    <div id="module-menu">
       <?php echo $_SESSION["menu"]->toString();?>  
    </div>
    <div id="module-status"></div>    
   </div>

   <div id="content-box">
     <div class="border">
       <div class="padding">
         <!-- Inicia el contenido -->
         <div align="right" class="usuario">Bienvenido&nbsp;:&nbsp;<?php echo nomUsuario();?></div>
         <?php
}

function pie(){
?>
		  <br />&nbsp;
          <br />&nbsp;
         <!--  Finaliza el contenido -->
       </div>
     </div>
   </div>
   <div id="border-bottom">
     <div>
      <div>
      </div>
     </div>
   </div>
 </div>
</div>
</body>
</html>
<?php
}
?>