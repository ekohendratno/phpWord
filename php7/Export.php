<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH."third_party/Autoloader.php");

use PhpOffice\PhpWord\Autoloader;
Autoloader::register();

class Export extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
	
    function docx() {
		
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
		
		$section = $phpWord->addSection();
		
		$section->addText(
			'"Learn from yesterday, live for today, hope for tomorrow. '
				. 'The important thing is not to stop questioning." '
				. '(Albert Einstein)'
		);
        
		
		$filename = date('Y-m-d H:i:s') . '.docx';		
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
    }
}
?>
