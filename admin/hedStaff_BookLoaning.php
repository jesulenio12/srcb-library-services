<?php
require_once 'core/init.php';
$user = new UserLogin(); //Current
			
function getColorByProgTrack($progtrack)
	{
		switch ($progtrack) {
			case 'BSIT':
				return '#B73135';
			case 'BSBA':
				return '#E9E633';
			case 'BSCRIM':
				return '#3A384B';
			case 'BSED':
				return '#5C60A4';
			case 'BEED':
				return '#5C60A4';
			case 'BSHM':
				return '#EF54AF';
			default:
				return '#000000'; // Default color
		}
	}

function getColorByUsertype($userType)
	{
		switch ($userType) {
			case 'Teacher':
				return '#3db166';
			case 'Student':
				return '#163269';
			default:
				return '#000000'; // Default color
		}
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="admin/images/logo.png"/>
<meta name="description" content="">
<meta name="author" content="">
<!-- School Seal -->
<link rel="icon" type="image/png" href="images/logo.png"/>
<!-- bootstrap 3.0.2 -->
<link href="styles/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="styles/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/all.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/staff-bookloaning.css">
<link rel="stylesheet" type="text/css" href="css/filtering.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<title>Book Loaning Transaction</title>
</head>
<style>
	body {
        margin: 0;
        overflow: hidden; /* Hide scroll bars */
		background: transparent;
		background-size:cover;
		background-position:center center;
		background-repeat: no-repeat;
    }

	#video-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1; /* Place it behind other content */
    }

	.card {
		display: flex;
		justify-content: flex-start;
		align-items: center;
		gap: 30px;
		position: relative;
		margin-top: -90px;
		margin-bottom: 20px;
		margin-left: 20px;
		margin-right: 20px;
		border-radius: 15px;
		padding: 0px 0 0px 30px;
    	height: 330px;
		box-shadow: 0 4px 20px rgb(0 0 0 / 99%);
	}

	.borrow-return-card {
		margin: 10px;
	}

	.avatar img {
		height: 200px;
		width: auto;
		border-radius: 50%;
	}

	span.name {
		font-size: 20px;
		font-weight: 500;
		font-family: fantasy;
		color: white;
	}

	.card-body, .sub-name, .card-row {
		font-size: 12px;
		font-family: math;
		font-weight: 500;
		color: white;
	}

	.sub-name {
		font-weight: 600;
		padding: 5px;
		border-radius: 5px;
	}

	.card-row .col-xs-6 {
		display: inline-block;
		font-weight: bold;
		padding: 0;
	}

	span.time-logged {
		color: white;
		padding: 2px 5px;
		border-radius: 3px;
	}

	.user-type {
		font-size: 14px;
		font-family: sans-serif;
		font-weight: 600;
		margin: 0;
		text-transform: uppercase;
		padding: 4px 6px 1px 6px;
		border-radius: 5px 0px 0px 5px;
		border: 1px solid white;
		width: fit-content;
	}

	.btn.btn-danger {
		height: 23px;
		border-radius: 0px 5px 5px 0px;
		padding: 2px 7px;
	}

	.card-label-button {
		display: flex;
		align-items: center;
		justify-content: start;
	}

	/* submit */
	.btnupdate{
		font-family: "Roboto", sans-serif;
		font-size: 20px;
		border: none;
		font-weight: bold;
		background: #3db166;
		width: 100%;
		height:50px;
		padding: 0px;
		text-align: center;
		text-decoration: none;
		text-transform: uppercase;
		color: #fff;
		border-radius:10px;
		cursor: pointer;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		-webkit-transition-duration: 0.3s;
		transition-duration: 0.3s;
		-webkit-transition-property: box-shadow, transform;
		transition-property: box-shadow, transform;
	}

	.btnupdate:hover, .btnupdate:focus, .btnupdate:active{
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}

	/* cancel */
	.btncancel{
		font-family: "Roboto", sans-serif;
		font-size: 20px;
		border: none;
		font-weight: bold;
		background: #fff;
		width: 100%;
		height:50px;
		padding: 0px;
		text-align: center;
		text-decoration: none;
		text-transform: uppercase;
		color: #3db166;
		border-radius:10px;
		cursor: pointer;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		-webkit-transition-duration: 0.3s;
		transition-duration: 0.3s;
		-webkit-transition-property: box-shadow, transform;
		transition-property: box-shadow, transform;
	}

	.btncancel:hover, .btncancel:focus, .btncancel:active{
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}

	.under-label-btn {
		margin-top: -65px;
		position: relative;
	}

	.abtnb{
		font-family: "Roboto", sans-serif;
		font-size:25px;
		margin-top:23px;
		border: 5px solid lightgrey;
		font-weight: bold;
		background: #3db166;
		width: 30%;
		height:48px;
		padding: 0px;
		justify-content: left;
		text-align: center;
		text-decoration: none;
		text-transform: uppercase;
		color: #fff;
		border-radius:30px 0px 0px 30px;
		cursor: pointer;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		-webkit-transition-duration: 0.3s;
		transition-duration: 0.3s;
		-webkit-transition-property: box-shadow, transform;
		transition-property: box-shadow, transform;
	}

	.abtnb:hover, .abtnb:focus, .abtnb:active{
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}

	.abtnr{
		font-family: "Roboto", sans-serif;
		font-size:25px;
		margin-top:23px;
		border: 5px solid lightgrey;
		font-weight: bold;
		background: #fff;
		width: 30%;
		height:48px;
		padding: 0px;
		margin-left:1px;
		justify-content: right;
		text-align: center;
		text-decoration: none;
		text-transform: uppercase;
		color: #3db166;
		border-radius:0px 30px 30px 0px;
		cursor: pointer;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		-webkit-transition-duration: 0.3s;
		transition-duration: 0.3s;
		-webkit-transition-property: box-shadow, transform;
		transition-property: box-shadow, transform;
	}

	.abtnr:hover, .abtnr:focus, .abtnr:active{
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}

	.small-box.bg {
		display: flex;
		justify-content: center;
		margin-bottom: 15px;
	}

	.small-box {
		background-image: url(./images/nav2.jfif);
		background-size: cover;
		background-position: center center;
		background-repeat: no-repeat;
		padding: 23px 0px 10px 0px;
		width: 98%;
		height: 110px;
		box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418);
		color: #163269;
		border-radius: 20px;
		border: 7px solid #3db166;
	}

	.secondary-small-box {
		background-image: url(images/background.jpg); 
		background-size:cover; 
		background-position:center center; 
		background-repeat: no-repeat; 
		padding: 8px 0px 0px 0px; 
		width: 95%;
		height: 80px; 
		box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); 
		border-radius: 100px; 
		border: 5px solid lightgrey;
	}

	.small-box p {
		font-size: 30px;
		font-family: arial;
		font-weight: 900;
		transform: scale(2, 2);
		padding-top: 0;
	}

	.secondary-small-box p {
		font-size: 30px;
		color: white;
		text-transform: uppercase;
		text-align: center;
		font-family: arial;
		font-weight: 900;
		padding-top: 7px;
	}

	.small-box img {
		width: 40px;
		height: auto;
		margin-top: 1px;
	}

