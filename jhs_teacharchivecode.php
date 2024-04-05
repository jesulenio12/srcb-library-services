<?php
session_start();
$con = mysqli_connect("localhost","root","","lms_dbs");

		if(isset($_POST['stud_update_multiple_btn']))
			{
				$all_id = $_POST['stud_update_id'];
				$extract_id = implode(',' , $all_id);
				$query = "UPDATE library_users
						SET archive = 0
						WHERE id IN($extract_id) ";
				$query_run = mysqli_query($con, $query);

				if($query_run)
				{
					$_SESSION['Updated'] = "Multiple user has been successfully restored.";
					header("Location: admin.php?action=JhsTeachArchiveList");
				}
				else
				{
					$_SESSION['Deleted'] = "Multiple user not restored.";
					header("Location: admin.php?action=JhsTeachArchiveList");
				}
			}elseif(isset($_POST['stud_delete_multiple_btn']))
			{
				$all_id = $_POST['stud_update_id'];
				$extract_id = implode(',' , $all_id);
				$query = "DELETE FROM library_users WHERE id IN($extract_id) ";
				$query_run = mysqli_query($con, $query);
						
				if($query_run)
				{
					$_SESSION['Updated'] = "Multiple user has been successfully deleted.";
					header("Location: admin.php?action=JhsTeachArchiveList");
				}
				else
				{
					$_SESSION['Deleted'] = "Multiple user not deleted.";
					header("Location: admin.php?action=JhsTeachArchiveList");
				}
			}

			
?>