<?php
require_once 'core/init.php';

$library_userID = ''; // Initialize the variable

if (isset($_GET['library_userID'])) {
    $library_userID = $_GET['library_userID'];
}

if (Input::exists()) {
    $userlogin = DB::getInstance()->get('userlogin', array('id', '=', Input::get('deactivate')));
    if ($userlogin->count()) {
        foreach ($userlogin->results() as $userlogin) {
            $user = new UserLogin();
            try {
                $user->update(array(
                    'status' => 'Deactivated',
                    'permission' => 0,
                ), $userlogin->id);
            } catch (Exception $e) {
                $error;
            }
        }
        Session::flash('Success', 'User has been successfully deactivated.');
    } else {
        $userlogin = DB::getInstance()->get('userlogin', array('id', '=', Input::get('activate')));
        if ($userlogin->count()) {
            foreach ($userlogin->results() as $userlogin) {
                $user = new UserLogin();
                try {
                    $user->update(array(
                        'status' => 'Active',
                        'permission' => 5,
                    ), $userlogin->id);
                } catch (Exception $e) {
                    $error;
                }
            }
            Session::flash('Success', 'User has been successfully activated.');
        } else {
            // Handle deletion
            $userlogin = DB::getInstance()->get('userlogin', array('id', '=', Input::get('delete')));
            if ($userlogin->count()) {
                foreach ($userlogin->results() as $userlogin) {
                    try {
                        // Retrieve avatar filename
                        $qrocdeFilename = $userlogin->qrcode;
                        
                        // Perform direct deletion using SQL query
                        $delete_query = "DELETE FROM userlogin WHERE id = ?";
                        $deleted = DB::getInstance()->query($delete_query, array($userlogin->id));
                        if ($deleted) {
                            // Delete corresponding qrcode image from local folder
                            $qrcodePath = 'admin/hedStudQRCodes/' . $qrocdeFilename;
                            if (file_exists($qrcodePath)) {
                                unlink($qrcodePath); // Delete the file
                            }
                            
                            Session::flash('Success', 'User has been successfully deleted.');
                            Redirect::to('admin.php?action=hedStud_OnlineUserList');
                        }
                    } catch (Exception $e) {
                        $error;
                    }
                }
            } else {
                $userlogin = DB::getInstance()->get('userlogin', array('id', '=', Input::get('reset')));
                if ($userlogin->count()) {
                    foreach ($userlogin->results() as $userlogin) {
                        $user = new UserLogin();
                        try {
                            $user->update(array(
                                'password' => Hash::make(Input::get('newPassword')),
                            ), $userlogin->id);
                        } catch (Exception $e) {
                            $error;
                        }
                    }
                    Session::flash('Success', 'User password has been successfully reset.');
                }
            }
        }
    }

    // Use the stored library_userID for redirection
    if (!empty($library_userID)) {
         Redirect::to('admin.php?action=AdminHedStudView&library_userID=' . urlencode($library_userID));
    } else {
       Redirect::to('admin.php?action=hedStud_OnlineUserList');
    }
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
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/addInputs.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>HED Online Book Requested</title>
</head>

<style>
    .user-btn {
        font-family: "Roboto", sans-serif;
        font-size: 8px;
        border: none;
        font-weight: 900;
        background: #3db166;
        width: fit-content;
        height: 21px;
        padding: 5px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition-duration: 0.3s;
        transition-property: box-shadow, transform;
    }

    .user-btn:hover, .user-btn:focus, .user-btn:active{
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
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

    .card {
		display: flex;
		justify-content: flex-start;
		align-items: center;
		gap: 30px;
		position: relative;
		margin-top: -105px;
		border-radius: 15px;
		padding: 0px 0 0px 40px;
		height: 323px;
    	width: 730px;
		box-shadow: 0 4px 20px rgb(0 0 0 / 99%);
	}

    .other-info-card {
		display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 30px;
        position: relative;
        margin-top: -105px;
        border-radius: 15px;
        padding: 0px 20px 0px 20px;
        height: 323px;
        width: 240px;
        box-shadow: 0 4px 20px rgb(0 0 0 / 99%);
	}

    .secondary-info-card {
		display: flex;
        justify-content: center;
        align-items: center;
        gap: 4px;
        position: relative;
        margin-top: -45px;
        border-radius: 15px;
        padding: 0px 10px 0px 10px;
        height: 45px;
        width: 240px;
	}

	.avatar img {
		height: 260px;
		width: auto;
		border-radius: 50%;
	}

	span.name {
		font-size: 20px;
		font-weight: 500;
		font-family: fantasy;
	}

    span.other-info {
        font-size: 18px;
        font-weight: bold;
        font-family: arial;
    }

	.card-body p {
		font-size: 15px;
		font-family: math;
		font-weight: 500;
		color: white;
	}

	span.time-logged {
		color: white;
		padding: 2px 5px;
		border-radius: 3px;
	}

	.user-type {
		font-size: 15px;
		font-family: sans-serif;
		font-weight: 600;
		text-transform: uppercase;
		padding: 4px 6px 1px 6px;
		border-radius: 5px;
		border: 1px solid white;
		width: fit-content;
	}

    .logoImageScan {
		position: absolute;
    	display: flex;
	}

	.logoImageScan img {
		width: auto;
		height: 80px;
		position: relative;
		bottom: 85px;
    	left: 565px;
		filter: drop-shadow(10px 5px 10px black);
	}

    .profile {
        display: flex;
        justify-content: center;
        margin-top: 85px;
        margin-bottom: 10px;
    }

    .view-user-card {
		display: flex;
		justify-content: center;
	}

    .add-input-container span {
        width: 145px;
    }
</style>
<body class="skin-blue" class="skin-blue" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="background-color:transparent">
                <!-- Content Header (Page header) -->
                <!-- Main content -->
				<br><br>
                <section style="background-color:transparent">
                	    <div class="col-xs-12" style="padding: 0px 30px 10px 30px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
								<br>
								<center>
                                    <div class="small-box bg">
                                        <p> USER PROFILE </p>
                                    </div>
                                </center>
                                <div class="box-body table-responsive">
									<?php if(Session::exists('Success')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Success'); ?>
                                             </div>
                                    <?php }?>
                                    <br>
                                    <div class="profile">
                                        <?php include 'AdminHedStudViewFilter.php'?>	
                                    </div>
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

    setTimeout(function(){
		document.getElementById("alert").style.display = "none";
	}, 5000);
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
  
  $('#confirmDeactivate').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDeactivate').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });

  $('#confirmActivate').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmActivate').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });

  $('#confirmReset').on('show.bs.modal', function (e) {
    var $message = $(e.relatedTarget).attr('data-message');
    $(this).find('.modal-body p').text($message);
    $title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title);

    // Pass form reference to modal for submission on yes/ok
    var form = $(e.relatedTarget).closest('form');
    $(this).find('.modal-footer #confirm').data('form', form);
});

// Form confirm (yes/ok) handler, performs validation before submission
$('#confirmReset').find('.modal-footer #confirm').on('click', function(){
    var newPassword = $('#newPassword').val();
    var confirmPassword = $('#confirmPassword').val();
    var confirmPasswordError = $('#confirmPasswordError');

    // Check if passwords match
    if (newPassword !== confirmPassword) {
        confirmPasswordError.text('Passwords do not match. Please re-enter.');
    } else {
        confirmPasswordError.text(''); // Clear validation message if passwords match
        $(this).data('form').submit(); // Submit the form if validation passes
    }
});
</script>
</body>

</html>
