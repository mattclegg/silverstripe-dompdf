<?php
/*  Copyright 2015  mattclegg  (email : cleggmatt@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class DefaultPDFController extends Controller {

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