<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    
if (Input::exists()) {

            //set it to writable location, a place for temp generated PNG files
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'jhsTeachQRCodes'.DIRECTORY_SEPARATOR;
			
			//ofcourse we need rights to create temp dir
			if (!file_exists($PNG_TEMP_DIR))
				mkdir($PNG_TEMP_DIR);

                $errorCorrectionLevel = 'H';
                $matrixPointSize = 10;

                    if($_FILES['teachercsv_file']['name'])
                    {
                    $filename = explode(".", $_FILES['teachercsv_file']['name']);
                    if(end($filename) == "csv")
                    {
                        $handle = fopen($_FILES['teachercsv_file']['tmp_name'], "r");
                        while($data = fgetcsv($handle))
                        {
                            if ($data[0]!='ID Number') {
                                $filename = '';
                                $library_userIDFilename  = 'ID-'.$data[0];
                                $newfilename = $library_userIDFilename.'-'.$data[1].' '.$data[2].'('.$data[3].'-'.$departmentType.').png';
                                $filename = $PNG_TEMP_DIR.$newfilename;
                                QRcode::png($library_userIDFilename, $filename, $errorCorrectionLevel, $matrixPointSize, 2);  
                                
                                $user = new UserLogin();
                                try {
                                    $user->create(array(
                                        'username' => 'ID-'.$data[0],
                                        'library_userID' => 'ID-'.$data[0],
                                        'password' => Hash::make('123456'),
                                        'permission' => '6',
                                        'permissionRole' => '6',
                                        'firstname' => $data[1],
                                        'lastname' => $data[2],
                                        'gender' => $data[3],
                                        'yearLevel' => '',
                                        'progtrack' => '',
                                        'userType' => 'Teacher',
                                        'departmentType' => 'Junior High School Department',
                                        'libraryClass' => 'High School Library',
                                        'login_id' => '',
                                        'avatar' => '',
                                        'current_session' => 0,
                                        'online' => 0,
                                        'archive' => 0,
                                        'qrcode' => $newfilename
                                    ));
                                
                                    } catch(Exception $e) {
                                        echo ($e->getMessage());
                                    }
                            }
                        
                        }
                        fclose($handle);
                    }
                        else
                            {
                            $message = '<label class="text-danger">Please Select CSV File only.</label>';
                            }
                        }
                        
                    else
                    {
                    $message = '<label class="text-danger">Please Select File.</label>';
                    }
                    
                    Session::flash('Added', 'New teachers has been successfully added!');
                    Redirect::to('admin.php?action=teachersJhsList');
                
}      
ob_end_flush();