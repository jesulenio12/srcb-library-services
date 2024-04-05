<?php
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
		$userlogin = new UserLogin();
			try {
				$userlogin->update(array(
                    'library_userID' => 'ID-'.Input::get('library_userID'),
					'username' => Input::get('username'),
					'permission' => Input::get('role'),
				), $_GET['uid']);
				Session::flash('UserUpdated', 'Library staff has been successfully updated.');
				Redirect::to('admin.php?action=userList');
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
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="buttonhover.css">
<link rel="stylesheet" type="text/css" href="css/addInputs.css">
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>Update Admin Role</title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}
</style>

<body class="skin-blue" class="skin-blue" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="background-color:transparent">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="background-color:transparent">
                    <!-- <h1>
						HED Department Teachers
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Edit Teacher's Profile</li>
                    </ol> -->
                </section>

                <!-- Main content -->
                <section class="content" class="col-lg-12 connectedSortable">
                    <div class="col-xs-12" tyle="padding: 0px 15px 10px 15px">
                        <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
							<br>
							<center>
								<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
									<p style="font-size:35px; transform: scale(1, 2);">
										UPDATE ADMIN ROLE
									</p>
								</div>
							</center>
                            <div class="box-body" style="padding: 0px 100px 0px 100px">
								<?php if(Session::exists('profileUpdated')){ ?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('profileUpdated'); ?>
                                    </div>
								<?php }?>
                                <?php 
									$users = DB:: getInstance()->query("SELECT * FROM userlogin WHERE id=".$_GET['uid']."");							
									foreach($users->results() as $users){
									?>
                                    <form id="editUser" action="" method="post">
                                        <div class="row" style="padding: 0px 20px 0px 20px">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="add-input-container"> 
                                                        <span for="library_userID">ID Number</span>
                                                        <input type="text" class="add-input" id="library_userID" name="library_userID" value="<?php echo substr ($username->library_userID, 3, 255); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="add-input-container"> 
                                                        <span for="username">Username</span>
                                                        <input type="text" class="add-input" id="username" name="username" value="<?php echo $users->username; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="add-input-container"> 
                                                        <span for="role">Role</span>
                                                        <select class="add-input" name="role" id="role" required>
                                                            <?php
                                                                $userRole = DB:: getInstance()->query("SELECT * FROM groups WHERE name='Administrator' OR name='HED Library Staff' OR name='HS Library Staff'  OR name='GS Library Staff'");							
                                                                foreach($userRole->results() as $userRole){
                                                                if ($userRole->id == $users->permission){
                                                                    $selected = 'selected';
                                                                }else{
                                                                    $selected = '';;
                                                                }
                                                            ?>
                                                            <option value="<?php echo $userRole->id;?>" <?php echo $selected; ?>><?php echo ucwords($userRole->name); ?></option>
                                                            <?php }?>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="row">
                                                <div class="col-md-6">
                                                    <div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
                                                        <label class="control-label" for="username">Username</label>
                                                    </div>
                                                    <div class="form-group" style="width:100%; padding-left:110px;">
                                                        <input style="height:50px; font-size: 17px; padding-left: 75px" type="text" class="form-control" id="username" name="username" placeholder="Input username" value="<?php echo $users->username; ?>" required >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div style="width:25%; height:50px; background-color:#163269; padding: 13px 8px 0px 15px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
                                                        <label class="control-label" for="role">User Role</label>
                                                    </div>
                                                    <div class="form-group" style="width:100%; padding-left:110px;">
                                                        <select style="height:50px; font-size: 17px; padding-left: 75px" class="form-control" name="role" id="role" >
                                                            <option hidden value="">Select Role</option>
                                                            <?php
                                                                $userRole = DB:: getInstance()->query("SELECT * FROM groups WHERE name='Administrator' OR name='HED Library Staff' OR name='HS Library Staff'  OR name='GS Library Staff'");							
                                                                foreach($userRole->results() as $userRole){
                                                                if ($userRole->id == $users->permission){
                                                                    $selected = 'selected';
                                                                }else{
                                                                    $selected = '';;
                                                                }
                                                            ?>
                                                            <option value="<?php echo $userRole->id;?>" <?php echo $selected; ?>><?php echo ucwords($userRole->name); ?></option>
                                                            <?php }?>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="clearfix"></div><hr />
                                            <div class="row">
                                                <div class=" col-md-6">
                                                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                                    <button type="submit" class="btnupdate" style="color: #fff">&nbsp;UPDATE</button>
                                                </div>
                                                <div class=" col-md-6">
                                                    <a style="color: #fff;" href="admin.php?action=userList"><button type="button" class="btncancel">CANCEL</button></a> 
                                                </div>
                                            </div>
                                        <br />
                                    </form>
								<!-- Modal -->
									</div>
								<?php }?>                 
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                    </div><!-- /.col -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
                    
<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap Datepicker -->
<script src="js/bootstrap-datepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- Bootstrap Validator JS -->
<script src="styles/admin/js/bootstrapValidator.min.js"></script>    
<script type="text/javascript">
	$(document).ready(function() {
        var validator = $("#editUser").bootstrapValidator({
			fields : {
				username : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Username cannot be empty.",
						},
					}
				},
				userRole : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Please select a User Role.",
						},
					}
			}
		});
    });
</script>
</body>
</html>