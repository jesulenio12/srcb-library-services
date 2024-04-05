
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
<link rel="stylesheet" href="admin-b-r-button.css">
<link rel="stylesheet" href="buttonhover.css">
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/responsiveness.css">
<link rel="stylesheet" type="text/css" href="css/bookgallery.css">
<title>HED Library Books </title>
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
                    <center>
						<ol class="breadcrumb" style="background-color: rgba(255, 255, 255, 0.239); border-radius:30px; margin-top:-5px;">
							<a href="admin.php?action=CollegeLibOnlineBookList"><button type="button" class="btn-mb" style="color:white; background-color: #3db166">HED LIBRARY</button></a> 
							<a href="admin.php?action=HighSchoolLibOnlineBookList"><button type="button" class="btn-mb" style="color:#3db166;">HS LIBRARY</button></a> 
							<a href="admin.php?action=ElementaryLibOnlineBookList"><button type="button" class="btn-mb" style="color:#3db166;">GS LIBRARY</button></a> 
						</ol>
                    </center>
                </section>
                <!-- Main content -->
                <section  class="col-lg-15 connectedSortable">
                        <div class="col-md-15">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px;">
										<br><br>
										<center>
											<div class="tb-title">
												<div class="small-box bg">
													<p>
														HED LIBRARY BOOKS
													</p>
												</div>
											</div>
										</center>
										<br>
										<hr style="border-top:1px dotted #000;"/>
										<br>	
										<form class="form-inline" method="POST" action="">
											<div class="wrap-filter">
												<div class="filter-input-group"> 
													<label class="filter-input-label">TITLE</label>
													<input type="text" class="filter-input-box" for="bookTitle" id="bookTitle" name="bookTitle" value="<?php echo isset($_POST['bookTitle']) ? $_POST['bookTitle'] : '' ?>">
												</div>
												<div class="filter-input-group"> 
													<label class="filter-input-label">AUTHOR</label>
													<select class="filter-input-box" for="author" name="author" id="author">
														<option value="<?php echo isset($_POST['author']) ? $_POST['author'] : '' ?>" > <?php echo isset($_POST['author']) ? $_POST['author'] : '' ?></option>
														<?php
															$books = DB:: getInstance()->query("SELECT DISTINCT author FROM books WHERE libraryClass = 'College Library' ORDER BY id ASC");							
															foreach($books->results() as $books){
														?>
														<option value="<?php echo $books->author?>"><?php echo ucwords($books->author) ?></option>
														<?php }?>
													</select> 
												</div>
												<div class="filter-input-group"> 
													<label class="filter-input-label">©YEAR</label>
													<input type="text" class="filter-input-box" for="datePublished" id="datePublished" name="datePublished" value="<?php echo isset($_POST['datePublished']) ? $_POST['datePublished'] : '' ?>">
												</div>
												<div class="filter-input-group"> 
													<label class="filter-input-label">SECTION</label>
													<select class="filter-input-box" for="bookSection" name="bookSection" id="bookSection">
														<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
														<?php
															$books = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'College Library' ORDER BY id ASC");							
															foreach($books->results() as $books){
														?>
														<option value="<?php echo $books->bookSection?>"><?php echo ucwords($books->bookSection) ?></option>
														<?php }?>
													</select> 
												</div>
												<div class="filter-buttons">
														<button class="filtersbtn" name="filterbook"><i class="fa fa-filter"></i></button>
														<button class="filtersbtn" type="button"><a style="background:transparent; border:none; color:#fff" href="admin.php?action=CollegeLibOnlineBookList"><i class="fa fa-refresh"></i></a></button>
												</div>
											</div>
										</form>
										<br>
										<?php if(Session::exists('Requested')){ ?>
												<div id="alert" class="alert alert-success">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Requested'); ?>
												</div>
										<?php }?> 
										<div class="bookqr">
											<?php include 'CollegeLibOnlineBookListFilter.php'?>
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

  $('#confirmRequest').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmRequest').find('.modal-footer #confirm').on('click', function(){
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

  $('#confirmLost').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmLost').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>

<script>
    // JavaScript to update modal content dynamically
    $('#moreInfo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var bookDescription = button.data('bookdescription'); // Corrected variable name
        var bookAccession = button.data('bookaccession');
        var title = button.data('title');
        var author = button.data('author');
        var callNumber = button.data('callnumber');
        var isbn = button.data('isbn');
        var publisher = button.data('publisher');
        var datePublished = button.data('datepublished'); // Corrected variable name
        var section = button.data('section');
        var image = button.data('image');

        var modal = $(this);
        modal.find('#bookDescription').text(bookDescription);
        modal.find('#bookAccession').text(bookAccession);
        modal.find('#bookTitle').text(title);
        modal.find('#author').text(author);
        modal.find('#callNumber').text(callNumber);
        modal.find('#isbn').text(isbn);
        modal.find('#publisher').text(publisher);
        modal.find('#datePublished').text(datePublished);
        modal.find('#bookSection').text(section);

        // Check if the book has an image
        if (image) {
            modal.find('#bookImage').attr('src', 'admin/hedBookImages/' + image);
        } else {
            // If no image, show a default image
            modal.find('#bookImage').attr('src', 'admin/images/default.png');
        }
    });
</script>


</body>

</html>
