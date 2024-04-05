<?php
if (Input::exists()) {
	$booktransactions = DB:: getInstance()->get('booktransactions', array('id','=',Input::get('paid')));
	if ($booktransactions->count()){
		foreach($booktransactions->results() as $booktransactions){
			$booktransaction = new BookTransactions();
			try {
				$booktransaction->update(array(
					'payment' => 1,
				),$booktransactions->id);
			} catch(Exception $e) {
			$error;
			}
		}

		Session::flash('Paid', 'Fines has been successfully paid.');
		Redirect::to('admin.php?action=HighSchoolLibFines');	
	}													
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- School Seal -->
<link rel="icon" type="image/png" href="images/logo.png"/>
<!-- bootstrap 3.0.2 -->
<link href="styles/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="styles/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/all.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="styles/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="buttonhover.css">
<link rel="stylesheet" type="text/css" href="css/filter-button.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>HS Library Book Fines</title>
</head>
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}

	@media print{
		.noprint, .noprint * {
			display: none; !important;
		}

		div.dataTables_filter label, div.dataTables_filter label * {
			display: none; !important;
		}

		div.dataTables_length label, div.dataTables_length label * { 
			display: none; !important;
		}

		div.dataTables_info, div.dataTables_info * { 
			display: none; !important;
		}

		div.dataTables_paginate, div.dataTables_paginate * { 
			display: none; !important;
		}

		div.row, div.row * { 
			display: none; !important;
		}

	}
</style>
<body class="skin-blue" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="background-color:transparent">
                <!-- Content Header (Page header) -->
				<section class="content-header" style="background-color:transparent">
                 
                </section>
                <!-- Main content -->
                <section style="background-color:transparent">
                    <div class="col-xs-12" style="padding: 0px 30px 10px 30px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
								<div class="col-md-3"></div>
									<br>
										<center>
											<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
												<p style="font-size:35px; transform: scale(1, 2);">
													BOOK FINES
												</p>
											</div>
										</center>
									<hr style="border-top:1px dotted #000;"/>
									<form class="form-inline" method="POST" action="">
										<center>
												<div class="wrap-filter" class="noprint">
													<div class="filter-input-group"> 
														<label class="filter-input-label">LOANER</label>
														<select class="filter-input-box" for="userType" name="userType" id="userType">
															<option value="<?php echo isset($_POST['userType']) ? $_POST['userType'] : '' ?>" > <?php echo isset($_POST['userType']) ? $_POST['userType'] : '' ?></option>
															<option value="">None</option>
															<option value="Student">Student</option>
															<option value="Teacher">Teacher</option>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">GENDER</label>
														<select class="filter-input-box" for="gender" name="gender" id="gender">
															<option value="<?php echo isset($_POST['gender']) ? $_POST['gender'] : '' ?>" > <?php echo isset($_POST['gender']) ? $_POST['gender'] : '' ?></option>
															<option value="">None</option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">YEAR LEVEL</label>
														<select class="filter-input-box" for="yearLevel" name="yearLevel" id="yearLevel">
															<option value="<?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?>" > <?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?></option>
															<option value="">None</option>
															<option style="font-weight:bolder" value="">JHS Department</option>
															<option value="Grade 7">Grade 7</option>	
															<option value="Grade 8">Grade 8</option>	
															<option value="Grade 9">Grade 9</option>	
															<option value="Grade 10">Grade 10</option>	
															<option style="font-weight:bolder" value="">SHS Department</option>
															<option value="Grade 11">Grade 11</option>	
															<option value="Grade 12">Grade 12</option>	
															<option style="font-weight:bolder" value="">HED Department</option>
															<option value="First Year">First Year</option>
															<option value="Second Year">Second Year</option>
															<option value="Third Year">Third Year</option>
															<option value="Fourth Year">Fourth Year</option>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">CLASS SECTION</label>
														<select class="filter-input-box" for="classSection" name="classSection" id="classSection">
															<option value="<?php echo isset($_POST['classSection']) ? $_POST['classSection'] : '' ?>" > <?php echo isset($_POST['classSection']) ? $_POST['classSection'] : '' ?></option>
															<?php
																$libusers = DB:: getInstance()->query("SELECT DISTINCT classSection FROM library_users WHERE departmentType = 'Senior High School Department' OR departmentType = 'Junior High School Department' AND classSection != 'N/A' ORDER BY id ASC");							
																foreach($libusers->results() as $libusers){
															?>
															<option value="<?php echo $libusers->classSection?>"><?php echo ucwords($libusers->classSection) ?></option>
															<?php }?>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">COURSE</label>
														<select class="filter-input-box" for="progtrack" name="progtrack" id="progtrack">
															<option value="<?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?>" > <?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?></option>
															<option value="">None</option>
															<option style="font-weight:bolder" value="">SHS Department</option>
															<option value="HUMMS">HUMMS</option>	
															<option value="STEM">STEM</option>	
															<option value="ABM">ABM</option>
															<option style="font-weight:bolder" value="">HED Department</option>
															<option value="BSIT">BSIT</option>	
															<option value="BSHM">BSHM</option>
															<option value="BSBA">BSBA</option>
															<option value="BSED">BSED</option>
															<option value="BEED">BEED </option>
															<option value="BSCRIM">BSCRIM</option>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">BOOK SECTION</label>
														<select class="filter-input-box" for="bookSection" name="bookSection" id="bookSection">
															<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
															<option value="">None</option>
															<?php
																$books = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'High School Library' ORDER BY id ASC");							
																foreach($books->results() as $books){
															?>
															<option value="<?php echo $books->bookSection?>"><?php echo ucwords($books->bookSection) ?></option>
															<?php }?>
														</select> 
													</div>

													<button class="filtersbtn" name="search"><i class="fa fa-filter"></i></button>
													<a class="filtersbtn" href="admin.php?action=HighSchoolLibFines"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
												</div>
										</center>
									</form>
									<br>
									<div class="box-body table-responsive">	
										<?php if(Session::exists('Paid')){ ?>
												<div class="alert alert-success" id="alert">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Paid'); ?>
												</div>
										<?php }?> 
										<table class="table table-bordered" id="articles">
											<thead>
                                            <tr>
												<th>#</th>
                                                <th>Loaner</th>
                                                <th>ID No.</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Year Level</th>
												<th>Class Section</th>
												<th>Track</th>
												<th>Acc. No.</th>
												<th>Title</th>
                                                <th>Section</th>
												<th>Date Borrowed</th>
                                                <th>Due Date</th>
                                                <th>Date Returned</th>
                                                <th>Lapses</th>
                                                <th>FPDD</th>
                                                <th>Fines</th>
                                                <th>Remarks</th>
												<th class="noprint">Action</th>
                                            </tr>
											</thead>
											<tbody>
												<?php include 'Filter_HighSchoolFinesReport.php'?>	
											</tbody>
										</table>
									</div>	
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div><!-- /.row (main row) -->
					
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="styles/admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="styles/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
    $(function() {
        $("#articles").dataTable();
    });

	setTimeout(function(){
		document.getElementById("alert").style.display = "none";
	}, 5000);
</script>
<script type="text/javascript">
  $('#confirmPayment').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmPayment').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>
</body>

</html>
