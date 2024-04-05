<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    
if (Input::exists()) {
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'gsStudQRCodes'.DIRECTORY_SEPARATOR;

    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);

    $filename = '';

    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'H';
    $matrixPointSize = 10;

		$library_userIDFilename  = 'ID-'.Input::get('library_userID');
		$yearLevel  = Input::get('yearLevel');
		$firstname  = Input::get('firstname');
		$lastname  = Input::get('lastname');
		$classSection  = Input::get('classSection');

        if (isset($_REQUEST['library_userID'])) { 

			$newfilename = $library_userIDFilename . '-' . $firstname . ' ' . $lastname . '-' . $yearLevelFilename. '(' .$classSection .' ' . ').png';
            $filename = $PNG_TEMP_DIR.$newfilename;
            QRcode::png($library_userIDFilename, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
            
        } 

        $user = new UserLogin();
        try {
            $user->create(array(
                'username' => 'ID-'.Input::get('library_userID'),
                'library_userID' => 'ID-'.Input::get('library_userID'),
                'password' => Hash::make('123456'),
                'permission' => '5',
                'permissionRole' => '5',
                'userType' => Input::get('userType'),
                'firstname' => Input::get('firstname'),
                'lastname' => Input::get('lastname'),
                'gender' => Input::get('gender'),
				'classSection' => Input::get('classSection'),
                'yearLevel' => Input::get('yearLevel'),
                'departmentType' => Input::get('departmentType'),
                'libraryClass' => Input::get('libraryClass'),
                'login_id' => '',
                'avatar' => '',
                'current_session' => 0,
                'online' => 0,
                'archive' => '0',
                'qrcode' => $newfilename
            ));

            Session::flash('Added', 'New student has been successfully added.');
            Redirect::to('admin.php?action=studentsElemList');
        
        } catch(Exception $e) {
            echo ($e->getMessage());
        }
			
}
ob_end_flush();