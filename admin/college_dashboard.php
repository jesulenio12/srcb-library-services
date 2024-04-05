<?php
    require 'conn.php';

    // TOTAL BOOK SECTIONS
    $sql = "SELECT bookSection, count(*) AS totalBSections
            FROM books
            WHERE status='Available' && discarded='0' && lost='0' && bookSection != 'Periodical' && libraryClass = 'College Library'
            GROUP BY bookSection ORDER BY totalBSections DESC";

    $result = mysqli_query($conn,$sql);

    $test = array();

    $count = 0;
    while($row = mysqli_fetch_array($result))
    {
        $test[$count]["label"] = $row["bookSection"];
        $test[$count]["y"] = $row["totalBSections"];
        $count = $count + 1;
    }

    // TOTAL STUDENT BY PROGRAM
    $sql2 = "SELECT progtrack, count(*) AS totalProgram
            FROM userlogin
            WHERE archive = 0 && libraryClass = 'College Library' && departmentType = 'Higher Education Department' && userType = 'Student'
            GROUP BY progtrack ORDER BY totalProgram DESC";

    $result2 = mysqli_query($conn,$sql2);

    $test2 = array();

    $count2 = 0;
    while($row2 = mysqli_fetch_array($result2))
    {
        $test2[$count2]["label"] = $row2["progtrack"];
        $test2[$count2]["y"] = $row2["totalProgram"];
        $count2 = $count2 + 1;
    }

    // TOTAL TEACHER
    $sql3 = "SELECT userType, count(*) AS totalTeacher
            FROM userlogin
            WHERE archive = 0 && libraryClass = 'College Library' && departmentType = 'Higher Education Department' && userType = 'Teacher'
            GROUP BY userType ORDER BY totalTeacher DESC";

    $result3 = mysqli_query($conn,$sql3);

    $test3 = array();

    $count3 = 0;
    while($row3 = mysqli_fetch_array($result3))
    {
        $test3[$count3]["label"] = $row3["userType"];
        $test3[$count3]["y"] = $row3["totalTeacher"];
        $count3 = $count3 + 1;
    }

    // TOTAL TEACHER
    $sql4 = "SELECT yearLevel, count(*) AS totalSyearLevel
            FROM userlogin
            WHERE archive = 0 && libraryClass = 'College Library' && departmentType = 'Higher Education Department' && userType = 'Student'
            GROUP BY yearLevel ORDER BY totalSyearLevel DESC";

    $result4 = mysqli_query($conn,$sql4);

    $test4 = array();

    $count4 = 0;
    while($row4 = mysqli_fetch_array($result4))
    {
        $test4[$count4]["label"] = $row4["yearLevel"];
        $test4[$count4]["y"] = $row4["totalSyearLevel"];
        $count4 = $count4 + 1;
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
<link rel="stylesheet" href="dashbookinfo.css"> 
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>QRBASEDLMS - College Library Most Borrowed Books</title>
<script>
    window.onload = function() {
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "TOTAL BOOKS BY SECTIONS"
        },
        subtitles: [{
            // text: "November 2017"
        }],
        data: [{
            type: "pie",
            yValueFormatString: "#,##0",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
 
    var chart = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        title:{
            text: "TOTAL STUDENTS BY PROGRAM"
        },
       
        data: [{
            type: "bar",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($test2, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
    
    var chart = new CanvasJS.Chart("chartContainer3", {
        animationEnabled: true,
        title:{
            text: "TOTAL TEACHERS"
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
            dataPoints: <?php echo json_encode($test3, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer4", {
        animationEnabled: true,
        title: {
            text: "TOTAL STUDENTS BY YEAR LEVEL"
        },
        data: [{
            type: "doughnut",
            indexLabel: "{symbol} {y}",
            yValueFormatString: "#,##0",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($test4, JSON_NUMERIC_CHECK); ?>
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
        padding-top: 3px;
        text-transform: uppercase;
	}

    .dashboard-conpost {
        margin-top:40px;
    }

    .dashboard-container{
        height: 10px;
        padding: 20px;
        margin: -50px 0px 0px 100px auto;
        background: #3db166;
        border-radius: 30px;
        display: flex;
        position:inherit;
        flex-direction: row;
        justify-content: center;
    }

    .dashboard-count{
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: #163269;
        border: 7px solid #3db166;
        color: white;
        padding: 10px 0px 0px 0px;
        margin: 0px 30px;
        margin-top: -75px;
        transition: 1s;

    }
    .dashboard-count:hover{
        transform: scale(1.1);
        z-index: 2;
        box-shadow: 2px 2px 2px #000;
        
    }

    .chart-row {
        display: flex;
        justify-content: space-around;
        margin-bottom: 10px;
        
    }

    .chart-container {
        width: 48%;
        height: 370px;
        margin: 10px;
        border: 10px solid rgba(57, 43, 43, 0.239);
        border-radius: 10px;
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
                </section>

                <!-- Main content -->
                 <section style="background-color:transparent">
                        <div class="col-xs-12" style="padding: 0px 30px 10px 30px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
                                <div class="col-md-3"></div>
                                    <br>
                                    <center>
                                        <div class="small-box bg">
                                            <p> Dashboard </p>
                                        </div>
					                </center>
                                    <br>
                                    <div class="dashboard-conpost">
                                        <div class="dashboard-container">
                                            <a href="admin.php?action=CollegeBookList">
                                                <div class="dashboard-count">
                                                    <div class="content">
                                                        <?php 
                                                        $books = DB:: getInstance()->query("SELECT * FROM books WHERE discarded='0' && lost='0' && bookSection != 'Periodical' && libraryClass = 'College Library'");
                                                        $countBooks =DB:: getInstance()->count($books);?>
                                                            <div class="inner">
                                                                <h3 style="font-size:30px; font-weight:900">
                                                                    <?php echo $countBooks; ?>
                                                                </h3>
                                                                <p style="font-size:13px">
                                                                Total Books
                                                                </p>
                                                            </div>
                                                    </div>
                                                </div>
                                           </a> 
                                            <a href="admin.php?action=CL-OnlineBookRequested">
                                                <div class="dashboard-count">
                                                    <div class="content">
                                                        <?php 
                                                        $books = DB:: getInstance()->query("SELECT * FROM books WHERE requested = 1 && status = 'Not Available' && discarded='0' && libraryClass = 'College Library'");
                                                        $countBooks =DB:: getInstance()->count($books);?>
                                                            <div class="inner">
                                                                <h3 style="font-size:30px; font-weight:900">
                                                                    <?php echo $countBooks; ?>
                                                                </h3>
                                                                <p style="font-size:13px">
                                                                    Book Requested
                                                                </p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </a> 
                                            <a href="admin.php?action=CL-OnlineBookBorrowed">
                                                <div class="dashboard-count">
                                                    <div class="content">
                                                        <?php 
                                                        $booksBorrowed = DB:: getInstance()->query("SELECT * FROM books WHERE is_borrowed=1 && status='Not Available' && discarded='0' && approved = '1' && transactionPlace = 'Col-Lib'");
                                                        $countBookB =DB:: getInstance()->count($booksBorrowed);?>
                                                            <div class="inner">
                                                                <h3 style="font-size:30px; font-weight:900">
                                                                    <?php echo $countBookB; ?>
                                                                </h3>
                                                                <p style="font-size:13px">
                                                                    Approved Request
                                                                </p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="admin.php?action=hedStaff_BookLoaning">
                                                <div class="dashboard-count">
                                                    <div class="content">
                                                        <?php 
                                                        $booksBorrowed = DB:: getInstance()->query("SELECT * FROM books WHERE is_borrowed=1 && status='Not Available' && received = '1' && discarded='0' && transactionPlace = 'Col-Lib'");
                                                        $countBookB =DB:: getInstance()->count($booksBorrowed);?>
                                                            <div class="inner">
                                                                <h3 style="font-size:30px; font-weight:900">
                                                                    <?php echo $countBookB; ?>
                                                                </h3>
                                                                <p style="font-size:13px">
                                                                    Books Borrowed
                                                                </p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </a> 
                                            <a href="admin.php?action=CollegeBookList">
                                                <div class="dashboard-count">
                                                    <div class="content">
                                                        <?php 
                                                        $booksAvailable = DB:: getInstance()->query("SELECT * FROM books WHERE is_borrowed='0' && status='Available' && discarded='0' && lost='0' && libraryClass = 'College Library'");
                                                        $countBookA =DB:: getInstance()->count($booksAvailable);?>
                                                            <div class="inner">
                                                                <h3 style="font-size:30px; font-weight:900">
                                                                    <?php echo $countBookA; ?>
                                                                </h3>
                                                                <p style="font-size:13px">
                                                                    Books Available
                                                                </p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </a> 
                                        </div>
                                    </div>
                                    <br><br><br><br>
                                    <div class="chart-row">
                                        <div id="chartContainer" class="chart-container"></div>
                                        <div id="chartContainer2" class="chart-container"></div>
                                    </div>
                                    <div class="chart-row">
                                        <div id="chartContainer3" class="chart-container"></div>
                                        <div id="chartContainer4" class="chart-container"></div>
                                    </div>
                                    <br>
                                    <div class="bookinfo">
                                        <div class="totalcal" style="border-left: 20px solid #3db166">
                                            <a href="admin.php?action=CollegePeriodicalList">
                                                <?php 
                                                $booksAvailable = DB:: getInstance()->query("SELECT * FROM books WHERE bookSection = 'Periodical' && libraryClass = 'College Library'");
                                                $countBookA =DB:: getInstance()->count($booksAvailable);?>
                                                <div class="inner">
                                                    <h3 style="font-size:50px; font-weight:bolder; padding-left:40px; color:#163269; text-transform:uppercase; font-weight:bold">
                                                        <?php echo $countBookA; ?>
                                                    </h3>
                                                    <p style="font-size:30px; padding-left:40px; color:#163269; text-transform:uppercase; font-weight:bold">
                                                       Periodical Books
                                                    </p>
                                                </div>
                                            </a> 
                                        </div>
                                        <div class="totalcal" style="border-left: 20px solid #3db166">
                                            <a href="admin.php?action=CollegeDiscardedBooks">
                                                <?php 
                                                $booksAvailable = DB:: getInstance()->query("SELECT * FROM `books` WHERE discarded = '1' && libraryClass = 'College Library' && bookSection != 'Periodical'");
                                                $countBookA =DB:: getInstance()->count($booksAvailable);?>
                                                <div class="inner">
                                                    <h3 style="font-size:50px; font-weight:bolder; padding-left:40px; color:#163269; text-transform:uppercase; font-weight:bold">
                                                        <?php echo $countBookA; ?>
                                                    </h3>
                                                    <p style="font-size:30px; padding-left:40px; color:#163269; text-transform:uppercase; font-weight:bold">
                                                        Discarded Books
                                                    </p>
                                                </div>
                                            </a> 
                                        </div>
                                        <div class="totalcal" style="border-left: 20px solid #3db166">
                                            <a href="admin.php?action=CollegeBookList">
                                                <?php 
                                                $booksAvailable = DB:: getInstance()->query("SELECT * FROM books WHERE lost='1' && libraryClass = 'College Library'");
                                                $countBookA =DB:: getInstance()->count($booksAvailable);?>
                                                <div class="inner">
                                                    <h3 style="font-size:50px; font-weight:bolder; padding-left:40px; color:#163269; text-transform:uppercase; font-weight:bold">
                                                        <?php echo $countBookA; ?>
                                                    </h3>
                                                    <p style="font-size:30px; padding-left:40px; color:#163269; text-transform:uppercase; font-weight:bold">
                                                        Lost Books
                                                    </p>
                                                </div>
                                            </a>  
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
