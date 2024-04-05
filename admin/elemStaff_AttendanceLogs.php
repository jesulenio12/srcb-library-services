<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current
			
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
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<title>QRBASEDLMS - Book Loaning Transaction</title>
<style>
.btn-huge{
	width:100%;
    padding:35px;
}
</style>
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Book Loaning Transaction
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active"> Book Loaning Transaction</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-book"></i> Book Transaction Type</h3>                           
                                </div><!-- /.box-header -->
                                <div class="box-body">
									<div class="row">
										<div class="col-xs-6">
											<a href="admin.php?action=borrowBooks" type="button" class="btn btn-info btn-lg btn-huge">Borrow Books</a>
											<?php if(Session::exists('Borrowed')){ ?>
												<div class="alert alert-success">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Borrowed'); ?>
												</div>
											<?php }?> 
										</div>
										<div class="col-xs-6">
											<a href="admin.php?action=returnBooks" type="button" class="btn btn-warning btn-lg btn-huge">Return Books</a>
											<?php if(Session::exists('Returned')){ ?>
												<div class="alert alert-success">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Returned'); ?>
												</div>
											<?php }?> 
										</div>
									</div>
								</div><!-- /.box -->
								
							</div><!-- /.box -->
						</div><!-- /.col -->
                    </div><!-- /.row (main row) -->
					<section class="col-lg-6 connectedSortable"> 
						<!-- Box (with bar chart) -->
						<div class="box box-success" id="loading-example">
							<div class="box-header">
								<i class="fa fa-user"></i>
								<h3 class="box-title">Transaction History (Borrowed Books)</h3>
							</div><!-- /.box-header -->
							<div class="box-body table-responsive">
							<table class="table table-bordered table-hover" id="borrow">
                            <thead>
                                <tr>
                                    <th>Accession No. </th>
                                    <th>Title</th>
                                    <th>Loaner Name</th>
                                    <th>Loaner Type</th>
                                    <th>Date Borrowed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    //$bookstransact = DB:: getInstance()->query("SELECT * FROM booktransactions WHERE departmentType = 'Higher Education Department' && departmentType = 'Senior High School Department' && departmentType = 'Junior High School Department' && transactionType='borrow'");		
                                    $bookstransact = DB:: getInstance()->query("SELECT * FROM booktransactions WHERE departmentType = 'Higher Education Department' && transactionType='borrow'");
                                    $bookstransact = DB:: getInstance()->query("SELECT * FROM booktransactions WHERE departmentType = 'Senior High School Department' && transactionType='borrow'");		
                                    $bookstransact = DB:: getInstance()->query("SELECT * FROM booktransactions WHERE departmentType = 'Junior High School Department' && transactionType='borrow'");				
                                    foreach($bookstransact->results() as $bookstransact){ ?>
                                            <tr>
                                                <td><?php echo $bookstransact->bookAccession ; ?></td>
                                                <td><?php echo $bookstransact->bookTitle ; ?></td>
                                                <td>
                                                    <?php echo $bookstransact->firstname ; ?>
                                                    <?php echo $bookstransact->lastname ; ?>
                                                </td>
                                                <td><?php echo $bookstransact->userType; ?></td>
                                                <td><?php echo $bookstransact->transactionDate ; ?></td>
                                            </tr>
                                            
                                    <?php 
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body --
						</div><!-- /.box -->        
					</section><!-- /.Left col -->
					<!-- right col (We are only adding the ID to make the widgets sortable)-->
					<section class="col-lg-6 connectedSortable">
						<!-- Map box -->
						<div class="box box-success" id="loading-example">
							<div class="box-header">
								<!-- tools box -->
								<i class="fa fa-user"></i>
								<h3 class="box-title">Transaction History (Returned Books)</h3>
							</div><!-- /.box-header -->
							<div class="box-body table-responsive">
							<table class="table table-bordered table-hover" id="return">
                            <thead>
                                <tr>
                                    <th>Accession No. </th>
                                    <th>Title</th>
                                    <th>Loaner Name</th>
                                    <th>Loaner Type</th>
                                    <th>Date Returned</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    //$bookstransact = DB:: getInstance()->query("SELECT * FROM booktransactions WHERE departmentType = 'Higher Education Department' && departmentType = 'Senior High School Department' && departmentType = 'Junior High School Department' && transactionType='return'");		
                                    $bookstransact = DB:: getInstance()->query("SELECT * FROM booktransactions WHERE departmentType = 'Higher Education Department' && transactionType='return'");
                                    $bookstransact = DB:: getInstance()->query("SELECT * FROM booktransactions WHERE departmentType = 'Senior High School Department' && transactionType='return'");		
                                    $bookstransact = DB:: getInstance()->query("SELECT * FROM booktransactions WHERE departmentType = 'Junior High School Department' && transactionType='return'");				
                                    foreach($bookstransact->results() as $bookstransact){ ?>
                                            <tr>
                                                <td><?php echo $bookstransact->bookAccession ; ?></td>
                                                <td><?php echo $bookstransact->bookTitle ; ?></td>
                                                <td>
                                                    <?php echo $bookstransact->firstname ; ?>
                                                    <?php echo $bookstransact->lastname ; ?>
                                                </td>
                                                <td><?php echo $bookstransact->userType; ?></td>
                                                <td><?php echo $bookstransact->transactionDate ; ?></td>
                                            </tr>
                                    <?php 
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body --
						</div><!-- /.box -->
					</section><!-- right col -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
	<!-- jQuery 2.0.2 -->
	<script src="styles/admin/js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- DATA TABES SCRIPT -->
	<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
	<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
	<!-- Bootstrap Validator JS -->
	<script src="styles/admin/js/bootstrapValidator.min.js"></script>
	<!-- page script -->
	<script type="text/javascript">
		$(function() {
			$("#borrow").dataTable();
		});
		function printImg(url) {
		  var win = window.open('');
		  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
		  win.focus();
		}
	</script>
	<script type="text/javascript">
		$(function() {
			$("#return").dataTable();
		});
		function printImg(url) {
		  var win = window.open('');
		  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
		  win.focus();
		}
	</script>
</body>
</html>

