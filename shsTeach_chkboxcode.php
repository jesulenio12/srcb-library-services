<?php
session_start();
require 'conn.php';

		if(isset($_POST['stud_delete_multiple_btn']))
			{
				$all_id = $_POST['stud_delete_id'];
				$extract_id = implode(',' , $all_id);
				$query = "UPDATE userlogin
						SET archive = 1
						WHERE id IN($extract_id) ";
				$query_run = mysqli_query($con, $query);

				if($query_run)
				{
					$_SESSION['Updated'] = "Multiple user has been successfully deleted.";
					header("Location: admin.php?action=teachersShsList");
				}
				else
				{
					$_SESSION['Deleted'] = "Multiple user not deleted.";
					header("Location: admin.php?action=teachersShsList");
				}
			}

			
?>