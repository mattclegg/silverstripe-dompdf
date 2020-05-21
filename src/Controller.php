<?php

namespace MattClegg\dompdf;

use SilverStripe\Control\Controller as SS_Controller;

class Controller extends SS_Controller {

	public function index(){

		if($this->request->param('ID')){
			Requirements::clear();

			$id = (int)$this->request->param('ID');

			if(!file_exists(ASSETS_PATH."/private")) mkdir(ASSETS_PATH."/private");

			$page = Page::get_by_id('Page', $id);

			$content = $this->customise(array(
				'Page'	=> $page
			))->renderWith(array('DefaultPDF'));

			if(isset($_REQUEST['show'])) {
				return $content;
			}

			$dompdf = new SS_DOMPDF();
			$dompdf->load_html($content);

			if ( isset($base_path) ) {
				$dompdf->set_base_path(ASSETS_PATH);
			}

			$paper = DOMPDF_DEFAULT_PAPER_SIZE;
			$orientation = "portrait";

			$dompdf->set_paper($paper, $orientation);
			$dompdf->render();

			$outfile = substr($page->Title, 0, 250).".pdf";

			$dompdf->stream(Convert::raw2xml($outfile));
		} else {
			echo 'Specify a page ID';
			die();
		}
	}

}