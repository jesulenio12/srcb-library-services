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
<link rel="stylesheet" type="text/css" href="css/filtering.css">
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
							<p style="color: #163269; transform: scale(1.2, 2.3)">
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
												<a style="color: #fff;" href="admin.php?action=GsLibBorrowBooks"><button type="button" class="btnb">BORROW BOOKS</button></a> 
												<?php if(Session::exists('Borrowed')){ ?>
													<div class="alert alert-success">
														<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Borrowed'); ?>
													</div>
												<?php }?> 
											</div>
											<div class="col-xs-6">
											<a style="color: #fff;" href="admin.php?action=GsLibReturnBooks"><button type="button" class="btnr">RETURN BOOKS</button></a> 
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
							<center class="noprint">
								<br>
								<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 8px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 5px solid lightgrey;">
									<p style="font-size:18px; transform: scale(1, 2.5); text-transform: uppercase;">
										Borrowed Books
									</p>
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
												<label class="input-label">YEAR LEVEL</label>
												<select class="input-box" for="yearLevel" name="yearLevel" id="yearLevel">
													<option value="<?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?>" > <?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?></option>
													<option value="">None</option>
													<option value="Grade 7">Grade 7</option>	
													<option value="Grade 8">Grade 8</option>
													<option value="Grade 9">Grade 9</option>
													<option value="Grade 10">Grade 10</option>
												</select> 
											</div>
											<div class="input-group">
												<label class="input-label">BOOK SECTION</label>
												<select class="input-box" for="bookSection" name="bookSection" id="bookSection">
													<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
														<?php
														$books = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'Grade School Library' ORDER BY id ASC");							
														foreach($books->results() as $books){
													?>
													<option value="<?php echo $books->bookSection?>"><?php echo ucwords($books->bookSection) ?></option>
													<?php }?>
												</select> 
											</div>
										</div>
										<div class="filter">
											<button class="btn2 noprint" name="search"><i class="fa fa-filter"></i>Filter</button>
											<a style="color: #fff;" href="admin.php?action=elemStaff_BookLoaning"> <button class="btn2" type="button"><i class="fa fa-refresh"></i>Reset</button></a>
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
                                                <th>Year</th>
												<th>Title</th>
                                                <th>Section</th>
                                                <th>Date Borrowed</th>
												<th>Due Date</th>
                                            </tr>
                                        </thead>
										<tbody>
												<?php include 'GsLibBorrowedFilter.php'?>	
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
								<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 8px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 5px solid lightgrey;">
									<p style="font-size:18px; transform: scale(1, 2.5); text-transform: uppercase;">
										Returned Books
									</p>
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
												<label class="input-label">YEAR LEVEL</label>
												<select class="input-box" for="yearLevel" name="yearLevel" id="yearLevel">
													<option value="<?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?>" > <?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?></option>
													<option value="">None</option>
													<option value="Grade 7">Grade 7</option>	
													<option value="Grade 8">Grade 8</option>
													<option value="Grade 9">Grade 9</option>
													<option value="Grade 10">Grade 10</option>
												</select> 
											</div>
											<div class="input-group">
												<label class="input-label">BOOK SECTION</label>
												<select class="input-box" for="bookSection" name="bookSection" id="bookSection">
													<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
														<?php
														$books = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'Grade School Library' ORDER BY id ASC");							
														foreach($books->results() as $books){
													?>
													<option value="<?php echo $books->bookSection?>"><?php echo ucwords($books->bookSection) ?></option>
													<?php }?>
												</select> 
											</div>
										</div>
										<div class="filter">
											<button class="btn2 noprint" name="search"><i class="fa fa-filter"></i>Filter</button>
											<a style="color: #fff;" href="admin.php?action=elemStaff_BookLoaning"> <button class="btn2" type="button"><i class="fa fa-refresh"></i>Reset</button></a>
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
                                                <th>Year</th>
												<th>Title</th>
                                                <th>Section</th>
                                                <th>Date Returned</th>
												<th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
												<?php include 'GsLibReturnedFilter.php'?>	
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
</body>
</html>

