<?php
    require 'conn.php';

    // MOST BORROWED BOOKS
    $sql = "SELECT bookTitle, count(*) AS mostBorrowed
            FROM booktransactions
            WHERE transactionType = 'return' && libraryClass = 'Grade School Library' && transactionPlace = 'Gs-Lib' && MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE)
            GROUP BY bookTitle ORDER BY mostBorrowed DESC LIMIT 5";



    $result = mysqli_query($conn,$sql);

    $test = array();

    $count = 0;
    while($row = mysqli_fetch_array($result))
    {
        $test[$count]["label"] = $row["bookTitle"];
        $test[$count]["y"] = $row["mostBorrowed"];
        $count = $count + 1;
    }

    // MOST BORROWED BOOK SECTIONS
    $sql2 = "SELECT bookSection, count(*) AS mostBorrowed
            FROM booktransactions
            WHERE transactionType = 'return' && libraryClass = 'Grade School Library' && transactionPlace = 'Gs-Lib' && MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE)
            GROUP BY bookSection ORDER BY mostBorrowed DESC LIMIT 5";

    $result2 = mysqli_query($conn,$sql2);

    $test2 = array();

    $count2 = 0;
    while($row2 = mysqli_fetch_array($result2))
    {
        $test2[$count2]["label"] = $row2["bookSection"];
        $test2[$count2]["y"] = $row2["mostBorrowed"];
        $count2 = $count2 + 1;
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
<!-- bootstrap wysihtml5 - text editor -->
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="buttonhover.css"> 
<link rel="stylesheet" type="text/css" href="css/filter-button.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>GS Library Most Borrowed Books</title>
<script>
    window.onload = function() {
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
            text: "MOST BORROWED BOOKS"
        },
        axisY: {
            // title: "Gold Reserves (in tonnes)"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.##",
            indexLabelFontColor: "#36454F",
            indexLabelFontSize: 18,
            indexLabelFontWeight: "bolder",
            dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        title: {
            text: "MOST BORROWED BOOK SECTIONS"
        },
        subtitles: [{
            // text: "November 2017"
        }],
        data: [{
            type: "pie",
            yValueFormatString: "#,##0",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($test2, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    }

</script>
</head>
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}

    .a.canvasjs-chart-credit {
		display: none; !important;
	}

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
                    <!-- <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="glyphicon glyphicon-th-list"></i> Go to</a></li>
                        <button type="button" class="btn btn-white btn-sm"> <a href="admin.php?action=CollegeMostBorrowedBooks"> HED Library</a> </button> 
                        <button type="button" class="btn btn-white btn-sm"> <a href="admin.php?action=HighSchoolMostBorrowedBooks"> HS/SHS Library</a> </button>
                        <button type="button" class="btn btn-white btn-sm"> <a href="admin.php?action=ElementaryMostBorrowedBooks"> Grade School Library</a> </button> 
                    </ol>
                    <br> -->
                </section>

                <!-- Main content -->
                 <section style="background-color:transparent">
                        <div class="col-xs-12" style="padding: 0px 30px 10px 30px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
                                <div class="col-md-3"></div>
                                    <br>
                                    <center>
                                        <div class="small-box bg" style="background-image: url(images/background.jpg); color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
                                            <p style="font-size:35px; transform: scale(1, 2);">
                                                MOST BORROWED BOOKS
                                            </p>
                                        </div>
                                    </center>
                                    <br>
                                    <center style="padding: 0px 50px 0px 50px">
                                        <div class="row" style="width:100%; background-color: rgba(57, 43, 43, 0.239); border-radius:10px; padding: 25px 15px 10px 15px">
                                            <div class="col-lg-6">
                                                <div id="chartContainer" style="height: 370px; width: 100%; opacity: 5;"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                    <!-- <div class = "row">
                                        <div id="chartContainer" style="height: 370px; width: 45%;"></div>
                                        <div id="chartContainer2" style="height: 370px; width: 45%;"></div>
                                    </div> -->
                                    <hr style="border-top:1px dotted #000;"/>
                                    <br>
                                    <div class="noprint">
                                        <form class="form-inline" method="POST" action="">
                                            <center>
												<div class="wrap-filter" class="noprint">
                                                    <div class="filter-input-group"> 
														<label class="filter-input-label">CLASS SECTION</label>
														<select class="filter-input-box" for="classSection" name="classSection" id="classSection">
															<option value="<?php echo isset($_POST['classSection']) ? $_POST['classSection'] : '' ?>" > <?php echo isset($_POST['classSection']) ? $_POST['classSection'] : '' ?></option>
															<?php
																$libusers = DB:: getInstance()->query("SELECT DISTINCT classSection FROM library_users WHERE departmentType = 'Grade School Department' ORDER BY id ASC");							
																foreach($libusers->results() as $libusers){
															?>
															<option value="<?php echo $libusers->classSection?>"><?php echo ucwords($libusers->classSection) ?></option>
															<?php }?>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">BOOK SECTION</label>
														<select class="filter-input-box" for="bookSection" name="bookSection" id="bookSection">
															<option value="<?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?>" > <?php echo isset($_POST['bookSection']) ? $_POST['bookSection'] : '' ?></option>
															<?php
																$books = DB:: getInstance()->query("SELECT DISTINCT bookSection FROM books WHERE libraryClass = 'Grade School Library' ORDER BY id ASC");							
																foreach($books->results() as $books){
															?>
															<option value="<?php echo $books->bookSection?>"><?php echo ucwords($books->bookSection) ?></option>
															<?php }?>
														</select> 
													</div>

													<button class="filtersbtn" name="filterbook"><i class="fa fa-filter"></i></button>
													<a class="filtersbtn" href="admin.php?action=ElementaryMostBorrowedBooks"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
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
												<th>ID Number</th>
                                                <th>Loaner</th>
                                                <th>Class Set</th>
												<th>Accession Number</th>
												<th>Title</th>
                                                <th>Section</th>
                                            </tr>
                                        </thead>
                                        <tbody>
												<?php include 'HighSchoolMostBorrowedBooksFilter.php'?>	
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
