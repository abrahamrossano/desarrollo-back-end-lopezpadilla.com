<?php
class crearArchivo{
	private $nombre;
	private $archivo;
	private $producto;
	private $analitics;
	// MEMBERS ====================================================================================
    /** @var string Holds the page DocType. */
    private $DocType;
    /** @var string Holds the Content-Type of page. Defaults to [text/html]. */
    private $ContentType;
    /** @var string Holds the page Character Set. Defaults to [UTF-8]. */
    private $Charset;
    /** @var string Holds the language code of HTML. */
    private $LangCode;
    /** @var string Holds the page title, showing in the browsers title bar. */
    public $Title;
    /** @var string Holds a page description. */
    public $Description;
    /** @var string Holds the keywords. */
    public $Keywords;
    /** @var string Holds the page rating. */
    public $Rating;
    /** @var array Array for robots meta tags. */
    public $Robots;
    /** @var string Path to favorite icon. */
    public $Favicon;
    /** @var array Holds the various page headers. */
    private $Headers;
    /** @var array Holds a the META tags. */
    private $Metas;
    /** @var array Array for page styles (CSS). */
    private $Styles;
    /** @var array Array for page scripts (javascript). */
    private $Scripts;

    // DOCTYPE CONSTANTS ==========================================================================
    const DT_XHTML_11    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

    // CONTENT TYPE CONSTANTS =====================================================================
    const CT_PLAIN = 'text/plain';
    const CT_HTML  = 'text/html';
    const CT_JAVAS = 'text/javascript';
    const CT_STYLE = 'text/stylesheet';

    // CHARACTER SET CONSTANTS ====================================================================
    const CH_UTF8  = 'UTF-8';
    const CH_ISO   = 'ISO-8859-1';
	
	public function crearArchivo()
    {
        $this->Title = 'SITE';
        $this->DocType = self::DT_XHTML_11;
        $this->ContentType = self::CT_HTML;
        $this->Charset = self::CH_UTF8;
        $this->LangCode = 'pt-br';

        $this->Description = null;
        $this->Keywords = null;
        $this->Robots = null;
        $this->Favicon = null;

        $this->Headers = null;
        $this->Metas   = null;
        $this->Styles  = null;
        $this->Scripts = null;

        $this->updateMetas();
    }
		
	// PROPERTIES =================================================================================
    /*** Sets the Title property. ***/
    public function setTitle($newTitle) { $this->Title = $newTitle; }
	
	/*** Dar el nombre del archivo que se crreará!........ ***/
	public function setNombre($nom){ $this->nombre = $nom . ".php";}
	
	/*** Dar el id del producto que le corresponde ***/
	public function setProducto($pro){ $this->producto = $pro;}
	
	/*** Para dar el codigo de google analitics   ***/
	public function setAnalitics($cad) { $this->analitics = $cad;  }
	// PROPERTIES =================================================================================
	
	// METODOS    =================================================================================
	
	/*** funcion para crear el archivo! ........ ***/
	public function crear(){
		$this->archivo = fopen($this->nombre , "w+");
	}
	
	/*** funcion para cerrar el archivo! ....... ***/
	public function cerrar(){
		fclose($this->archivo);
	}
	
	/*** Updates the Meta tags.  ***/
    private function updateMetas() {
        if( is_null($this->Metas) )
            $this->Metas = array();

        $this->Metas[0] = '<meta http-equiv="Content-Type" content="' . $this->ContentType . '; charset=' . $this->Charset . '" />';
    }
	
	 /*** Adds a cascade style sheet file. ***/
    public function addStyle($css, $cacheable = true) {
        if(is_null($this->Styles))
            $this->Styles = array();

        $this->Styles[] = array('file'=>$css, 'cache'=>$cacheable);
    }
	
	/** Alias to addStyle() */
    public function addCss( $css, $cache = true ) { $this->addStyle($css, $cache); }
	
