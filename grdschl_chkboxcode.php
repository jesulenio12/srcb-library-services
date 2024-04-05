<?php
session_start();
require 'conn.php';
require_once 'core/init.php';

		if(isset($_POST['stud_update_multiple_btn']))
			{
				$all_id = $_POST['stud_update_id'];
				$extract_id = implode(',' , $all_id);
				$yearLevel = $_POST['yearLevel'];
				$classSection = $_POST['classSection'];
				$query = "UPDATE userlogin
						SET yearLevel = '$yearLevel',  classSection = '$classSection'
						WHERE id IN($extract_id)";
				$query_run = mysqli_query($conn, $query);

				if($query_run)
				{
					$_SESSION['Updated'] = "Student(s) has been successfully updated.";
					header("Location: admin.php?action=studentsElemList");
				}
				else
				{
					$_SESSION['Deleted'] = "Error! Student(s) not updated.";
					header("Location: admin.php?action=studentsElemList");
				}
			}elseif(Input::exists()) {
				$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'gsStudQRCodes'.DIRECTORY_SEPARATOR;
			
				$userlogin = DB:: getInstance()->get('userlogin', array('id','=',Input::get('deactivate')));							
				foreach($userlogin->results() as $userlogin){
					unlink($PNG_TEMP_DIR.$userlogin->qrcode);
				}
		
				$userlogin = DB:: getInstance()->get('userlogin', array('id','=',Input::get('deactivate')));
				if ($userlogin->count()){
				foreach($userlogin->results() as $userlogin){
					$userlog = new UserLogin();
						try {
						$userlog->update(array(
							'archive' => 1,
						),$userlogin->id);
					} catch(Exception $e) {
						$error;
					}
				}
			}
		
			Session::flash('Deactivated', 'Student has been successfully deactivated.');
			Redirect::to('admin.php?action=studentsElemList');	
		}
?>

