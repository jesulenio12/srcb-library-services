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
<title>JHS Teacher's Library Cards</title>
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
		margin-right: 29px;
		margin-left: 5px;
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
		margin-right: -29px;
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
                                        <div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 130px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
                                            <p style="font-size:35px; transform: scale(1, 2);">
                                                JHS TEACHER LIBRARY CARDS
                                            </p>
                                            <a style="color: #fff;" href="admin.php?action=jhsTeach_allLibCard"><button type="button" style="background: white; color: #3db166;" class="abtnb">BULK PRINTING </button></a>
                                            <a style="color: #fff;" href="admin.php?action=jhsTeach_allLibCardSelect"><button type="button" style="background: #3db166; color:white" class="abtnr">SELECTIVE PRINTING</button></a> 
                                        </div>
                                    </center>
                            	<div class="box-body">
									<br>
									<div class="noprint">
										<center>
											<button class="btn2 noprint" name="search" onclick="window.print();"><i class="fa fa-print"></i></button>
											<button style="margin-left:3px" type="button" class="btn2-1 noprint" onclick="window.location='admin.php?action=teachersJhsList'">Cancel</button>
										</center>
									</div>
									<br>
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
										<?php include 'jhsTeach_allLibCardFilterSelect.php'?>
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