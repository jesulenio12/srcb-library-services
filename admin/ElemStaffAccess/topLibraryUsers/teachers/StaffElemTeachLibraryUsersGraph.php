<?php
    require 'conn.php';

    $filterTitle = ""; // Initialize an empty variable for the filter title

    // Check if form is submitted
    if(isset($_POST['submit'])) {
        // Get start and end dates from the form
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $gender = $_POST['gender'];
        $departmentType = $_POST['departmentType'];

        // Construct the dynamic SQL query with date filter
        $sql = "SELECT fullname, count(*) AS topName
                FROM attendance
                WHERE libraryClass = 'Grade School Library' && userType = 'Teacher'
                AND timeIn BETWEEN '$startDate' AND '$endDate' AND gender LIKE '$gender%' AND departmentType LIKE '$departmentType%'
                GROUP BY fullname ORDER BY topName DESC LIMIT 5";

        $sql2 = "SELECT gender, count(*) AS topGender
                FROM attendance
                WHERE libraryClass = 'Grade School Library' && userType = 'Teacher'
                AND timeIn BETWEEN '$startDate' AND '$endDate' AND gender LIKE '$gender%' AND departmentType LIKE '$departmentType%'
                GROUP BY gender ORDER BY topGender DESC LIMIT 5";

        // Set the filter title
        $filterTitle = "Library Statistics as of: " . date('F j, Y', strtotime($startDate)) . ' to ' . date('F j, Y', strtotime($endDate));
    } else {
        // Default query without date filter
        $sql = "SELECT fullname, count(*) AS topName
                FROM attendance
                WHERE libraryClass = 'Grade School Library' && userType = 'Teacher'
                AND MONTH(timeIn) = MONTH(CURRENT_DATE) AND YEAR(timeIn) = YEAR(CURRENT_DATE)
                GROUP BY fullname ORDER BY topName DESC LIMIT 5";

        $sql2 = "SELECT gender, count(*) AS topGender
                FROM attendance
                WHERE libraryClass = 'Grade School Library' && userType = 'Teacher'
                AND MONTH(timeIn) = MONTH(CURRENT_DATE) AND YEAR(timeIn) = YEAR(CURRENT_DATE)
                GROUP BY gender ORDER BY topGender DESC LIMIT 5";

        $filterTitle = "Library Statistics as of: " . date('F j, Y');
    }

    $result = mysqli_query($conn, $sql);
    $test = array();
    $count = 0;
    while($row = mysqli_fetch_array($result))
    {
        $test[$count]["label"] = $row["fullname"];
        $test[$count]["y"] = $row["topName"];
        $count = $count + 1;
    }


    $result2 = mysqli_query($conn, $sql2);
    $test2 = array();
    $count2 = 0;
    while($row2 = mysqli_fetch_array($result2))
    {
        $test2[$count2]["label"] = $row2["gender"];
        $test2[$count2]["y"] = $row2["topGender"];
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
<link rel="stylesheet" href="admin-b-r-button.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>GS TEACHERS LIBRARY USERS</title>

<script>
    window.onload = function() {
    
      var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          title:{
              text: "TOP LIBRARY USERS BY TEACHER",
              fontFamily: "Arial",
              fontSize: 25,
              fontWeight: "100",
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
          title:{
              text: "TOP LIBRARY USERS BY GENDER",
              fontFamily: "Arial",
              fontSize: 25,
              fontWeight: "100",
          },
          axisY: {
              // title: "Gold Reserves (in tonnes)"
          },
          data: [{
              type: "spline",
              yValueFormatString: "#,##0.##",
              indexLabelFontColor: "#36454F",
              indexLabelFontSize: 18,
              indexLabelFontWeight: "bolder",
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

    .chart-row {
        display: flex;
        justify-content: space-around; /* Adjust as needed */
        margin-bottom: 10px; /* Adjust as needed */
        
    }

    .chart-container {
        width: 48%; /* Adjust as needed */
        height: 370px;
        margin: 10px;
        /* background-color: rgba(57, 43, 43, 0.239); */
        border: 10px solid rgba(57, 43, 43, 0.239);
        border-radius: 10px;
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
        margin: 10px 10px;
    }

    @page {
        size: A4 landscape;
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

        body {
                margin: 0;
        }

        .chart-row {
            display: flex;
            justify-content: space-around; /* Adjust as needed */
            margin-bottom: 20px; /* Adjust as needed */
            page-break-inside: avoid;
        }

        canvas.canvasjs-chart-canvas {
            max-width: 97.8%; /* Adjust as needed */
            max-height: 340px;
            margin: 10px;
        }

        .styled-text {
            display: block;
            font-size: 23px;
            font-family: Arial; 
            font-weight: 900;
            transform: scale(1.5, 2);
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
            margin: 10px 47px'
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
                        <a href="admin.php?action=StaffElemStudLibraryUsers"><button type="button" class="btn" style="background: #3db166; color:white">Students</button></a> 
                        <a href="admin.php?action=StaffElemTeachLibraryUsers"><button type="button" class="btn" style="color: #3db166;">Teachers</button></a> 
                    </ol>
                    </center>
                </section>

                <!-- Main content -->
                    <section style="background-color:transparent">
                        <div class="col-xs-12" style="padding: 0px 30px 10px 30px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
                                <div class="col-md-3"></div>
                                    <br>
                                    <center class="noprint">
                                        <div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 130px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
                                            <p style="font-size:35px; transform: scale(1, 2);">
                                               GS LIBRARY DAILY USERS
                                            </p>
                                            <a style="color: #fff;" href="admin.php?action=StaffElemStudLibraryUsers"><button type="button" style="background: #fff; color: #3db166;" class="abtnb">TABLE DATA </button></a>
                                            <a style="color: #fff;" href="admin.php?action=StaffElemStudLibraryUsers"><button type="button" style="background: #3db166; color:white" class="abtnr">GRAPHICAL DATA</button></a> 
                                        </div>
                                    </center>
                                    <center>
                                        <p class="styled-text">GS LIBRARY USERS LOGGED RECORD</p>
                                    </center>
                                    <br>
                                    <div class="noprint">
                                        <form method="post" action="">
                                            <div class="wrap-filter">
                                                <div class="filter-input-group"> 
                                                    <label class="filter-input-label">FROM DATE</label>
                                                    <input type="date" class="filter-input-box" placeholder="Start" name="startDate" value="<?php echo isset($_POST['startDate']) ? $_POST['startDate'] : '' ?>" />
                                                </div>
                                                <div class="filter-input-group"> 
                                                    <label class="filter-input-label">TO DATE</label>
                                                    <input type="date" class="filter-input-box" placeholder="End"  name="endDate" value="<?php echo isset($_POST['endDate']) ? $_POST['endDate'] : '' ?>" />
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
                                                <!-- BUTTON -->
                                                <button class="btn2 noprint" type="submit" name="submit" value = "filter"><i class="fa fa-filter"></i></button>
                                                <a class="filtersbtn" href="admin.php?action=StaffElemTeachLibraryUsersGraph"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
                                                <button class="btn2 noprint" name="search" onclick="window.print();"><i class="fa fa-print"></i></button>
                                                <!-- BUTTON -->
                                            </div>
                                        </form>
                                    </div>
                                    <br>

                                    <center>
                                        <?php echo "<center><h1 class='statLabel'>{$filterTitle}</h1></center>"; ?>
                                    </center>

                                    <div class="chart-row">
                                        <div id="chartContainer" class="chart-container"></div>
                                        <div id="chartContainer2" class="chart-container"></div>
                                    </div>
									<!-- <hr style="border-top:1px dotted #000;"/> -->
                                    <br>
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
