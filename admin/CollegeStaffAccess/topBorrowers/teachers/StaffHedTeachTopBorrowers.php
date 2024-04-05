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
<link rel="stylesheet" href="buttonhover.css">   
<link rel="stylesheet" type="text/css" href="css/input-filter-btn.css">
<link rel="stylesheet" href="admin-b-r-button.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>HED TEACHERS LIBRARY USERS</title>

</head>
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}

    a.canvasjs-chart-credit,  a.canvasjs-chart-credit * {
        display: none; !important;
    }

    .styled-text {
        display: none;
    }

    #currentMonthAndYear {
        display: none;
    }

    .table-label {
        display: none;
    }

    .statLabel {
        font-size: 23px; 
        font-weight: 900; 
        font-family: sans-serif; 
        text-transform: uppercase;
        background-color: #163269; 
        border: 1px solid #333; 
        color: white; 
        padding: 3px 0px 5px 0px; 
        border-radius: 20px; 
        margin: 10px 47px'
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
        text-transform: uppercase;
	}

    .under-label-btn {
		margin-top: -53px;
		position: relative;
	}

	@media print {
		.noprint, .noprint * {
			display: none; !important;
		}
        
        .small-box, .small-box * {
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

        a.canvasjs-chart-credit,  a.canvasjs-chart-credit * {
            display: none; !important;
        }

        .box-body.table-responsive, .box-body.table-responsive {
            page-break-inside: avoid;
        }

        section.content-header {
            display: none; !important;
        }

        .box-body.table-responsive {
            position: absolute;
        }

        .row, .row * {
            page-break-inside: avoid;
            column-count: 1;
            zoom: 97%;
           
        }

        .statLabel {
            font-size: 20px; 
            font-weight: 900; 
            font-family: sans-serif; 
            text-transform: uppercase;
            background-color: #163269; 
            border: 1px solid #333; 
            color: white; 
            padding: 3px 0px 5px 0px; 
            border-radius: 20px; 
            margin: 10px 10px;
        }
      
        .col-lg-6 {
            max-width: 100%;
            height: 370px;
           
            /* border: 1px solid black; */
            margin-bottom: 30px;
        }

        .printGraph {
            display: flex;
            flex-direction: row;
        }

        .styled-text {
            display: block;
            font-size: 23px;
            font-family: Arial; 
            font-weight: 900;
            transform: scale(1.5, 2);
        }

        tr:nth-child(-n+5) {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            font-style: italic;
        }

        .table-label {
            display: block;
            font-family: Arial;
            font-size: 24px;
            font-weight: bold;
        }

        @page {
            size: A4 landscape;
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
                        <a href="admin.php?action=StaffHedStudTopBorrowers"><button type="button" class="btn" style="color: #3db166;">Students</button></a> 
                        <a href="admin.php?action=StaffHedTeachTopBorrowers"><button type="button" class="btn" style="background: #3db166; color:white">Teachers</button></a> 
                    </ol>
                    </center>
                </section>

                <!-- Main content -->
                    <section style="background-color:transparent">
                        <div class="col-xs-12" style="padding: 0px 30px 10px 30px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
                                <div class="col-md-3"></div>
                                    <br>
                                    <center>
                                        <div class="small-box bg">
                                            <p> TOP BOOK BORROWERS  </p>
                                        </div>
                                        <div class="under-label-btn">
                                            <a style="color: #fff;" href="admin.php?action=StaffHedTeachTopBorrowers"><button type="button" style="background: #3db166; color:white" class="abtnb">TABLE DATA </button></a>
                                            <a style="color: #fff;" href="admin.php?action=StaffHedTeachTopBorrowersGraph"><button type="button" style="background: #fff; color: #3db166;" class="abtnr">GRAPHICAL DATA</button></a> 
                                        </div>
                                    </center>
                                    <center>
                                        <p class="styled-text">HED TOP BOOK BORROWERS RECORD</p>
                                    </center>
                                    <br>
                                    <div class="noprint">
                                        <form class="form-inline" method="POST" action="">
                                            <center>
												<div class="wrap-filter">
                                                    <div class="filter-input-group"> 
                                                        <label class="filter-input-label">FROM DATE</label>
                                                        <input type="date" class="date-filter-input-box" placeholder="Start"  name="firstDate" value="<?php echo isset($_POST['firstDate']) ? $_POST['firstDate'] : '' ?>" />
                                                    </div>
                                                    <div class="filter-input-group"> 
                                                        <label class="filter-input-label">TO DATE</label>
                                                        <input type="date" class="date-filter-input-box" placeholder="End"  name="secondDate" value="<?php echo isset($_POST['secondDate']) ? $_POST['secondDate'] : '' ?>" />
                                                    </div>
                                                    <div class="filter-input-group"> 
														<label class="filter-input-label">GENDER</label>
														<select class="filter-input-box" for="gender" name="gender" id="gender">
                                                            <option value="<?php echo isset($_POST['gender']) ? $_POST['gender'] : '' ?>" > <?php echo isset($_POST['gender']) ? $_POST['gender'] : '' ?></option>
                                                            <option value="">None</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
														</select> 
													</div>
                                                    <div class="filter-input-group"> 
														<label class="filter-input-label">DEPARTMENT</label>
														<select class="filter-input-box" for="departmentType" name="departmentType" id="departmentType">
                                                            <option value="<?php echo isset($_POST['departmentType']) ? $_POST['departmentType'] : '' ?>" > <?php echo isset($_POST['departmentType']) ? $_POST['departmentType'] : '' ?></option>
                                                            <option value="">None</option>
                                                            <option value="Higher Education Department">Higher Education Department</option>	
                                                            <option value="Senior High School Department">Senior High School Department</option>	
                                                            <option value="Junior High School Department">Junior High School Department</option>
                                                            <option value="Grade School Department">Grade School Department</option>		
														</select> 
													</div>
													<button class="filtersbtn noprint" name="filter"><i class="fa fa-filter"></i></button>
													<a class="filtersbtn noprint" href="admin.php?action=StaffHedTeachTopBorrowers"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
                                                    <button class="filtersbtn noprint" name="search" onclick="window.print();"><i class="fa fa-print"></i></button>
												</div>
											</center>
                                        </form>
                                    </div>
                                <div class="box-body table-responsive">
                                    <?php if(Session::exists('Deleted')){ ?>
                                             <div class="alert alert-danger">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Deleted'); ?>
                                             </div>
                                    <?php }?> 
                                    <table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
                                                <th style="width:1%">#</th>
                                                <th>Loaner ID</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Department</th>
                                                <th style="width:7%">Total Logged</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include 'StaffHedTeachTopBorrowersFilter.php'?>
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
<!-- Bootstrap WYSIHTML5 -->
<script src="styles/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<script src="styles/admin/js/AdminLTE/canvasjs.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
    $(function() {
        $("#articles").dataTable();
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
</script>
</body>

</html>
