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
<link rel="stylesheet" href="admin-b-r-button.css">
<link rel="stylesheet" type="text/css" href="css/filter-button.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>GS Students Books Returned Report</title>
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
                   <br>
					<center>
						<ol class="breadcrumb" style="background-color: rgba(255, 255, 255, 0.239); border-radius:30px; margin-top:-5px;">
							<li><a href="admin.php" style="color:white"><i class="glyphicon glyphicon-th-list"></i> Go to</a></li>
							<a href="admin.php?action=studentsHed_transactionHistory(Borrowed)"><button type="button" class="btn-mb" style="color:#3db166;">HED Students</button></a> 
							<a href="admin.php?action=studentsShs_transactionHistory(Borrowed)"><button type="button" class="btn-mb" style="color:#3db166;">SHS Students</button></a> 
							<a href="admin.php?action=studentsJhs_transactionHistory(Borrowed)"><button type="button" class="btn-mb" style="color:#3db166;">JHS Students</button></a> 
							<a href="admin.php?action=studentsElem_transactionHistory(Borrowed)"><button type="button" class="btn-mb" style="background: #3db166; color:white">GS Students</button></a> 
						</ol>
                    </center>
                </section>

                <!-- Main content -->
                    <section class="col-lg-12 connectedSortable" >
                        <div class="col-xs-12" style="padding: 0px 15px 10px 15px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
							    <div class="col-md-3"></div>
									<!-- <div align="center">
										<h1 style="font-weight:bold; text-transform:uppercase;" class="box-title">Books Borrrowed Report</h1>
									</div> -->
                                    <br>
										<center  class="noprint">
											<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 130px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
												<p style="font-size:35px; transform: scale(1, 2);">
                                                   GS BOOKS RETURNED REPORT
												</p>
                                                <a style="color: #fff;" href="admin.php?action=studentsElem_transactionHistory(Borrowed)"><button type="button" class="abtnb">BORROWED BOOKS</button></a>
                                                <a style="color: #fff;" href="admin.php?action=studentsElem_transactionHistory(Returned)"><button type="button" class="abtnr">RETURNED BOOKS</button></a> 
											</div>
										</center>
									<br>
									<hr  class="noprint" style="border-top:1px dotted #000;"/>
                                <div class="noprint">
                                        <form class="form-inline" method="POST" action="" >
                                            <center>
                                            <div class="wrap-filter" class="noprint">
													<div class="filter-input-group"> 
														<label class="filter-input-label">FROM DATE</label>
														<input type="date" class="filter-input-box" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">TO DATE</label>
														<input type="date" class="filter-input-box" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>" />
													</div>
												</div>
												<br>
												<div class="wrap-filter" class="noprint">
													<div class="filter-input-group"> 
														<label class="filter-input-label">LIBRARY</label>
														<select class="filter-input-box" for="libraryClass" name="libraryClass" id="libraryClass">
															<option value="<?php echo isset($_POST['libraryClass']) ? $_POST['libraryClass'] : '' ?>" > <?php echo isset($_POST['libraryClass']) ? $_POST['libraryClass'] : '' ?></option>
															<option value="">None</option>
															<option value="College Library">College Library</option>
															<option value="High School Library">High School Library</option>
															<option value="Grade School Library">Grade School Library</option>
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
															<option value="K 1">K 1</option>
															<option value="K 2">K 2</option>	
															<option value="Grade 1">Grade 1</option>	
															<option value="Grade 2">Grade 2</option>	
															<option value="Grade 3">Grade 3</option>	
															<option value="Grade 4">Grade 4</option>	
															<option value="Grade 5">Grade 5</option>	
															<option value="Grade 6">Grade 6</option>	
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">CLASS SECTION</label>
														<select class="filter-input-box" for="classSection" name="classSection" id="classSection">
															<option value="<?php echo isset($_POST['classSection']) ? $_POST['classSection'] : '' ?>" > <?php echo isset($_POST['classSection']) ? $_POST['classSection'] : '' ?></option>
															<?php
																$libusers = DB:: getInstance()->query("SELECT DISTINCT classSection FROM library_users WHERE departmentType = 'Grade School Department' ORDER BY id ASC");							
																foreach($libusers->results() as $libusers){
															?>
															<option value="<?php echo $libusers->classSection?>"><?php echo ucwords($libusers->classSection) ?></option>
															<?php }?>
														</select> 
													</div>
                                                    <div class="filter-input-group"> 
                                                        <label class="filter-input-label">BOOK SECTION</label>
                                                        <select class="filter-input-box" for="bookSection" name="bookSection" id="bookSection">
                                                            <option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
                                                            <?php
                                                                $books = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books ORDER BY id ASC");							
                                                                foreach($books->results() as $books){
                                                            ?>
                                                            <option value="<?php echo $books->bookSection?>"><?php echo ucwords($books->bookSection) ?></option>
                                                            <?php }?>
                                                        </select> 
                                                    </div>

													<button class="filtersbtn" name="search"><i class="fa fa-filter"></i></button>
													<a class="filtersbtn" href="admin.php?action=studentsElem_transactionHistory(Returned)"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
													<button class="filtersbtn" onclick="window.print();"><i class="fa fa-print"></i></button>
												</div>
                                            </center>
                                        </form>
                                    </div>
									
									<br>
									<div class="table-responsive">	
										<table class="table table-bordered table-hover" id="articles">
											<thead>
                                            <tr>
                                                <th>Library</th>
                                                <th>Loaner ID</th>
                                                <th>Loaner Name</th>
												<th>Gender</th>
                                                <th>Year Level</th>
                                                <th>Class Section</th>
												<th>Accession No.</th>
												<th>Title</th>
                                                <th>Section</th>
                                                <th>Date Returned</th>
                                                <th>Day(s) Lapses</th>
                                                <th>Remarks</th>
                                            </tr>
											</thead>
											<tbody>
                                                <?php include 'admin/transactionHistory/bookloanDF/students/grdschl_bookreturnedDF.php'?>
											</tbody>
										</table>
									</div>	
                            </div><!-- /.box -->
                        </div><!-- /.col -->
						</div><!-- /.box -->        
					</section><!-- /.Left col -->
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
</script>
<script type="text/javascript">
  $('#confirmDelete').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>
</body>

</html>
