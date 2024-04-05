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
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="buttonhover.css">
<link rel="stylesheet" type="text/css" href="css/input-filter-btn.css">
<link rel="stylesheet" href="admin-b-r-button.css">
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>HED Student's Library Cards</title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}

	.small-box.bg {
		display: flex;
		justify-content: center;
		margin-bottom: 15px;
	}

	.small-box {
		padding: 23px 0px 10px 0px;
		width: 98%;
		height: 110px;
		box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418);
        background-color: #163269;
		border-radius: 20px;
		border: 7px solid #3db166;
	}

    .small-box p {
		font-size: 30px;
        color: white;
        font-family: arial;
        font-weight: 900;
        transform: scale(2, 2);
        text-transform: uppercase;
	}

    .under-label-btn {
		margin-top: -53px;
		position: relative;
	}

	@media print {

		.card-label-button, .card-label-button * {
			display: none; !important;
		}

		.session-message, .session-message * {
			display: none; !important;
		}

		.name {
			font-family: sans-serif; 
			font-size:15px; 
			font-weight: 900; 
			text-transform:uppercase;
		}

		.details {
			font-family:Arial; 
			text-transform: uppercase; 
			font-size: 12px;
		}
  		/* Set page size to A4 portrait orientation */
		@page {
				size: letter portrait;
				margin-top: 1in;
				padding: 0;
			}

			/* Set 3-column layout */
			body {
				column-count: 2;
				column-gap: 0;
				zoom: 80%;
			}

			/* Style images to fill available space in column */
			img {
				max-width: 100%;
				height: auto;
				display: block;
				margin: 0 auto;
			}

			.noprint, .noprint * {
				display: none; !important;
			}

			.row, .row * {
				page-break-inside: avoid;
			}
	}

	.libcard {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
	}

	.libcard .row {
    	flex: 1 1 25%;
	}

	.libcard .row .col-md-4 {
		display: block;
	}

	.name {
		font-family: sans-serif; 
		font-size:15px; 
		font-weight: 900; 
		text-transform:uppercase;
	}

	.details {
		font-family:Arial; 
		text-transform: uppercase; 
		font-size: 12px;
	}

	.dateFilter {
		background-color: #163269;
		color: white;
		font-weight: bolder;
		font-family: arial;
		font-size: 15px;
		border-radius: 4px;
		padding: 4px 9px;
		margin-left: 29px;
		margin-right: 5px;
	}

	button.btn.btn-primary.mt-2 {
		width: fit-content;
		height: fit-content;
		padding: 0px 6px 0px 6px;
		background-color: #163269;
		border: none;
	}

	.card-label-button {
		display: flex;
		position: absolute;
		align-items: baseline;
		margin-top: -12px;
		margin-left: -29px;
	}

</style>

<body class="skin-blue" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side"  style="background-color:transparent">
                <!-- Content Header (Page header) -->
                <section class="content-header"  style="background-color:transparent">
                    <!-- <h1>
                        Book Card Catalog
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Book Card Catalog</li>
                    </ol> -->
                </section>

                <!-- Main content -->
                <section  class="col-lg-12 connectedSortable">
                        <div class="col-xs-12" style="padding: 0px 15px 10px 15px">
                            <div style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding: 0px 30px 10px 30px">
								<br>
									<center class="noprint">
										<div class="small-box bg">
											<p> HED STUDENT QR CODES </p>
										</div>
										<div class="under-label-btn">
											<a style="color: #fff;" href="admin.php?action=hedStud_allLibCard"><button type="button" style="background: #3db166; color:white" class="abtnb">BULK PRINTING </button></a>
											<a style="color: #fff;" href="admin.php?action=hedStud_allLibCardSelect"><button type="button" style="background: #fff; color: #3db166;" class="abtnr">SELECTIVE PRINTING</button></a> 
										</div>
									</center>
                            	<div class="box-body">
									<br>
									<div class="noprint">
										<form class="form-inline" method="POST" action="">
											<center>
												<div class="wrap-filter" class="noprint">
													<div class="filter-input-group"> 
														<label class="filter-input-label">FROM DATE</label>
														<input type="date" class="date-filter-input-box" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">TO DATE</label>
														<input type="date" class="date-filter-input-box" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>" />
													</div>
													<!-- +
													<div class="filter-input-group"> 
														<label class="filter-input-label">FROM TIME</label>
														<input type="time" class="filter-input-box" placeholder="Start" id="datetimepicker5" name="time1" value="<?php echo isset($_POST['time1']) ? $_POST['time1'] : '' ?>" />
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">TO TIME</label>
														<input type="time" class="filter-input-box" placeholder="End"id="datetimepicker5" name="time2" value="<?php echo isset($_POST['time2']) ? $_POST['time2'] : '' ?>" />
													</div> -->
												</div>
												<br>
												<div class="wrap-filter" class="noprint">
													<div class="filter-input-group"> 
														<label class="filter-input-label">FIRSTNAME</label>
														<input type="text" class="filter-input-box" for="firstname" id="firstname" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>">
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">LASTNAME</label>
														<input type="text" class="filter-input-box" for="lastname" id="lastname" name="lastname" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>">
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
															<option value="First Year">First Year</option>
															<option value="Second Year">Second Year</option>
															<option value="Third Year">Third Year</option>
															<option value="Fourth Year">Fourth Year</option>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">PROGRAM</label>
														<select class="filter-input-box" for="progtrack" name="progtrack" id="progtrack">
															<option value="<?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?>" > <?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?></option>
															<option value="">None</option>
															<option value="BSIT">BSIT</option>	
															<option value="BSHM">BSHM</option>
															<option value="BSBA">BSBA</option>
															<option value="BSED">BSED</option>
															<option value="BEED">BEED </option>
															<option value="BSCRIM">BSCRIM</option>
														</select> 
													</div>
												</div>
												<br>
												<button class="filtersbtn noprint" name="search"><i class="fa fa-filter"></i></button>
                                        		<a style="color: #fff;" href="admin.php?action=hedStud_allLibCard"><button class="filtersbtn noprint" type="button"><i class="fa fa-refresh"></i></button></a>
												<button class="filtersbtn noprint" name="search" onclick="window.print();"><i class="fa fa-print"></i></button>
												<button style="margin-left:3px" type="button" class="btn-label noprint" onclick="window.location='admin.php?action=studentsHedList'">Cancel</button>
											</center>
										</form>
										<br>
									</div>
									<div class="clearfix noprint"></div><hr class="noprint" />
									<div class="session-message">
										<?php if(Session::exists('Move')){ ?>
												<div class="alert alert-success" id="alert">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Move'); ?>
												</div>
										<?php }?> 
										<?php if(Session::exists('Return')){ ?>
												<div class="alert alert-success" id="alert">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Return'); ?>
												</div>
										<?php }?> 
										<?php if(Session::exists('Error')){ ?>
												<div class="alert alert-danger" id="alert">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Error'); ?>
												</div>
										<?php }?> 
									</div>
									
									<div class="libcard">
										<?php include 'hedStud_allLibCardFilter.php'?>
									</div>
								<!-- Modal -->
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap Datepicker -->
<script src="js/bootstrap-datepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- Bootstrap Validator JS -->
<script src="styles/admin/js/bootstrapValidator.min.js"></script> 
<script>
	$(function () {
		$('#datetimepicker5').datetimepicker({
			use24hours: true,
			format: 'HH:mm'
		});
	});
</script>
</body>
</html>