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
<link rel="stylesheet" type="text/css" href="css/filter-button.css">
<link rel="stylesheet" href="admin-b-r-button.css">
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>GS Library QR Codes</title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}

	@media print {

		.card-label-button, .card-label-button * {
			display: none; !important;
		}

		.session-message, .session-message * {
			display: none; !important;
		}


		@page {
				size: 816px 1248px;
				orientation: portrait;
				margin: 0;
				padding-top: 0;
			}

			/* Set 3-column layout */
			body {
				column-count: 4;
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

	.bookqr {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
	}

	.bookqr .row {
    	flex: 1 1 20%;
		text-align: center;
	}

	.bookqr .row .col-md-4 {
		display: block;
	}

	.dateFilter {
		background-color: #163269;
		color: white;
		font-weight: bolder;
		font-family: arial;
		font-size: 15px;
		border-radius: 4px;
		padding: 4px 9px;
		margin-right: -5px;
	}
	

	button.btn.btn-primary.mt-2 {
		width: fit-content;
		height: fit-content;
		padding: 0px 6px 0px 6px;
		background-color: #163269;
		border: none;
		margin-left: 10px
	}

	.card-label-button {
		display: flex;
		align-items: baseline;
		justify-content: center;
	}

	.card {
		background:white;
		border-radius:10px;
		width:300px;
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
                        <div class="col-xs-12" style="padding: 10px 15px 10px 15px">
                            <div style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding: 0px 30px 10px 30px">
								<br>
								<center class="noprint">
									<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 130px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
										<p style="font-size:35px; transform: scale(1, 2);">
											GS LIBRARY BOOK QR CODES
										</p>
										<a style="color: #fff;" href="admin.php?action=gsLib_allQR"><button type="button" class="abtnb">BULK PRINTING </button></a>
										<a style="color: #fff;" href="admin.php?action=gsLib_allQRSelect"><button type="button" class="abtnr">SELECTIVE PRINTING</button></a> 
									</div>
								</center>
                            	<div class="box-body">
									<br>
									<form class="form-inline" method="POST" action="" style="margin-left: 20px">
										<center class="noprint" >
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
													<label class="filter-input-label">TITLE</label>
													<input type="text" class="filter-input-box" for="bookTitle" id="bookTitle" name="bookTitle" value="<?php echo isset($_POST['bookTitle']) ? $_POST['bookTitle'] : '' ?>">
												</div>
												<div class="filter-input-group"> 
													<label class="filter-input-label">AUTHOR</label>
													<input type="text" class="filter-input-box" for="author" id="author" name="author" value="<?php echo isset($_POST['author']) ? $_POST['author'] : '' ?>">
												</div>
												<div class="filter-input-group"> 
													<label class="filter-input-label">COPYRIGHT YR.</label>
													<input type="text" class="filter-input-box" for="datePublished" id="datePublished" name="datePublished" value="<?php echo isset($_POST['datePublished']) ? $_POST['datePublished'] : '' ?>">
												</div>
												<div class="filter-input-group"> 
													<label class="filter-input-label">PUBLISHER</label>
													<input type="text" class="filter-input-box" for="publisher" id="publisher" name="publisher" value="<?php echo isset($_POST['publisher']) ? $_POST['publisher'] : '' ?>">
												</div>
												<div class="filter-input-group"> 
													<label class="filter-input-label">BOOK SECTION</label>
													<select class="filter-input-box" for="bookSection" name="bookSection" id="bookSection">
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
											<br>
											<button class="btn2 noprint" name="filterbook"><i class="fa fa-filter"></i></button>
											<a style="color: #fff;" class="noprint"  href="admin.php?action=gsLib_allQR"><button class="btn2 noprint" type="button"><i class="fa fa-refresh"></i></button></a>
											<button class="btn2 noprint" name="search" onclick="window.print();"><i class="fa fa-print"></i></button>
											<button style="margin-left:3px" type="button" class="btn2-1 noprint" onclick="window.location='admin.php?action=ElementaryBookList'">Cancel</button>
										</center>
									</form>
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
									<div class="bookqr">
										<?php include 'gsLib_allQRFilter.php'?>
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
</body>
</html>