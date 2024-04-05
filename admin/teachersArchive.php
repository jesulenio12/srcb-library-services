<?php
if (Input::exists()) {
	$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'bookQRCodes'.DIRECTORY_SEPARATOR;
		
		$library_users = DB:: getInstance()->get('library_users', array('id','=',Input::get('restore')));							
		foreach($library_users->results() as $library_users){
			unlink($PNG_TEMP_DIR.$library_users->qrcode);
		}
		
		$library_users = DB:: getInstance()->get('library_users', array('id','=',Input::get('restore')));
		if ($library_users->count()){
			foreach($library_users->results() as $library_users){
				$library_user = new Library_users();
				 try {
					$library_user->update(array(
						'status' => 0,
					),$library_users->id);
				} catch(Exception $e) {
				   $error;
				}
			}
		}else{
			$library_users = DB:: getInstance()->get('library_users', array('id','=',Input::get('delete')));							
			foreach($library_users->results() as $library_users){
			unlink($PNG_TEMP_DIR.$library_users->qrcode);
		}$contents = DB:: getInstance()->delete('library_users', array('id','=',Input::get('delete')));	
		Session::flash('Deleted', 'Library user has been successfully deleted.');
		Redirect::to('admin.php?action=teachersArchive');	
	
		}																	
		Session::flash('Activated', 'Library user has been successfully activated.');
		Redirect::to('admin.php?action=teachersArchive');
}
?>



<!-- For Book Archive-->

<!-- For Book Archive-->
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
<!-- bootstrap wysihtml5 - text editor -->
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>QRBASEDLMS - Library Users Archive List</title>
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
				<section class="content-header">
                    <h1> Library Users Archive List </h1>
					<ol class="breadcrumb">
						<li><a href="admin.php"><i class="glyphicon glyphicon-th-list"></i> Go to</a></li>
						<button type="button" class="btn btn-white btn-sm"> <a href="admin.php?action=bookArchive"> Book Archive</a> </button>
						<button type="button" class="btn btn-white btn-sm"> <a href="admin.php?action=staffArchive"> Library Staff Archive</a> </button>
						<button type="button" class="btn btn-white btn-sm"> <a href="admin.php?action=studentsArchive"> Library Users Archive</a> </button>
                    </ol>
					<br>
                </section>

                <!-- Main content -->
                <section class="content">
                        <div class="col-xs-12">
                            <div class="box box-primary">
								<div class="box-header">
									<ol class="breadcrumb">
										<li><a href="admin.php"><i class="glyphicon glyphicon-th-list"></i></a></li>
										<button type="button" class="btn-white btn-primary btn-sm"> <a style="color:white" href="admin.php?action=studentsArchive"> Students</a> </button>
										<button type="button" class="btn-white btn-primary btn-sm"> <a style="color:white" href="admin.php?action=teachersArchive"> Teachers</a> </button>
									</ol>
								</div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <?php if(Session::exists('Deleted')){ ?>
                                             <div class="alert alert-danger">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Deleted'); ?>
                                             </div>
                                    <?php }?> 
                                    <?php if(Session::exists('Restored')){ ?>
                                             <div class="alert alert-success">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Restored'); ?>
                                             </div>
                                    <?php }?>
                                    <table class="table table-bordered table-hover" id="lib-users">
                                        <thead>
                                            <tr>
												<th>ID Number</th>
												<th>Firstname</th>
												<th>Lastname</th>
												<th>Gender</th>
                                                <th>Department</th>
												<th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$library_users = DB:: getInstance()->query("SELECT * FROM library_users WHERE status=1");
												foreach($library_users->results() as $library_users){ ?>
												  <?php if($library_users->userType =='Teacher'){?>
														<tr>
                                                            <td><?php echo $library_users->library_userID ; ?></td>
															<td><?php echo $library_users->firstname ; ?></td>
															<td><?php echo $library_users->lastname ; ?></td>
															<td><?php echo $library_users->gender ; ?></td>
															<td><?php echo $library_users->departmentType ; ?></td>
															<td align="center">
																<!-- Modal -->
																<div id="myModal_<?php echo ucwords($library_users->id); ?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	<!-- Modal content-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<h4 class="modal-title"><?php echo ucwords($library_users->library_userID); ?></h4>
																			</div>
																			<div class="modal-body" >
																				<image src="admin/teachersQRCodes/<?php echo ucwords($library_users->qrcode) ?>"/>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-primary" onclick="printImg('admin/teachersQRCodes/<?php echo ucwords($library_users->qrcode) ?>')">Print</button>
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>

																	</div>
																</div>
																<?php require_once ('delete-confirm.php');?>
																<form method="POST" action="" style="display:inline">
																	<input type="hidden" name="delete" value="<?php echo $library_users->id;  ?>">
																	<button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Confirm Deletion" data-message="Are you sure you want to delete this?">
																		<i class="glyphicon glyphicon-trash"></i> Delete
																	</button>
																</form>
																<?php require_once ('activate-confirm.php');?>
																<form method="POST" action="" style="display:inline">
																	<input type="hidden" name="restore" value="<?php echo $library_users->id;  ?>">
																	<button class="btn btn-xs btn-success" type="button" data-toggle="modal" data-target="#confirmRestore" data-title="Confirm Activation" data-message="Are you sure you want to activate?">
																		<i class="glyphicon glyphicon-ok"></i> Activate
																	</button>
																</form>
															</td>
														</tr>
												<?php
												}
												 else{
													// Not belong
												}
												?>

												<!-- end forloop -->
												<?php 
												}
												?>
                                        </tbody>
                                    </table>
                               
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
<!-- Bootstrap WYSIHTML5 -->
<script src="styles/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
    $(function() {
        $("#staff").dataTable();
    });
    $(function() {
        $("#books").dataTable();
    });
    $(function() {
        $("#lib-users").dataTable();
    });
</script>
<script type="text/javascript">
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
