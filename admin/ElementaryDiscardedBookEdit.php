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
			Redirect::to('admin.php?action=ElementaryDiscardedBooks');
            } catch(Exception $e) {
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
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>Book Discarded Edit </title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
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
									<p style="font-size:35px; transform: scale(1, 2);">
										Edit Book Information
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
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="datePublished">Book Title</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="bookTitle" name="bookTitle" placeholder="Input Title of the Book" value="<?php echo $books->bookTitle; ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="program">Accession No.</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="bookAccession" name="bookAccession" placeholder="Input Accession Number" value="<?php echo substr($books->bookAccession, 5, 255); ?>">
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="datePublished">ISBN</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="isbn" name="isbn" placeholder="Input ISBN" value="<?php echo $books->isbn; ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="program">Call No.</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="callNumber" name="callNumber" placeholder="Input Call Number" value="<?php echo $books->callNumber; ?>">
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="datePublished">Description</label>
														</div>
														<div class="form-group" style="width:99%">
															<textarea style="padding-top:65px; font-size: 17px" cols="30" rows="5" type="text" class="form-control" id="bookDescription" name="bookDescription" placeholder="Input Book Description..."><?php echo $books->bookDescription; ?></textarea>
														</div>
													</div>
												</div>
													
												<div class="row">
													<div class="col-md-6">
														<div style="width:25%; height:142px; background-color:#163269; padding: 60px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="datePublished">Subject</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="margin-bottom:5px; height:50px; padding-left:20px; font-size: 17px" type="text" class="form-control" id="subject" name="subject" placeholder="I. [Input Book Subject]" value="<?php echo $books->subject; ?>">
															<textarea style="font-size: 17px; padding-left:20px;" rows="3" type="text" class="form-control" for="otherSubject" id="otherSubject" name="otherSubject" placeholder="(eg. II. Organizational Behavior - Philippines and soon...)"><?php echo $books->otherSubject; ?></textarea>
														</div>
													</div>
													<div class="col-md-6">
														<div style="width:25%; height:142px; background-color:#163269; padding: 60px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="program">Author</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="margin-bottom:5px; height:50px; padding-left:20px; font-size: 17px" type="text" class="form-control" id="author" name="author" placeholder="1. [Input Author Name]"value="<?php echo $books->author; ?>">
															<textarea style="font-size: 17px; padding-left:20px;" rows="3" type="text" class="form-control" for="otherAuthor" id="otherAuthor" name="otherAuthor" placeholder="(eg. 2. Arlyn Macas and soon...)"><?php echo $books->otherAuthor; ?></textarea>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="datePublished">Et. Al</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<select style="height:50px; font-size: 17px; padding-left:20px;" class="form-control" name="etAl_authors" id="etAl_authors" placeholder="Input [Et. Al]" value="<?php echo $books->etAl_authors; ?>"> 
																<option value=" ">  </option>
																<option value="[Et. Al]">[Et. Al]</option>
															</select> 
														</div>
													</div>
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="program">Author No.</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="authorNumber" name="authorNumber" placeholder="Input Author Number" value="<?php echo $books->authorNumber; ?>">
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="datePublished">Glossary Page</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="glossary" name="glossary" placeholder="Input Glossary Page" value="<?php echo substr($books->glossary, 13, 255); ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="program">Bibliography Page</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="bibliography" name="bibliography" placeholder="Input Bibliography Page" value="<?php echo substr($books->bibliography, 17, 255); ?>">
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="datePublished">Appendix Page</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="appendix" name="appendix" placeholder="Input Appendix Page" value="<?php echo substr($books->appendix, 13, 255); ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="program">Index Page</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="indexNumber" name="indexNumber" placeholder="Input Index Page" value="<?php echo substr($books->indexNumber, 10, 255); ?>">
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="datePublished">Includes</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="includes" name="includes" placeholder="Input Includes" value="<?php echo substr($books->includes, 9, 255); ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="datePublished">Publisher</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="publisher" name="publisher" placeholder="Input Publisher" value="<?php echo $books->publisher; ?>">
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="datePublished">Book Sections</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<select style="height:50px; font-size: 17px; padding-left:20px;" class="form-control" name="bookSection" id="bookSection"> 
																<option value="<?php echo $books->bookSection; ?>"><?php echo $books->bookSection; ?></option>
																	<?php
																	$bookSec = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'Grade School Library' ORDER BY id ASC");							
																	foreach($bookSec->results() as $bookSec){
																?>
																<option value="<?php echo $bookSec->bookSection?>"><?php echo ucwords($bookSec->bookSection) ?></option>
																<?php }?>
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
															<label class="control-label" for="program">Copyright Year</label>
														</div>
														<div class="form-group" style="width:97%; padding-left:155px;">
															<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="datePublished" name="datePublished" placeholder="Input Copyright Date" value="<?php echo $books->datePublished; ?>">
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
														<a style="color: #fff;" href="admin.php?action=ElementaryDiscardedBooks"><button type="button" class="btncancel">CANCEL</button></a> 
													</div>
												</div>
												<br />
											</form>
								
													<div class="modal fade" id="editBookTitle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h3 class="modal-title" id="exampleModalLabel">Edit Book Accession</h3>
														</div>
														<div class="modal-body">
															<form enctype="multipart/form-data" method="post" action="EditBookQR.php">
																<label class="control-label" for="newbookAccession"><font color="#EC0003">*</font>Book Accession</label>
																<div class="form-group">
																	<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="newbookAccession" name="newbookAccession" value="<?php echo $books->bookAccession; ?>">													
																</div>
																<input type="hidden" name="newID" value="<?php echo $books->id; ?>">
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-success" value="save"><i class="glyphicon glyphicon-edit"></i> Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
															</form>
														</div>
														</div>
													</div>
													</div>
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