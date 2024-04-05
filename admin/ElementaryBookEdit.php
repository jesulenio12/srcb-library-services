<?php
if (Input::exists()) {
    $book = new Books();
    try {
        $book->update(array(
			'bookTitle' => Input::get('bookTitle'),
			'bookAccession' => 'Acc:'.' '.Input::get('bookAccession'),
			'isbn' => Input::get('isbn'),
			'callNumber' => Input::get('callNumber'),
			'bookDescription' => Input::get('bookDescription'),
			'subject' => Input::get('subject'),
			'otherSubject' => Input::get('otherSubject'),
			'author' => Input::get('author'),
			'otherAuthor' => '/'.Input::get('otherAuthor'),
			'etAl_authors' => Input::get('etAl_authors'),
			'authorNumber' => Input::get('authorNumber'),
			'glossary' => 'Glossary: p.'.' '.Input::get('glossary'),
			'bibliography' => 'Bibliography: p.'.' '.Input::get('bibliography'),
			'appendix' => 'Appendix: p.'.' '.Input::get('appendix'),
			'indexNumber' => 'Index: p.'.' '.Input::get('indexNumber'),
			'includes' => 'Includes'.' '.Input::get('includes'),
			'publisher' => Input::get('publisher'),
			'datePublished' => Input::get('datePublished'),
			'bookSection' => Input::get('bookSection'),
        ), $_GET['id']);

        Session::flash('Updated', 'Book Info has been successfully updated.');
        Redirect::to('admin.php?action=gsBookViewCopies&bookTitle=' . urlencode($_GET['bookTitle']));
    } catch (Exception $e) {
        $error;
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
<link rel="stylesheet" type="text/css" href="css/bookaddInputs.css">
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>GS Book Edit </title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}

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

</style>

<body class="skin-blue"  style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="background-color:transparent">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="background-color:transparent">
                    
                </section>

                <!-- Main content -->
                <section class="col-lg-12 connectedSortable">
                    <div class="col-xs-12" style="padding: 0px 15px 10px 15px">
                        <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
							<br>
							<center>
								<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
									<p style="font-size:35px; transform: scale(1, 2); text-transform:uppercase">
										Update Book Information
									</p>
								</div>
							</center>
							<br>
                            <div class="box-body" style="padding: 0px 100px 0px 100px">
								<?php if(Session::exists('bookUpdated')){ ?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('bookUpdated'); ?>
                                    </div>
								<?php }?>
                                <?php 
									$books = DB:: getInstance()->get('books', array('id','=',$_GET['id']));							
									foreach($books->results() as $books){
									?>
											<form id="editUser" action="" method="post">
													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="bookTitle">Book Title</span>
																<input type="text" class="add-input" id="bookTitle" name="bookTitle" value="<?php echo $books->bookTitle; ?>" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="bookAccession">Accession No.</span>
																<input type="text" class="add-input" id="bookAccession" name="bookAccession" value="<?php echo substr($books->bookAccession, 5, 255); ?>" required>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="isbn">ISBN</span>
																<input type="text" class="add-input" id="isbn" name="isbn" value="<?php echo $books->isbn; ?>" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="callNumber">Call No.</span>
																<input type="text" class="add-input" id="callNumber" name="callNumber" value="<?php echo $books->callNumber; ?>">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															<div style="width:46.5%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius: 5px 0 0 5px"> 
																<label class="control-label" for="bookDescription">Description</label>
															</div>
															<div class="form-group" style="width:100%; margin-bottom: 0px">
																<textarea style="padding-top:65px; font-size: 15px; border: 2px solid #163269; border-radius:6px" cols="30" rows="5" type="text" class="form-control" id="bookDescription" name="bookDescription"><?php echo $books->bookDescription; ?></textarea>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="subject">Subject</span>
																<input type="text" class="add-input" id="subject" name="subject" value="<?php echo $books->subject; ?>">
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="otherSubject">Other Subject</span>
																<input type="text" class="add-input" id="otherSubject" name="otherSubject" value="<?php echo $books->otherSubject; ?>">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="author">Author</span>
																<input type="text" class="add-input" id="author" name="author" value="<?php echo $books->author; ?>">
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="otherAuthor">Other Author</span>
																<input type="text" class="add-input" id="otherAuthor" name="otherAuthor" value="<?php echo $books->otherAuthor; ?>">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="authorNumber">Author No.</span>
																<input type="text" class="add-input" id="authorNumber" name="authorNumber" value="<?php echo $books->authorNumber; ?>">
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="etAl_authors">Et. Al</span>
																<input type="text" class="add-input" id="etAl_authors" name="etAl_authors" value="<?php echo $books->etAl_authors; ?>">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="glossary">Glossary Page</span>
																<input type="text" class="add-input" id="glossary" name="glossary" value="<?php echo substr($books->glossary, 13, 255); ?>">
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="bibliography">Bibliography Page</span>
																<input type="text" class="add-input" id="bibliography" name="bibliography" value="<?php echo substr($books->bibliography, 17, 255); ?>">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="appendix">Appendix Page</span>
																<input type="text" class="add-input" id="appendix" name="appendix" value="<?php echo substr($books->appendix, 13, 255); ?>">
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="indexNumber">Index Page</span>
																<input type="text" class="add-input" id="indexNumber" name="indexNumber" value="<?php echo substr($books->indexNumber, 10, 255); ?>">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="includes">Includes</span>
																<input type="text" class="add-input" id="includes" name="includes" value="<?php echo substr($books->includes, 9, 255); ?>">
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="publisher">Publisher</span>
																<input type="text" class="add-input" id="publisher" name="publisher" value="<?php echo $books->publisher; ?>">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="bookSections">Book Sections</span>
																<input type="text" class="add-input" list="bookSections" name="bookSection" id="bookSection" value="<?php echo $books->bookSection; ?>">
																<datalist id="bookSections">
																	<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
																	<?php
																		$bookSec = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'Grade School Library' ORDER BY id ASC");							
																		foreach($bookSec->results() as $bookSec){
																	?>
																	<option value="<?php echo $bookSec->bookSection?>"><?php echo ucwords($bookSec->bookSection) ?></option>
																	<?php }?>
																</datalist>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="datePublished">Copyright Year</span>
																<input type="text" class="add-input" id="datePublished" name="datePublished" value="<?php echo $books->datePublished; ?>">
															</div>
														</div>
													</div>

												<div class="clearfix"></div><hr />
												<div class="row">
													<div class=" col-md-6">
														<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
															<button type="submit" class="btnupdate" style="color: #fff">&nbsp;UPDATE</button>
													</div>
													<div class=" col-md-6">
														<a style="color: #fff;" href="admin.php?action=gsBookViewCopies&bookTitle=<?php echo urlencode($_GET['bookTitle']); ?>">
															<button type="button" class="btncancel">CANCEL</button>
														</a>
													</div>
												</div>
												<br />
											</form>
								<?php }?>                 
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
<script type="text/javascript">
	$(document).ready(function() {
        var validator = $("#editUser").bootstrapValidator({
			fields : {
				username : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Username cannot be empty.",
						},
					}
				},
				userRole : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Please select a User Role.",
						},
					}
			}
		});
    });
</script>
</body>
</html>