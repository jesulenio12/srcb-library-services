<?php
if (Input::exists()) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'bookQRCodes'.DIRECTORY_SEPARATOR;
		
			$books = DB:: getInstance()->get('books', array('id','=',Input::get('restore')));							
			foreach($books->results() as $books){
				unlink($PNG_TEMP_DIR.$books->qrcode);
			}

			$books = DB:: getInstance()->get('books', array('id','=',Input::get('restore')));
			if ($books->count()){
			foreach($books->results() as $books){
				$book = new Books();
				 try {
					$book->update(array(
						'lost' => 0,
					),$books->id);
				} catch(Exception $e) {
				   $error;
				}
			}

			Session::flash('Restored', 'Record has been successfully restored.');
			Redirect::to('admin.php?action=HighSchoolLostBooks');	
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
<link rel="stylesheet" href="buttonhover.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>HS Library Lost Book List  </title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}

	.wrap-filter {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.filter-input-group {
  display: flex;
  align-items: flex-start;
}

.filter-input-box {
	min-height: 35px;
	max-width: 150px;
	padding: 0 1rem;
	color: #484747;
	font-size: 15px;
	font-weight: 800;
	border: 2px solid #163269;
	border-radius: 0 6px 6px 0;
	background-color: transparent;
}

.filter-input-label {
	min-height: 35px;
    padding: 7px 1rem;
    border: none;
    border-radius: 6px 0 0 6px;
    background-color: #163269;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: background-color .3s ease-in-out;
}

.filter-input-box:focus, .filter-input-box:focus-visible {
  border-color: #3898EC;
  outline: none;
}

.filtersbtn{
    font-family: "Roboto", sans-serif;
    font-size: 15px;
    border: none;
    font-weight: bolder;
    background: #3db166;
    width: 3%;
    height:35px;
    padding: 0px;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    color: #fff;
    border-radius:5px;
    cursor: pointer;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -webkit-transition-property: box-shadow, transform;
    transition-property: box-shadow, transform;
}

.filtersbtn:hover, .filtersbtn:focus, .filtersbtn:active{
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
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
							<a href="admin.php?action=HighSchoolBookList"><button type="button" class="btn-mb" style="color:#3db166;">Book List</button></a> 
							<a href="admin.php?action=HighSchoolPeriodicalList"><button type="button" class="btn-mb" style="color:#3db166;">Periodical Books</button></a> 
							<a href="admin.php?action=HighSchoolDiscardedBooks"><button type="button" class="btn-mb" style="color:#3db166;">Discarded Books</button></a> 
							<a href="admin.php?action=HighSchoolLostBooks"><button type="button" class="btn-mb" style="background: #3db166; color:white">Lost Books</button></a> 
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
													LIBRARY LOST BOOK LIST
												</p>
											</div>
										</center>
										<br>
                               			<hr style="border-top:1px dotted #000;"/>
										<form class="form-inline" method="POST" action="" style="margin-left: 20px">
											<center>
												<div class="wrap-filter" class="noprint">
													<div class="filter-input-group"> 
														<label class="filter-input-label">BOOK SECTION</label>
														<select class="filter-input-box" for="bookSection" name="bookSection" id="bookSection">
															<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
															<?php
																$books = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'High School Library' ORDER BY id ASC");							
																foreach($books->results() as $books){
															?>
															<option value="<?php echo $books->bookSection?>"><?php echo ucwords($books->bookSection) ?></option>
															<?php }?>
														</select> 
													</div>

													<button class="filtersbtn" name="filterbook"><i class="fa fa-filter"></i></button>
													<a class="filtersbtn" href="admin.php?action=HighSchoolLostBooks"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
													<button class="filtersbtn" onclick="window.print();"><i class="fa fa-print"></i></button>
												</div>
											</center>
										</form>
										<br>
                                <div class="box-body table-responsive">
                                    <?php if(Session::exists('Deleted')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Deleted'); ?>
                                             </div>
                                    <?php }?> 
									<?php if(Session::exists('Restored')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Restored'); ?>
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
												<th>#</th>
												<th>Accession No.</th>
												<th>Call No.</th>
												<th>ISBN</th>
												<th>Book Section</th>
												<th>Title</th>
                                                <th>Author</th>
												<th>Publisher</th>
												<th>Copyright Year</th>
												<th class="noprint" style="width:15%">Actions</th>
                                            </tr>
                                        </thead>
										<tbody>
												<?php include 'HighSchoolLostBookFilterSec.php'?>	
										</tbody>
                                    </table>
                                </div><!-- /.box-body -->
									<!-- Modal -->
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

	// $(function(){
    //     $("#datePublished").datepicker({ dateFormat: 'yy-mm-dd' });
    //     $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
    //         var minValue = $(this).val();
    //         minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
    //         minValue.setDate(minValue.getDate()+1);
    //         $("#datePublished").datepicker( "option", "minDate", minValue );
    //     })
    // });
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
</script>
</body>

</html>