	/*** Adds a script file. ***/
    public function addScript($js, $cacheable = true) {
        // Check if JS is local or url
       if(strpos($js, "http") === false) {
            // File is local. Check if file exists
            if(!file_exists($js)) {
                //App::error("Archivo [$js] inexistente.", 0x0011);
                return;
            }
        }

        if(is_null($this->Scripts))
            $this->Scripts = array();

        $this->Scripts[] = array('file'=>$js, 'cache'=>$cacheable);
    }
	
	 /** Alias to addScript() */
    public function addJs( $js, $cache = true ) { $this->addScript($js, $cache); }
	
	/*** Write down all headers. ***/
    private function writeHeaders() {
        if( is_null($this->Headers) ) return;

        foreach($this->Headers as $hd) {
            header($hd);
        }

        header("Content-Type: ". $this->ContentType ."; charset=". $this->Charset ."");
    }
	
	public function write()
    {
        // Write HTTP Headers:
        $this->writeHeaders();

        // Write HTML Doc -------------------------------------------------------------------------
		fwrite($this->archivo, $this->DocType ."\r\n");
        fwrite($this->archivo, '<html xmlns="http://www.w3.org/1999/xhtml">'. "\r\n");
        fwrite($this->archivo, '<head>'. "\r\n");

        // Site Title
        fwrite($this->archivo, '<title>' . $this->Title . '</title>' . "\r\n");

        // Metas ----------------------------------------------------------------------------------
        foreach($this->Metas as $meta) {
            fwrite($this->archivo, $meta . "\r\n");
        }
		
		//añadimos las metas que se hacen en un ciclo
      	$meta = '<?
		$con= new contenido($sql);
		$listM = $con->getTodasMetas();
				 
		foreach($listM as $lst){
		?>
		<meta name="<?=$lst["meta"]?>" content="<?=$lst["descripcion"]?>" />
		<?
		}
		?>';
		fwrite($this->archivo, $meta . "\r\n");

        // Styles ---------------------------------------------------------------------------------
        for($i = 0; $i < count($this->Styles); $i++) {
            $css = $this->Styles[$i]['file'];
            fwrite($this->archivo, '<link rel="stylesheet" type="text/css" href="' . $css . '" />' . "\r\n");
        }

        // Scripts --------------------------------------------------------------------------------
        for($i = 0; $i < count($this->Scripts); $i++) {
            $js = $this->Scripts[$i]['file'];
            fwrite($this->archivo, '<script language="javascript" type="text/javascript" src="' . $js . '"></script>' . "\r\n");
        }
		
		// Analitics ----------------------------------------------------------------------------
        if(!is_null($this->analitics))
            fwrite($this->archivo, '<script language="javascript"><?=$fin["analitics"];?></script>' . "\r\n");

        fwrite($this->archivo, "</head>" . "\r\n");
    }
	
	public function writePHP(){
		$cont = '<?php ' . "\r\n" . 'include_once("../inicio/libreria/database.php");' . "\r\n" . 'include_once("../inicio/libreria/config.php");' . "\r\n";
		$cont .= 'include_once("../inicio/libreria/producto.php");' . "\r\n" . 'include_once("../inicio/libreria/contenido.php");' . "\r\n\r\n";
		$cont .= '$sql= new database(HOST, USER, PASSWD, DATABASE);' . "\r\n";
		$cont .= '$pro= new producto($sql);'. "\r\n" . '$most = $pro->getMostrarProd(' . $this->producto . ');'. "\r\n" . '$fin = $most[0];' . "\r\n";
		$cont .= '$catser = "";';
		$cont .= "\r\n" . 'if ($fin["idcategoria"] > 1) {' . "\r\n\t" . '$catser = $fin["categoria"];' . "\r\n" . '}' . "\r\n" . '?>' . "\r\n";
	
		fwrite($this->archivo, $cont);
	}
	
