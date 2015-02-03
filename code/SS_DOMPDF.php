<?php
/**
 * DOMPDF - PHP5 HTML to PDF renderer
 *
 * File: $RCSfile: dompdf_config.inc.php,v $
 * Created on: 2004-08-04
 *
 * Copyright (c) 2004 - Benj Carson <benjcarson@digitaljunkies.ca>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library in the file LICENSE.LGPL; if not, write to the
 * Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA
 * 02111-1307 USA
 *
 * Alternatively, you may distribute this software under the terms of the
 * PHP License, version 3.0 or later.  A copy of this license should have
 * been distributed with this file in the file LICENSE.PHP .  If this is not
 * the case, you can obtain a copy at http://www.php.net/license/3_0.txt.
 *
 * The latest version of DOMPDF might be available at:
 * http://www.digitaljunkies.ca/dompdf
 *
 * @link http://www.digitaljunkies.ca/dompdf
 * @copyright 2004 Benj Carson
 * @author Benj Carson <benjcarson@digitaljunkies.ca>
 * @package dompdf
 * @version 0.5.1
 */

/* $Id: dompdf_config.inc.php,v 1.19 2006/07/07 21:31:02 benjcarson Exp $ */

error_reporting(E_STRICT | E_ALL);

define("DOMPDF_DIR", str_replace(DIRECTORY_SEPARATOR, '/', BASE_PATH."/dompdf/dompdf"));

define("DOMPDF_INC_DIR", DOMPDF_DIR . "/include");
define("DOMPDF_LIB_DIR", DOMPDF_DIR . "/lib");
define("DOMPDF_FONT_DIR", DOMPDF_DIR . "/lib/fonts/");
define("DOMPDF_FONT_CACHE", DOMPDF_FONT_DIR);
define("DOMPDF_TEMP_DIR", sys_get_temp_dir());
define("DOMPDF_UNICODE_ENABLED", true);
define("DOMPDF_PDF_BACKEND", "CPDF");
define("DOMPDF_DEFAULT_MEDIA_TYPE", "screen");
define("DOMPDF_DEFAULT_PAPER_SIZE", "letter");
define("DOMPDF_DEFAULT_FONT", "serif");
define("DOMPDF_DPI", 96);
define("DOMPDF_ENABLE_PHP", false);
define("DOMPDF_ENABLE_JAVASCRIPT", true);
define("DOMPDF_ENABLE_REMOTE", false);
define("DOMPDF_LOG_OUTPUT_FILE", DOMPDF_FONT_DIR."log.htm");
define("DOMPDF_FONT_HEIGHT_RATIO", 1.1);
define("DOMPDF_ENABLE_CSS_FLOAT", false);
define('DEBUGPNG', false);
define('DEBUGKEEPTEMP', false);
define('DEBUGCSS', false);
define('DEBUG_LAYOUT', false);
define('DEBUG_LAYOUT_LINES', true);
define('DEBUG_LAYOUT_BLOCKS', true);
define('DEBUG_LAYOUT_INLINE', true);
define('DEBUG_LAYOUT_PADDINGBOX', true);


class SS_DOMPDF {
	public $PluginDir         = '../dompdf/dompdf';


	public function __construct() {

		//require_once $this->PluginDir . "/load_font.php";
		//install_font_family('helvetica');
		require_once $this->PluginDir . "/include/functions.inc.php";
		$this->Object=new DOMPDF();
	}
  
	public function load_html($data){
		$this->Object->load_html($data);
	}
	public function load_html_file($filename){
		$this->Object->load_html_file($filename);
	}
  
	public function render(){
		$this->Object->render();
	}
	public function output($options=null){
		return $this->Object->output($options);
	}
	
	public function set_paper($size, $orientation){
		$this->Object->set_paper($size, $orientation);
	}
	public function stream($outfile){
		return $this->Object->stream($outfile);
	}

}
