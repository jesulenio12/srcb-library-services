<?php
if (Input::exists()) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'hedBookQRCodes'.DIRECTORY_SEPARATOR;
		
		$books = DB:: getInstance()->get('books', array('bookAccession','=',Input::get('id')));							
		foreach($books->results() as $books){
			unlink($PNG_TEMP_DIR.$books->qrcode);
		}

		
		$books = DB:: getInstance()->get('books', array('bookAccession','=',Input::get('id')));
		if ($books->count()){
			foreach($books->results() as $books){
				$book = new Books();
				 try {
					$book->update(array(
						'is_borrowed' => 0,
						'requested' => 0,
						'status' => 'Available',
						'dateRequested' => '',
						'library_userID' => '',
						'userType' => '',
						'firstname' => '',
						'lastname' => '',
						'gender' => '',
						'yearLevel' => '',
						'classSection' => '',
						'departmentType' => '',
						'progtrack' => '',
						'libraryClass' => '',
					),$books->id);
				} catch(Exception $e) {
				   $error;
				}
			}
		}													
		
			Session::flash('Requested', 'Book has been successfully canceled.');
			Redirect::to('admin.php?action=HighSchoolLibRequestedBooks');
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
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>QRBASEDLMS - Requested Books </title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}
</style>

<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
						Requested Books 
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Requested Books </li>
                    </ol>
					<br>
                </section>

				
                <!-- Main content -->
                <section class="content">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
									<br>
                                    <?php if(Session::exists('Requested')){ ?>
                                             <div class="alert alert-success">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Requested'); ?>
                                             </div>
                                    <?php }?> 
                                    <table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
												<th>Accession No.</th>
												<th>Call No.</th>
												<th>Book Section</th>
												<th>Title</th>
                                                <th>Author</th>
												<th>Date Published</th>
												<th>Status</th>
												<th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$books = DB:: getInstance()->query("SELECT * FROM books WHERE libraryClass = 'High School Library' && requested = '1'");
                                                if($books->results() > 0){
												foreach($books->results() as $books){ 
													if($books->library_userID == $user->data()->username){
													?> 
												 
														<tr>
															<td><?php echo $books->bookAccession ; ?></td>
															<td><?php echo $books->callNumber ; ?></td>
															<td><?php echo $books->bookSection ; ?></td>
															<td><?php echo $books->bookTitle ; ?></td>
															<td><?php echo $books->author ; ?></td>
															<td><?php echo $books->datePublished ; ?></td>
															<td align="center">
																<!-- Updated code Sept-18-22-->
																<?php if($books->requested == 1){?>
																	<span class="label label-primary"> Pending... </span>
																<?php }?>
																
															    <!-- Updated code Sept-18-22-->
															</td>
															<td align="center">
															<?php require_once ('cancel-confirm.php');?>
																  <form method="POST" action="" style="display:inline">
																	  <input type="hidden" name="id" value="<?php echo $books->bookAccession;  ?>">
																	  <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmRemove" data-title="Confirm Cancelation" data-message="Are you sure you want to cancel this?">
																	  <i class="glyphicon glyphicon-remove"></i> Cancel
																	  </button>
																  </form>
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
</script>
</body>

</html>