	public function cuerpo(){
		$contenido = '<body>
<form id="forma_1" name="forma_1" method="post">
	<input type="hidden" id="serv" name="serv" value="<?=$fin["idservicio"]?>" />
	<input type="hidden" id="cate" name="cate" value="<?=$fin["idcategoria"]?>" />
</form>
<table width="910" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#FFFFFF">
		<td valign="top"><?php include_once("encabezado.php");?></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td valign="top"><table width="910" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="20"><img src="../imagenes/trans.gif" width="20" height="30" /></td>
				<td valign="top"><table width="870" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="870" valign="top" align="center"><table width="870" border="0" cellspacing="0" cellpadding="0">
          					<tr>
            					<td background="../imagenes/c1.png">&nbsp;</td>
          					</tr>
          					<tr>
            					<td valign="top" background="../imagenes/c3.png"><table width="840" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="78" align="left"><img src="../imagenes/servicios.png" width="235" height="71" /></td>
              </tr>
              <tr>
                <td><div id="arr_servicio" align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
                    <td align="left" valign="middle" colspan="3" height="80px">
                    <a class="titulouno2"  onclick="getInicial(\'arr_servicio\');">Productos</a> &nbsp;
                    <span class="separa2">>&nbsp;&nbsp;</span>
                    <a class="titulouno2" onclick="getSiguiente(<?=$fin["idservicio"]?>,\'arr_servicio\');"><?=$fin["nomservicio"]?></a>&nbsp;
                    <?	if(strlen($catser) > 1) {	?>
                    <span class="separa2">>&nbsp;&nbsp;</span>
                    <a class="titulouno2" onclick="getSiguiente(<?=$fin["idservicio"]?>, \'arr_servicio\');"><?=$catser?></a>&nbsp;
                    <?	}	?>
                    <span class="separa2">>&nbsp;&nbsp;<?=$fin["producto"]?></span>&nbsp;
                    <hr /></td>
                </tr>
				<tr>
					<td width="15px" rowspan="3">&nbsp;</td>
					<td valign="middle" width="65px" align="center"><img src="../imagenes/titulo.png" width="50" height="50" /></td>
					<td valign="middle" height="64" width="760"><span class="producto"><?=$fin["producto"]?></span></td>
				</tr>
				<tr>
                	<td colspan="2">&nbsp;</td>
               	</tr>
				<tr>
					<td colspan="2"><table cellpadding="1" cellspacing="5" align="center" border="0" width="100%">
					 	<tr>
							<td colspan="2" align="center"><img src="../inicio/imagenProducto/<?=$fin["nomFoto"]?>" alt="<?=$fin["producto"]?>" title="<?=$fin["producto"]?>" /></td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<?
						$arr_uno = explode("/*-*/", $fin["nomCarac"]);
						foreach($arr_uno as $arr){
							$ar = explode("|@|", $arr);
						?>
						<tr>
							<td align="left" valign="top" width="250">
							<span class="desprodcat"><img src="../imagenes/vineta.png" />&nbsp;<?=strtoupper($ar[0])?>&nbsp;</span></td>
							<td align="left"><span class="descripcion"><?=$ar[1]?></span></td>
						</tr>
						<?	
						}
						
						if (strlen($fin["descripcion"]) > 5 ){
						?>
						<tr>
							<td align="left" valign="top"><span class="desprodcat"><img src="../imagenes/vineta.png" />&nbsp;DESCRIPCI&Oacute;N&nbsp;</span></td>
							<td align="left"><span class="especial"><?=html_entity_decode($fin["descripcion"])?></span></td>
						</tr>
						<?
						}
						?>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
					</table></td>
				</tr>
                </table>
                </div>
                  <p>&nbsp;</p></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          					</tr>
         					<tr>
            					<td height="30" background="../imagenes/c2.png">&nbsp;</td>
          					</tr>
							<tr>
								<td height="25">&nbsp;</td>
							</tr>
        				</table><br /></td>
					</tr>
				</table></td>
				<td width="20"><img src="../imagenes/trans.gif" width="20" height="30"/></td>
			</tr>
		</table></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td valign="bottom"><?php include("pie.php");?></td>
	</tr>
</table>
</body>
</html>';
		fwrite($this->archivo, $contenido);
	}
	
	function cerrarPHP(){
		$php = "\r\n" . '<?' . "\r\n" . 'unset($sql);' . "\r\n" . 'unset($pro);' . "\r\n" . 'unset($con);' . "\r\n". '?>';
		fwrite($this->archivo, $php);
	}
	
}
?>