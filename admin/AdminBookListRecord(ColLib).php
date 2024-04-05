<?php

if (Input::exists()) {
		
			$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'bookQRCodes'.DIRECTORY_SEPARATOR;
		
			$books = DB:: getInstance()->get('books', array('id','=',Input::get('discard')));							
			foreach($books->results() as $books){
				unlink($PNG_TEMP_DIR.$books->qrcode);
			}

			$books = DB:: getInstance()->get('books', array('id','=',Input::get('discard')));
			if ($books->count()){
			foreach($books->results() as $books){
				$book = new Books();
				 try {
					$book->update(array(
						'discarded' => 1,
					),$books->id);
				} catch(Exception $e) {
				   $error;
				}
			}

			Session::flash('Discarded', 'Library user has been successfully discarded.');
			Redirect::to('admin.php?action=CollegeBookList');	
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
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="buttonhover.css">
<link rel="stylesheet" type="text/css" href="css/filter-button.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>All Library Book Records</title>
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
							<a href="admin.php?action=AdminBookListRecord(ColLib)"><button type="button" class="btn-mb" style="background: #3db166; color:white">Book List</button></a> 
							<a href="admin.php?action=AdminCollegePeriodicalList"><button type="button" class="btn-mb" style="color:#3db166;">Periodical Books</button></a> 
							<a href="admin.php?action=AdminCollegeDiscardedBooks"><button type="button" class="btn-mb" style="color:#3db166;">Discarded Books</button></a> 
							<a href="admin.php?action=AdminLostBooks"><button type="button" class="btn-mb" style="color:#3db166;">Lost Books</button></a> 
						</ol>
                    </center>
                </section>
                <!-- Main content -->
                <section  class="col-lg-12 connectedSortable">
                        <div class="col-xs-12" style="padding: 0px 15px 10px 15px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
										<br>
										<center>
											<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
												<p style="font-size:35px; transform: scale(1, 2);">
													ALL LIBRARY BOOKS
												</p>
											</div>
										</center>
										<br>
										<div class="conpost">
											<div class="container">
												<div class="data">
													<div class="content">
														<?php 
														$books = DB:: getInstance()->query("SELECT * FROM books WHERE status='Available' && discarded='0' && libraryClass = 'College Library'");
														$countBooks =DB:: getInstance()->count($books);?>
															<div class="inner">
																<h3 style="font-size:30px; font-weight:bolder">
																	<?php echo $countBooks; ?>
																</h3>
																<p style="font-size:13px">
																Total Books
																</p>
															</div>
													</div>
												</div>
												<div class="data">
													<div class="content">
														<?php 
														$booksBorrowed = DB:: getInstance()->query("SELECT * FROM books WHERE is_borrowed=1 && status='Available' && discarded='0' && libraryClass = 'College Library'");
														$countBookB =DB:: getInstance()->count($booksBorrowed);?>
															<div class="inner">
																<h3 style="font-size:30px; font-weight:bolder">
																	<?php echo $countBookB; ?>
																</h3>
																<p style="font-size:13px">
																	Books Borrowed
																</p>
															</div>
													</div>
												</div>
												<div class="data">
													<div class="content">
														<?php 
														$booksAvailable = DB:: getInstance()->query("SELECT * FROM books WHERE is_borrowed=0 && status='Available' && discarded='0' && libraryClass = 'College Library'");
														$countBookA =DB:: getInstance()->count($booksAvailable);?>
															<div class="inner">
																<h3 style="font-size:30px; font-weight:bolder">
																	<?php echo $countBookA; ?>
																</h3>
																<p style="font-size:13px">
																	Books Available
																</p>
															</div>
													</div>
												</div>
											</div>
										</div>
										<br><br><br>
										<hr style="border-top:1px dotted #000;"/>	
										<form class="form-inline" method="POST" action="" style="margin-left: 20px">
											<center>
												<div class="wrap-filter" class="noprint">
													<div class="filter-input-group"> 
														<label class="filter-input-label">LIBRARY</label>
														<select class="filter-input-box" for="libraryClass" name="libraryClass" id="libraryClass">
															<option value="<?php echo isset($_POST['libraryClass']) ? $_POST['libraryClass'] : '' ?>" > <?php echo isset($_POST['libraryClass']) ? $_POST['libraryClass'] : '' ?></option>
															<option value="College Library">College Library</option>
															<option value="High School Library">High School Library</option>
															<option value="Grade School Library">Grade School Library</option>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">STATUS</label>
														<select class="filter-input-box" for="status" name="status" id="status">
															<option value="<?php echo isset($_POST['status']) ? $_POST['status'] : '' ?>" > <?php echo isset($_POST['status']) ? $_POST['status'] : '' ?></option>
															<option value="None">None</option>
															<option value="Available">Available</option>
															<option value="Not Available">Not Available</option>
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
													<a class="filtersbtn" href="admin.php?action=AdminBookListRecord(ColLib)"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
													<button class="filtersbtn" onclick="window.print();"><i class="fa fa-print"></i></button>
												</div>
											</center>
										</form>
										<br>
                                <div class="table-responsive">
                                    <?php if(Session::exists('Existed')){ ?>
                                             <div class="alert alert-danger">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Existed'); ?>
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
								<form action="AdminBookListRecord(ColLib)_chkboxcode.php" method="POST">
                                    <table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th style="width:5%"  class="noprint">
													<!-- UPDATE YEAR LEVEL -->
													<center>
														<button type="button" class="btn7" data-toggle="modal" data-target="#updatemultiModal"><i class="glyphicon glyphicon-remove"></i></button>	
													</center>
													
														<div class="modal fade" id="updatemultiModal" tabindex="-1" role="dialog" aria-labelledby="updatemultiModalLabel" aria-hidden="true" style="padding: 0px 200px 0px 200px">
															<div class="modal-dialog modal-lg" role="document">
																<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<center>
																			<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
																				<p style="font-size:30px; transform: scale(.7, 1);">
																					Confirm Removal
																				</p>
																			</div>
																		</center>
																	</div>
																	<div class="modal-body">
																		<center>
																			<p  style="font-size:30px"> Are you sure you want to remove? </p>
																		</center>
																		<div class="modal-footer">
																			<div class="row">
																				<div class="col-md-6">
																					<button type="submit" name="stud_update_multiple_btn" class="btnupdate" style="color: #fff" value="Upload">Remove</button>
																				</div>
																				<div class="col-md-6">
																					<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
																				</div>
																				</div>
																			</div>
																	</div>
																</div>
															</div>
														</div>

														<!-- DELETE MULTIPLE -->
												</th>
												<th>Library</th>
												<th>Accession No.</th>
												<th>Call No.</th>
												<th>ISBN</th>
												<th>Book Section</th>
												<th>Title</th>
                                                <th>Author</th>
												<th>Publisher</th>
												<th>Copyright Year</th>
												<th>Status</th>
												<th class="noprint" style="width:20%">Actions</th>
                                            </tr>
                                            </tr>
                                        </thead>
										<tbody>
												<?php include 'FilterAdminBookListRecord(ColLib).php'?>	
										</tbody>
                                    </table>
								</form>
                                </div><!-- /.box-body -->
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
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(function() {
        $("#articles").dataTable();
    });

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
