<?php
session_start();
require 'conn.php';

		if(isset($_POST['stud_update_multiple_btn']))
			{
				$all_id = $_POST['stud_update_id'];
				$extract_id = implode(',' , $all_id);
						$query = "UPDATE books
						SET remove = '0'
						WHERE id IN($extract_id) ";
				$query_run = mysqli_query($conn, $query);

				if($query_run)
				{
					$_SESSION['Updated'] = "Multiple books has been successfully restored.";
					header("Location: admin.php?action=discardedbookArchive");
				}
				else
				{
					$_SESSION['Deleted'] = "Multiple books not restored.";
					header("Location: admin.php?action=discardedbookArchive");
				}
			}elseif(isset($_POST['stud_delete_multiple_btn']))
			{
				$all_id = $_POST['stud_update_id'];
				$extract_id = implode(',' , $all_id);
				$query = "DELETE FROM books
				WHERE id IN($extract_id) ";
				$query_run = mysqli_query($conn, $query);

				if($query_run)
				{
					$_SESSION['Updated'] = "Multiple books has been successfully deleted.";
					header("Location: admin.php?action=discardedbookArchive");
				}
				else
				{
					$_SESSION['Deleted'] = "Multiple books not deleted.";
					header("Location: admin.php?action=discardedbookArchive");
				}
			}

			
?>