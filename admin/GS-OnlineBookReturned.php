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
						'is_borrowed' => 0,
						'received' => 0,
						'pickupTime' => '',
						'pickupDate' => '',
						'dateRequested' => '',
						'dateBorrowed' => '',
						'library_userID' => '',
						'userType' => '',
						'firstname' => '',
						'lastname' => '',
						'gender' => '',
						'yearLevel' => '',
						'classSection' => '',
						'departmentType' => '',
						'progtrack' => '',
						'transactionPlace' => '',
						'status' => 'Available',
					),$books->id);
				} catch(Exception $e) {
				   $error;
				}
			}

			$booktransaction = new BookTransactions();
            try {
                $booktransaction->create(array(
					'transactionType'  => 'return',
					'transactionDate' => date('Y-m-d'),
					'transactionPlace' => Input::get('transactionPlace'),
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
					'departmentType' => Input::get('departmentType'),
					'progtrack' => Input::get('progtrack'),
					'totalFines' => Input::get('totalFines'),
					'interval2' => Input::get('interval2').' '.'Day(s)',
					'dueDate' => Input::get('dueDate'),
					'libraryClass' => Input::get('libraryClass'),
					'dateRequested' => Input::get('dateRequested'),
					'dateBorrowed' => Input::get('dateBorrowed'),
					'pickupTime' => Input::get('pickupTime'),
					'pickupDate' => Input::get('pickupDate'),
					'remarks' => Input::get('remarks'),
                ));
				
			
			Session::flash('Returned', 'Book has been returned.');
			Redirect::to('admin.php?action=GS-OnlineBookReturned');
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
<title>GS Online Book Returned</title>
</head>
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
							<a href="admin.php?action=GS-OnlineBookRequested"><button type="button" class="btn" style="color: #3db166;">Book Requested</button></a> 
							<a href="admin.php?action=GS-OnlineBookBorrowed"><button type="button" class="btn" style="color: #3db166;">Book Borrowed</button></a>
							<a href="admin.php?action=GS-OnlineBookReturned"><button type="button" class="btn" style="background: #3db166; color:white">Book Returned</button></a>  
						</ol>
                    </center>
                </section>
                <!-- Main content -->
                <section style="background-color:transparent">
                <div class="col-xs-12" style="padding: 0px 30px 10px 30px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
								<br>
									<center>
										<div class="small-box bg" style="background-image: url(images/background.jpg); color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
											<p style="font-size:35px; transform: scale(1, 2);">
												ONLINE BOOK RETURNED
											</p>
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
												<th>Date Borrowed</th>
												<th>Due Date</th>
												<th>Lapses</th>
                                                <th>Fines</th>
												<th>Remarks</th>
												<th style="width:10%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$interval2 = 0;
												$dueDate = 0;
												$totalfines = 0;
												$dueDate = 0;
												$books = DB:: getInstance()->query("SELECT * FROM books WHERE received = '1' && libraryClass = 'Grade School Library'");
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
																	if($books->departmentType == 'Grade School Department'){
																		echo 'GS';
																	}else{
																		echo 'JHS';
																	}
																?>
															</td>
															<td><?php echo date('Y-m-d', strtotime($books->dateBorrowed ));?></td>
															<td>
																<?php
																	if($books->bookSection != 'Fiction'){
																		$date = date_create($books->dateBorrowed);
																		date_add($date,date_interval_create_from_date_string("3 days"));
																		echo date_format($date,"Y-m-d");
																		$duedate =  date_format($date,"Y-m-d");
																	}else if($books->bookSection == 'Fiction'){
																		$date = date_create($books->dateBorrowed);
																		date_add($date,date_interval_create_from_date_string("7 days"));
																		echo date_format($date,"Y-m-d");
																		$duedate =  date_format($date,"Y-m-d");
																	}
																?>
															</td>
															<td>
																<?php
																	// Due Date
																	if($books->bookSection == 'Fiction'){
																		$date = date_create($books->dateBorrowed);
																		date_add($date,date_interval_create_from_date_string("7 days"));
																		$dueDate =  date_format($date,"Y-m-d");
														
																		// Date Interval
																		$datenow = date('Y-m-d');
																		$due = date_create($dueDate);
																		$date_now = date_create($datenow);
																	
																		if($date_now>$due){
																			$interval = date_diff($due, $date_now);
																			$interval2 = (int) $interval->format('%d');
																			$fines_perdue = $books->finesperDueDate;
																			$totalfines = $fines_perdue*$interval2;
														
																			echo $interval2 = $due->diff($date_now)->format("%d").' '.'Day(s)';

																			$remarks = 'Overdue';
																		}else{
																			echo $interval2 = '0 Day(s)';

																			$remarks = 'On Time';
																		}
																	}else if($books->bookSection != 'Fiction'){
																		$date2 = date_create($books->dateBorrowed);
																		date_add($date2,date_interval_create_from_date_string("3 days"));
																		$dueDate2 =  date_format($date2,"Y-m-d");
														
																		// Date Interval
																		$datenow = date('Y-m-d');
																		$due = date_create($dueDate2);
																		$date_now = date_create($datenow);
																	
																		if($date_now>$due){
																			$interval = date_diff($due, $date_now);
																			$interval2 = (int) $interval->format('%d');
																			$fines_perdue = $books->finesperDueDate;
																			$totalfines = $fines_perdue*$interval2;
														
																			echo $interval2 = $due->diff($date_now)->format("%d").' '.'Day(s)';

																			$remarks = 'Overdue';
																		}else{
																			echo $interval2 = '0 Day(s)';

																			$remarks = 'On Time';
																		}
																	}
																?>
															</td>
															<td align="center">
																<span> ₱<?php echo $totalfines; ?>.00</span>
															</td>
															<td><?php echo $remarks ; ?></td>
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
																	<input type="hidden" class="form-control" id="dateBorrowed" name="dateBorrowed" value="<?php echo $books->dateBorrowed;  ?>">
																	<input type="hidden" class="form-control" id="pickupTime" name="pickupTime" value="<?php echo $books->pickupTime;  ?>">
																	<input type="hidden" class="form-control" id="pickupDate" name="pickupDate" value="<?php echo $books->pickupDate;  ?>">
																	<input type="hidden" class="form-control" id="dueDate" name="dueDate" value="<?php echo $dueDate =  date_format($date,"Y-m-d");  ?>">
																	<input type="hidden" class="form-control" id="interval2" name="interval2" value="<?php echo $interval2;  ?>">
																	<input type="hidden" class="form-control" id="totalFines" name="totalFines" value="<?php echo $totalfines;  ?>">
																	<input type="hidden" class="form-control" id="remarks" name="remarks" value="<?php echo $remarks;  ?>">
																	<input type="hidden" name="return" value="<?php echo $books->id;  ?>">
																	<button class="btn6" type="button" data-toggle="modal" data-target="#confirmRestore" data-title="Confirm Return" data-message="Are you sure you want to return this?">
																		<i class="glyphicon glyphicon-ok"></i>
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
        $("#books").dataTable();
    });
    $(function() {
        $("#booktransactions").dataTable();
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
