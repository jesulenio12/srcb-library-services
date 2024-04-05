<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current
			
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
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<title>Book Loaning Transaction</title>

<style>
.btn-huge{
	width:100%;
    padding:35px;
}
</style>
</head>
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
					</center>
                </section>
                <!-- Main content -->
                <section class="col-lg-12 connectedSortable">
					<div class="row">
                        <div class="col-xs-12" style="padding: 15px 30px 15px 30px">
                            <div class="box box-primary" style="background-color: rgba(255, 255, 255, 0.239); border-radius:20px; padding: 8px 20px 0px 20px;">
                                <div class="box-header">
                                </div>
                                <div class="box-body">
									<center>
										<div class="row">
											<div class="col-xs-6">
												<a style="color: #fff;" href="admin.php?action=HsLibBorrowBooks"><button type="button" class="btnb">BORROW BOOKS</button></a> 
												<?php if(Session::exists('Borrowed')){ ?>
													<div class="alert alert-success">
														<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Borrowed'); ?>
													</div>
												<?php }?> 
											</div>
											<div class="col-xs-6">
											<a style="color: #fff;" href="admin.php?action=HsLibReturnBooks"><button type="button" class="btnr">RETURN BOOKS</button></a> 
												<?php if(Session::exists('Returned')){ ?>
													<div class="alert alert-success">
														<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Returned'); ?>
													</div>
												<?php }?> 
											</div>
										</div>
									</div><!-- /.box -->
								</center>
								<br>
							</div><!-- /.box -->
						</div><!-- /.col -->
                    </div><!-- /.row (main row) -->
					<section class="col-lg-6 connectedSortable" style="box-shadow: 2px 2px 10px 1px rgba(0, 0, 0, 0.418)"> 
						<!-- Box (with bar chart) -->
						<br>
						<div class="box box-success" id="loading-example">
							<div align="center">
								<h3 style="font-weight:bold" class="box-title">Book Loaning History (Borrowed)</h3> 
							</div>
							<hr style="border-top:1px dotted #000;"/>
							<div class="noprint">
								<form class="form-inline" method="POST" action="">
									<center>
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:7px 10px; border-radius:5px 0px 0px 5px">FROM DATE</label>
										<input style="width:38%; margin: 10px 10px 10px -3px" type="date" class="form-control noprint" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:7px 10px; border-radius:5px 0px 0px 5px">TO DATE</label>
										<input style="width:38%; margin: 10px 10px 10px -3px" type="date" class="form-control noprint" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>  
										<br>
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:5px 10px; border-radius:5px 0px 0px 5px">LOANER</label>
										<select style="height:30px; width:100% auto; margin: 10px 10px 10px -3px" class="form-control noprint" for="userType" name="userType" id="userType">
											<option value="<?php echo isset($_POST['userType']) ? $_POST['userType'] : '' ?>" > <?php echo isset($_POST['userType']) ? $_POST['userType'] : '' ?></option>
											<option value="">None</option>
											<option value="Student">Student</option>	
											<option value="Teacher">Teacher</option>
										</select> 
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:5px 10px; border-radius:5px 0px 0px 5px">COURSE</label>
										<select style="height:30px; width:100% auto; margin: 10px 10px 10px -3px" class="form-control noprint" for="progtrack" name="progtrack" id="progtrack">
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
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:5px 10px; border-radius:5px 0px 0px 5px">YEAR</label>
										<select style="height:30px; width:100% auto; margin: 10px 10px 10px -3px" class="form-control noprint" for="yearLevel" name="yearLevel" id="yearLevel">
											<option value="<?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?>" > <?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?></option>
											<option value="">None</option>
											<option value="Grade 7">Grade 7</option>	
											<option value="Grade 8">Grade 8</option>
											<option value="Grade 9">Grade 9</option>
											<option value="Grade 10">Grade 10</option>
										</select> 
										<br>
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:5px 10px; border-radius:5px 0px 0px 5px">BOOKS SECTION</label>
										<select style="height:30px; width:100% auto; margin: 10px 10px 10px -3px" class="form-control noprint" for="bookSection" name="bookSection" id="bookSection">
											<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
											<option value="">None</option>
											<option value="Accounting">Accounting</option>
											<option value="Bussiness Administration">Bussiness Administration</option>
											<option value="Circulation">Circulation</option>
											<option value="Criminology">Criminology</option>
											<option value="Dictionaries">Dictionaries</option>
											<option value="Education">Education</option>
											<option value="Fiction">Fiction</option>
											<option value="Fiction">Filipiniana</option>	
											<option value="Foreign References">Foreign References</option>
											<option value="General References">General References</option>
											<option value="General Education">General Education</option>
											<option value="Hotel Management">Hotel Management</option>
											<option value="Hotel & Restaurant">Hotel & Restaurant</option>
											<option value="Information Technology">Information Technology</option>
											<option value="Professional Readings">Professional Readings</option>
											<option value="Reviewers">Reviewers</option>
											<option value="Senior High School">Senior High School</option>
										</select>
										<button class="btn2 noprint" name="search"><i class="fa fa-filter"></i></button>
                                       	<a style="color: #fff;" href="admin.php?action=hsStaff_BookLoaning"> <button class="btn2" type="button"><i class="fa fa-refresh"></i></button></a>
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
                                                <th>Course/Year</th>
												<th>Title</th>
                                                <th>Section</th>
                                                <th>Date Borrowed</th>
												<th>Due Date</th>
                                            </tr>
                                        </thead>
										<tbody>
												<?php include 'HsLibBorrowedFilter.php'?>	
										</tbody>
                                    </table>
                    	</div><!-- /.box-body --
						</div><!-- /.box -->        
					</section><!-- /.Left col -->
					<section class="col-lg-6 connectedSortable" style="box-shadow: 2px 2px 20px 1px rgba(0, 0, 0, 0.418)"> 
					<br>
						<!-- Box (with bar chart) -->
						<div class="box box-success" id="loading-example">
						<div align="center">
								<h3 style="font-weight:bold" class="box-title">Book Loaning History (Returned)</h3> 
							</div>
							<hr style="border-top:1px dotted #000;"/>
							<div class="noprint">
								<form class="form-inline" method="POST" action="">
									<center>
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:7px 10px; border-radius:5px 0px 0px 5px">FROM DATE</label>
										<input style="width:38%; margin: 10px 10px 10px -3px" type="date" class="form-control noprint" placeholder="Start"  name="date3" value="<?php echo isset($_POST['date3']) ? $_POST['date3'] : '' ?>" />
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:7px 10px; border-radius:5px 0px 0px 5px">TO DATE</label>
										<input style="width:38%; margin: 10px 10px 10px -3px" type="date" class="form-control noprint" placeholder="End"  name="date4" value="<?php echo isset($_POST['date4']) ? $_POST['date4'] : '' ?>"/>  
										<br>
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:5px 10px; border-radius:5px 0px 0px 5px">LOANER</label>
										<select style="height:30px; width:100% auto; margin: 10px 10px 10px -3px" class="form-control noprint" for="userType" name="userType" id="userType">
											<option value="<?php echo isset($_POST['userType']) ? $_POST['userType'] : '' ?>" > <?php echo isset($_POST['userType']) ? $_POST['userType'] : '' ?></option>
											<option value="">None</option>
											<option value="Student">Student</option>	
											<option value="Teacher">Teacher</option>
										</select> 
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:5px 10px; border-radius:5px 0px 0px 5px">COURSE</label>
										<select style="height:30px; width:100% auto; margin: 10px 10px 10px -3px" class="form-control noprint" for="progtrack" name="progtrack" id="progtrack">
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
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:5px 10px; border-radius:5px 0px 0px 5px">YEAR</label>
										<select style="height:30px; width:100% auto; margin: 10px 10px 10px -3px" class="form-control noprint" for="yearLevel" name="yearLevel" id="yearLevel">
											<option value="<?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?>" > <?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?></option>
											<option value="">None</option>
											<option value="Grade 7">Grade 7</option>	
											<option value="Grade 8">Grade 8</option>
											<option value="Grade 9">Grade 9</option>
											<option value="Grade 10">Grade 10</option>
										</select> 
										<br>
										<label class="noprint" style="background: #163269; color:white; font-weight:bold; padding:5px 10px; border-radius:5px 0px 0px 5px">BOOKS SECTION</label>
										<select style="height:30px; width:100% auto; margin: 10px 10px 10px -3px" class="form-control noprint" for="bookSection" name="bookSection" id="bookSection">
											<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
											<option value="">None</option>
											<option value="Accounting">Accounting</option>
											<option value="Bussiness Administration">Bussiness Administration</option>
											<option value="Circulation">Circulation</option>
											<option value="Criminology">Criminology</option>
											<option value="Dictionaries">Dictionaries</option>
											<option value="Education">Education</option>
											<option value="Fiction">Fiction</option>
											<option value="Fiction">Filipiniana</option>	
											<option value="Foreign References">Foreign References</option>
											<option value="General References">General References</option>
											<option value="General Education">General Education</option>
											<option value="Hotel Management">Hotel Management</option>
											<option value="Hotel & Restaurant">Hotel & Restaurant</option>
											<option value="Information Technology">Information Technology</option>
											<option value="Professional Readings">Professional Readings</option>
											<option value="Reviewers">Reviewers</option>
											<option value="Senior High School">Senior High School</option>
										</select>
										<button class="btn2 noprint" name="search"><i class="fa fa-filter"></i></button>
										<a style="color: #fff;" href="admin.php?action=hsStaff_BookLoaning"> <button class="btn2" type="button"><i class="fa fa-refresh"></i></button></a>
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
                                                <th>Course/Year</th>
												<th>Title</th>
                                                <th>Section</th>
                                                <th>Date Returned</th>
												<th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
												<?php include 'HsLibReturnedFilter.php'?>	
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
	</script>
</body>
</html>

