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
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>Book Card Catalog </title>
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

		.card {
			display: flex;
			flex-direction: column;
			border: none;
		}
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
                            <div class="box" class="noprint" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
								<br>
									<center>
										<div class="small-box bg noprint" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
											<p style="font-size:30px; transform: scale(1, 2);">
												CARD CATALOG
											</p>
										</div>
									</center>
								<br>
                            <div class="box-body" style="padding: 0px 40px 0px 40px">
								<?php if(Session::exists('bookUpdated')){ ?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('bookUpdated'); ?>
                                    </div>
								<?php }?>
								<div class="card">
									<div class="cardbox">
										<table class="table table-bordered table-hover" id="articles" style="background-color:white; width:480px; height:192px">
											<thead>
												<tr class="noprint">
													<th style="background-color:#163269; text-align: center; height:50px; color:white; padding: -13px 0px 0px 0px; font-size:20px">Title Card</th>
													<!-- <th>Author Card</th>
													<th>Subject Card</th> -->
												</tr>
											</thead>
											<tbody>
												<?php 
													$books = DB:: getInstance()->get('books', array('id','=',$_GET['id']));							
													foreach($books->results() as $books){?>
															<tr style="font-family:Arial Narrow; font-size:10px">
																<td>
																	<!-- Title Card -->
																	<p  style="text-transform:uppercase; margin:0px;">
																		<?php echo substr($books->bookSection, 0, 3); ?>.
																	</p>
																	<?php echo $books->callNumber; ?><br>
																	<?php echo $books->authorNumber; ?><br>
																	<?php echo $books->datePublished; ?><br>
																		<div style="margin-top: -60px; padding-right: 0px;">
																			<p style="text-transform:uppercase; margin:0px; font-weight: bold; margin-left: 100px;">
																				<?php echo $books->bookTitle; ?><br>
																			</p>
																			<p style="margin-left: 100px;">
																				<?php echo $books->author; ?>
																			</p>
																			<p style="margin-left: 100px;">
																				<?php echo $books->author; ?>
																				<?php echo $books->otherAuthor; ?><br>
																				<?php echo $books->bookDescription; ?>
																				Ⓒ<?php echo $books->datePublished; ?>
																			</p>
																			<p style="margin-left: 100px;">
																				<?php echo $books->includes; ?>.<br><br>
																				<?php echo $books->indexNumber; ?><br>
																				<?php echo $books->appendix; ?><br>
																				<?php echo $books->glossary; ?>	  <br>
																				<?php echo $books->bibliography;?><br>
																				ISBN <?php echo $books->isbn; ?><br>
																				<?php echo $books->subject;?>
																				<?php echo $books->otherSubject;?><br>I. Title.
																			</p>
																				<?php echo substr($books->bookAccession, 4, 255); ?><br>
																		</div>
															</tr>
													<?php 
															
														}
												?>
											</tbody>
										</table>
									</div>
									<div class="cardbox">
										<table class="table table-bordered table-hover" id="articles" style="background-color:white; width:480px; height:192px">
											<thead>
												<tr class="noprint">
													<th style="background-color:#163269; text-align: center; height:50px; color:white; padding: -13px 0px 0px 0px; font-size:20px">Author Card</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$books = DB:: getInstance()->get('books', array('id','=',$_GET['id']));							
													foreach($books->results() as $books){?>
															<tr style="font-family:Arial Narrow; font-size:10px">
																<td>
																	<!-- Author Card -->
																	<p  style="text-transform:uppercase; margin:0px;">
																		<?php echo substr($books->bookSection, 0, 3); ?>.
																	</p>
																	<?php echo $books->callNumber; ?><br>
																	<?php echo $books->authorNumber; ?><br>
																	<?php echo $books->datePublished; ?><br>
																		<div style="margin-top: -60px; padding-right: 0px;">
																			<p style="text-transform:uppercase; margin:0px; font-weight: bold; margin-left: 100px;">
																				<?php echo $books->author; ?><br>
																			</p>
																			<p style="margin-left: 100px;">
																				<?php echo $books->bookTitle; ?>
																			</p>
																			<p style="margin-left: 100px;">
																				<?php echo $books->author; ?>
																				<?php echo $books->otherAuthor; ?><br>
																				<?php echo $books->bookDescription; ?>
																				Ⓒ<?php echo $books->datePublished; ?>
																			</p>
																			<p style="margin-left: 100px;">
																				<?php echo $books->includes; ?>.<br><br>
																				<?php echo $books->indexNumber; ?><br>
																				<?php echo $books->appendix; ?><br>
																				<?php echo $books->glossary; ?>	  <br>
																				<?php echo $books->bibliography;?><br>
																				ISBN <?php echo $books->isbn; ?><br>
																				<?php echo $books->subject;?>
																				<?php echo $books->otherSubject;?><br>I. Title.
																			</p>
																				<?php echo substr($books->bookAccession, 4, 255); ?><br>
																		</div>
																</td>
															</tr>
													<?php 
															
														}
												?>
											</tbody>
										</table>
									</div>
									<div class="cardbox">
										<table class="table table-bordered table-hover" id="articles" style="background-color:white; width:480px; height:192px">
											<thead>
												<tr class="noprint">
													<th style="background-color:#163269; text-align: center; height:50px; color:white; padding: -13px 0px 0px 0px; font-size:20px">Subject Card</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$books = DB:: getInstance()->get('books', array('id','=',$_GET['id']));							
													foreach($books->results() as $books){?>
															<tr style="font-family:Arial Narrow; font-size:10px">
																<td>
																	<!-- Subject Card -->
																	<p  style="text-transform:uppercase; margin:0px;">
																		<?php echo substr($books->bookSection, 0, 3); ?>.
																	</p>
																	<?php echo $books->callNumber; ?><br>
																	<?php echo $books->authorNumber; ?><br>
																	<?php echo $books->datePublished; ?><br>
																		<div style="margin-top: -60px; padding-right: 0px;">
																			<p style="text-transform:uppercase; margin:0px; font-weight: bold; margin-left: 100px;">
																				<?php echo substr($books->subject, 3, 255); ?><br>
																			</p>
																			<p style="margin-left: 100px;">
																				<?php echo $books->author; ?>
																			</p>
																			<p style="margin-left: 100px;">
																				<?php echo $books->author; ?>
																				<?php echo $books->otherAuthor; ?><br>
																				<?php echo $books->bookDescription; ?>
																				Ⓒ<?php echo $books->datePublished; ?>
																			</p>
																			<p style="margin-left: 100px;">
																				<?php echo $books->includes; ?>.<br><br>
																				<?php echo $books->subject;?>
																				<?php echo $books->otherSubject;?><br>I. Title.
																			</p>
																				<?php echo substr($books->bookAccession, 4, 255); ?><br>
																		</div>
																</td>
															</tr>
													<?php 
															
														}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<br><br>
                                    <div class="clearfix noprint"></div><hr class="noprint" />
                                    <div class="form-actions">
										<div class="row">
											<div class="col-md-6">
												<button type="button" class="btnupdate noprint" onclick="window.print();"> Print</button>	
											</div>
											<div class="col-md-6">
												<button type="button" class="btncancel noprint" onclick="window.location='admin.php?action=HighSchoolLostBooks'">Cancel</button>
											</div>
										</div>
										<br>
                                    </div>
                                </form>
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