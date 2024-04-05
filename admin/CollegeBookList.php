<!-- <?php  
 if(isset($_POST["export"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "lib_server");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=HED Library Book List.csv');  
      $output = fopen("php://output", "w");  
    //   fputcsv($output, array('Accession No.', 'Call No.', 'ISBN', 'Title', 'Author', 'Publisher', 'Copyright Year'));
	  fputcsv($output, array('Title', 'Accession No.', 'ISBN', 'Call No.', 'Description', 'Subject', 'Other Subject', 'Author', 'Other Author', '[Et. Al]', 'Author No.', 'Glossary', 'Bibliography',  'Publisher', 'Copyright Year'));    
      $query = "SELECT bookAccession, callNumber, isbn, bookTitle, author, publisher, datePublished FROM books ORDER BY id DESC";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
	  exit;
 }  
 ?> -->

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
<link rel="stylesheet" type="text/css" href="css/bookaddInputs.css">
<link rel="stylesheet" type="text/css" href="css/input-filter-btn.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>HED Library Book List </title>
</head>

<!-- select dropdown css -->
<style>

	.add-input-container span {
		width: 150px;
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
		min-height: 31px;
		max-width: 90px;
		padding: 0 1rem;
		color: #484747;
		font-size: 15px;
		font-weight: 800;
		border: 2px solid #163269;
		border-radius: 0 6px 6px 0;
		background-color: transparent;
	}

	.filter-input-label {
		min-height: 30px;
		padding: 8px 7px 7px 7px;
		border: none;
		border-radius: 6px 0 0 6px;
		background-color: #163269;
		color: #fff;
		font-size: 11px;
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
		height:31px;
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

	.btn-label{
		font-family: "Roboto", sans-serif;
		font-size: 15px;
		border: none;
		font-weight: bolder;
		background: #fff;
		width: 10%;
		height:30px;
		padding: 0px;
		text-align: center;
		text-decoration: none;
		text-transform: uppercase;
		color: #3db166;
		border-radius:5px;
		cursor: pointer;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		-webkit-transition-duration: 0.3s;
		transition-duration: 0.3s;
		-webkit-transition-property: box-shadow, transform;
		transition-property: box-shadow, transform;
	}

	.btn-label:hover, .btn-label:focus, .btn-label:active{
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
							<a href="admin.php?action=CollegeBookList"><button type="button" class="btn-mb" style="background: #3db166; color:white">All Books</button></a> 
							<a href="admin.php?action=CollegePeriodicalList"><button type="button" class="btn-mb" style="color:#3db166;">Periodical</button></a> 
							<a href="admin.php?action=CollegeDiscardedBooks"><button type="button" class="btn-mb" style="color:#3db166;">Discarded</button></a> 
							<a href="admin.php?action=CollegeLostBooks"><button type="button" class="btn-mb" style="color:#3db166;">Lost</button></a> 
						</ol>
                    </center>
                </section>
                <!-- Main content -->
                <section  class="col-lg-12 connectedSortable">
                        <div class="col-xs-12" style="padding: 0px 15px 10px 15px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
										<br>
										<center>
											<div class="small-box bg">
												<p> LIBRARY BOOK LIST </p>
											</div>
										</center>
										<br>
										<div class="noprint">
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
															<label class="filter-input-label">BOOK SECTION</label>
															<select class="filter-input-box" for="bookSec" name="bookSec" id="bookSec">
																<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
																<?php
																	$books = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'College Library' ORDER BY id ASC");							
																	foreach($books->results() as $books){
																?>
																<option value="<?php echo $books->bookSection?>"><?php echo ucwords($books->bookSection) ?></option>
																<?php }?>
															</select> 
														</div>

														<button class="filtersbtn" name="filterbook"><i class="fa fa-filter"></i></button>
														<a class="filtersbtn" href="admin.php?action=CollegeBookList"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
														<button class="filtersbtn" onclick="window.print();"><i class="fa fa-print"></i></button>
														<a class="filtersbtn" href="admin.php?action=hedLib_allQR"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="glyphicon glyphicon-qrcode"></i></button></a>
														
														<button type="button" class="btn-label noprint" data-toggle="modal" data-target="#exampleModal">Add</button>	
														<button type="button" class="btn-label noprint" data-toggle="modal" data-target="#importModal">Upload</button>	
													</div>
												</center>
											</form>
										
										<br>
									</div>
                                <div class="table-responsive">
                                    <?php if(Session::exists('Existed')){ ?>
                                             <div class="alert alert-danger" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Existed'); ?>
                                             </div>
                                    <?php }?> 
									<?php if(Session::exists('Discarded')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Discarded'); ?>
                                             </div>
                                    <?php }?> 
									<?php if(Session::exists('Lost')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Lost'); ?>
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
												<th>Title</th>
                                                <th>Author</th>
												<th>Publisher</th>
												<th style="width: 5%">© Year</th>
												<th>Book Section</th>
												<th>Total</th>
												<th>Available</th>
												<th class="noprint">Actions</th>
                                            </tr>
                                            </tr>
                                        </thead>
										<tbody>
											<?php include 'ColLibBookFilterSec.php'?>	
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
														<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 5px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
															<p id="exampleModalLabel" style="font-size:40px; transform: scale(.7, 1);">
																ADD NEW BOOK
															</p>
														</div>
													</center>
											</div>
											<div class="modal-body">
												<form enctype="multipart/form-data" method="post" action="CollegeAddBook.php">
													<div class="row">
														<!-- <div class="col-md-6">
															<div class="add-input-container">
																<span for="bookTitleDropdown">Book Title</span>
																<input type="text" class="add-input" list="bookTitleDropdown" name="bookTitle" id="bookTitleDropdown" required>
																<datalist id="bookTitleDropdown">
																	<option value="<?php echo isset($_POST['bookTitle']) ? $_POST['bookTitle'] : '' ?>" > <?php echo isset($_POST['bookTitle']) ? $_POST['bookTitle'] : '' ?></option>
																	<?php
																		$books = DB::getInstance()->query("SELECT DISTINCT bookTitle FROM books WHERE libraryClass = 'College Library' ORDER BY id ASC");
																		foreach($books->results() as $book) {
																	?>
																	<option value="<?php echo $book->bookTitle?>"><?php echo ucwords($book->bookTitle) ?></option>
																	<?php } ?>
																</datalist>
															</div>
														</div> -->
														<div class="col-md-6">
															<div class="add-input-container">
																<span for="bookTitle">Book Title</span>
																<input type="text" class="add-input" id="bookTitleDropdown" name="bookTitle" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container">
																<span for="bookAccession">Accession No.</span>
																<input type="text" class="add-input" id="bookAccession" name="bookAccession" required>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="isbn">ISBN</span>
																<input type="text" class="add-input" id="isbn" name="isbn" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="callNumber">Call No.</span>
																<input type="text" class="add-input" id="callNumber" name="callNumber" required>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															<div style="width:46.5%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius: 5px 0 0 5px"> 
																<label class="control-label" for="bookDescription">Description</label>
															</div>
															<div class="form-group" style="width:100%; margin-bottom: 0px">
																<textarea style="padding-top:65px; font-size: 15px; border: 2px solid #163269; border-radius:6px" cols="30" rows="5" type="text" class="form-control" id="bookDescription" name="bookDescription"></textarea>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="subject">Subject</span>
																<input type="text" class="add-input" id="subject" name="subject">
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="otherSubject">Other Subject</span>
																<input type="text" class="add-input" id="otherSubject" name="otherSubject">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="author">Author</span>
																<input type="text" class="add-input" id="author" name="author" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="otherAuthor">Other Author</span>
																<input type="text" class="add-input" id="otherAuthor" name="otherAuthor">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="authorNumber">Author No.</span>
																<input type="text" class="add-input" id="authorNumber" name="authorNumber" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="etAl_authors">Et. Al</span>
																<input type="text" class="add-input" id="etAl_authors" name="etAl_authors">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="glossary">Glossary Page</span>
																<input type="text" class="add-input" id="glossary" name="glossary">
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="bibliography">Bibliography Page</span>
																<input type="text" class="add-input" id="bibliography" name="bibliography">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="appendix">Appendix Page</span>
																<input type="text" class="add-input" id="appendix" name="appendix">
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="indexNumber">Index Page</span>
																<input type="text" class="add-input" id="indexNumber" name="indexNumber">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="includes">Includes</span>
																<input type="text" class="add-input" id="includes" name="includes">
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="publisher">Publisher</span>
																<input type="text" class="add-input" id="publisher" name="publisher">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="bookSections">Book Sections</span>
																<input type="text" class="add-input" list="bookSections" name="bookSection" id="bookSection" required value="<?php echo isset($_POST['bookSection']) ? htmlspecialchars($_POST['bookSection']) : ''; ?>">
																<datalist id="bookSections">
																	<?php
																		$books = DB::getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'College Library' ORDER BY id ASC");
																		foreach ($books->results() as $book) {
																	?>
																	<option value="<?php echo $book->bookSection?>"><?php echo ucwords($book->bookSection) ?></option>
																	<?php }?>
																</datalist>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="datePublished">Copyright Year</span>
																<input type="text" class="add-input" id="datePublished" name="datePublished" required>
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
													</div>
												</form>
											</div>
										</div>
									</div>
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
																UPLOAD CSV FILE
															</p>
														</div>
													</center>
												</div>
												<div class="modal-body" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
													<p class="form-paragraph">
														File should be a .csv format or download this file template <a style="color:#fff" href="bookTemplate.php"> <button class="btncsv" type="submit"> CSV Template <i class="fas fa-file-download"></i></button></a>
													</p>
													<form enctype="multipart/form-data" method="post" action="CollegeBookBulkUpload.php">
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
	$(function() {
        $("#articles").dataTable();
    });

	setTimeout(function(){
		document.getElementById("alert").style.display = "none";
	}, 5000);

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

<!-- Assuming your book title dropdown has an id="bookTitleDropdown" -->
<script>
	document.getElementById('bookTitleDropdown').addEventListener('change', function() {
		var selectedBookTitle = this.value;

		// Trigger AJAX call
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'getBookDetails.php', true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				var response = JSON.parse(xhr.responseText);

				// Update form fields with retrieved details
				// document.getElementById('bookAccession').value = response.bookAccession || '';
				document.getElementById('isbn').value = response.isbn || '';
				document.getElementById('callNumber').value = response.callNumber || '';
				document.getElementById('bookDescription').value = response.bookDescription || '';
				document.getElementById('subject').value = response.subject || '';
				document.getElementById('otherSubject').value = response.otherSubject || '';
				document.getElementById('author').value = response.author || '';
				document.getElementById('otherAuthor').value = response.otherAuthor || '';
				document.getElementById('authorNumber').value = response.authorNumber || '';
				document.getElementById('etAl_authors').value = response.etAl_authors || '';
				document.getElementById('glossary').value = response.glossary || '';
				document.getElementById('bibliography').value = response.bibliography || '';
				document.getElementById('appendix').value = response.appendix || '';
				document.getElementById('indexNumber').value = response.indexNumber || '';
				document.getElementById('includes').value = response.includes || '';
				document.getElementById('publisher').value = response.publisher || '';
				document.getElementById('bookSection').value = response.bookSection || '';
				document.getElementById('datePublished').value = response.datePublished || '';
			}
		};

		// Send the request
		xhr.send('bookTitle=' + selectedBookTitle);
	});
</script>

</body>
</html>