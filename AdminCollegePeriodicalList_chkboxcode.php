<?php
session_start();
require 'conn.php';

		if(isset($_POST['stud_update_multiple_btn']))
			{
				$all_id = $_POST['stud_update_id'];
				$extract_id = implode(',' , $all_id);
						$query = "UPDATE books
						SET status = 'Not Available'
						WHERE id IN($extract_id) ";
				$query_run = mysqli_query($conn, $query);

				if($query_run)
				{
					$_SESSION['Updated'] = "Multiple books has been successfully removed.";
					header("Location: admin.php?action=AdminCollegePeriodicalList");
				}
				else
				{
					$_SESSION['Deleted'] = "Multiple books not removed.";
					header("Location: admin.php?action=AdminCollegePeriodicalList");
				}
			}

			
?>