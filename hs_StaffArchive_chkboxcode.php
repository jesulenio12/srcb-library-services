<?php
session_start();
require 'conn.php';
		if(isset($_POST['stud_update_multiple_btn']))
			{
				$all_id = $_POST['stud_update_id'];
				$extract_id = implode(',' , $all_id);
						$query = "UPDATE userlogin
						SET permission = '3'
						WHERE id IN($extract_id) ";
				$query_run = mysqli_query($conn, $query);

				if($query_run)
				{
					$_SESSION['Updated'] = "Multiple admins has been successfully activated.";
					header("Location: admin.php?action=hs_StaffArchiveList");
				}
				else
				{
					$_SESSION['Deleted'] = "Multiple admins not activated.";
					header("Location: admin.php?action=hs_StaffArchiveList");
				}
			}elseif(isset($_POST['stud_delete_multiple_btn']))
			{
				$all_id = $_POST['stud_update_id'];
				$extract_id = implode(',' , $all_id);
				$query = "DELETE FROM userlogin
				WHERE id IN($extract_id) ";
				$query_run = mysqli_query($conn, $query);

				if($query_run)
				{
					$_SESSION['Updated'] = "Multiple admins has been successfully deleted.";
					header("Location: admin.php?action=hs_StaffArchiveList");
				}
				else
				{
					$_SESSION['Deleted'] = "Multiple admins not deleted.";
					header("Location: admin.php?action=hs_StaffArchiveList");
				}
			}
?>