<?php

namespace MattClegg\dompdf;

use Dompdf\DOMPDF;

error_reporting(E_ALL);

class SS_DOMPDF {
	public function __construct() {
		$this->Object = new DOMPDF([
			'isRemoteEnabled' => true
		]);
	}
  
	public function loadHtml($data){
		$this->Object->loadHtml($data);
	}

	public function loadHtmlFile($filename){
		$this->Object->loadHtmlFile($filename);
	}

	public function set_paper($size, $orientation = "portrait"){
		$this->Object->setPaper($size, $orientation);
	}

	public function stream($filename = "document.pdf", $options = []){
		$this->Object->render();
		return $this->Object->stream($filename, $options);
	}

	public function output($options = []){
		$this->Object->render();
		return $this->Object->output($options);
	}
}
