<?php
session_start();
require 'conn.php';

		if(isset($_POST['stud_delete_multiple_btn']))
			{
				$all_id = $_POST['stud_update_id'];
				$extract_id = implode(',' , $all_id);
				$query = "UPDATE userlogin
						SET permission = 0, archive = 1
						WHERE id IN($extract_id) ";
				$query_run = mysqli_query($conn, $query);

				if($query_run)
				{
					$_SESSION['Updated'] = "Student(s) has been successfully deactivated.";
					header("Location: admin.php?action=gsStud_OnlineUserList");
				}
				else
				{
					$_SESSION['Error'] = "Error! Student(s) not deactivated.";
					header("Location: admin.php?action=gsStud_OnlineUserList");
				}
			}
?>

