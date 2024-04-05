<?php

if (Input::exists()) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'bookperiodicalQRCodes'.DIRECTORY_SEPARATOR;
		
		$books = DB:: getInstance()->get('books', array('id','=',Input::get('removed')));							
		foreach($books->results() as $books){
			unlink($PNG_TEMP_DIR.$books->qrcode);
		}

		
		$books = DB:: getInstance()->get('books', array('id','=',Input::get('removed')));
		if ($books->count()){
			foreach($books->results() as $books){
				$book = new Books();
				 try {
					$book->update(array(
						'status' => 'Available',
					),$books->id);
				} catch(Exception $e) {
				   $error;
				}
			}
		}
		Session::flash('Removed', 'Record has been successfully removed.');
		Redirect::to('admin.php?action=ElementaryPeriodicalList');
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
<link rel="stylesheet" href="buttonhover.css">
<link rel="stylesheet" type="text/css" href="css/bookaddInputs.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>GS Library Periodical Book List </title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}

	.add-input-container span {
		width: 110px;
		text-align: center;
		padding: 8px 12px;
		font-size: 15px;
		line-height: 25px;
		color: #ffffff;
		background: #163269;
		border: 2px solid #163269;
		border-radius: 5px 0 0 5px;
		font-weight: bold;
		transition: background 0.3s ease, border 0.3s ease, color 0.3s ease;
	}

	.btncsv {
		font-family: "Roboto", sans-serif;
		font-size: 12px;
		border: none;
		font-weight: bold;
		background: #12f330;
		width: 25%;
		height: 30px;
		padding-top: 4px;
		text-align: center;
		text-decoration: none;
		text-transform: uppercase;
		color: #fff;
		border-radius: 25px;
		cursor: pointer;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		-webkit-transition-duration: 0.3s;
		transition-duration: 0.3s;
		-webkit-transition-property: box-shadow, transform;
		transition-property: box-shadow, transform
	}

	.btncsv:hover,
	.btncsv:focus,
	.btncsv:active {
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}

	.form-paragraph {
		margin-top: 10px;
		font-size: 15px;
		color: rgb(105, 105, 105);
		text-align: center
	}

	.drop-container {
		background-color: #ffffffb8;
		position: relative;
		display: flex;
		gap: 10px;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		padding: 10px;
		margin-top: 2.1875rem;
		border-radius: 10px;
		border: 3px dashed #3db166;
		color: #444;
		cursor: pointer;
		transition: background .2s ease-in-out, border .2s ease-in-out;
	}

	.drop-container:hover {
		background: rgba(0, 140, 255, 0.164);
		border-color: rgba(17, 17, 17, 0.616);
	}

	.drop-container:hover .drop-title {
		color: #222;
	}

	.drop-title {
		color: #444;
		font-size: 20px;
		font-weight: bold;
		text-align: center;
		transition: color .2s ease-in-out;
	}

	.file-input {
		width: 465px;
		max-width: 100%;
		color: #444;
		padding: 2px;
		background: #fff;
		border-radius: 10px;
		border: 1px solid #163269;
	}

	.file-input::file-selector-button {
		margin-right: 20px;
		border: 1px solid #163269;
		background: #163269;
		padding: 13px 20px;
		border-radius: 10px 0 0 10px;
		color: #fff;
		cursor: pointer;
		transition: background .2s ease-in-out;
	}

	.file-input::file-selector-button:hover {
		background: #0d45a5;
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
							<a href="admin.php?action=ElementaryBookList"><button type="button" class="btn-mb" style="color:#3db166;">Book List</button></a> 
							<a href="admin.php?action=ElementaryPeriodicalList"><button type="button" class="btn-mb" style="background: #3db166; color:white">Periodical Books</button></a> 
							<a href="admin.php?action=ElementaryDiscardedBooks"><button type="button" class="btn-mb" style="color:#3db166;">Discarded Books</button></a> 
							<a href="admin.php?action=ElementaryLostBooks"><button type="button" class="btn-mb" style="color:#3db166;">Lost Books</button></a> 
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
											LIBRARY PERIODICAL BOOK LIST
										</p>
									</div>

								<button type="button" class="btn2-1 noprint" data-toggle="modal" data-target="#exampleModal">Add Book</button>	
								<button type="button" class="btn2-1 noprint" data-toggle="modal" data-target="#importModal">Upload CSV</button>	
								<button type="button" class="btn2-1 noprint" onclick="window.print();"> Print</button>	
								</center>
								<br>
								
                                <div class="box-body table-responsive">
                                    <?php if(Session::exists('Removed')){ ?>
                                             <div class="alert alert-danger" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Removed'); ?>
                                             </div>
                                    <?php }?> 
									<?php if(Session::exists('Discarded')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Discarded'); ?>
                                             </div>
                                    <?php }?> 
                                    <?php if(Session::exists('Updated')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Updated'); ?>
                                             </div>
                                    <?php }?>
									<?php if(Session::exists('Added')) { ?>
										<div class="alert alert-success" id="alert">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Added'); ?>
										</div>
									<?php }?>
									
                                    <table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
												<th>Title</th>
												<th>Date Issued</th>
												<th>Volume</th>
												<th>Number</th>
												<th class="noprint">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
												$books = DB:: getInstance()->query("SELECT * FROM books WHERE status ='Available'");
												  foreach($books->results() as $books){ ?>
													  <?php if($books->libraryClass =='Grade School Library' && $books->bookSection =='Periodical'){?>
														  <tr>
														  	  <td><?php echo $books->bookTitle ; ?></td>
															  <td><?php echo $books->datePublished ; ?></td>
															  <td><?php echo $books->callNumber ; ?></td>
															  <td><?php echo $books->bookAccession ; ?></td>
															    <td align="center" class="noprint">
																  <?php require_once ('remove-confirm.php');?>
																  <form method="POST" action="" style="display:inline">
																	  <input type="hidden" name="removed" value="<?php echo $books->id;  ?>">
																	  <button class="btn9" type="button" data-toggle="modal" data-target="#confirmRemove" data-title="Confirm Remove" data-message="Are you sure you want to remove this?">
																		  <i class="glyphicon glyphicon-remove"></i> Remove
																	  </button>
																  </form>
																  <form method="POST" action="admin.php?action=ElementaryPeriodicalBookEdit&&id=<?php echo $books->id; ?>" style="display:inline">
																	  <button class="btn9" type="submit">
																		  <i class="glyphicon glyphicon-edit"></i> Update
																	  </button>
																  </form>
															    </td>
														  </tr>
  
													  <?php
													  }
													  else{
														  // Not belong
													  }
													  ?>	
												  
												  <?php 
												  		
													}
														
											?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
									<!-- Modal -->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<center>
												<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
													<p id="exampleModalLabel" style="font-size:30px; transform: scale(.7, 1);">
														ADD PERIODICAL
													</p>
												</div>
											</center>
										</div>
										<div class="modal-body">
											<form enctype="multipart/form-data" method="post" action="ElementaryPeriodicalAddBook.php">
												<div class="row">
													<div class="col-md-6">
														<div class="add-input-container"> 
															<span for="bookTitle">Title</span>
															<input type="text" class="add-input" id="bookTitle" name="bookTitle" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="add-input-container"> 
															<span for="datePublished">Date Issued</span>
															<input type="text" class="add-input" id="datePublished" name="datePublished" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div class="add-input-container"> 
															<span for="callNumber">Volume No.</span>
															<input type="text" class="add-input" id="callNumber" name="callNumber" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="add-input-container"> 
															<span for="bookAccession">Number</span>
															<input type="text" class="add-input" id="bookAccession" name="bookAccession" required>
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
                                </div>
								<div class="box-footer">
									<!-- Modal -->
									<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-md" role="document">
											<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<center>
														<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
															<p style="font-size:30px; transform: scale(.7, 1);">
																UPLOAD CSV FILE
															</p>
														</div>
													</center>
												</div>
												<div class="modal-body" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
													<p class="form-paragraph">
														File should be a .csv format or download this file template <a style="color:#fff" href="CSVPeriodicalBookTemplate.php"> <button class="btncsv" type="submit"> CSV Template <i class="fas fa-file-download"></i></button></a>
													</p>
													<form enctype="multipart/form-data" method="post" action="ElementaryPeriodicalBulkUpload.php">
														<label for="bookscsv_file" class="drop-container">
															<span class="drop-title">Drop files here</span>
																or
															<input type="file" class="file-input" id="bookscsv_file" name="bookscsv_file">
														</label>
												</div>
												<div class="modal-footer">
													<div class="row">
														<div class="col-md-6">
															<button type="submit" name="upload" class="btnupdate" value="Upload"> Upload</button>
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

	setTimeout(function(){
		document.getElementById("alert").style.display = "none";
	}, 5000);
	
	function printImg(url) {
	  var win = window.open('');
	  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
	  win.focus();
	}

	$(function(){
        $("#datePublished").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#datePublished").datepicker( "option", "minDate", minValue );
        })
    });
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
