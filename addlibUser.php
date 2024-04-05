<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    
if (Input::exists()) {

		//set it to writable location, a place for temp generated PNG files
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'staffQRCodes'.DIRECTORY_SEPARATOR;
			
		//ofcourse we need rights to create temp dir
		if (!file_exists($PNG_TEMP_DIR))
			mkdir($PNG_TEMP_DIR);
		
		$filename = '';
		
		//processing form input
		//remember to sanitize user input in real-life solution !!!
		$errorCorrectionLevel = 'H';
		$matrixPointSize = 10;

		// if ($library_userID != $library_userID) {

			$library_userIDFilename  = 'ID-'.Input::get('library_userID');
			$firstname  = Input::get('firstname');
			$lastname  = Input::get('lastname');
			$gender  = Input::get('gender');
			
			if (isset($_REQUEST['library_userID'])) { 

				$newfilename = $library_userIDFilename.'-'.$firstname.'-'.$lastname.'-'.$gender.'.png';
				$filename = $PNG_TEMP_DIR.$newfilename;
				QRcode::png($library_userIDFilename, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
				
			} 

			$validate = new Validate();
			$validation = $validate->check($_POST, array(
					'username' => array(
					'name' => 'username',
					'required' => true,
					'min' => 2,
					'max' => 20,
					'unique' => 'userlogin'
				),
			));
			if ($validate->passed()) {
				$user = new Userlogin();
				try {
					$user->create(array(
						'library_userID' => 'ID-'.Input::get('library_userID'),
						'username' => Input::get('username'),
						'password' => Hash::make(Input::get('password')),
						'permission' => Input::get('userRole'),
						'permissionRole' => Input::get('userRole'),
						'firstname' => Input::get('firstname'),
						'lastname' => Input::get('lastname'),
						'gender' => Input::get('gender'),
						'email' => Input::get('email'),
						'contactNum' => Input::get('contactNum'),
						'login_id' => '',
						'avatar' => '',
						'current_session' => 0,
						'online' => 0,
						'archive' => 0,
						'status' => 'Active',
						'qrcode' => $newfilename
					));

				Session::flash('UserAdded', 'New library staff has been successfully added.');
				Redirect::to('admin.php?action=userList');
			
				} catch(Exception $e) {
					echo ($e->getMessage());
				}

			} else {
				foreach ($validate->errors() as $error) {
					Session::flash('Error', $error);
					Redirect::to('admin.php?action=userList');
				}
			}
}
ob_end_flush();