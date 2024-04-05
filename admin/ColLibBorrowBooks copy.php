<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current
	
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {  
			$qrcodevaluechek = Input::get('qrcode');
			$books = DB::getInstance()->get('books', array('bookAccession','=',Input::get('qrcode')));
			if ($books->count()){
				foreach($books->results() as $books){
					$book = new Books();
					 try {
						$book->update(array(
							'is_borrowed' => 1,
							'dateBorrowed' => date('Y-m-d'),
							'status' => 'Not Available',
							'library_userID' => Input::get('library_userID'),
							'userType' => Input::get('userType'),
							'firstname' => Input::get('firstname'),
							'lastname' => Input::get('lastname'),
							'gender' => Input::get('gender'),
							'yearLevel' => Input::get('yearLevel'),
							'classSection' => Input::get('classSection'),
							'departmentType' => Input::get('departmentType'),
							'progtrack' => Input::get('progtrack'),
							'transactionPlace' => 'Col-Lib',
						),$books->id);
					} catch(Exception $e) {
					   $error;
					}
				}
			}
			
			$booktransaction = new BookTransactions();
            try {
                $booktransaction->create(array(
					'transactionType'  => 'borrow',
					'transactionDate' => date('Y-m-d'),
					'transactionPlace' => 'Col-Lib',
					'bookAccession' => Input::get('qrcode'),
					'callNumber' => Input::get('callNumber'),
					'bookSection' => Input::get('bookSection'),
					'bookTitle' => Input::get('bookTitle'),
					'author' => Input::get('author'),
					'publisher' => Input::get('publisher'),
					'datePublished' => Input::get('datePublished'),
					'library_userID' => Input::get('library_userID'),
					'userType' => Input::get('userType'),
					'fullname' => Input::get('firstname').' '.Input::get('lastname'),
					'gender' => Input::get('gender'),
					'yearLevel' => Input::get('yearLevel'),
					'classSection' => Input::get('classSection'),
					'progtrack' => Input::get('progtrack'),
					'departmentType' => Input::get('departmentType'),
					'totalFines' => '0',
					'interval2' => '0 day(s)',
					'payment' => '0',
					'remarks' => 'N/A',
					'received' => '0',
					'returned' => '0',
					'finesperDueDate'  => '3',
					'libraryClass' => 'College Library',
                ));
			
			Session::flash('Borrowed', 'New Book has been borrowed.');
			Redirect::to('admin.php?action=hedStaff_BookLoaning');
            } catch(Exception $e) {
               $error;
            }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" type="image/png" href="admin/images/logo.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- bootstrap 3.0.2 -->
<link href="styles/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="styles/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/all.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link rel="stylesheet" href="buttonhover.css">
<link rel="stylesheet" type="text/css" href="css/secondary-inputs.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<title>Book Loaning Transaction</title>
<style>
.video-box {
	margin: auto;
	width:90%;
	border:10px solid #dcdcdc;
	background-color: #dcdcdc;
}
.btn-huge{
	width:100%;
    padding:20px;
	margin-bottom:5px;
}

</style>
</head>
<body style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="center">
                <!-- Content Header (Page header) -->
                <!-- <section class="center">
					<center>
						<h1 class="small-box" style="background-color:#00c0ef; color: white; padding: 35px 0px 25px 0px; width:98%; font-family: Wide Latin; font-size:70px; height: 160px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
						BORRROW BOOKS
						</h1>
					</center>
                </section> -->
				<section class="center">
					<br>
					<center>
						<div class="small-box" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; color: #163269; padding: 40px 0px 25px 0px; width:98%; font-family: Wide Latin; height: 160px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid #3db166; cursor: pointer;">
							<p style="font-size:50px; transform: scale(1, 2);">
								<img src="images/logo.png" width="140" height="60" style="margin-top:-12px"/>
									BORROW BOOKS
								<img src="images/qrcode.jpg" width="135" height="55" style="margin-top:-12px"/>
							</p>
						</div>
						<!-- <h1 style="width:99%; font-family: Arial Black; font-size:30px; color:white; height: 60px; border-radius: 80px;">
						--------------------- CHOSE TRANSACTION TYPE --------------------- 
						</h1> -->
					</center>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-xs-12" style="padding: 0px 30px 0px 30px;">
                            <div class="box box-primary" style="background-color: rgba(255, 255, 255, 0.239); border-radius:20px; padding: 0px 20px 0px 20px;">
								<br>
                                <div class="box-body">
									<div class="row">
										<form enctype="multipart/form-data" method="post" action="" >
											<input type="hidden" class="form-control" id="classSection" name="classSection" readonly>
											<input type="hidden" class="form-control" id="departmentType" name="departmentType" readonly>
											<div class="row">
												<div class="col-xs-5">
													<div class="row">
														<div class="col-xs-12">
															<div class="video-box" style="border-radius:20px; width:95%;">
																<video width="100%" id="preview"></video>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-12">
															<span id="msg" name="msg">
															</span>
														</div>
														<div class="col-xs-12">
															<div style="display:none" id="qrinvalid" name="qrinvalid" class="alert alert-danger" >
																<i class="glyphicon glyphicon-remove"></i> QR code invalid.
															</div>
														</div>
														<audio src="admin/beep.mp3" id="audio" controls style="display:none"></audio>
													</div>
												</div>
												<div class="col-xs-7" style="text-transform:uppercase; margin-top: -30px;">
													<br><br>
													<div class="row">
														<div class=" col-md-6">
															<div style="width:92%; height:50px; background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; padding: 5px 0px 0px 15px; font-size: 25px; color:white; position: absolute; border-radius:25px; text-align:center; border: 3px solid white"> 
																<label class="control-label">Books Information</label>
															</div>
														</div>
														<div class=" col-md-6">
															<div style="width:92%; height:50px; background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; padding: 5px 0px 0px 15px; font-size: 25px; color:white; position: absolute; border-radius:25px; text-align:center; border: 3px solid white"> 
																<label class="control-label">Borrower Information</label>
															</div>
														</div>
													</div>
													<br><br><br>
													<div class="row">
														<div class="col-md-6">
															
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="qrcode">Accession</span>
																<input type="text" class="input" id="qrcode" name="qrcode" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="library_userID">ID Number</span>
																<input type="text" class="input" id="library_userID" name="library_userID" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="callNumber">Call Number</span>
																<input type="text" class="input" id="callNumber" name="callNumber" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="userType">Loaner</span>
																<input type="text" class="input" id="userType" name="userType" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="bookSection">Book Section</span>
																<input type="text" class="input" id="bookSection" name="bookSection" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="firstname">Firstname</span>
																<input type="text" class="input" id="firstname" name="firstname" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="bookTitle">Book Title</span>
																<input type="text" class="input" id="bookTitle" name="bookTitle" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="lastname">Lastname</span>
																<input type="text" class="input" id="lastname" name="lastname" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="author">Author</span>
																<input type="text" class="input" id="author" name="author" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="gender">Gender</span>
																<input type="text" class="input" id="gender" name="gender" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="publisher">Publisher</span>
																<input type="text" class="input" id="publisher" name="publisher" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="yearLevel">Year Level</span>
																<input type="text" class="input" id="yearLevel" name="yearLevel" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="datePublished">Copyright Year</span>
																<input type="text" class="input" id="datePublished" name="datePublished" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="input-container"> 
																<span for="progtrack">Course</span>
																<input type="text" class="input" id="progtrack" name="progtrack" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
															<button type="submit" class="btns" style="display: none" name="transact" id="transact">BORROW</button>
														</div>
														<div class="col-md-6">
															<a style="color: #3db166;" href="admin.php?action=hedStaff_BookLoaning"><button type="button" class="btnc">CANCEL</button></a> 
														</div>
													</div>
												</div>
											</div>
											<hr>
										</form>
									</div>
								</div><!-- /.box -->
								
							</div><!-- /.box -->
						</div><!-- /.col -->
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
	<script src="js/jquery3.3.1.min.js"></script>
	<script src="js/instascan.min.js"></script>
	<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
		var qrcode = content;
		let accessionsubstring = qrcode.substring(0,4);
		let idsubstring = qrcode.substring(0,3);
		if(accessionsubstring == 'Acc:'){
			$.ajax({
				type: "POST",
				url: "borrow.php",
				dataType: "json",
				data: {qrcode:qrcode, action:'view_book_info'},
				success : function(data){
					$("#qrcode").val(data.id);
					$("#callNumber").val(data.callNumber);
					$("#bookSection").val(data.bookSection);
					$("#bookTitle").val(data.bookTitle);
					$("#author").val(data.author);
					$("#publisher").val(data.publisher);
					$("#datePublished").val(data.datePublished);
					$("#msg").html(data.msg);
					if (data.id == '') {
						document.getElementById("transact").style.display = "none";
					}else{
						document.getElementById("transact").style.display = "block";
						document.getElementById("audio").play();
						document.getElementById("transact").focus();
					}
					document.getElementById("qrinvalid").style.display = "none";
				}
			});
		}
		else if(idsubstring == 'ID-'){
			$.ajax({
				type: "POST",
				url: "borrow.php",
				dataType: "json",
				data: {qrcode:qrcode, action:'view_users_info'},
				success : function(data){
					$("#library_userID").val(data.userid); 
					$("#userType").val(data.userType);
					$("#firstname").val(data.firstname);
					$("#lastname").val(data.lastname);
					$("#gender").val(data.gender);
					$("#yearLevel").val(data.yearLevel);
					$("#classSection").val(data.classSection);
					$("#departmentType").val(data.departmentType);
					$("#progtrack").val(data.progtrack);
					$("#msg").html(data.msg);
					if (data.id == '') {
						document.getElementById("transact").style.display = "none";
					}else{
						document.getElementById("transact").style.display = "block";
						document.getElementById("audio").play();
						document.getElementById("transact").focus();
					}
				}
			});
		}

			
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
	<script>
		setTimeout(function(){
			document.getElementById("msg").style.display = "none";
		}, 5000);
		
			setTimeout(function(){
			document.getElementById("qrinvalid").style.display = "none";
		}, 5000);
	</script>
	<!-- jQuery 2.0.2 -->
	<script src="styles/admin/js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
	<!-- Bootstrap Validator JS -->
	<script src="styles/admin/js/bootstrapValidator.min.js"></script>
	<script src="styles/admin/js/sweetalert.min.js"></script>
	<script src="styles/admin/js/datetime.js" defer></script>
</body>
</html>

