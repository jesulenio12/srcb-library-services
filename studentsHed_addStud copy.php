<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    

if (Input::exists()) {
    // Set directories
    $QR_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'hedStudQRCodes'.DIRECTORY_SEPARATOR;
    $AVATAR_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'UserAvatars'.DIRECTORY_SEPARATOR;

    // Create directories if not exist
    if (!file_exists($QR_TEMP_DIR))
        mkdir($QR_TEMP_DIR);
    
    if (!file_exists($AVATAR_TEMP_DIR))
        mkdir($AVATAR_TEMP_DIR);

    // Processing form input
    // Remember to sanitize user input in a real-life solution !!!

    // Error correction level and point size for QR code
    $errorCorrectionLevel = 'H';
    $matrixPointSize = 10;

    // Retrieve input fields
    $library_userIDFilename = 'ID-' . Input::get('library_userID');
    $firstname = Input::get('firstname');
    $lastname = Input::get('lastname');
    $avatar = $_FILES['avatar'];

    // Generate QR code
    if (isset($_REQUEST['library_userID'])) {
        $newfilename = $library_userIDFilename . '-' . $firstname . ' ' . $lastname . '.png';
        $filename = $QR_TEMP_DIR . $newfilename;
        QRcode::png($library_userIDFilename, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
    } 

    // Handle avatar/image upload
    $avatarName = '';
    if (!empty($avatar['name'])) {
        $avatarExtension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        if (in_array($avatarExtension, $allowedExtensions)) {
            $avatarName = $library_userIDFilename . '-' . $firstname . ' ' . $lastname . '.' . $avatarExtension;
            $avatarPath = $AVATAR_TEMP_DIR . $avatarName;
            
            // Move uploaded file to temp directory
            move_uploaded_file($avatar['tmp_name'], $avatarPath);

            // Resize image to standard avatar size
            list($width, $height) = getimagesize($avatarPath);
            $newWidth = 330; // Standard width
            $newHeight = 330; // Standard height
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
            if ($avatarExtension == 'jpg' || $avatarExtension == 'jpeg') {
                $source = imagecreatefromjpeg($avatarPath);
            } elseif ($avatarExtension == 'png') {
                $source = imagecreatefrompng($avatarPath);
            }
            imagecopyresampled($resizedImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Save resized image
            imagejpeg($resizedImage, $avatarPath, 330); // Save as jpeg with maximum quality

            // Free memory
            imagedestroy($source);
            imagedestroy($resizedImage);
        } else {
            echo "Invalid file format for avatar. Allowed formats: jpg, jpeg, png";
            // You may want to redirect or show an appropriate message here
            exit(); // Exiting script execution
        }
    }

    // Create user
    $user = new UserLogin();
    try {
        $user->create(array(
            'username' => 'ID-' . Input::get('library_userID'),
            'library_userID' => 'ID-' . Input::get('library_userID'),
            'password' => Hash::make('123456'),
            'permission' => '5',
            'permissionRole' => '5',
            'userType' => Input::get('userType'),
            'firstname' => Input::get('firstname'),
            'lastname' => Input::get('lastname'),
            'gender' => Input::get('gender'),
            'yearLevel' => Input::get('yearLevel'),
            'progtrack' => Input::get('progtrack'),
            'departmentType' => Input::get('departmentType'),
            'libraryClass' => Input::get('libraryClass'),
            'login_id' => '',
            'current_session' => 0,
            'online' => 0,
            'archive' => '0',
            'avatar' => $avatarName,
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
