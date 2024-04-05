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
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>QRBASEDLMS - Book List Record </title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}
</style>

<style type="text/css" media="print">
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

<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
				<section class="content-header">
                    <h1> Select Library Options </h1>
					<ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Select Library Options </li>
                    </ol>
					<br>
					<div class="row">
						<div class="col-lg-4 col-xs-15">
							<!-- small box -->
							<div class="small-box bg-blue" style="height: 130px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 10px; border: 3px solid lightgrey; cursor: pointer;" >
								<div class="inner">
									<h3 style="margin: 30px; font-family:Showcard Gothic; font-size: 30px;"><a style="color:white;" href="admin.php?action=AdminBookListRecord(ColLib)">
										College Library
									</h3></a>
								</div>
								<div class="icon">
									<a href="admin.php?action=AdminBookListRecord(ColLib)"><i style="color: rgba(39, 36, 36, 0.479);" class="fa fa-book"></i></a>
								</div>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-4 col-xs-15">
							<!-- small box -->
							<div class="small-box bg-blue" style="height: 130px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 10px; border: 3px solid lightgrey; cursor: pointer;" >
								<div class="inner">
									<h3 style="margin: 30px; font-family:Showcard Gothic; font-size: 30px;"><a style="color:white;" href="admin.php?action=AdminBookListRecord(HsLib)">
										High School Library
										
									</h3></a>
								</div>
								<div class="icon">
									<a href="admin.php?action=AdminBookListRecord(HsLib)"><i style="color: rgba(39, 36, 36, 0.479);" class="fa fa-book"></i></a>
								</div>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-4 col-xs-15">
							<!-- small box -->
							<div class="small-box bg-blue" style="height: 130px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 10px; border: 3px solid lightgrey; cursor: pointer;" >
								<div class="inner">
									<h3 style="margin: 30px; font-family:Showcard Gothic; font-size: 30px;"><a style="color:white;" href="admin.php?action=AdminBookListRecord(ElLib)">
										Grade School Library
									</h3></a>
								</div>
								<div class="icon">
									<a href="admin.php?action=AdminBookListRecord(ElLib)"><i style="color: rgba(39, 36, 36, 0.479);" class="fa fa-book"></i></a>
								</div>
							</div>
						</div><!-- ./col -->
        			</div><!-- /.row -->
                </section>

				
                <!-- Main content -->
                <section class="content">
                        <div class="col-xs-12">
                            <div class="box box-primary">
								<div class="box-header" style="box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418);">
									<h4 class="box-title" style="padding-left:40%; padding-right:40%; font-family:Cooper Black; font-size: 30px; color:white; background: #428bca; width: 100%;">
										Grade School Books
									</h4>
                                </div><!-- /.box-header -->
								<br>
									<div align="center">
										<center>
											<form class="form-inline" method="POST" action="" style="margin-left: 20px">
											<label class="noprint" style="background: #00e5ed; font-weight:bold; padding:7px 10px; border-radius:5px 0px 0px 5px">BOOKS SECTION</label>
													<select style="width:100% auto;"  class="form-control noprint" for="bookSection" name="bookSection" id="bookSection">
														<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
														<option value="Accounting">Accounting</option>
														<option value="Bussiness Administration">Bussiness Administration</option>
														<option value="Circulation">Circulation</option>
														<option value="Criminology">Criminology</option>
														<option value="Dictionaries">Dictionaries</option>
														<option value="Education">Education</option>
														<option value="Fiction">Fiction</option>
														<option value="Fiction">Filipiniana</option>	
														<option value="Foreign References">Foreign References</option>
														<option value="General References">General References</option>
														<option value="General Education">General Education</option>
														<option value="Hotel Management">Hotel Management</option>
														<option value="Hotel & Restaurant">Hotel & Restaurant</option>
														<option value="Information Technology">Information Technology</option>
														<option value="Professional Readings">Professional Readings</option>
														<option value="Reviewers">Reviewers</option>
														<option value="Senior High School">Senior High School</option>
													</select> 
													<button class="btn btn-primary noprint" name="search"><span class="glyphicon glyphicon-filter"></span> </button>
													<a href="admin.php?action=AdminBookListRecord(ColLib)" type="button" class="btn btn-primary noprint"><span class = "glyphicon glyphicon-refresh"><span> </a>
													<button type="button" style="margin-right: 3px" class="btn btn-primary noprint" onclick="window.print();"><span class = "glyphicon glyphicon-print"><span> </button>  
											</form>
										</center>
									</div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <?php if(Session::exists('Removed')){ ?>
                                             <div class="alert alert-danger">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Removed'); ?>
                                             </div>
                                    <?php }?> 
									<?php if(Session::exists('Discarded')){ ?>
                                             <div class="alert alert-success">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Discarded'); ?>
                                             </div>
                                    <?php }?> 
                                    <?php if(Session::exists('Updated')){ ?>
                                             <div class="alert alert-success">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Updated'); ?>
                                             </div>
                                    <?php }?>
									<?php if(Session::exists('Added')) { ?>
										<div class="alert alert-success">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Added'); ?>
										</div>
									<?php }?>
									
                                    <table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
												<th>Accession No.</th>
												<th>Call No.</th>
												<th>ISBN</th>
												<th>Book Section</th>
												<th>Title</th>
                                                <th>Author</th>
												<th>Publisher</th>
												<th>Copyright Date</th>
												<th>Status</th>
												<th class="noprint">Actions</th>
                                            </tr>
                                            </tr>
                                        </thead>
										<tbody>
												<?php include 'FilterAdminBookListRecord(ElLib).php'?>	
										</tbody>
                                    </table>
                                </div><!-- /.box-body -->
								<div class="box-footer">
									<!-- Modal -->
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title" id="exampleModalLabel">Add New Book</h3>
										</div>
										<div class="modal-body">
											<form enctype="multipart/form-data" method="post" action="CollegeAddBook.php">
												<div class="row">
													<div class="col-lg-6 col-md-3">
														<label class="control-label" for="bookTitle"><font color="#EC0003">*</font> Book Title</label>
														<div class="form-group">
															<input type="text" class="form-control" id="bookTitle" name="bookTitle" placeholder="Input Title of the Book">
														</div>
													</div>
													<div class="col-lg-6 col-md-3">
														<label class="control-label" for="bookAccession"><font color="#EC0003">*</font> Book Accession Number</label>
														<div class="form-group">
															<input type="text" class="form-control" id="bookAccession" name="bookAccession" placeholder="Input Accession Number">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6 col-md-3">
														<label class="control-label" for="isbn"><font color="#EC0003">*</font> International Standard Book Number</label>
														<div class="form-group">
															<input type="text" class="form-control" id="isbn" name="isbn" placeholder="Input ISBN">
														</div>
													</div>
													<div class="col-lg-6 col-md-3">
														<label class="control-label" for="callNumber"><font color="#EC0003">*</font> Book Call Number</label>
														<div class="form-group">
															<input type="text" class="form-control" id="callNumber" name="callNumber" placeholder="Input Call Number">
														</div>
													</div>
												</div>
												<label class="control-label" for="bookDescription"><font color="#EC0003">*</font> Book Description</label>
													<div class="form-group">
														<textarea cols="30" rows="5" type="text" class="form-control" id="bookDescription" name="bookDescription" placeholder="Input Book Description..."></textarea>
													</div>

												<div class="row">
													<div class="col-lg-6 col-md-3">
														<label class="control-label" for="subject"><font color="#EC0003">*</font> Book Subject</label>
														<div class="form-group">
															<input style="margin-bottom:5px" type="text" class="form-control" id="subject" name="subject" placeholder="1. [Input Book Subject]">
															<textarea rows="2" type="text" class="form-control" for="otherSubject" id="otherSubject" name="otherSubject" placeholder="(eg. 2. Organizational Behavior - Philippines and soon...)"></textarea>
														</div>
													</div>
													<div class="col-lg-6 col-md-3">
														<label class="control-label" for="author"><font color="#EC0003">*</font> Author Name</label>
														<div class="form-group">
															<input style="margin-bottom:5px" type="text" class="form-control" id="author" name="author" placeholder="1. [Input Author Name]">
															<textarea rows="2" type="text" class="form-control" for="otherAuthor" id="otherAuthor" name="otherAuthor" placeholder="(eg. Arlyn Macas/ and soon...)"></textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6 col-md-2">
														<label class="control-label" for="publisher"><font color="#EC0003">*</font>Et. Al</label>
														<div class="form-group">
															<select class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" class="form-control" name="bookSection" id="bookSection" placeholder="Input [Et. Al]"> 
																<option value=" ">  </option>
																<option value="[Et. Al]">[Et. Al]</option>
															</select> 
														</div>
													</div>
													<div class="col-lg-6 col-md-2">
														<label class="control-label" for="authorNumber"><font color="#EC0003">*</font> Author No.</label>
														<div class="form-group">
															<input type="text" class="form-control" id="authorNumber" name="authorNumber" placeholder="Input Author Number">
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-lg-4 col-md-2">
														<label class="control-label" for="glossary"><font color="#EC0003">*</font> Glossary Page</label>
														<div class="form-group">
															<input type="text" class="form-control" id="glossary" name="glossary" placeholder="Input Glossary Page">
														</div>
													</div>
													<div class="col-lg-4 col-md-2">
														<label class="control-label" for="bibliography"><font color="#EC0003">*</font> Bibliography Page</label>
														<div class="form-group">
															<input type="text" class="form-control" id="bibliography" name="bibliography" placeholder="Input Bibliography Page">
														</div>
													</div>
													<div class="col-lg-4 col-md-2">
														<label class="control-label" for="appendix"><font color="#EC0003">*</font> Appendix Page</label>
														<div class="form-group">
															<input type="text" class="form-control" id="appendix" name="appendix" placeholder="Input Appendix Page">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4 col-md-2">
														<label class="control-label" for="indexNumber"><font color="#EC0003">*</font> Index Page</label>
														<div class="form-group">
															<input type="text" class="form-control" id="indexNumber" name="indexNumber" placeholder="Input Index Page">
														</div>
													</div>
													<div class="col-lg-4 col-md-2">
														<label class="control-label" for="includes"><font color="#EC0003">*</font> Includes</label>
														<div class="form-group">
															<input type="text" class="form-control" id="includes" name="includes" placeholder="Input Includes">
														</div>
													</div>
													<div class="col-lg-4 col-md-2">
														<label class="control-label" for="bookLibraries"><font color="#EC0003">*</font>Book Libraries</label>
														<div class="form-group">
															<select class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" class="form-control" name="bookLibraries" id="bookLibraries"> 
																<option value="Select Book Libraries"> Select Book Libraries</option>
																<option value="HED">HED</option>
																<option value="SHS">SHS</option>
																<option value="JHS">JHS</option>
																<option value="ELEM">ELEM</option>
															</select> 
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6 col-md-2">
														<label class="control-label" for="publisher"><font color="#EC0003">*</font> Publisher</label>
														<div class="form-group">
															<input type="text" class="form-control" id="publisher" name="publisher" placeholder="Input Publisher">
														</div>
													</div>
													<div class="col-lg-6 col-md-2">
														<label class="control-label" for="datePublished"><font color="#EC0003">*</font> Copyright Date</label>
														<div class="form-group">
															<input type="text" class="form-control" id="datePublished" name="datePublished" placeholder="Input Copyright Date">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12 col-md-3">
														<label class="control-label" for="bookSection"><font color="#EC0003">*</font>Book Sections</label>
														<div class="form-group">
															<select class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" class="form-control" name="bookSection" id="bookSection"> 
																<option value="Select Book Section"> Select Book Section</option>
																<option value="Accounting">Accounting</option>
																<option value="Bussiness Administration">Bussiness Administration</option>
																<option value="Circulation">Circulation</option>
																<option value="Criminology">Criminology</option>
																<option value="Dictionaries">Dictionaries</option>
																<option value="Education">Education</option>
																<option value="Fiction">Fiction</option>
																<option value="Fiction">Filipiniana</option>	
																<option value="Foreign References">Foreign References</option>
																<option value="General References">General References</option>
																<option value="General Education">General Education</option>
																<option value="Hotel Management">Hotel Management</option>
																<option value="Hotel & Restaurant">Hotel & Restaurant</option>
																<option value="Information Technology">Information Technology</option>
																<option value="Professional Readings">Professional Readings</option>
																<option value="Reviewers">Reviewers</option>
																<option value="Senior High School">Senior High School</option>
															</select> 
														</div>
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-lg btn-success" value="save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
											<button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancel</button>
											</form>
										</div>
										</div>
									</div>
									</div>
                                </div>
								<div class="box-footer">
									<!-- Modal -->
									<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
										<div class="modal-header">
											
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title" id="importModalLabel">Upload CSV File |	<button type="submit" style="background: #214ec7; border-radius: 10px" class="btn btn-primary"> <a style="color:white; cursor: pointer;" href="bookTemplate.php"> Download CSV Template <i class="fas fa-file-download"></i></button></a></h3>
										</div>
										<div class="modal-body">
											<form enctype="multipart/form-data" method="post" action="CollegeBookBulkUpload.php">
												<div class="row">
													<div class="col-lg-12 col-md-3">
														<div class="form-group">
															<input type="file" class="form-control" name="bookscsv_file" required >
														</div>
													</div>
												</div>
										<div class="modal-footer">
											<button type="submit" name="upload" class="btn btn-lg btn-success" value="Upload"><i class="glyphicon glyphicon-floppy-disk"></i> Upload</button>
											<button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancel</button>
											</form>
										</div>
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
<!-- <script src="bookfilter.js"></script> -->
<script type="text/javascript">
	// window.onload = () => {
    //         console.log(document.querySelector("#articles > tbody > tr:nth-child(1) > td:nth-child(2) ").innerHTML);
    //     };

    //     getUniqueValuesFromColumn()

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
  $('#confirmRemove').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmRemove').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });

  $('#confirmDiscard').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDiscard').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>
</body>

</html>
