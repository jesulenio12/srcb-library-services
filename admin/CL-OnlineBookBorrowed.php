<?php
if (Input::exists()) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'bookQRCodes'.DIRECTORY_SEPARATOR;
		
		$books = DB:: getInstance()->get('books', array('bookAccession','=',Input::get('bookAccession')));							
		foreach($books->results() as $books){
			unlink($PNG_TEMP_DIR.$books->qrcode);
		}
		
		$books = DB:: getInstance()->get('books', array('bookAccession','=',Input::get('bookAccession')));
		if ($books->count()){
			foreach($books->results() as $books){
				$book = new Books();
				 try {
					$book->update(array(
						'received' => 1,
						'approved' => 0,
						'dateBorrowed' => date('Y-m-d'),
					),$books->id);
				} catch(Exception $e) {
				   $error;
				}
			}

			$booktransaction = new BookTransactions();
            try {
                $booktransaction->create(array(
					'received' => 1,
					'transactionType'  => 'borrow',
					'transactionDate' => date('Y-m-d'),
					'transactionPlace' => 'Col-Lib',
					'bookAccession' => Input::get('bookAccession'),
					'callNumber' => Input::get('callNumber'),
					'bookSection' => Input::get('bookSection'),
					'bookTitle' => Input::get('bookTitle'),
					'author' => Input::get('author'),
					'publisher' => Input::get('publisher'),
					'datePublished' => Input::get('datePublished'),
					'library_userID' => Input::get('library_userID'),
					'userType' => Input::get('userType'),
					'fullname' => Input::get('firstname').' '.Input::get('lastname'),
					'gender' => Input::get('gender'),
					'yearLevel' => Input::get('yearLevel'),
					'classSection' => Input::get('classSection'),
					'progtrack' => Input::get('progtrack'),
					'departmentType' => Input::get('departmentType'),
					'dateRequested' => Input::get('dateRequested'),
					'pickupTime' => Input::get('pickupTime'),
					'pickupDate' => Input::get('pickupDate'),
					'finesperDueDate'  => '2',
					'libraryClass' => Input::get('libraryClass'),
                ));
				
			
			Session::flash('Received', 'Book has been succesfully received.');
			Redirect::to('admin.php?action=CL-OnlineBookBorrowed');
			} catch(Exception $e) {
			$error;
			}

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
<!-- bootstrap wysihtml5 - text editor -->
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="buttonhover.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>HED Online Book Borrowed</title>
</head>
<style>
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
</style>
<body class="skin-blue" class="skin-blue" class="skin-blue" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="background-color:transparent">
				<section class="content-header" style="background-color:transparent">
                  <br>
                    <center>
						<ol class="breadcrumb" style="background-color: rgba(255, 255, 255, 0.239); border-radius:30px; margin-top:-5px;">
							<li><a href="admin.php" style="color:white"><i class="glyphicon glyphicon-th-list"></i> Go to</a></li>
							<a href="admin.php?action=CL-OnlineBookRequested"><button type="button" class="btn" style="color: #3db166;">Book Requested</button></a> 
							<a href="admin.php?action=CL-OnlineBookBorrowed"><button type="button" class="btn" style="background: #3db166; color:white">Book Borrowed</button></a>
							<a href="admin.php?action=CL-OnlineBookReturned"><button type="button" class="btn" style="color: #3db166;">Book Returned</button></a>  
						</ol>
                    </center>
                </section>
                <!-- Main content -->
                <section style="background-color:transparent">
                <div class="col-xs-12" style="padding: 0px 30px 10px 30px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
								<br>
									<center>
										<div class="small-box bg">
											<p> ONLINE BOOK BORROWED </p>
										</div>
									</center>
								<br>
								<hr style="border-top:1px dotted #000;"/>	
                                <div class="box-body table-responsive">
									<?php if(Session::exists('Returned')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Returned'); ?>
                                             </div>
                                    <?php }?>
                                    <?php if(Session::exists('Deleted')){ ?>
                                             <div class="alert alert-danger" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Deleted'); ?>
                                             </div>
                                    <?php }?> 
                                    
                                    <table class="table table-bordered table-hover" id="books">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Accession No.</th>
												<th>Title</th>
												<th>Book Section</th>
												<th>Name</th>
												<th>Loaner</th>
												<th>Gender</th>
												<th>Year Level</th>
												<th>Course</th>
												<th>Department</th>
												<th>Date Approved</th>
												<th>Pickup Time</th>
												<th style="width:10%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$interval2 = 0;
												$dueDate = 0;
												$totalfines = 0;
												$dueDate = 0;
												$books = DB:: getInstance()->query("SELECT * FROM books WHERE approved = '1' && received = '0' && libraryClass = 'College Library'");
												foreach($books->results() as $books){ ?>
														<tr>
															<td>#</td>
															<td><?php echo $books->bookAccession ; ?></td>
															<td><?php echo $books->bookTitle ; ?></td>
															<td><?php echo $books->bookSection ; ?></td>
															<td>
																<?php echo $books->firstname ; ?>
																<?php echo $books->lastname ; ?>
															</td>
															<td>
																<?php
																	if($books->userType == 5){
																		echo 'Student';
																	}else{
																		echo 'Teacher';
																	}
																?>
															</td>
															<td><?php echo $books->gender ; ?></td>
															<td><?php echo $books->yearLevel ; ?></td>
															<td><?php echo $books->progtrack ; ?></td>
															<td>
																<?php
																	if($books->departmentType == 'Higher Education Department'){
																		echo 'HED';
																	}else{
																		echo 'SHS';
																	}
																?>
															</td>
															<td><?php echo date('Y-m-d', strtotime($books->pickupDate ));?></td>
															<td><?php echo $books->pickupTime ; ?></td>
															<td align="center">
																<!-- Modal -->
																<form method="POST" action="" style="display:inline">
																	<input type="hidden" name="libraryClass" value="<?php echo $books->libraryClass;  ?>">
																	<input type="hidden" name="transactionPlace" value="<?php echo $books->transactionPlace;  ?>">
																	<input type="hidden" name="bookAccession" value="<?php echo $books->bookAccession;  ?>">
																  	<input type="hidden" name="callNumber" value="<?php echo $books->callNumber;  ?>">
																	<input type="hidden" name="bookSection" value="<?php echo $books->bookSection;  ?>">
																	<input type="hidden" name="bookTitle" value="<?php echo $books->bookTitle;  ?>">
																	<input type="hidden" name="author" value="<?php echo $books->author;  ?>">
																	<input type="hidden" name="publisher" value="<?php echo $books->publisher;  ?>">
																	<input type="hidden" name="datePublished" value="<?php echo $books->datePublished;  ?>">
																	<input type="hidden" class="form-control" id="library_userID" name="library_userID" value="<?php echo $books->library_userID;  ?>">
																	<input type="hidden" class="form-control" id="firstname" name="firstname" value="<?php echo $books->firstname;  ?>">
																	<input type="hidden" class="form-control" id="lastname" name="lastname" value="<?php echo $books->lastname;  ?>">
																	<input type="hidden" class="form-control" id="gender" name="gender" value="<?php echo $books->gender;  ?>">
																	<input type="hidden" class="form-control" id="yearLevel" name="yearLevel" value="<?php echo $books->yearLevel;  ?>">
																	<input type="hidden" class="form-control" id="classSection" name="classSection" value="<?php echo $books->classSection;  ?>">
																	<input type="hidden" class="form-control" id="progtrack" name="progtrack" value="<?php echo $books->progtrack;  ?>">
																	<input type="hidden" class="form-control" id="userType" name="userType" value="<?php echo $books->userType;  ?>">
																	<input type="hidden" class="form-control" id="departmentType" name="departmentType" value="<?php echo $books->departmentType;  ?>">
																	<input type="hidden" class="form-control" id="dateRequested" name="dateRequested" value="<?php echo $books->dateRequested;  ?>">
																	<input type="hidden" class="form-control" id="pickupTime" name="pickupTime" value="<?php echo $books->pickupTime;  ?>">
																	<input type="hidden" class="form-control" id="pickupDate" name="pickupDate" value="<?php echo $books->pickupDate;  ?>">
																	<input type="hidden" name="return" value="<?php echo $books->id;  ?>">
																	<button class="btn6" type="button" data-toggle="modal" data-target="#confirmReceived" data-title="Confirm Received" data-message="Are you sure you want to confirm received?">
																		<i class="fa fa-inbox"></i>
																	</button>
																</form>
																<?php require_once ('delete-confirm.php');?>
																<form method="POST" action="" style="display:inline">
																	<input type="hidden" name="delete" value="<?php echo $books->id;  ?>">
																	<button class="btn6" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Confirm Deletion" data-message="Are you sure you want to delete this?">
																		<i class="glyphicon glyphicon-trash"></i>
																	</button>
																</form>
															</td>
														</tr>
														
															<!-- Modal -->

															<div class="modal fade" id="confirmReceived" tabindex="-1" role="dialog" aria-labelledby="confirmRestoreLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
																	<div class="modal-header">
																		<center>
																		<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
																			<p style="font-size:30px; transform: scale(.7, 1);">
																			Confirm Receive
																			</p>
																		</div>
																		</center>
																	</div>
																	<div class="modal-body" >
																		<p style="font-size:30px; text-align:center"> Are you sure you want to confirm received? </p>
																	</div>
																	<div class="modal-footer">
																		<div class="row">
																		<div class=" col-md-6">
																			<button type="button" class="btnupdate" id="confirm">Received</button>
																		</div>
																		<div class=" col-md-6">
																			<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
																		</div>
																		</div>
																	</div>
																	</div>
																</div>
															</div>

															<div class="modal fade" id="confirmRestore" tabindex="-1" role="dialog" aria-labelledby="confirmRestoreLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
																	<div class="modal-header">
																		<center>
																		<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
																			<p style="font-size:30px; transform: scale(.7, 1);">
																			Confirm Return
																			</p>
																		</div>
																		</center>
																	</div>
																	<div class="modal-body" >
																		<p style="font-size:30px; text-align:center"> Are you sure you want to return this? </p>
																	</div>
																	<div class="modal-footer">
																		<div class="row">
																		<div class=" col-md-6">
																			<button type="button" class="btnupdate" id="confirm">Return</button>
																		</div>
																		<div class=" col-md-6">
																			<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
																		</div>
																		</div>
																	</div>
																	</div>
																</div>
															</div>

												<!-- end forloop -->
												<?php 
												}
												?>
                                        </tbody>
                                    </table>
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
<!-- Bootstrap WYSIHTML5 -->
<script src="styles/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
    $(function() {
        $("#staff").dataTable();
    });
    $(function() {
        $("#books").dataTable();
    });
    $(function() {
        $("#lib-users").dataTable();
    });
	setTimeout(function(){
		document.getElementById("alert").style.display = "none";
	}, 5000);
</script>
<script type="text/javascript">
  $('#confirmDelete').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
  
  $('#confirmRestore').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmRestore').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });

  $('#confirmReceived').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmReceived').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>
</body>

</html>
