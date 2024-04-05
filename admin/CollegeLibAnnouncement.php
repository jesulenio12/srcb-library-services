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
                                                Announcement
                                            </p>
                                        </div>
                                    </center>
                                    <br>
                                    <?php if(Session::exists('Success')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Success'); ?>
                                             </div>
                                    <?php }?> 
									<?php if(Session::exists('Failed')){ ?>
                                             <div class="alert alert-danger" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Failed'); ?>
                                             </div>
                                    <?php }?> 
                                    <div class="announcement">
                                        <form method="post" action="CollegeLibAnnouncementCreate.php">
                                            <div class="form-group row">
                                                <label class="control-label col-md-4" for="notification">Name</label>
                                                <div class="col-md-6">
                                                <input type="text" name="title" id="title" class="form-control" placeholder="Announcement title" required/>
                                                </div> 
                                            </div>   
                                            <div class="form-group row">
                                                <label class="control-label col-md-4" for="notification">Message</label>
                                                <div class="col-md-6">
                                                <textarea style="resize:none !important;"name="message" id="message" rows="4" cols="10" class='form-control'></textarea>
                                                </div> 
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-10 col-offset-2" style="text-align:center;">
                                                    <button type="submit" class="btnupdate" value="save"> Submit</button>
                                                </div>
                                            </div>   
                                        </form>       
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

</body>

</html>
