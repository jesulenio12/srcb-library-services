<?php
if (Input::exists()) {
			$book = new Books();
			
            try {
                $book->update(array(
					'isbn' => Input::get('isbn'),
					'callNumber' => Input::get('callNumber'),
					'bookTitle' => Input::get('bookTitle'),
					'author' => Input::get('author'),
					'publisher' => Input::get('publisher'),
					'datePublished' => Input::get('datePublished'),
					'bookSection' => Input::get('bookSection'),
                ), $_GET['id']);
			
			Session::flash('Updated', 'Book Info has been successfully updated.');
			Redirect::to('admin.php?action=hotelmanageListBook');
            } catch(Exception $e) {
                $error;
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
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>SRCB</title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}
</style>

<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Book Information
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Edit Book Information</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Book - <small><font color="#EC0003">*</font> required fields</small></h3>    
                                <div class="pull-right box-tools">
                                </div><!-- /. tools -->                                
                            </div><!-- /.box-header -->
                            <div class="box-body">
								<?php if(Session::exists('bookUpdated')){ ?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('bookUpdated'); ?>
                                    </div>
								<?php }?>
                                <?php 
									$books = DB:: getInstance()->get('books', array('id','=',$_GET['id']));							
									foreach($books->results() as $books){
									?>
								<form id="editUser" action="" method="post">
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<label class="control-label" for="isbn"><font color="#EC0003">*</font> Book Accession </label>
											<div class="form-group">
												<div class="row">
													<div class="col-lg-8 col-md-8">
														<input type="text" class="form-control" id="bookAccession" name="bookAccession" value="<?php echo $books->bookAccession; ?>" disabled>
													</div>
													<div class="col-lg-4 col-md-4">
														<button type="button" class="btn btn-success" data-toggle="modal" data-target="#editBookTitle">
															Edit  Book Accession
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<label class="control-label" for="bookTitle"><font color="#EC0003">*</font> Book Title</label>
											<div class="form-group">
												<input type="text" class="form-control" id="bookTitle" name="bookTitle" value="<?php echo $books->bookTitle; ?>" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="isbn"><font color="#EC0003">*</font> International Standard Book Number</label>
											<div class="form-group">
												<input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $books->isbn; ?>" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="callNumber"><font color="#EC0003">*</font> Book Call Number</label>
											<div class="form-group">
												<input type="text" class="form-control" id="callNumber" name="callNumber" value="<?php echo $books->callNumber; ?>" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="author"><font color="#EC0003">*</font> Author</label>
											<div class="form-group">
												<input type="text" class="form-control" id="author" name="author" value="<?php echo $books->author; ?>" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="publisher"><font color="#EC0003">*</font> Publisher</label>
											<div class="form-group">
												<input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $books->publisher; ?>" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<label class="control-label" for="datePublished"><font color="#EC0003">*</font> Date of the Publication</label>
											<div class="form-group">
												<input type="text" class="form-control" id="datePublished" name="datePublished" value="<?php echo $books->datePublished; ?>" data-provide="datepicker" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<label class="control-label" for="bookSection"><font color="#EC0003">*</font>Book Sections</label>
											<div class="form-group">
												<select class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" class="form-control" name="bookSection" id="bookSection" required>
													<option value="Hotel Management">Hotel Management</option>	
													<option value="Accounting">Accounting</option>
													<option value="Bussiness Administration">Bussiness Administration</option>
													<option value="Bound Periodicals">Bound Periodicals</option>
													<option value="Circulation">Circulation</option>
													<option value="Criminology">Criminology</option>
													<option value="Dictionaries">Dictionaries</option>
													<option value="Education">Education</option>
													<option value="Fiction">Fiction</option>
													<option value="Foreign References">Foreign References</option>
													<option value="General References">General References</option>
													<option value="General Education">General Education</option>
													<option value="Hotel & Restaurant">Hotel & Restaurant</option>
													<option value="Information Technology">Information Technology</option>
													<option value="Professional Readings">Professional Readings</option>
													<option value="Reviewers">Reviewers</option>
													<option value="Senior High School">Senior High School</option>
											    </select> 
											</div>
										</div>
									</div>
                                    <div class="clearfix"></div><hr />
                                    <div class="form-actions">
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-edit fa-fw"></i>&nbsp;Save Edits
                                        </button>
                                        <button type="button" class="btn btn" onclick="window.location='admin.php?action=hotelmanageListBook'">Cancel</button>
                                    </div>
                                    <br />
                                </form>
								<!-- Modal -->
													<div class="modal fade" id="editBookTitle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h3 class="modal-title" id="exampleModalLabel">Edit Book bookAccession</h3>
														</div>
														<div class="modal-body">
															<form enctype="multipart/form-data" method="post" action="hotelmanage_editBookQR.php">
																<label class="control-label" for="newbookAccession"><font color="#EC0003">*</font>Book Accession</label>
																<div class="form-group">
																	<input type="text" class="form-control" id="newbookAccession" name="newbookAccession" value="<?php echo $books->bookAccession; ?>">													
																</div>
																<input type="hidden" name="newID" value="<?php echo $books->id; ?>">
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-success" value="save"><i class="glyphicon glyphicon-edit"></i> Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
															</form>
														</div>
														</div>
													</div>
													</div>
								<?php }?>                 
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