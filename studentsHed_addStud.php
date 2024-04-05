<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    

if (Input::exists()) {
    // Set directories
    $QR_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'hedStudQRCodes'.DIRECTORY_SEPARATOR;

    // Create directories if not exist
    if (!file_exists($QR_TEMP_DIR))
        mkdir($QR_TEMP_DIR);
    
    // Processing form input
    // Remember to sanitize user input in a real-life solution !!!

    // Error correction level and point size for QR code
    $errorCorrectionLevel = 'H';
    $matrixPointSize = 10;

    // Retrieve input fields
    $library_userID = 'ID-' . Input::get('library_userID');
    $firstname = Input::get('firstname');
    $lastname = Input::get('lastname');
    $yearLevel = Input::get('yearLevel');
    $progtrack = Input::get('progtrack');

    // Check if library_userID already exists
    $userCheck = DB::getInstance()->get('userlogin', array('library_userID', '=', $library_userID));
    if ($userCheck->count() > 0) {
        Session::flash('Error', 'Error! Student ID No. already exists.');
        Redirect::to('admin.php?action=studentsHedList');
        exit(); // Stop further execution
    }

    // Generate QR code
    if (isset($_REQUEST['library_userID'])) {
        $newfilename = $library_userID . '-' . $firstname . ' ' . $lastname . '(' . $yearLevel .'-' . $progtrack . ').png';
        $filename = $QR_TEMP_DIR . $newfilename;
        QRcode::png($library_userID, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
    } 

    // Create user
    $user = new UserLogin();
    try {
        $user->create(array(
            'username' => $library_userID,
            'library_userID' => $library_userID,
            'password' => Hash::make('123456'),
            'permission' => '5',
            'permissionRole' => '5',
            'userType' => Input::get('userType'),
            'firstname' => $firstname,
            'lastname' => $lastname,
            'gender' => Input::get('gender'),
            'yearLevel' => $yearLevel,
            'progtrack' => $progtrack,
            'departmentType' => Input::get('departmentType'),
            'libraryClass' => Input::get('libraryClass'),
            'login_id' => '',
            'current_session' => 0,
            'online' => 0,
            'archive' => '0',
            'status' => 'Active',
            'qrcode' => $newfilename
        ));

        Session::flash('Added', 'New student has been successfully added.');
        Redirect::to('admin.php?action=studentsHedList');
    } catch(Exception $e) {
        echo ($e->getMessage());
    }
}

ob_end_flush();
?>
