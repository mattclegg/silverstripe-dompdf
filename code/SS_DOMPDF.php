<?php


define("DOMPDF_DIR", str_replace(DIRECTORY_SEPARATOR, '/', BASE_PATH."/dompdf/dompdf"));

/**
 * The location of the DOMPDF include directory
 */
define("DOMPDF_INC_DIR", DOMPDF_DIR . "/include");

/**
 * The location of the DOMPDF lib directory
 */
define("DOMPDF_LIB_DIR", DOMPDF_DIR . "/lib");

define("DOMPDF_FONT_DIR", DOMPDF_DIR . "/lib/fonts/");

/**
 * The location of the DOMPDF font cache directory
 *
 * Note this directory must be writable by the webserver process
 * This folder must already exist!
 * It contains the .afm files, on demand parsed, converted to php syntax and cached
 * This folder can be the same as DOMPDF_FONT_DIR
 *
 * *Please note the trailing slash.*
 */
define("DOMPDF_FONT_CACHE", DOMPDF_FONT_DIR);

/**
 * The location of a temporary directory.
 *
 * The directory specified must be writeable by the webserver process.
 * The temporary directory is required to download remote images and when
 * using the PFDLib back end.
 */
if ( !function_exists('sys_get_temp_dir')) {
	function sys_get_temp_dir() {
      if( $temp=getenv('TMP') )        return $temp;
      if( $temp=getenv('TEMP') )        return $temp;
      if( $temp=getenv('TMPDIR') )    return $temp;
      $temp=tempnam(__FILE__,'');
      if (file_exists($temp)) {
          unlink($temp);
          return dirname($temp);
      }
      return null;
  }
}

define("DOMPDF_TEMP_DIR", sys_get_temp_dir());

/**
 * ==== IMPORTANT ====
 *
 * dompdf's "chroot": Prevents dompdf from accessing system files or other
 * files on the webserver.  All local files opened by dompdf must be in a
 * subdirectory of this directory.  DO NOT set it to '/' since this could
 * allow an attacker to use dompdf to read any files on the server.  This
 * should be an absolute path.
 * This is only checked on command line call by dompdf.php, but not by
 * direct class use like:
 * $dompdf = new DOMPDF();	$dompdf->load_html($htmldata); $dompdf->render(); $pdfdata = $dompdf->output();
 */
define("DOMPDF_CHROOT", ASSETS_PATH."/private/");

/**
 * Whether to use Unicode fonts or not.
 *
 * When set to true the PDF backend must be set to "CPDF" and fonts must be
 * loaded via the modified ttf2ufm tool included with dompdf (see below).
 * Unicode font metric files (with .ufm extensions) must be created with
 * ttf2ufm.  load_font.php should do this for you if the TTF2AFM define below
 * points to the modified ttf2ufm tool included with dompdf.
 *
 * When enabled, dompdf can support all Unicode glyphs.  Any glyphs used in a
 * document must be present in your fonts, however.
 *
 */
define("DOMPDF_UNICODE_ENABLED", true);

/**
 * The path to the tt2pt1 utility (used to convert ttf to afm)
 *
 * Not strictly necessary, but useful if you would like to install
 * additional fonts using the {@link load_font.php} utility.
 *
 * Windows users should use something like this:
 * define("TTF2AFM", "C:\\Program Files\\Ttf2Pt1\\bin\\ttf2pt1.exe");
 *
 * @link http://ttf2pt1.sourceforge.net/
 */
if ( strpos(PHP_OS, "WIN") === false )
  define("TTF2AFM", DOMPDF_LIB_DIR ."/ttf2ufm/ttf2ufm-src/ttf2pt1.1");
else 
  define("TTF2AFM", "C:\\Program Files\\GnuWin32\\bin\\ttf2pt1.exe");

/**
 * The PDF rendering backend to use
 *
 * Valid settings are 'PDFLib', 'CPDF' (the bundled R&OS PDF class), 'GD' and
 * 'auto'.  'auto' will look for PDFLib and use it if found, or if not it will
 * fall back on CPDF.  'GD' renders PDFs to graphic files.  {@link
 * Canvas_Factory} ultimately determines which rendering class to instantiate
 * based on this setting.
 *
 * Both PDFLib & CPDF rendering backends provide sufficient rendering
 * capabilities for dompdf, however additional features (e.g. object,
 * image and font support, etc.) differ between backends.  Please see
 * {@link PDFLib_Adapter} for more information on the PDFLib backend
 * and {@link CPDF_Adapter} and lib/class.pdf.php for more information
 * on CPDF.  Also see the documentation for each backend at the links
 * below.
 *
 * The GD rendering backend is a little different than PDFLib and
 * CPDF.  Several features of CPDF and PDFLib are not supported or do
 * not make any sense when creating image files.  For example,
 * multiple pages are not supported, nor are PDF 'objects'.  Have a
 * look at {@link GD_Adapter} for more information.  GD support is new
 * and experimental, so use it at your own risk.
 *
 * @link http://www.pdflib.com
 * @link http://www.ros.co.nz/pdf
 * @link http://www.php.net/image
 */
define("DOMPDF_PDF_BACKEND", "CPDF");

