<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    
if (Input::exists()) {
			//set it to writable location, a place for temp generated PNG files
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'discardedbookQRCodes'.DIRECTORY_SEPARATOR;
			
			//ofcourse we need rights to create temp dir
			if (!file_exists($PNG_TEMP_DIR))
				mkdir($PNG_TEMP_DIR);
			
			$filename = '';
			
			$errorCorrectionLevel = 'H';
			$matrixPointSize = 10;

			$bookTitleFilename  = Input::get('bookTitle');
			$author  = Input::get('author');
			$bookAcc  = 'Acc:'.' '.Input::get('bookAccession');
			$callNumber  = Input::get('callNumber');
			if (isset($_REQUEST['bookAccession'])) { 
			
				$newfilename = $bookTitleFilename.'-'.$author.'('.$bookAcc.'-'.$callNumber.').png';
				$filename = $PNG_TEMP_DIR.$newfilename;
				QRcode::png($bookAcc, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
				
			} 
			$books = new Books();
            try {
                $books->create(array(
					'bookTitle' => Input::get('bookTitle'),
					'bookAccession' => 'Acc:'.' '.Input::get('bookAccession'),
					'isbn' => Input::get('isbn'),
					'callNumber' => Input::get('callNumber'),
					'bookDescription' => Input::get('bookDescription'),
					'subject' => Input::get('subject'),
					'otherSubject' => Input::get('otherSubject'),
					'author' => Input::get('author'),
					'otherAuthor' => '/'.Input::get('otherAuthor'),
					'etAl_authors' => Input::get('etAl_authors'),
					'authorNumber' => Input::get('authorNumber'),
					'glossary' => 'Glossary: p.'.' '.Input::get('glossary'),
					'bibliography' => 'Bibliography: p.'.' '.Input::get('bibliography'),
					'appendix' => 'Appendix: p.'.' '.Input::get('appendix'),
					'indexNumber' => 'Index: p.'.' '.Input::get('indexNumber'),
					'includes' => 'Includes'.' '.Input::get('includes'),
					'publisher' => Input::get('publisher'),
					'datePublished' => Input::get('datePublished'),
					'bookSection' => Input::get('bookSection'),
					'libraryClass' => 'High School Library',
					'is_borrowed' => '0',
					'requested' => '0',
					'approved' => '0',
					'received' => '0',
					'discarded' => '1',
					'lost' => '0',
					'remove' => '0',
					'qrcode' => $newfilename
                ));
			
			Session::flash('Added', 'New book has been successfully added.');
			Redirect::to('admin.php?action=HighSchoolDiscardedBooks');
            } catch(Exception $e) {
				echo ($e->getMessage());
            }
}
ob_end_flush();