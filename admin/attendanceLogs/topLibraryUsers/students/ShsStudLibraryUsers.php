<?php
    require 'conn.php';

    // MOST BORROWED BOOKS
    $sql = "SELECT fullname, count(*) AS mostBorrowed
            FROM attendance
            WHERE libraryClass = 'High School Library' && userType = 'Student' && MONTH(timeIn) = MONTH(CURRENT_DATE) AND YEAR(timeIn) = YEAR(CURRENT_DATE)
            GROUP BY fullname ORDER BY mostBorrowed DESC LIMIT 5";



    $result = mysqli_query($conn,$sql);

    $test = array();

    $count = 0;
    while($row = mysqli_fetch_array($result))
    {
        $test[$count]["label"] = $row["fullname"];
        $test[$count]["y"] = $row["mostBorrowed"];
        $count = $count + 1;
    }

    // MOST BORROWED BOOK SECTIONS
    $sql2 = "SELECT progtrack, count(*) AS mostBorrowed
            FROM attendance
            WHERE libraryClass = 'High School Library' && userType = 'Student' && MONTH(timeIn) = MONTH(CURRENT_DATE) AND YEAR(timeIn) = YEAR(CURRENT_DATE)
            GROUP BY progtrack ORDER BY mostBorrowed DESC LIMIT 5";

    $result2 = mysqli_query($conn,$sql2);

    $test2 = array();

    $count2 = 0;
    while($row2 = mysqli_fetch_array($result2))
    {
        $test2[$count2]["label"] = $row2["progtrack"];
        $test2[$count2]["y"] = $row2["mostBorrowed"];
        $count2 = $count2 + 1;
    }

     // MOST BORROWED BOOK SECTIONS
     $sql3 = "SELECT yearLevel, count(*) AS mostLevel
            FROM attendance
            WHERE libraryClass = 'High School Library' && userType = 'Student' && MONTH(timeIn) = MONTH(CURRENT_DATE) AND YEAR(timeIn) = YEAR(CURRENT_DATE)
            GROUP BY yearLevel ORDER BY mostLevel DESC LIMIT 5";

    $result3 = mysqli_query($conn,$sql3);

    $test3 = array();

    $count3 = 0;
    while($row3 = mysqli_fetch_array($result3))
    {
        $test3[$count3]["label"] = $row3["yearLevel"];
        $test3[$count3]["y"] = $row3["mostLevel"];
        $count3 = $count3 + 1;
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
<title>HS Students Library Daily Users</title>

<script>
    window.onload = function() {
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
            text: "TOP DAILY USERS BY STUDENT"
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
            text: "TOP DAILY USERS BY COURSE"
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

    var chart = new CanvasJS.Chart("chartContainer3", {
        animationEnabled: true,
        title: {
            text: "TOP DAILY USERS BY YEAR LEVEL"
        },
        subtitles: [{
            // text: "November 2017"
        }],
        data: [{
            type: "doughnut",
            yValueFormatString: "#,##0",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($test3, JSON_NUMERIC_CHECK); ?>
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
                    <center>
                    <ol class="breadcrumb" style="background-color: rgba(255, 255, 255, 0.239); border-radius:30px; margin-top:-5px;">
                        <li><a href="admin.php" style="color:white"><i class="glyphicon glyphicon-th-list"></i> Go to</a></li>
                        <a href="admin.php?action=ShsStudLibraryUsers"><button type="button" class="btn" style="background: #3db166; color:white">Students</button></a> 
                        <a href="admin.php?action=ShsTeachLibraryUsers"><button type="button" class="btn" style="color: #3db166;">Teachers</button></a> 
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
                                        <div class="small-box bg" style="background-image: url(images/background.jpg); color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
                                            <p style="font-size:35px; transform: scale(1, 2);">
                                                HS LIBRARY DAILY USERS
                                            </p>
                                        </div>
                                    </center>
                                    <br>
                                    
                                    <center style="padding: 0px 50px 0px 50px">
                                        <div class="row" style="width:100%; background-color: rgba(57, 43, 43, 0.239); border-radius:10px; padding: 25px 15px 10px 15px">
                                            <div class="col-lg-4">
                                                <div id="chartContainer" style="height: 250px; width: 100%;"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <div id="chartContainer2" style="height: 250px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <div id="chartContainer3" style="height: 250px; width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
									<hr style="border-top:1px dotted #000;"/>
                                    <br>
                                    <div class="noprint">
                                        <form class="form-inline" method="POST" action="">
                                            <center>
												<div class="wrap-filter" class="noprint">
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
														<label class="filter-input-label">YEAR LEVEL</label>
														<select class="filter-input-box" for="yearLevel" name="yearLevel" id="yearLevel">
                                                            <option value="<?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?>" > <?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?></option>
                                                            <option value="">None</option>
                                                            <option style="font-weight:bolder" value="">JHS Department</option>
                                                            <option value="Grade 7">Grade 7</option>	
                                                            <option value="Grade 8">Grade 8</option>	
                                                            <option value="Grade 9">Grade 9</option>	
                                                            <option value="Grade 10">Grade 10</option>	
                                                            <option style="font-weight:bolder" value="">SHS Department</option>
                                                            <option value="Grade 11">Grade 11</option>	
                                                            <option value="Grade 12">Grade 12</option>	
                                                            <option style="font-weight:bolder" value="">HED Department</option>
                                                            <option value="First Year">First Year</option>
                                                            <option value="Second Year">Second Year</option>
                                                            <option value="Third Year">Third Year</option>
                                                            <option value="Fourth Year">Fourth Year</option>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">COURSE</label>
														<select class="filter-input-box" for="progtrack" name="progtrack" id="progtrack">
                                                            <option value="<?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?>" > <?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?></option>
                                                            <option value="">None</option>
                                                            <option style="font-weight:bolder" value="">HED Department</option>
                                                            <option value="BSIT">BSIT</option>	
                                                            <option value="BSHM">BSHM</option>
                                                            <option value="BSBA">BSBA</option>
                                                            <option value="BSED">BSED</option>
                                                            <option value="BEED">BEED </option>
                                                            <option value="BSCRIM">BSCRIM</option>
                                                            <option style="font-weight:bolder" value="">SHS Department</option>
                                                            <option value="HUMMS">HUMMS</option>	
                                                            <option value="STEM">STEM</option>	
                                                            <option value="ABM">ABM</option>
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
														</select> 
													</div>

													<button class="filtersbtn" name="filterbook"><i class="fa fa-filter"></i></button>
													<a class="filtersbtn" href="admin.php?action=ShsStudLibraryUsers"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
												</div>
											</center>
                                        </form>
                                    </div>
                                    <br>
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
                                                <th>Course</th>
                                                <th>Year</th>
                                                <th>Department</th>
                                            </tr>
                                        </thead>
                                        <tbody>
												<?php include 'ShsStudLibraryUsersFilter.php'?>	
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
