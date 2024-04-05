<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    
if (Input::exists()) {
			//set it to writable location, a place for temp generated PNG files
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'bookperiodicalQRCodes'.DIRECTORY_SEPARATOR;
			
			//ofcourse we need rights to create temp dir
			if (!file_exists($PNG_TEMP_DIR))
				mkdir($PNG_TEMP_DIR);
			
			$filename = '';
			
			$errorCorrectionLevel = 'H';
			$matrixPointSize = 10;

			$bookTitleFilename  = Input::get('bookTitle');
			$callNumber  = Input::get('callNumber');
			$bookAcc  = 'No.'.' '.Input::get('bookAccession');
			$datePublished  = Input::get('datePublished');
			if (isset($_REQUEST['bookAccession'])) { 
			
				$newfilename = $bookTitleFilename.'-'.$callNumber.'('.$bookAcc.'-'.$isbn.').png';
				$filename = $PNG_TEMP_DIR.$newfilename;
				QRcode::png($bookAcc, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
				
			} 
			$books = new Books();
            try {
                $books->create(array(
					'bookTitle' => Input::get('bookTitle'),
					'callNumber' => Input::get('callNumber'),
					'datePublished' => Input::get('datePublished'),
					'bookAccession' => 'No.'.' '.Input::get('bookAccession'),
					'bookSection' => 'Periodical',
					'libraryClass' => 'College Library',
					'status' => 'Available',
					'qrcode' => $newfilename
                ));
			
			Session::flash('Added', 'New book has been successfully added.');
			Redirect::to('admin.php?action=CollegePeriodicalList');
            } catch(Exception $e) {
				echo ($e->getMessage());
            }
}
ob_end_flush();