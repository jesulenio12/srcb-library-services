
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
<title>QRBASEDLMS - Book List </title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}

	@media print{
		.noprint, .noprint * {
			display: none; !important;
		}

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
						Book List 
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Book List </li>
                    </ol>
					<br>
					<div class="row">
						<div class="col-lg-4 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-blue">
							<?php 
							$books = DB:: getInstance()->query("SELECT * FROM books ");
							$countBooks =DB:: getInstance()->count($books);?>
								<div class="inner">
									<h3>
										<?php echo $countBooks; ?>
									</h3>
									<p>
									Total Books
									</p>
								</div>
								<div class="icon">
									<i class="fa fa-book"></i>
								</div>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-4 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-blue">
							<?php 
							$booksBorrowed = DB:: getInstance()->query("SELECT * FROM books WHERE is_borrowed=1");
							$countBookB =DB:: getInstance()->count($booksBorrowed);?>
								<div class="inner">
									<h3>
										<?php echo $countBookB; ?>
									</h3>
									<p>
										Books Borrowed
									</p>
								</div>
								<div class="icon">
									<i class="fa fa-book"></i>
								</div>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-4 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-blue">
							<?php 
							$booksAvailable = DB:: getInstance()->query("SELECT * FROM books WHERE is_borrowed=0");
							$countBookA =DB:: getInstance()->count($booksAvailable);?>
								<div class="inner">
									<h3>
										<?php echo $countBookA; ?>
									</h3>
									<p>
										Books Available
									</p>
								</div>
								<div class="icon">
									<i class="fa fa-book"></i>
								</div>
							</div>
						</div><!-- ./col -->
        			</div><!-- /.row -->
                </section>

				
                <!-- Main content -->
                <section class="content">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
									<div align="center">
										<h3 class="box-title">Book Master List</h3> 
										<br>
									</div>
									
									<br>		
									<form method="GET" action="" style="margin-top: -15px;">
											<br>
											<div class="col-md-2" style="margin-right: -20px;">
												<div class="form-group">
													<label>From Date</label>
													<input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control" data-date-format='yyyy-mm-dd'>
												</div>
											</div>
											<div class="col-md-2" style="margin-right: -20px;">
												<div class="form-group">
													<label>To Date</label>
													<input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control" data-date-format='yyyy-mm-dd'>
												</div>
											</div>
											<div class="col-md-2" style="margin-top: 20px;">
												<div class="form-group">
												<button type="submit" style="margin-right:3px;" class="btn btn-primary noprint"> <a style="color:white;" href="admin.php?action=BookPrint"> Filter</button></a>
												<button type="button" style="margin:3px;" class="btn btn-primary noprint" onclick="window.print();"> Print</button>	
												</div>
											</div>
										</div>
										
									</form>								    
                                                                  
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <?php if(Session::exists('Removed')){ ?>
                                             <div class="alert alert-danger">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Removed'); ?>
                                             </div>
                                    <?php }?> 
                                    <?php if(Session::exists('Updated')){ ?>
                                             <div class="alert alert-success">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Updated'); ?>
                                             </div>
                                    <?php }?>
									<?php if(Session::exists('Added')) { ?>
										<div class="alert alert-success">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Added'); ?>
										</div>
									<?php }?>
									
                                    <table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
												<th>Accession No.</th>
												<th>Call No.</th>
												<th>ISBN</th>
												<th>Book Section</th>
												<th>Title</th>
                                                <th>Author</th>
												<th>Publisher</th>
												<th>Date Published</th>
												<th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
                                               if(isset($_GET['from_date'])!='' && isset($_GET['to_date'])!='')
											   {
												
												$from_date = $_GET['from_date'];
												$to_date = $_GET['to_date'];
												

												  $books = DB:: getInstance()->query("SELECT * FROM books WHERE datePublished BETWEEN '$from_date' AND '$to_date'");
												  foreach($books->results() as $books){ ?>
													  <?php if($books->status =='0'){?>
														  <tr>
															  <td><?php echo $books->bookAccession ; ?></td>
															  <td><?php echo $books->callNumber ; ?></td>
															  <td><?php echo $books->isbn ; ?></td>
															  <td><?php echo $books->bookSection ; ?></td>
															  <td><?php echo $books->bookTitle ; ?></td>
															  <td><?php echo $books->author ; ?></td>
															  <td><?php echo $books->publisher ; ?></td>
															  <td><?php echo $books->datePublished ; ?></td>
															  <td align="center">
																  <?php if($books->is_borrowed == 1){?>
																	  <span class="label label-danger"> Not Available</span>
																  <?php }else{?>
																	  <span class="label label-success"> Available</span>
																  <?php }?>
																  
															  </td>
														  </tr>
													  <?php
													  }
													  else{
														  // Not belong
													  }
													  ?>	
												  
												  <?php 
												  		
													}
														
												  }
												  	
											   
											   else{
												$books = DB:: getInstance()->query("SELECT * FROM books WHERE status='0'");
                                                if($books->results() > 0){
												foreach($books->results() as $books){ ?>
														<tr>
															<td><?php echo $books->bookAccession ; ?></td>
															<td><?php echo $books->callNumber ; ?></td>
															<td><?php echo $books->isbn ; ?></td>
															<td><?php echo $books->bookSection ; ?></td>
															<td><?php echo $books->bookTitle ; ?></td>
															<td><?php echo $books->author ; ?></td>
															<td><?php echo $books->publisher ; ?></td>
															<td><?php echo $books->datePublished ; ?></td>
															<td align="center">
																<!-- Updated code Sept-18-22-->
																<?php if($books->is_borrowed == 1){?>
																	<span class="label label-danger"> Not Available</span>
																<?php }else{?>
																	<span class="label label-success"> Available</span>
																<?php }?>
																
															    <!-- Updated code Sept-18-22-->
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
