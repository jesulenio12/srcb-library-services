<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    
if (Input::exists()) {
			//set it to writable location, a place for temp generated PNG files
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'studentsQRCodes'.DIRECTORY_SEPARATOR;
			
			//ofcourse we need rights to create temp dir
			if (!file_exists($PNG_TEMP_DIR))
				mkdir($PNG_TEMP_DIR);
			
			$filename = '';
			
			//processing form input
			//remember to sanitize user input in real-life solution !!!
			$errorCorrectionLevel = 'H';
			$matrixPointSize = 10;

			$library_userIDFilename  = 'ID-'.Input::get('library_userID');
			$firstname  = Input::get('firstname');
			$lastname  = Input::get('lastname');
			$yearLevel  = Input::get('yearLevel');
			$program  = Input::get('program');
			if (isset($_REQUEST['upload'])) { 
				
				$newfilename = $library_userIDFilename.'-'.$firstname.' '.$lastname.'('.$yearLevel.'-'.$program.').png';
				$filename = $PNG_TEMP_DIR.$newfilename;
				QRcode::png($library_userIDFilename, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
				// QRcode::png($_REQUEST['library_userID'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
				
			} 
			$library_users = new Library_users();
            try {
                $library_users->create(array(
					'library_userID' => 'ID-'.Input::get('library_userID'),
					'firstname' => Input::get('firstname'),
					'lastname' => Input::get('lastname'),
					'gender' => Input::get('gender'),
					'yearLevel' => Input::get('yearLevel'),
					'program' => Input::get('program'),
					'departmentType' => Input::get('departmentType'),
					'userType' => Input::get('userType'),
					'qrcode' => $newfilename
                ));
			
			Session::flash('Added', 'New library user has been successfully added.');
			Redirect::to('admin.php?action=studentsHedList');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
}
ob_end_flush();