/**
 * PDFlib license key
 *
 * If you are using a licensed, commercial version of PDFlib, specify
 * your license key here.  If you are using PDFlib-Lite or are evaluating
 * the commercial version of PDFlib, comment out this setting.
 *
 * @link http://www.pdflib.com
 *
 * If pdflib present in web server and auto or selected explicitely above,
 * a real license code must exist!
 */
#def("DOMPDF_PDFLIB_LICENSE", "your license key here");

/**
 * html target media view which should be rendered into pdf.
 * List of types and parsing rules for future extensions:
 * http://www.w3.org/TR/REC-html40/types.html
 *   screen, tty, tv, projection, handheld, print, braille, aural, all
 * Note: aural is deprecated in CSS 2.1 because it is replaced by speech in CSS 3.
 * Note, even though the generated pdf file is intended for print output,
 * the desired content might be different (e.g. screen or projection view of html file).
 * Therefore allow specification of content here.
 */
define("DOMPDF_DEFAULT_MEDIA_TYPE", "screen");

/**
 * The default paper size.
 *
 * North America standard is "letter"; other countries generally "a4"
 *
 * @see CPDF_Adapter::PAPER_SIZES for valid sizes
 */
define("DOMPDF_DEFAULT_PAPER_SIZE", "a4");

/**
 * The default font family
 *
 * Used if no suitable fonts can be found. This must exist in the font folder.
 * @var string
 */
define("DOMPDF_DEFAULT_FONT", "serif");

/**
 * Image DPI setting
 *
 * This setting determines the default DPI setting for images and fonts.  The
 * DPI may be overridden for inline images by explictly setting the
 * image's width & height style attributes (i.e. if the image's native
 * width is 600 pixels and you specify the image's width as 72 points,
 * the image will have a DPI of 600 in the rendered PDF.  The DPI of
 * background images can not be overridden and is controlled entirely
 * via this parameter.
 *
 * For the purposes of DOMPDF, pixels per inch (PPI) = dots per inch (DPI).
 * If a size in html is given as px (or without unit as image size),
 * this tells the corresponding size in pt.
 * This adjusts the relative sizes to be similar to the rendering of the
 * html page in a reference browser.
 *
 * In pdf, always 1 pt = 1/72 inch
 *
 * Rendering resolution of various browsers in px per inch:
 * Windows Firefox and Internet Explorer:
 *   SystemControl->Display properties->FontResolution: Default:96, largefonts:120, custom:?
 * Linux Firefox:
 *   about:config *resolution: Default:96
 *   (xorg screen dimension in mm and Desktop font dpi settings are ignored)
 *
 * Take care about extra font/image zoom factor of browser.
 *
 * In images, <img> size in pixel attribute, img css style, are overriding
 * the real image dimension in px for rendering.
 *
 * @var int
 */
define("DOMPDF_DPI", 96);

/**
 * Enable inline PHP
 *
 * If this setting is set to true then DOMPDF will automatically evaluate
 * inline PHP contained within <script type="text/php"> ... </script> tags.
 *
 * Enabling this for documents you do not trust (e.g. arbitrary remote html
 * pages) is a security risk.  Set this option to false if you wish to process
 * untrusted documents.
 *
 * @var bool
 */
define("DOMPDF_ENABLE_PHP", false);

/**
 * Enable inline Javascript
 *
 * If this setting is set to true then DOMPDF will automatically insert
 * JavaScript code contained within <script type="text/javascript"> ... </script> tags.
 *
 * @var bool
 */
define("DOMPDF_ENABLE_JAVASCRIPT", true);

/**
 * Enable remote file access
 *
 * If this setting is set to true, DOMPDF will access remote sites for
 * images and CSS files as required.
 * This is required for part of test case www/test/image_variants.html through www/examples.php
 *
 * Attention!
 * This can be a security risk, in particular in combination with DOMPDF_ENABLE_PHP and
 * allowing remote access to dompdf.php or on allowing remote html code to be passed to
 * $dompdf = new DOMPDF(); $dompdf->load_html(...);
 * This allows anonymous users to download legally doubtful internet content which on
 * tracing back appears to being downloaded by your server, or allows malicious php code
 * in remote html pages to be executed by your server with your account privileges.
 *
 * @var bool
 */
define("DOMPDF_ENABLE_REMOTE", false);


define('DEBUGPNG', false);
define('DEBUGKEEPTEMP', false);
define('DEBUGCSS', false);
define('DEBUG_LAYOUT', false);
define('DEBUG_LAYOUT_LINES', false);
define('DEBUG_LAYOUT_BLOCKS', false);
define('DEBUG_LAYOUT_INLINE', false);
define('DEBUG_LAYOUT_PADDINGBOX', false);

class SS_DOMPDF {
	public $PluginDir         = '../dompdf/dompdf';


  public function __construct() {
  
  	//require_once $this->PluginDir . "/load_font.php";
  	//install_font_family('helvetica');
	require_once $this->PluginDir . "/include/functions.inc.php";
    $this->Object=new DOMPDF();
    
  }
  
  
  public function load_html_file($filename){
  	$this->Object->load_html_file($filename);
  }
  
  public function render(){
	$this->Object->render();
  }
  
  public function set_paper($size, $orientation){
  	$this->Object->set_paper($size, $orientation);
  }
  public function stream($outfile){
  	$this->Object->stream($outfile);
  }
  
}