<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, user-scalable=no" />
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
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/responsiveness.css">
<title>Books Borrowed</title>
</head>

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
                    <!-- <center>
						<ol class="breadcrumb" style="background-color: rgba(255, 255, 255, 0.239); border-radius:30px; margin-top:-5px;">
							<a href="admin.php?action=CollegeLibOnlineBookList"><button type="button" class="btn-mb" style="color:#3db166;">HED LIBRARY</button></a> 
							<a href="admin.php?action=HighSchoolLibOnlineBookList"><button type="button" class="btn-mb" style="color:#3db166;">HS LIBRARY</button></a> 
							<a href="admin.php?action=ElementaryLibOnlineBookList"><button type="button" class="btn-mb" style="color:#3db166;">GS LIBRARY</button></a> 
						</ol>
                    </center> -->
                </section>
                <!-- Main content -->
                <section  class="col-lg-15 connectedSortable">
                        <div class="col-md-15">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
										<br><br>
										<center>
											<div class="tb-title">
												<div class="small-box bg">
													<p>
														BOOK BORROWED
													</p>
												</div>
											</div>
										</center>
										<br>
										<hr style="border-top:1px dotted #000;"/>	
                                <div class="table-responsive">
								<table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Library</th>
												<th>Accession No.</th>
												<th>Call No.</th>
												<th>Book Section</th>
												<th>Title</th>
                                                <th>Author</th>
												<th>Copyright Year</th>
												<th>Status</th>
                                                <th>Pickup Date</th>
												<th>Date Borrowed</th>
												<th>Due Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$books = DB:: getInstance()->query("SELECT * FROM books WHERE approved ='1' OR received = '1'");
                                                if($books->results() > 0){
												foreach($books->results() as $books){ 
                                                    if($books->library_userID == $user->data()->username){
                                                    ?>
														<tr>
															<td data-label="#">#</td>
															<td data-label="Library"><?php echo $books->libraryClass ; ?></td>
															<td data-label="Accession No."><?php echo $books->bookAccession ; ?></td>
															<td data-label="Call No."><?php echo $books->callNumber ; ?></td>
															<td data-label="Book Section"><?php echo $books->bookSection ; ?></td>
															<td data-label="Title"><?php echo $books->bookTitle ; ?></td>
															<td data-label="Author"><?php echo $books->author ; ?></td>
															<td data-label="Copyright Year"><?php echo $books->datePublished ; ?></td>
															<td data-label="Status">
																<?php if($books->approved == 1 && $books->pickupTime != ''){?>
																	<span class="label label-primary"> Approved </span>
																<?php }elseif($books->dateBorrowed != ''){?>
																	<span class="label label-success"> Received </span>
																<?php }?>
															</td>
                                                            <td data-label="Pickup Date">
																<?php echo $books->pickupDate ;?> | <?php echo $books->pickupTime ; ?>
															</td>
															<td data-label="Date Borrowed">
																<?php if($books->dateBorrowed == ''){?>
																	--/--/--
																<?php }else{?>
																	<?php echo $books->dateBorrowed ; ?>
																<?php }?>
															</td>
															<td data-label="Due Date">
																<?php
																	if($books->dateBorrowed != ''){
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
																	}else{
																		echo '--/--/--';
																	}
																?>
															</td>
														</tr>
												    <?php 	
													}
												}
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
<!-- Bootstrap Datepicker -->
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
	setTimeout(function(){
		document.getElementById("alert").style.display = "none";
	}, 5000);
</script>
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
  
  $('#confirmApproval').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmApproval').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>
</body>

</html>
