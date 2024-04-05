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
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="buttonhover.css">

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>SHS Student's Library Card</title>
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
			page-break-inside: avoid;
		}

		.box-body {
			zoom: 87.5%;
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
                <section class="col-lg-12 connectedSortable">
                    <div class="col-xs-12" >
                        <div style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
							<br>
							<center class="noprint">
								<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
									<p style="font-size:35px; transform: scale(1, 2);">
										STUDENT'S LIBRARY CARD
									</p>
								</div>
							</center>
							<br>
                            <div class="box-body">
                                    <div class="form-actions">
										<div class="row" class="noprint" style="padding:0px 150px 0px 150px">
											<div class="col-md-6">
												<button type="button" class="btnupdate noprint" onclick="window.print();"> Print</button>	
											</div>
											<div class="col-md-6">
												<button type="button" class="btncancel noprint" onclick="window.location='admin.php?action=studentsJhsList'">Cancel</button>
											</div>
										</div>
										<br>
                                    </div>
								<div class="row mt-5" align="center">
									<?php 
										$library_users = DB:: getInstance()->get('library_users', array('id','=',$_GET['id']));							
										foreach($library_users->results() as $library_users){?>
											<div class="col-md-12" style="margin:10px 0px 10px 0px;" class="column">
												<div class="card" style="background:white; border: 3px solid #163269; border-radius:10px; width:443px;">
													<div class="card-body">
														<h2 class="card-title" align="left"><img src="images/srcblogo.png" style="width:140px; height:35px; margin-top:-10px" class="card-img-logo"/></h2>
														<hr style="border-top:2px solid #3db166; margin-top:2px"/>	
														<p class="card-text" style="margin-top:-17px" align="left">
															<span class="name" style="font-family:fantasy; font-size:15px; text-transform:uppercase">
																<?php echo $library_users->firstname ; ?> <?php echo $library_users->lastname ; ?>
															</span>
															<br>
															<span style="font-family:Arial">
																<?php echo $library_users->yearLevel ; ?><br>
																ID No.<?php echo substr($library_users->library_userID, 3, 255); ?> 
																	<br>
																<?php echo $library_users->departmentType ; ?>
															</span>
														</p>
													</div>
													<img src="admin/studentsQRCodes/<?php echo ($library_users->qrcode) ?>" width="200px" height="170px" style="border-radius:10px; margin-left:10px; margin-right:-10px"  class="card-img-qr">
												</div>
											</div>
									<?php }?>         
								</div>
								<br>
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
<script type="text/javascript">
	$(document).ready(function() {
        var validator = $("#editUser").bootstrapValidator({
			fields : {
				username : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Username cannot be empty.",
						},
					}
				},
				userRole : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Please select a User Role.",
						},
					}
			}
		});
    });
</script>
</body>
</html>