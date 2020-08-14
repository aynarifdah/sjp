<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Dompdf\Dompdf;

/**
* Name:  DOMPDF
* 
* Author: Jd Fiscus
* 	 	  jdfiscus@gmail.com
*         @iamfiscus
*          
*
* Origin API Class: http://code.google.com/p/dompdf/
* 
* Location: http://github.com/iamfiscus/Codeigniter-DOMPDF/
*          
* Created:  06.22.2010 
* 
* Description:  This is a Codeigniter library which allows you to convert HTML to PDF with the DOMPDF library
* 
*/

class Dompdf_gen {
		
	public function __construct() {
		
		// require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		require_once APPPATH.'third_party/dompdf/autoload.inc.php';
		
		$pdf = new Dompdf();
		
		$CI =& get_instance();
		$CI->dompdf = $pdf;
		
	}
	
}

// class Pdfgenerator {

//   public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
//   {
//     $dompdf = new DOMPDF();
//     $dompdf->loadHtml($html);
//     $dompdf->setPaper($paper, $orientation);
//     $dompdf->render();
//     if ($stream) {
//         $dompdf->stream($filename.".pdf", array("Attachment" => 0));
//     } else {
//         return $dompdf->output();
//     }
//   }
// }