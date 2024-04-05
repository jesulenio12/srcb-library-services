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

	@media print{
		.noprint, .noprint * {
			display: none; !important;
		}

		.row, .row * {
			columns: 400px 2;
			page-break-inside: avoid;
		}

		.box-body {
			zoom: 87.5%;
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
										<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 30px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
											<p style="font-size:28px; transform: scale(1, 2.5);">
												STAFF LIBRARY CARDS
											</p>
										</div>
									</center>

                            	<div class="box-body">
									<br>
									<div class="noprint">
										<form class="form-inline" method="POST" action="">
											<center>
												<button style="margin-left:3px; background-color:#3db166; color:#fff" type="button" class="btn2-1 noprint" onclick="window.print();">Print</button>
												<button style="margin-left:3px" type="button" class="btn2-1 noprint" onclick="window.location='admin.php?action=userList'">Cancel</button>
											</center>
										</form>
										<br>
									</div>
									<div class="clearfix noprint"></div><hr class="noprint" />
									<div class="libcard">
										<?php include 'staff_allLibCardFilter.php'?>
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