</style>
<body style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
        <!-- header logo: style can be found in header.less -->

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="center">
                <!-- Content Header (Page header) -->
                <section class="center">
					<br>
					<center>
						<div class="small-box bg">
							<p style="color: #163269">
								<img src="images/logo.png"/>
									WALK-IN BOOK REQUEST
								<img src="images/qrcode.jpg"/>
							</p>
						</div>
						<div class="under-label-btn">
							<a style="color: #fff;" href="admin.php?action=ColLibBorrowBooks"><button type="button" class="abtnb">BORROW BOOKS </button></a>
							<a style="color: #fff;" href="admin.php?action=ColLibReturnBooks"><button type="button" class="abtnr">RETURN BOOKS</button></a> 
						</div>
						
					</center>
                </section>
                <!-- Main content -->
				<br><br><br><br><br>
				<div class="borrow-return-card">
					<?php include 'ColLibBorrowedCard.php'?>
					<?php include 'ColLibReturnedCard.php'?>
				</div>
				<div class="col-xs-6">
					<?php if(Session::exists('Canceled')){ ?>
						<div class="alert alert-success" id="brrw-success">
							<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Canceled'); ?>
						</div>
					<?php }?> 
				</div>
				<?php if(Session::exists('Borrowed')){ ?>
					<div class="alert alert-success" id="brrw-success">
						<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Borrowed'); ?>
					</div>
				<?php }?> 
				<?php if(Session::exists('Returned')){ ?>
					<div class="alert alert-success" id="rtrn-success">
						<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Returned'); ?>
					</div>
				<?php }?> 
                <section class="col-lg-12 connectedSortable">
					<section class="col-lg-6 connectedSortable" style="box-shadow: 2px 2px 10px 1px rgba(0, 0, 0, 0.418)"> 
						<!-- Box (with bar chart) -->
						<br>
						<div class="box box-success" id="loading-example">
							<center class="noprint">
								<br>
								<div class="secondary-small-box bg">
									<p> Borrowed Books Log </p>
								</div>
							</center>
							<hr style="border-top:1px dotted #000;"/>
							<div class="noprint">
								<form class="form-inline" method="POST" action="">
									<center>
										<div class="date-picker" class="noprint">
											<div class="input-group"> 
												<label class="input-label">FROM DATE</label>
												<input type="date" class="input-box" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
											</div>
											<div class="input-group"> 
												<label class="input-label">TO DATE</label>
												<input type="date" class="input-box" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>  
											</div>
										</div>

										<div class="dropdown-filter">
											<div class="input-group">
												<label class="input-label">LOANER</label>
												<select class="input-box" for="userType" name="userType" id="userType">
													<option value="<?php echo isset($_POST['userType']) ? $_POST['userType'] : '' ?>" > <?php echo isset($_POST['userType']) ? $_POST['userType'] : '' ?></option>
													<option value="">None</option>
													<option value="Student">Student</option>	
													<option value="Teacher">Teacher</option>
												</select> 
											</div>
											<div class="input-group">
												<label class="input-label">COURSE</label>
												<select class="input-box" for="progtrack" name="progtrack" id="progtrack">
													<option value="<?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?>" > <?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?></option>
													<option value="">None</option>
													<option style="font-weight:bolder" value="">HED Department</option>
													<option value="BSIT">BSIT</option>	
													<option value="BSHM">BSHM</option>
													<option value="BSBA">BSBA</option>
													<option value="BSED">BSED</option>
													<option value="BEED">BEED </option>
													<option value="BSCRIM">BSCRIM</option>
													<option style="font-weight:bolder" value="">SHS Department</option>
													<option value="HUMMS">HUMMS</option>	
													<option value="STEM">STEM</option>	
													<option value="ABM">ABM</option>
												</select> 
											</div>
											<div class="input-group">
												<label class="input-label">BOOK SECTION</label>
												<select class="input-box" for="bookSection" name="bookSection" id="bookSection">
													<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
														<?php
														$books = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'College Library' ORDER BY id ASC");							
														foreach($books->results() as $books){
													?>
													<option value="<?php echo $books->bookSection?>"><?php echo ucwords($books->bookSection) ?></option>
													<?php }?>
												</select> 
											</div>
										</div>
										<div class="filter">
											<button class="btn2 noprint" name="search"><i class="fa fa-filter"></i>Filter</button>
											<a style="color: #fff;" href="admin.php?action=hedStaff_BookLoaning"> <button class="btn2" type="button"><i class="fa fa-refresh"></i>Reset</button></a>
										</div>
									</center>
								</form>
							</div>
							
							<div class="box-body table-responsive">
                            		<table class="table table-bordered table-hover" id="borrow">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Loaner</th>
												<th>ID No.</th>
												<th>Name</th>
                                                <th>Course</th>
												<th>Title</th>
                                                <th>Section</th>
                                                <th>Date Borrowed</th>
												<th>Due Date</th>
                                            </tr>
                                        </thead>
										<tbody>
												<?php include 'ColLibBorrowedFilter.php'?>	
										</tbody>
                                    </table>
                    	</div><!-- /.box-body --
						</div><!-- /.box -->        
					</section><!-- /.Left col -->
					<section class="col-lg-6 connectedSortable" style="box-shadow: 2px 2px 20px 1px rgba(0, 0, 0, 0.418)"> 
						<br>
						<!-- Box (with bar chart) -->
						<div class="box box-success" id="loading-example">
							<center class="noprint">
								<br>
								<div class="secondary-small-box bg">
									<p> Returned Books Log </p>
								</div>
							</center>
							<hr style="border-top:1px dotted #000;"/>
							<div class="noprint">
								<form class="form-inline" method="POST" action="">
									<center>
										<div class="date-picker" class="noprint">
											<div class="input-group"> 
												<label class="input-label">FROM DATE</label>
												<input type="date" class="input-box" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
											</div>
											<div class="input-group"> 
												<label class="input-label">TO DATE</label>
												<input type="date" class="input-box" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>  
											</div>
										</div>

										<div class="dropdown-filter">
											<div class="input-group">
												<label class="input-label">LOANER</label>
												<select class="input-box" for="userType" name="userType" id="userType">
													<option value="<?php echo isset($_POST['userType']) ? $_POST['userType'] : '' ?>" > <?php echo isset($_POST['userType']) ? $_POST['userType'] : '' ?></option>
													<option value="">None</option>
													<option value="Student">Student</option>	
													<option value="Teacher">Teacher</option>
												</select> 
											</div>
											<div class="input-group">
												<label class="input-label">COURSE</label>
												<select class="input-box" for="progtrack" name="progtrack" id="progtrack">
													<option value="<?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?>" > <?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?></option>
													<option value="">None</option>
													<option style="font-weight:bolder" value="">HED Department</option>
													<option value="BSIT">BSIT</option>	
													<option value="BSHM">BSHM</option>
													<option value="BSBA">BSBA</option>
													<option value="BSED">BSED</option>
													<option value="BEED">BEED </option>
													<option value="BSCRIM">BSCRIM</option>
													<option style="font-weight:bolder" value="">SHS Department</option>
													<option value="HUMMS">HUMMS</option>	
													<option value="STEM">STEM</option>	
													<option value="ABM">ABM</option>
												</select> 
											</div>
											<div class="input-group">
												<label class="input-label">BOOK SECTION</label>
												<select class="input-box" for="progtrack" name="progtrack" id="progtrack">
													<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
														<?php
														$books = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'College Library' ORDER BY id ASC");							
														foreach($books->results() as $books){
													?>
													<option value="<?php echo $books->bookSection?>"><?php echo ucwords($books->bookSection) ?></option>
													<?php }?>
												</select> 
											</div>
										</div>
										<div class="filter">
											<button class="btn2 noprint" name="search"><i class="fa fa-filter"></i>Filter</button>
											<a style="color: #fff;" href="admin.php?action=hedStaff_BookLoaning"> <button class="btn2" type="button"><i class="fa fa-refresh"></i>Reset</button></a>
										</div>
									</center>
								</form>
							</div>
							<div class="box-body table-responsive">
                            		<table class="table table-bordered table-hover" id="return">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Loaner</th>
												<th>ID No.</th>
												<th>Name</th>
                                                <th>Course</th>
												<th>Title</th>
                                                <th>Section</th>
                                                <th>Date Returned</th>
												<th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
												<?php include 'ColLibReturnedFilter.php'?>	
										</tbody>
                                    </table>
                    	</div><!-- /.box-body --
						</div><!-- /.box -->        
					</section><!-- /.Left col -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
	<!-- jQuery 2.0.2 -->
	<script src="styles/admin/js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- DATA TABES SCRIPT -->
	<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
	<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
	<!-- Bootstrap Validator JS -->
	<script src="styles/admin/js/bootstrapValidator.min.js"></script>
	<!-- page script -->
	<script type="text/javascript">
		$(function() {
			$("#borrow").dataTable();
		});
		function printImg(url) {
		  var win = window.open('');
		  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
		  win.focus();
		}

		$(function() {
			$("#return").dataTable();
		});
		function printImg(url) {
		  var win = window.open('');
		  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
		  win.focus();
		}
	</script>
	<script type="text/javascript">
		setTimeout(function(){
			document.getElementById("msg").style.display = "none";
		}, 5000);

		setTimeout(function(){
			document.getElementById("brrw-success").style.display = "none";
		}, 5000);

		setTimeout(function(){
			document.getElementById("rtrn-success").style.display = "none";
		}, 5000);
	</script>
	<script>
		$('#confirmRemove').on('show.bs.modal', function (e) {
		var $message = $(e.relatedTarget).attr('data-message');
		$(this).find('.modal-body p').text($message);
		$title = $(e.relatedTarget).attr('data-title');
		$(this).find('.modal-title').text($title);

		// Pass form reference to modal for submission on yes/ok
		var form = $(e.relatedTarget).closest('form');
			$(this).find('.modal-footer #confirm').data('form', form);
		});
		<!-- Form confirm (yes/ok) handler, submits form -->
		$('#confirmRemove').find('.modal-footer #confirm').on('click', function(){
			$(this).data('form').submit();
		});
	</script>
</body>
</html>

