<?php
	require 'conn.php';
	$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 0 && userType != 'Student' AND userType != 'Teacher' ORDER BY `id` DESC") or die(mysqli_error());
	while($fetch=mysqli_fetch_array($query)){
?>
	<div class="row mt-5">
		<div class="col-md-4" style="margin:10px 10px 10px 10px;" class="column">
			<div class="card" style="background:white; border: 3px solid #163269; border-radius:10px; width:443px;">
				<div class="card-body">
					<h2 class="card-title"><img src="images/srcblogo.png" style="width:180px; height:50px; margin-top: 3px" class="card-img-logo"/></h2>
					<hr style="border-top:2px solid #3db166; margin-top:2px"/>	
					<p class="card-text" style="margin-top:-17px">
						<span class="name" style="font-family: sans-serif; font-size:15px; font-weight: bold; text-transform:uppercase">
							<?php echo $fetch['firstname']?> <?php echo $fetch['lastname']?>
						</span>
						<br>
						<span style="font-family:Arial">
							ID: <?php echo substr($fetch['library_userID'], 3, 255);?><br>
							<?php 
								if ($fetch['userType'] == 1) {
									echo 'System Administrator';
								}elseif($fetch['userType'] == 2){
									echo 'HED Library Staff';
								}elseif($fetch['userType'] == 3){
									echo 'BED Library Staff';
								}elseif($fetch['userType'] == 4){
									echo 'GS Library Staff';
								}
							?>
						</span>
					</p>
				</div>
				<img src="admin/staffQRCodes/<?php echo $fetch['qrcode']?>" width="200px" height="200px" style="border-radius:10px; margin-left:10px; margin-right:-10px"  class="card-img-qr">
			</div>
		</div>
	</div>
<?php
		}
?>