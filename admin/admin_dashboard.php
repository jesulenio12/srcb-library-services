<?php
    require 'conn.php';

    // MOST BORROWED BOOKS (HED)
    $sql = "SELECT bookTitle, count(*) AS mostBorrowed
    FROM booktransactions
    WHERE transactionType = 'return' && libraryClass = 'College Library' && MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE)
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

    // MOST BORROWED BOOKS (HS)
    $sql2 = "SELECT bookTitle, count(*) AS mostBorrowed
    FROM booktransactions
    WHERE transactionType = 'return' && libraryClass = 'High School Library' && MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE)
    GROUP BY bookTitle ORDER BY mostBorrowed DESC LIMIT 5";
 
    $result2 = mysqli_query($conn,$sql2);
 
    $test2 = array();
 
    $count2 = 0;
    while($row2 = mysqli_fetch_array($result))
    {
    $test2[$count2]["label"] = $row2["bookTitle"];
    $test2[$count2]["y"] = $row2["mostBorrowed"];
    $count2 = $count2 + 1;
    }

    // MOST BORROWED BOOKS (GS)
    $sql3 = "SELECT bookTitle, count(*) AS mostBorrowed
    FROM booktransactions
    WHERE transactionType = 'return' && libraryClass = 'Grade School Library' && MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE)
    GROUP BY bookTitle ORDER BY mostBorrowed DESC LIMIT 5";
 
    $result3 = mysqli_query($conn,$sql3);
 
    $test3 = array();
 
    $count3 = 0;
    while($row3 = mysqli_fetch_array($result))
    {
    $test3[$count3]["label"] = $row3["bookTitle"];
    $test3[$count3]["y"] = $row3["mostBorrowed"];
    $count3 = $count3 + 1;
    }

    // ------------------------------------------------------------------------------------------------------------

    // MOST BORROWED BOOK SECTIONS (HED)
    $sql4 = "SELECT bookSection, count(*) AS mostBorrowed
            FROM booktransactions
            WHERE transactionType = 'return' && libraryClass = 'College Library' && MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE)
            GROUP BY bookSection ORDER BY mostBorrowed DESC LIMIT 5";

    $result4 = mysqli_query($conn,$sql4);

    $test4 = array();

    $count4 = 0;
    while($row4 = mysqli_fetch_array($result4))
    {
        $test4[$count4]["label"] = $row4["bookSection"];
        $test4[$count4]["y"] = $row4["mostBorrowed"];
        $count4 = $count4 + 1;
    }

     // MOST BORROWED BOOK SECTIONS (HS)
     $sql5 = "SELECT bookSection, count(*) AS mostBorrowed
     FROM booktransactions
     WHERE transactionType = 'return' && libraryClass = 'High School Library' && MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE)
     GROUP BY bookSection ORDER BY mostBorrowed DESC LIMIT 5";

    $result5 = mysqli_query($conn,$sql5);

    $test5 = array();

    $count5 = 0;
    while($row5 = mysqli_fetch_array($result5))
    {
    $test5[$count5]["label"] = $row5["bookSection"];
    $test5[$count5]["y"] = $row5["mostBorrowed"];
    $count5 = $count5 + 1;
    }

     // MOST BORROWED BOOK SECTIONS (GS)
     $sql6 = "SELECT bookSection, count(*) AS mostBorrowed
     FROM booktransactions
     WHERE transactionType = 'return' && libraryClass = 'Grade School Library' && MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE)
     GROUP BY bookSection ORDER BY mostBorrowed DESC LIMIT 6";

    $result6 = mysqli_query($conn,$sql6);

    $test6 = array();

    $count6 = 0;
    while($row6 = mysqli_fetch_array($result6))
    {
    $test6[$count6]["label"] = $row6["bookSection"];
    $test6[$count6]["y"] = $row6["mostBorrowed"];
    $count6 = $count6 + 1;
    }

    // ------------------------------------------------------------------------------------------------------------

    // TOTAL BOOKS PER BOOK SECTION (HED)
    $sql7 = "SELECT bookSection, count(*) AS totalBookHed
            FROM books
            WHERE status='Available' && discarded='0' && bookSection != 'Periodical' && libraryClass = 'College Library'
            GROUP BY bookSection ORDER BY totalBookHed DESC";

    $result7 = mysqli_query($conn,$sql7);

    $test7 = array();

    $count7 = 0;
    while($row7 = mysqli_fetch_array($result7))
    {
        $test7[$count7]["label"] = $row7["bookSection"];
        $test7[$count7]["y"] = $row7["totalBookHed"];
        $count7 = $count7 + 1;
    }

    // TOTAL BOOKS PER BOOK SECTION (HS)
    $sql8 = "SELECT bookSection, count(*) AS totalBookHs
            FROM books
            WHERE status='Available' && discarded='0' && bookSection != 'Periodical' && libraryClass = 'High School Library'
            GROUP BY bookSection ORDER BY totalBookHs DESC";

    $result8 = mysqli_query($conn,$sql8);

    $test8 = array();

    $count8 = 0;
    while($row8 = mysqli_fetch_array($result8))
    {
        $test8[$count8]["label"] = $row8["bookSection"];
        $test8[$count8]["y"] = $row8["totalBookHs"];
        $count8 = $count8 + 1;
    }

    // TOTAL BOOKS PER BOOK SECTION (HS)
    $sql9 = "SELECT bookSection, count(*) AS totalBookGs
            FROM books
            WHERE status='Available' && discarded='0' && bookSection != 'Periodical' && libraryClass = 'Grade School Library'
            GROUP BY bookSection ORDER BY totalBookGs DESC";

    $result9 = mysqli_query($conn,$sql9);

    $test9 = array();

    $count9 = 0;
    while($row9 = mysqli_fetch_array($result9))
    {
        $test9[$count9]["label"] = $row9["bookSection"];
        $test9[$count9]["y"] = $row9["totalBookGs"];
        $count9 = $count9 + 1;
    }

     // ------------------------------------------------------------------------------------------------------------

    // TOTAL STUDENTS PER PROGRAM (HED)
    $sql10 = "SELECT progtrack, count(*) AS totalProgram
            FROM userlogin
            WHERE archive = 0 && departmentType = 'Higher Education Department' && userType = 'Student'
            GROUP BY progtrack ORDER BY totalProgram DESC";

    $result10 = mysqli_query($conn,$sql10);

    $test10 = array();

    $count10 = 0;
    while($row10 = mysqli_fetch_array($result10))
    {
        $test10[$count10]["label"] = $row10["progtrack"];
        $test10[$count10]["y"] = $row10["totalProgram"];
        $count10 = $count10 + 1;
    }

    // TOTAL STUDENTS PER PROGRAM (SHS)
    $sql11 = "SELECT progtrack, count(*) AS totalProgram
            FROM userlogin
            WHERE archive = 0 && departmentType = 'Senior High School Department' && userType = 'Student'
            GROUP BY progtrack ORDER BY totalProgram DESC";

    $result11 = mysqli_query($conn,$sql11);

    $test11 = array();

    $count11 = 0;
    while($row11 = mysqli_fetch_array($result11))
    {
        $test11[$count11]["label"] = $row11["progtrack"];
        $test11[$count11]["y"] = $row11["totalProgram"];
        $count11 = $count11 + 1;
    }

     // TOTAL STUDENTS PER PROGRAM (JHS)
     $sql12 = "SELECT progtrack, count(*) AS totalProgram
     FROM userlogin
     WHERE archive = 0 && departmentType = 'Junior High School Department' && userType = 'Student'
     GROUP BY progtrack ORDER BY totalProgram DESC";

    $result12 = mysqli_query($conn,$sql12);

    $test12 = array();

    $count12 = 0;
    while($row12 = mysqli_fetch_array($result12))
    {
    $test12[$count12]["label"] = $row12["progtrack"];
    $test12[$count12]["y"] = $row12["totalProgram"];
    $count12 = $count12 + 1;
    }

     // TOTAL STUDENTS PER PROGRAM (GS)
     $sql13 = "SELECT progtrack, count(*) AS totalProgram
     FROM userlogin
     WHERE archive = 0 && departmentType = 'Grade School Department' && userType = 'Student'
     GROUP BY progtrack ORDER BY totalProgram DESC";

    $result13 = mysqli_query($conn,$sql13);

    $test13 = array();

    $count13 = 0;
    while($row13 = mysqli_fetch_array($result13))
    {
    $test13[$count13]["label"] = $row13["progtrack"];
    $test13[$count13]["y"] = $row13["totalProgram"];
    $count13 = $count13 + 1;
    }

     // ------------------------------------------------------------------------------------------------------------

    // TOTAL TEACHER (HED)
    $sql14 = "SELECT gender, count(*) AS totalTeacher
            FROM userlogin
            WHERE archive = 0 && departmentType = 'Higher Education Department' && userType = 'Teacher'
            GROUP BY gender ORDER BY totalTeacher DESC";

    $result14 = mysqli_query($conn,$sql14);

    $test14 = array();

    $count14 = 0;
    while($row14 = mysqli_fetch_array($result14))
    {
        $test14[$count14]["label"] = $row14["gender"];
        $test14[$count14]["y"] = $row14["totalTeacher"];
        $count14 = $count14 + 1;
    }

    // TOTAL TEACHER (SHS)
    $sql15 = "SELECT gender, count(*) AS totalTeacher
            FROM userlogin
            WHERE archive = 0 && departmentType = 'Senior High School Department' && userType = 'Teacher'
            GROUP BY gender ORDER BY totalTeacher DESC";

    $result15 = mysqli_query($conn,$sql15);

    $test15 = array();

    $count15 = 0;
    while($row15 = mysqli_fetch_array($result15))
    {
        $test15[$count15]["label"] = $row15["gender"];
        $test15[$count15]["y"] = $row15["totalTeacher"];
        $count15 = $count15 + 1;
    }

    // TOTAL TEACHER (JHS)
    $sql16 = "SELECT gender, count(*) AS totalTeacher
            FROM userlogin
            WHERE archive = 0 && departmentType = 'Junior High School Department' && userType = 'Teacher'
            GROUP BY gender ORDER BY totalTeacher DESC";

    $result16 = mysqli_query($conn,$sql16);

    $test16 = array();

    $count16 = 0;
    while($row16 = mysqli_fetch_array($result16))
    {
        $test16[$count16]["label"] = $row16["gender"];
        $test16[$count16]["y"] = $row16["totalTeacher"];
        $count16 = $count16 + 1;
    }

    // TOTAL TEACHER (GS)
    $sql17 = "SELECT gender, count(*) AS totalTeacher
            FROM userlogin
            WHERE archive = 0 && departmentType = 'Grade School Department' && userType = 'Teacher'
            GROUP BY gender ORDER BY totalTeacher DESC";

    $result17 = mysqli_query($conn,$sql17);

    $test17 = array();

    $count17 = 0;
    while($row17 = mysqli_fetch_array($result17))
    {
        $test17[$count17]["label"] = $row17["gender"];
        $test17[$count17]["y"] = $row17["totalTeacher"];
        $count17 = $count17 + 1;
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
<link rel="stylesheet" href="admincard.css"> 
<link rel="stylesheet" href="admincard2.css"> 
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>Admin Dashboard</title>
<script>
    window.onload = function() {


    // TOP 5 MOST BORROWED BOOKS -----------------------------------------------------------------
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
            text: "COLLEGE LIBRARY"
        },
       
        data: [{
            type: "column",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        title:{
            text: "HIGH SCHOOL LIBRARY"
        },
       
        data: [{
            type: "column",
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
            text: "GRADE SCHOOL LIBRARY"
        },
       
        data: [{
            type: "column",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($test3, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

     // TOP 5 MOST BORROWED BOOKS SECTIONS -----------------------------------------------------------------
     var chart = new CanvasJS.Chart("chartContainer4", {
        animationEnabled: true,
        title:{
            text: "COLLEGE LIBRARY"
        },
       
        data: [{
            type: "bar",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($test4, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer5", {
        animationEnabled: true,
        title:{
            text: "HIGH SCHOOL LIBRARY"
        },
       
        data: [{
            type: "bar",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($test5, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer6", {
        animationEnabled: true,
        title:{
            text: "GRADE SCHOOL LIBRARY"
        },
       
        data: [{
            type: "bar",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($test6, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    // TOTAL BOOKS PER SECTION -----------------------------------------------------------------
    
    var chart = new CanvasJS.Chart("chartContainer7", {
        animationEnabled: true,
        title: {
            text: "COLLEGE LIBRARY"
        },
        subtitles: [{
            // text: "November 2017"
        }],
        data: [{
            type: "pie",
            yValueFormatString: "#,##0",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($test7, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer8", {
        animationEnabled: true,
        title: {
            text: "HIGH SCHOOL LIBRARY"
        },
        subtitles: [{
            // text: "November 2017"
        }],
        data: [{
            type: "pie",
            yValueFormatString: "#,##0",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($test8, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer9", {
        animationEnabled: true,
        title: {
            text: "GRADE SCHOOL LIBRARY"
        },
        subtitles: [{
            // text: "November 2017"
        }],
        data: [{
            type: "pie",
            yValueFormatString: "#,##0",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($test9, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

     // TOTAL STUDENTS -----------------------------------------------------------------

    var chart = new CanvasJS.Chart("chartContainer10", {
        animationEnabled: true,
        title: {
            text: "HIGHER EDUCATION DEPARTMENT"
        },
        data: [{
            type: "doughnut",
            indexLabel: "{symbol} {y}",
            yValueFormatString: "#,##0",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($test10, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer11", {
        animationEnabled: true,
        title: {
            text: "SENIOR HIGH SCHOOL DEPARTMENT"
        },
        data: [{
            type: "doughnut",
            indexLabel: "{symbol} {y}",
            yValueFormatString: "#,##0",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($test11, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer12", {
        animationEnabled: true,
        title: {
            text: "JUNIOR HIGH SCHOOL DEPARTMENT"
        },
        data: [{
            type: "doughnut",
            indexLabel: "{symbol} {y}",
            yValueFormatString: "#,##0",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($test12, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer13", {
        animationEnabled: true,
        title: {
            text: "GRADE CHOOL DEPARTMENT"
        },
        data: [{
            type: "doughnut",
            indexLabel: "{symbol} {y}",
            yValueFormatString: "#,##0",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($test13, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    // TOTAL TEACHERS -----------------------------------------------------------------
    var chart = new CanvasJS.Chart("chartContainer14", {
        animationEnabled: true,
        title: {
            text: "HIGHER EDUCATION DEPARTMENT"
        },
        data: [{
            type: "pie",
            indexLabel: "{y}",
            yValueFormatString: "#,##0\"%\"",
            indexLabelPlacement: "inside",
            indexLabelFontColor: "#36454F",
            indexLabelFontSize: 18,
            indexLabelFontWeight: "bolder",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($test14, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer15", {
        animationEnabled: true,
        title: {
            text: "SENIOR HIGH SCHOOL DEPARTMENT"
        },
        data: [{
            type: "pie",
            indexLabel: "{y}",
            yValueFormatString: "#,##0\"%\"",
            indexLabelPlacement: "inside",
            indexLabelFontColor: "#36454F",
            indexLabelFontSize: 18,
            indexLabelFontWeight: "bolder",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($test15, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer16", {
        animationEnabled: true,
        title: {
            text: "JUNIOR HIGH SCHOOL DEPARTMENT"
        },
        data: [{
            type: "pie",
            indexLabel: "{y}",
            yValueFormatString: "#,##0\"%\"",
            indexLabelPlacement: "inside",
            indexLabelFontColor: "#36454F",
            indexLabelFontSize: 18,
            indexLabelFontWeight: "bolder",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($test16, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer17", {
        animationEnabled: true,
        title: {
            text: "GRADE CHOOL DEPARTMENT"
        },
        data: [{
            type: "pie",
            indexLabel: "{y}",
            yValueFormatString: "#,##0\"%\"",
            indexLabelPlacement: "inside",
            indexLabelFontColor: "#36454F",
            indexLabelFontSize: 18,
            indexLabelFontWeight: "bolder",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($test17, JSON_NUMERIC_CHECK); ?>
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

    .text-divider {
		--text-divider-gap: 1rem;
        display: flex;
        align-items: center;
        text-align: center;
        font-size: 25px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-weight: bolder;
        font-family: Arial Black;
        margin-bottom: 20px;
        color: #163269;
	}
	
	.text-divider::before, .text-divider::after {
		content: '';
		height: 6px;
		background-color: #163269;
		flex-grow: 1;
		border-radius: 10px;
	}

	.text-divider::before {
		margin-right: var(--text-divider-gap);
	}

	.text-divider::after {
		margin-left: var(--text-divider-gap);
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
                                                <div class="data">
                                                    <div class="content">
                                                        <?php 
                                                        $books = DB:: getInstance()->query("SELECT * FROM books WHERE status='Available' && discarded='0' && libraryClass = 'College Library'");
                                                        $countBooks =DB:: getInstance()->count($books);?>
                                                            <div class="inner">
                                                                <h3 style="font-size:30px; font-weight:bolder">
                                                                    <?php echo $countBooks; ?>
                                                                </h3>
                                                                <p style="font-size:13px">
                                                                    HED Total Books
                                                                </p>
                                                            </div>
                                                    </div>
                                                </div>
                                           </a> 
                                            <a href="admin.php?action=CL-ApproveRequest">
                                                <div class="data">
                                                    <div class="content">
                                                        <?php 
                                                        $books = DB:: getInstance()->query("SELECT * FROM books WHERE status='Available' && discarded='0' && libraryClass = 'High School Library'");
                                                        $countBooks =DB:: getInstance()->count($books);?>
                                                            <div class="inner">
                                                                <h3 style="font-size:30px; font-weight:bolder">
                                                                    <?php echo $countBooks; ?>
                                                                </h3>
                                                                <p style="font-size:13px">
                                                                    HS Total Books
                                                                </p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </a> 
                                            <a href="admin.php?action=hedStaff_BookLoaning">
                                                <div class="data">
                                                    <div class="content">
                                                        <?php 
                                                        $booksBorrowed = DB:: getInstance()->query("SELECT * FROM books WHERE status='Available' && discarded='0' && libraryClass = 'Grade School Library'");
                                                        $countBookB =DB:: getInstance()->count($booksBorrowed);?>
                                                            <div class="inner">
                                                                <h3 style="font-size:30px; font-weight:bolder">
                                                                    <?php echo $countBookB; ?>
                                                                </h3>
                                                                <p style="font-size:13px">
                                                                    GS Total Books
                                                                </p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </a> 
                                        </div>
                                    </div>
                                    <br><br><br><br>
                                    <div class="whladmincard" style="padding: 0px 50px 0px 50px">
                                        <h1 class="text-divider"> TOP 5 MOST BORROWED BOOKS </h1>
                                        <div class="admincard">
                                            <div class="admincardbox">
                                                <div class="form-group">
                                                    <div id="chartContainer" style="height: 250px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox">
                                                <div class="form-group">
                                                    <div id="chartContainer2" style="height: 250px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox">
                                                <div class="form-group">
                                                    <div id="chartContainer3" style="height: 250px; width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="whladmincard" style="padding: 0px 50px 0px 50px">
                                        <h1 class="text-divider"> TOP 5 MOST BORROWED BOOK SECTION </h1>
                                        <div class="admincard">
                                            <div class="admincardbox">
                                                <div class="form-group">
                                                    <div id="chartContainer4" style="height: 250px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox">
                                                <div class="form-group">
                                                    <div id="chartContainer5" style="height: 250px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox">
                                                <div class="form-group">
                                                    <div id="chartContainer6" style="height: 250px; width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="whladmincard" style="padding: 0px 50px 0px 50px">
                                        <h1 class="text-divider"> TOTAL BOOKS PER BOOK SECTION </h1>
                                        <div class="admincard">
                                            <div class="admincardbox">
                                                <div class="form-group">
                                                    <div id="chartContainer7" style="height: 250px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox">
                                                <div class="form-group">
                                                    <div id="chartContainer8" style="height: 250px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox">
                                                <div class="form-group">
                                                    <div id="chartContainer9" style="height: 250px; width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="whladmincard" style="padding: 0px 50px 0px 50px">
                                        <h1 class="text-divider"> TOTAL STUDENTS PER PROGRAM </h1>
                                        <div class="admincard2">
                                            <div class="admincardbox2">
                                                <div class="form-group">
                                                    <div id="chartContainer10" style="height: 200px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox2">
                                                <div class="form-group">
                                                    <div id="chartContainer11" style="height: 200px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox2">
                                                <div class="form-group">
                                                    <div id="chartContainer12" style="height: 200px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox2">
                                                <div class="form-group">
                                                    <div id="chartContainer13" style="height: 200px; width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="whladmincard" style="padding: 0px 50px 0px 50px">
                                        <h1 class="text-divider"> TOTAL TEACHERS PER DEPARTMENT </h1>
                                        <div class="admincard2">
                                            <div class="admincardbox2">
                                                <div class="form-group">
                                                    <div id="chartContainer14" style="height: 200px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox2">
                                                <div class="form-group">
                                                    <div id="chartContainer15" style="height: 200px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox2">
                                                <div class="form-group">
                                                    <div id="chartContainer16" style="height: 200px; width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="admincardbox2">
                                                <div class="form-group">
                                                    <div id="chartContainer17" style="height: 200px; width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
