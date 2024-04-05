<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    


if (Input::exists()) {
    
            if($_FILES['libusercsv_file']['name'])
            {
            $filename = explode(".", $_FILES['libusercsv_file']['name']);
            if(end($filename) == "csv")
            {
                $handle = fopen($_FILES['libusercsv_file']['tmp_name'], "r");
                while($data = fgetcsv($handle))
                {
                    if ($data[0]!='ID Number') {
                            $user = new UserLogin();
                            try {
                                $user->create(array(
                                    'username' => 'ID-'.$data[0],
                                    'password' => Hash::make($data[1]),
                                    'fname' => $data[2],
                                    'lname' => $data[3],
                                    'gender' => $data[4],
                                    'yearLevel' => $data[5],
                                    'progtrack' => $data[6],
                                ));
                            
                            } catch(Exception $e) {
                                echo $error, '<br>';
                            }
                        
                    } 
                }
                fclose($handle);
        }
                else
                    {
                        Session::flash('error', 'test');
                        Redirect::to('admin.php?action=hedStud_OnlineUserList');
                    }
                }
                  
            else
            {
            // $message = '<label class="text-danger">Please Select File.</label>';
            Session::flash('error', 'Please Select File..');
                        Redirect::to('admin.php?action=hedStud_OnlineUserList');
            }
            
            Session::flash('UserAdded', 'New library users successfully added!');
            Redirect::to('admin.php?action=hedStud_OnlineUserList');
           
           
}      
ob_end_flush();