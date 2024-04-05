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
<link rel="stylesheet" type="text/css" href="css/addInputs.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>Library Staff List</title>
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
        padding-top: 3px;
        text-transform: uppercase;
	}

	.man-acc-conpost {
        margin-top:40px;
    }

    .man-acc-container{
        height: 10px;
        padding: 20px;
        margin: -50px 0px 0px 100px auto;
        background: #3db166;
        border-radius: 30px;
        display: flex;
        position:inherit;
        flex-direction: row;
        justify-content: center;
    }

    .man-acc-count{
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: #163269;
        border: 7px solid #3db166;
        color: white;
        padding: 10px 0px 0px 0px;
        margin: 0px 30px;
        margin-top: -75px;
        transition: 1s;

    }
    .man-acc-count:hover{
        transform: scale(1.1);
        z-index: 2;
        box-shadow: 2px 2px 2px #000;
        
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
                    <!-- <ol class="breadcrumb" style="background-color: rgba(255, 255, 255, 0.239); border-radius:30px; margin-top:-5px;">
                        <li><a href="admin.php" style="color:white"><i class="glyphicon glyphicon-th-list"></i> Go to</a></li>
                        <a href="admin.php?action=userList"><button type="button" class="btn" style="color:#3db166">Library Staff</button></a> 
                        <a href="admin.php?action=libuserList"><button type="button" class="btn" style="color:#3db166">Library Users</button></a> 
                    </ol> -->
                    </center>
                </section>
                <!-- Main content -->
                <section class="col-lg-12 connectedSortable">
                        <div class="col-xs-12" style="padding: 0px 15px 10px 15px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
										<br>
										<center>
											<div class="small-box bg">
												<p> LIBRARY STAFF LIST </p>
											</div>
										</center>
										<br>
										<div class="man-acc-conpost">
											<div class="man-acc-container">
												<div class="data">
													<div class="content">
													<?php 
													$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin WHERE permission != 0 && permissionRole = 1");
													$countUserlogin =DB:: getInstance()->count($userlogin);?>
														<div class="inner">
															<h3>
																<?php echo $countUserlogin; ?>
															</h3>
															<p>
																Administrator
															</p>
														</div>
													</div>
												</div>
												<div class="data">
													<div class="content">
													<?php 
													$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin WHERE permission != '0' && permissionRole = '2'");
													$countUserlogin =DB:: getInstance()->count($userlogin);?>
														<div class="inner">
															<h3>
																<?php echo $countUserlogin; ?>
															</h3>
															<p>
																HED Staff
															</p>
														</div>
													</div>
												</div>
												<div class="data">
													<div class="content">
													<?php 
													$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin WHERE permission != 0 && permissionRole = 3");
													$countUserlogin =DB:: getInstance()->count($userlogin);?>
														<div class="inner">
															<h3>
																<?php echo $countUserlogin; ?>
															</h3>
															<p>
																HS Staff
															</p>
														</div>
													</div>
												</div>
												<div class="data">
													<div class="content">
													<?php 
													$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin WHERE permission != 0 && permissionRole = 4");
													$countUserlogin =DB:: getInstance()->count($userlogin);?>
														<div class="inner">
															<h3>
																<?php echo $countUserlogin; ?>
															</h3>
															<p>
																GS Staff
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									<br><br><br>
									<hr style="border-top:1px dotted #000;"/>								    
									<div class="noprint">
										<form class="form-inline" method="POST" action="">
											<center>
												<button type="button" class="btn-label noprint" data-toggle="modal" data-target="#exampleModal">Add Staff</button>	
												<button class="filtersbtn noprint" onclick="window.print();"><i class="fa fa-print"></i></button>
												<a href="admin.php?action=staff_allLibCard"><button class="filtersbtn noprint" type="button" ><i class="glyphicon glyphicon-qrcode"></i></button></a>
											</center>
										</form>
										<br>
									</div>
                                <div class="box-body table-responsive">
									<?php if(Session::exists('UserUpdated')) { ?>
										<div class="alert alert-success">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('UserUpdated'); ?>
										</div>
									<?php }?>
									<?php if(Session::exists('UserAdded')) { ?>
										<div class="alert alert-success">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('UserAdded'); ?>
										</div>
									<?php }?>
									<?php if(Session::exists('Success')) { ?>
										<div class="alert alert-success">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Success'); ?>
										</div>
									<?php }?>
									<table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>User Role</th>
												<th>ID Number</th>
                                                <th>Username</th>
												<th>Name</th>
												<th style="width:6%;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php include 'userListFilter.php'?>	
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->

								<!-- ADD NEW MODAL -->
								
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
													<center>
														<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
															<p id="exampleModalLabel" style="font-size:30px; transform: scale(.7, 1); text-transform: uppercase">
																Add New Staff
															</p>
														</div>
													</center>
											</div>
											<div class="modal-body">
												<form method="post" action="addlibUser.php">
													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="library_userID">ID Number</span>
																<input type="text" class="add-input" id="library_userID" name="library_userID" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="userRole">Role</span>
																<select class="add-input" name="userRole" id="userRole" required>
																	<option value="<?php echo isset($_POST['userRole']) ? $_POST['userRole'] : '' ?>" > <?php echo isset($_POST['userRole']) ? $_POST['userRole'] : '' ?></option>
																	<?php
																		$userRole = DB:: getInstance()->query("SELECT * FROM groups WHERE id != '5' AND id != '6' ORDER BY id ASC");							
																		foreach($userRole->results() as $userRole){
																	?>
																	<option value="<?php echo $userRole->id?>"><?php echo ucwords($userRole->name) ?></option>
																	<?php }?>
																</select> 
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="firstname">Firstname</span>
																<input type="text" class="add-input" id="firstname" name="firstname" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="lastname">Lastname</span>
																<input type="text" class="add-input" id="lastname" name="lastname" required>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="contactNum">Contact No.</span>
																<input type="text" class="add-input" id="contactNum" name="contactNum" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="gender">Gender</span>
																<select class="add-input" name="gender" id="gender" required>
																	<option value=""></option>
																	<option value="Male">Male</option>	
																	<option value="Female">Female</option>	
																</select> 
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															<div class="add-input-container"> 
																<span for="email">Email</span>
																<input type="text" class="add-input" id="email" name="email" required>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="username">Username</span>
																<input type="text" class="add-input" id="username" name="username" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="password">Password</span>
																<input type="password" class="add-input" id="password" name="password" required>
															</div>
														</div>
													</div>
											</div>
											<div class="modal-footer">
												<div class="row">
													<div class="col-md-6">
														<button type="submit" class="btnupdate" value="save"> Save</button>
													</div>
													<div class="col-md-6">
														<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
													</div>
												</div>
												</form>
											</div>
											</div>
										</div>
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
<!-- Bootstrap Datepicker -->
<script src="js/bootstrap-datepicker.min.js"></script>
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
	function printImg(url) {
	  var win = window.open('');
	  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
	  win.focus();
	}
</script>
<script type="text/javascript">
  $('#confirmDeactivate').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDeactivate').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>
</body>

</html>