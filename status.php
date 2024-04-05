<?php
include ("core/init.php");

$id = $_GET['id'];
$status = $_GET['status'];
$updatestatus = "UPDATE library_users SET status=$status WHERE id=$id";
mysqli_query($conn,$updatestatus);
Redirect::to('admin.php?action=teachersHedList');

?>

<?php
																if($library_users['status'] == 1){
																	echo '<p><a href="status.php?id='.$library_users['id'].'&status=0" class="btn btn-success">Active</a></p>';
																}
																else
																{
																	echo '<p><a href="status.php?id='.$library_users['id'].'&status=1" class="btn btn-success">Inactive</a></p>';
																}
																?>
																