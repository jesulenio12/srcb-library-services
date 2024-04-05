<?php
if (Input::exists()) {
			$book = new Books();
			
            try {
                $book->update(array(
					'bookTitle' => Input::get('bookTitle'),
					'callNumber' => Input::get('callNumber'),
					'datePublished' => Input::get('datePublished'),
					'bookAccession' => Input::get('bookAccession'),
                ), $_GET['id']);
			
			Session::flash('Updated', 'Book Info has been successfully updated.');
			Redirect::to('admin.php?action=CollegePeriodicalList');
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
<link rel="stylesheet" type="text/css" href="css/bookaddInputs.css">
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>Edit Periodical Book</title>
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
</style>

<body class="skin-blue" class="skin-blue" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">>
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="background-color:transparent">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="background-color:transparent">
                    <!-- <h1>
                        Book Information
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Edit Book Information</li>
                    </ol> -->
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
													<span for="bookTitle">Title</span>
													<input type="text" class="add-input" id="bookTitle" name="bookTitle" value="<?php echo $books->bookTitle; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="add-input-container"> 
													<span for="datePublished">Date Issued</span>
													<input type="text" class="add-input" id="datePublished" name="datePublished" data-date-format='yyyy-mm-dd' value="<?php echo $books->datePublished; ?>">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="add-input-container"> 
													<span for="callNumber">Volume No.</span>
													<input type="text" class="add-input" id="callNumber" name="callNumber" value="<?php echo $books->callNumber; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="add-input-container"> 
													<span for="bookAccession">Number</span>
													<input type="text" class="add-input" id="bookAccession" name="bookAccession" value="<?php echo $books->bookAccession; ?>">
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
													<a style="color: #fff;" href="admin.php?action=CollegePeriodicalList"><button type="button" class="btncancel">CANCEL</button></a> 
												</div>
											</div>
										<br />
                                </form>
								<!-- Modal -->
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
</body>
</html>