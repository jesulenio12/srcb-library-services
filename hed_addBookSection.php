<?php
session_start();
require 'conn.php';

		if(isset($_POST['stud_update_multiple_btn']))
			{
				$all_id = $_POST['stud_update_id'];
				$extract_id = implode(',' , $all_id);
				$yearLevel = $_POST['yearLevel'];
				$query = "UPDATE library_users
						SET yearLevel = '$yearLevel'
						WHERE id IN($extract_id)";
				$query_run = mysqli_query($conn, $query);

				if($query_run)
				{
					$_SESSION['Updated'] = "Multiple user has been successfully updated.";
					header("Location: admin.php?action=studentsHedList");
				}
				else
				{
					$_SESSION['Deleted'] = "Multiple user not updated.";
					header("Location: admin.php?action=studentsHedList");
				}
			}elseif(isset($_POST['stud_delete_multiple_btn']))
			{
				$all_id = $_POST['stud_update_id'];
				$extract_id = implode(',' , $all_id);
				$query = "UPDATE library_users
						SET archive = 1
						WHERE id IN($extract_id) ";
				$query_run = mysqli_query($conn, $query);

				if($query_run)
				{
					$_SESSION['Updated'] = "Multiple user has been successfully deactivated.";
					header("Location: admin.php?action=studentsHedList");
				}
				else
				{
					$_SESSION['Deleted'] = "Multiple user not deactivated.";
					header("Location: admin.php?action=studentsHedList");
				}
			}
?>

