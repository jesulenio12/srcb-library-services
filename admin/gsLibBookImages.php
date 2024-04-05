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
<link rel="stylesheet" type="text/css" href="css/filter-button.css">
<link rel="stylesheet" href="admin-b-r-button.css">
<link rel="stylesheet" type="text/css" href="css/bookaddInputs.css">
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>GS Library Book Images</title>
</head>

<style>
	.add-input-container span {
		width: 116px;
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

	.alert {
		margin-top: 17px;
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
<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}

	@media print {

		.card-label-button, .card-label-button * {
			display: none; !important;
		}

		.session-message, .session-message * {
			display: none; !important;
		}


		@page {
				size: 816px 1248px;
				orientation: portrait;
				margin: 0;
				padding-top: 0;
			}

			/* Set 3-column layout */
			body {
				column-count: 4;
				column-gap: 0;
				zoom: 80%;
			}

			/* Style images to fill available space in column */
			img {
				max-width: 100%;
				height: auto;
				display: block;
				margin: 0 auto;
			}

			.noprint, .noprint * {
				display: none; !important;
			}

			.row, .row * {
				page-break-inside: avoid;
			}

	}

	.bookqr {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
	}

	.bookqr .row {
    	flex: 1 1 20%;
		text-align: center;
	}

	.bookqr .row .col-md-4 {
		display: block;
	}

	button.btn.btn-primary.mt-2 {
		width: fit-content;
		height: fit-content;
		padding: 6px 9px 6px 9px;
		background: #d13131;
		border: none;
		border-radius: 50%;
		margin-right: -16px;
    	margin-bottom: -20px;
		color: white;
		position: relative;
	}

	.card-label-button {
		display: flex;
		align-items: baseline;
		justify-content: end;
	}

	.card {
		background: none;
		border-radius:10px;
		width:300px;
	}

	img.card-img-qr {
		border: 3px solid black;
		border-radius: 10px;
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
                        <div class="col-xs-12" style="padding: 10px 15px 10px 15px">
                            <div style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding: 0px 30px 10px 30px">
								<br>
								<center class="noprint">
									<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 116px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
										<p style="font-size:35px; transform: scale(1, 2);">
											GS LIBRARY BOOKS
										</p>
										<!-- <a style="color: #fff;" href="admin.php?action=gsLib_allQR"><button type="button" class="abtnb">BULK PRINTING </button></a>
										<a style="color: #fff;" href="admin.php?action=gsLib_allQRSelect"><button type="button" class="abtnr">SELECTIVE PRINTING</button></a>  -->
									</div>
								</center>
                            	<div class="box-body">
									<br>
									<form class="form-inline" method="POST" action="" style="margin-left: 20px">
										<center class="noprint" >
											<div class="wrap-filter" class="noprint">
												<div class="filter-input-group"> 
													<label class="filter-input-label">TITLE</label>
													<input type="text" class="filter-input-box" for="bookImageTitle" id="bookImageTitle" name="bookImageTitle" value="<?php echo isset($_POST['bookImageTitle']) ? $_POST['bookImageTitle'] : '' ?>">
												</div>
												<div class="filter-input-group"> 
													<label class="filter-input-label">AUTHOR</label>
													<select class="filter-input-box" for="bookImageAuthor" name="bookImageAuthor" id="bookImageAuthor">
														<option value="<?php echo isset($_POST['bookImageAuthor']) ? $_POST['bookImageAuthor'] : '' ?>" > <?php echo isset($_POST['bookImageAuthor']) ? $_POST['bookImageAuthor'] : '' ?></option>
														<?php
															$books = DB:: getInstance()->query("SELECT DISTINCT bookImageAuthor FROM bookimages WHERE bookImageLibClass = 'Grade School Library' ORDER BY id ASC");							
															foreach($books->results() as $books){
														?>
														<option value="<?php echo $books->bookImageAuthor?>"><?php echo ucwords($books->bookImageAuthor) ?></option>
														<?php }?>
													</select> 
												</div>
												<div class="filter-input-group"> 
													<label class="filter-input-label">© YEAR</label>
													<input type="text" class="filter-input-box" for="bookdatePublished" id="bookdatePublished" name="bookdatePublished" value="<?php echo isset($_POST['bookdatePublished']) ? $_POST['bookdatePublished'] : '' ?>">
												</div>
												<div class="filter-input-group"> 
													<label class="filter-input-label">SECTION</label>
													<select class="filter-input-box" for="bookImageSection" name="bookImageSection" id="bookImageSection">
														<option value="<?php echo isset($_POST['bookImageSection']) ? $_POST['bookImageSection'] : '' ?>" > <?php echo isset($_POST['bookImageSection']) ? $_POST['bookImageSection'] : '' ?></option>
														<?php
															$books = DB:: getInstance()->query("SELECT DISTINCT bookImageSection FROM bookimages WHERE bookImageLibClass = 'Grade School Library' ORDER BY id ASC");							
															foreach($books->results() as $books){
														?>
														<option value="<?php echo $books->bookImageSection?>"><?php echo ucwords($books->bookImageSection) ?></option>
														<?php }?>
													</select> 
												</div>

												<button class="filtersbtn" name="filterbook"><i class="fa fa-filter"></i></button>
												<a class="filtersbtn" href="admin.php?action=gsLibBookImages"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
												<button type="button" class="btn2-1 noprint" data-toggle="modal" data-target="#importModal">Add Image</button>	
											</div>
										</center>
									</form>
									<div class="clearfix noprint"></div><hr class="noprint" />
									<div class="session-message">
										<?php if(Session::exists('Added')){ ?>
												<div class="alert alert-success" id="alert">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Added'); ?>
												</div>
										<?php }?> 
										<?php if(Session::exists('Deleted')){ ?>
												<div class="alert alert-success" id="alert">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Deleted'); ?>
												</div>
										<?php }?> 
										<?php if(Session::exists('Error')){ ?>
												<div class="alert alert-danger" id="alert">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Error'); ?>
												</div>
										<?php }?> 
									</div>
									<div class="bookqr">
										<?php include 'gsLibBookImagesFilter.php'?>
									</div>
								<!-- Modal -->
									<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-md" role="document">
											<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<center>
														<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
															<p style="font-size:30px; transform: scale(.7, 1);">
																ADD NEW IMAGE
															</p>
														</div>
													</center>
												</div>
												<div class="modal-body" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
													<form enctype="multipart/form-data" method="post" action="gsLibAddImage.php">
														<div class="row">
															<div class="col-md-6">
																<div class="add-input-container"> 
																	<span for="bookImageTitle">Book Title</span>
																	<input type="text" class="add-input" id="bookImageTitle" name="bookImageTitle" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="add-input-container"> 
																	<span for="bookImageSection">Section</span>
																	<input type="text" class="add-input" list="bookImageSection" name="bookImageSection" id="bookImageSection" required>
																	<datalist id="bookImageSection">
																		<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
																		<?php
																			$books = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'Grade School Library' ORDER BY id ASC");							
																			foreach($books->results() as $books){
																		?>
																		<option value="<?php echo $books->bookSection?>"><?php echo ucwords($books->bookSection) ?></option>
																		<?php }?>
																	</datalist>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="add-input-container"> 
																	<span for="bookImageAuthor">Author</span>
																	<input type="text" class="add-input" id="bookImageAuthor" name="bookImageAuthor" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="add-input-container"> 
																	<span for="bookdatePublished">© Year</span>
																	<input type="text" class="add-input" id="bookdatePublished" name="bookdatePublished" required>
																</div>
															</div>
														</div>
														<label for="uploadImage" class="drop-container">
															<span class="drop-title">Drop files here</span>
																or
															<input type="file" class="file-input" id="uploadImage" name="uploadImage">
														</label>
												</div>
												<div class="modal-footer">
													<div class="row">
														<div class="col-md-6">
															<button type="submit" name="upload" class="btnupdate" value="Upload"> Add</button>
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

<script>
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
</script>
</body>
</html>