<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";

if (Input::exists()) {
    // Set the directory for temporary QR code files
    $PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'hedStudQRCodes' . DIRECTORY_SEPARATOR;

    // Create the directory if it does not exist
    if (!file_exists($PNG_TEMP_DIR)) {
        mkdir($PNG_TEMP_DIR);
    }

    $errorCorrectionLevel = 'H';
    $matrixPointSize = 10;

    // Check if a CSV file is uploaded
    if ($_FILES['studentcsv_file']['name']) {
        $filename = explode(".", $_FILES['studentcsv_file']['name']);

        // Verify that the uploaded file is a CSV file
        if (end($filename) == "csv") {
            $handle = fopen($_FILES['studentcsv_file']['tmp_name'], "r");

            while ($data = fgetcsv($handle)) {
                // Skip the header row
                if ($data[0] != 'ID Number') {
                    // Construct the library_userID
                    $library_userID = 'ID-' . $data[0];

                    // Check if the library_userID already exists in the database
                    $userCheck = DB::getInstance()->get('userlogin', array('library_userID', '=', $library_userID));

                    // If the library_userID already exists, skip adding the student
                    if ($userCheck->count() > 0) {
                        continue;
                    }

                    // Generate QR code filename
                    $newfilename = $library_userID . '-' . $data[1] . ' ' . $data[2] . '(' . $data[4] . '-' . $data[5] . ').png';
                    $filename = $PNG_TEMP_DIR . $newfilename;

                    // Generate QR code
                    QRcode::png($library_userID, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

                    // Create new user if library_userID is unique
                    $user = new UserLogin();
                    try {
                        $user->create(array(
                            'username' => $library_userID,
                            'library_userID' => $library_userID,
                            'password' => Hash::make('123456'),
                            'permission' => '5',
                            'permissionRole' => '5',
                            'firstname' => $data[1],
                            'lastname' => $data[2],
                            'gender' => $data[3],
                            'yearLevel' => $data[4],
                            'progtrack' => $data[5],
                            'userType' => 'Student',
                            'departmentType' => 'Higher Education Department',
                            'libraryClass' => 'College Library',
                            'login_id' => '',
                            'avatar' => '',
                            'current_session' => 0,
                            'online' => 0,
                            'archive' => 0,
                            'status' => 'Active',
                            'qrcode' => $newfilename
                        ));

                    } catch (Exception $e) {
                        echo ($e->getMessage());
                    }
                }
            }

            fclose($handle);
        } else {
            $message = '<label class="text-danger">Please Select CSV File only.</label>';
        }
    } else {
        $message = '<label class="text-danger">Please Select File.</label>';
    }

    Session::flash('Added', 'New students have been successfully added!');
    Redirect::to('admin.php?action=studentsHedList');
}
ob_end_flush();
?>
