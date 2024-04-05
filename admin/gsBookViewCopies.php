<?php
require_once 'core/init.php';

$bookTitle = ''; // Initialize the variable

if (isset($_GET['bookTitle'])) {
    $bookTitle = $_GET['bookTitle']; // Store the book title
}

if (Input::exists()) {
    $PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'gsBookQRCodes' . DIRECTORY_SEPARATOR;

    $books = DB::getInstance()->get('books', array('id', '=', Input::get('discard')));
    foreach ($books->results() as $books) {
        unlink($PNG_TEMP_DIR . $books->qrcode);
    }

    $books = DB::getInstance()->get('books', array('id', '=', Input::get('discard')));
    if ($books->count()) {
        foreach ($books->results() as $books) {
            $book = new Books();
            try {
                $book->update(array(
                    'discarded' => 1,
                ), $books->id);
            } catch (Exception $e) {
                $error;
            }
        }
    } else {
        $books = DB::getInstance()->get('books', array('id', '=', Input::get('lost')));
        foreach ($books->results() as $books) {
            unlink($PNG_TEMP_DIR . $books->qrcode);
        }
        $books = DB::getInstance()->get('books', array('id', '=', Input::get('lost')));
        if ($books->count()) {
            foreach ($books->results() as $books) {
                $book = new Books();
                try {
                    $book->update(array(
                        'lost' => 1,
                    ), $books->id);
                } catch (Exception $e) {
                    $error;
                }
            }
        }

        Session::flash('Lost', 'Library book has been successfully updated.');

        // Use the stored book title for redirection
        if (!empty($bookTitle)) {
             Redirect::to('admin.php?action=gsBookViewCopies&bookTitle=' . urlencode($_GET['bookTitle']));
        } else {
           Redirect::to('admin.php?action=ElementaryBookList');
        }
    }

    Session::flash('Discarded', 'Library book has been successfully discarded.');

    // Use the stored book title for redirection
    if (!empty($bookTitle)) {
		 Redirect::to('admin.php?action=gsBookViewCopies&bookTitle=' . urlencode($_GET['bookTitle']));
    } else {
       Redirect::to('admin.php?action=ElementaryBookList');
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
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>GS Online Book Requested</title>
</head>

<style>
    .btn-arrow-back {
        font-family: "Roboto", sans-serif;
        font-size: 18px;
        border: none;
        font-weight: bold;
        background: #3db166;
        width: fit-content;
        height: 35px;
        padding: 6px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        color: white;
        border-radius: 10px;
        cursor: pointer;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition-duration: 0.3s;
        transition-property: box-shadow, transform;
    }

    .btn-arrow-back:hover, .btn-arrow-back:focus, .btn-arrow-back:active{
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
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
									<div class="small-box bg" style="background-image: url(images/background.jpg); color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
										<p class="dynamic-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%; font-size:27px; transform: scale(1, 2); padding: 10px 30px;">
											<?php echo isset($_GET['bookTitle']) ? htmlspecialchars(urldecode($_GET['bookTitle'])) : 'ALL BOOK COPIES'; ?>
										</p>
									</div>
								</center>
								<br>
								<hr style="border-top:1px dotted #000;"/>	
                                <div class="box-body table-responsive">
									<?php if(Session::exists('Updated')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Updated'); ?>
                                             </div>
                                    <?php }?>
                                    <?php if(Session::exists('Discarded')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Discarded'); ?>
                                             </div>
                                    <?php }?> 
									<?php if(Session::exists('Lost')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Lost'); ?>
                                             </div>
                                    <?php }?> 
                                    <?php if(Session::exists('Deleted')){ ?>
                                             <div class="alert alert-danger" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Deleted'); ?>
                                             </div>
                                    <?php }?> 
                                    
                                    <table class="table table-bordered table-hover" id="books">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Accession No.</th>
												<th>ISBN</th>
												<th>Call No.</th>
												<th>Author</th>
												<th>Author No.</th>
												<th>Subject</th>
												<th>Publisher</th>
												<th>© Year</th>
												<th>Section</th>
												<th>Status</th>
												<th class="noprint" style="width:15%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php include 'gsBookViewCopiesFilter.php'?>	
                                        </tbody>
                                    </table>
                                    <a style="color: #fff;" href="admin.php?action=ElementaryBookList">
										<button type="button" class="btn-arrow-back"><i class="fa fa-arrow-left"></i> GO BACK</button>
									</a>
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
  
  $('#confirmApproval').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmApproval').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });

  $('#confirmDiscard').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDiscard').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });

  $('#confirmLost').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmLost').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>
</body>

</html>
