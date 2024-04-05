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
						'discarded' => 0,
					),$books->id);
				} catch(Exception $e) {
				   $error;
				}
			}

			Session::flash('Restored', 'Record has been successfully restored.');
			Redirect::to('admin.php?action=HighSchoolDiscardedBooks');	
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
<link rel="stylesheet" type="text/css" href="css/uploadModal.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>HS Library Discarded Book List</title>
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
							<a href="admin.php?action=HighSchoolDiscardedBooks"><button type="button" class="btn-mb" style="background: #3db166; color:white">Discarded Books</button></a> 
							<a href="admin.php?action=HighSchoolLostBooks"><button type="button" class="btn-mb" style="color:#3db166;">Lost Books</button></a> 
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
													LIBRARY DISCARDED BOOK LIST
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
													<a class="filtersbtn" href="admin.php?action=HighSchoolDiscardedBooks"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
													<button class="filtersbtn" onclick="window.print();"><i class="fa fa-print"></i></button>
													
													<button type="button" class="btn2-1 noprint" data-toggle="modal" data-target="#exampleModal">Add Book</button>	
													<button type="button" class="btn2-1 noprint" data-toggle="modal" data-target="#importModal">Upload CSV</button>	
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
												<th>Copyright Date</th>
												<th style="width:10%">Action</th>
                                            </tr>
                                        </thead>
										<tbody>
												<?php include 'HighSchoolDiscardBookFilterSec.php'?>	
										</tbody>
                                    </table>
                                </div><!-- /.box-body -->
								<div class="box-footer">
									<!-- Modal -->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document" style="width:50%">
										<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<center>
												<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
													<p id="exampleModalLabel" style="font-size:30px; transform: scale(.7, 1);">
														Add Discarded Book
													</p>
												</div>
											</center>
										</div>
										<div class="modal-body">
											<form enctype="multipart/form-data" method="post" action="HighSchoolDiscardedAddBook.php">
											<div class="row">
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="datePublished">Book Title</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="bookTitle" name="bookTitle" placeholder="Input Title of the Book">
															</div>
														</div>
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="program">Accession No.</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="bookAccession" name="bookAccession" placeholder="Input Accession Number">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="datePublished">ISBN</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="isbn" name="isbn" placeholder="Input ISBN">
															</div>
														</div>
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="program">Call No.</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="callNumber" name="callNumber" placeholder="Input Call Number">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="datePublished">Description</label>
															</div>
															<div class="form-group" style="width:100%">
																<textarea style="padding-top:65px; font-size: 17px" cols="30" rows="5" type="text" class="form-control" id="bookDescription" name="bookDescription" placeholder="Input Book Description..."></textarea>
															</div>
														</div>
													</div>
														
													<div class="row">
														<div class="col-md-6">
															<div style="width:36%; height:142px; background-color:#163269; padding: 60px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="datePublished">Subject</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="margin-bottom:5px; height:50px; font-size: 17px" type="text" class="form-control" id="subject" name="subject" placeholder="I. [Input Book Subject]">
																<textarea style="font-size: 17px" rows="3" type="text" class="form-control" for="otherSubject" id="otherSubject" name="otherSubject" placeholder="(eg. II. Organizational Behavior - Philippines and soon...)"></textarea>
															</div>
														</div>
														<div class="col-md-6">
															<div style="width:36%; height:142px; background-color:#163269; padding: 60px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="program">Author</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="margin-bottom:5px; height:50px; font-size: 17px" type="text" class="form-control" id="author" name="author" placeholder="1. [Input Author Name]">
																<textarea style="font-size: 17px" rows="3" type="text" class="form-control" for="otherAuthor" id="otherAuthor" name="otherAuthor" placeholder="(eg. 2. Arlyn Macas and soon...)"></textarea>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="datePublished">Et. Al</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<select style="height:50px; font-size: 17px;" class="form-control" name="etAl_authors" id="etAl_authors" placeholder="Input [Et. Al]"> 
																	<option value=" ">  </option>
																	<option value="[Et. Al]">[Et. Al]</option>
																</select> 
															</div>
														</div>
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="program">Author No.</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="authorNumber" name="authorNumber" placeholder="Input Author Number">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="datePublished">Glossary Page</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="glossary" name="glossary" placeholder="Input Glossary Page">
															</div>
														</div>
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="program">Bibliography Page</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="bibliography" name="bibliography" placeholder="Input Bibliography Page">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="datePublished">Appendix Page</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="appendix" name="appendix" placeholder="Input Appendix Page">
															</div>
														</div>
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="program">Index Page</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="indexNumber" name="indexNumber" placeholder="Input Index Page">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="datePublished">Includes</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="includes" name="includes" placeholder="Input Includes">
															</div>
														</div>
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="datePublished">Publisher</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="publisher" name="publisher" placeholder="Input Publisher">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="datePublished">Book Sections</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px; width: 260px; border: 1px solid rgb(0 0 0 / 23%); padding-left: 12px" type="text" list="bookSections" name="bookSection" id="bookSection" placeholder="Select Book Section">
																<datalist id="bookSections">
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
														<div class="col-md-6">
															<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																<label class="control-label" for="program">Copyright Year</label>
															</div>
															<div class="form-group" style="width:100%; padding-left:155px;">
																<input style="height:50px; font-size: 17px;" type="text" class="form-control" id="datePublished" name="datePublished" placeholder="Input Copyright Year">
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
													<a style="color:#fff" href="CSVDiscardedBookTemplate.php"> <button style="width:85%;" class="btncsv" type="submit"> Download CSV Template <i class="fas fa-file-download"></i></button></a>
												</center>
											</div>
											<br>
											<div class="modal-body" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
												<form enctype="multipart/form-data" method="post" action="HighSchoolDiscardedBulkUpload.php">
													<div class="row">
														<div class="col-md-12">
															<div class="input-container"> 
																<span for="bookscsv_file">Choose File</span>
																<input type="file" class="input" id="bookscsv_file" name="bookscsv_file" readonly>
															</div>
														</div>
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
