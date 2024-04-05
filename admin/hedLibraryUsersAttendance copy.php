<?php
require_once 'core/init.php';
require 'conn.php';

$user = new UserLogin(); //Current
$prev_id_entry = "";

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {  
			$qrcod = Input::get('library_userID');

			$query=mysqli_query($conn, "SELECT * FROM attendance order by id DESC LIMIT 1") or die(mysqli_error());
			$row=mysqli_num_rows($query);
			if($row>0){
				while($fetch=mysqli_fetch_array($query)){
					$prev_id_entry = $fetch['library_userID'];
				}
			}

			$attendance = new Attendance();
            try {
				if($prev_id_entry != $qrcod){
					$attendance->create(array(
						'library_userID' => Input::get('library_userID'),
						'userType' => Input::get('userType'),
						'fullname' => Input::get('firstname').' '.Input::get('lastname'),
						'gender' => Input::get('gender'),
						'yearLevel' => Input::get('yearLevel'),
						'classSection' => Input::get('classSection'),
						'departmentType' => Input::get('departmentType'),
						'progtrack' => Input::get('progtrack'),
						'libraryClass' => Input::get('libraryClass'),
					));
					Session::flash('Log', 'Welcome to the Library, thank you for coming!');
					Redirect::to('admin.php?action=hedLibraryUsersAttendance');
				}

				if($prev_id_entry == $qrcod){
					Session::flash('ScannedAlready', 'You have scanned already!');
					Redirect::to('admin.php?action=hedLibraryUsersAttendance');
				}

            } catch(Exception $e) {
               $error;
            }
    }
}
	
?>
