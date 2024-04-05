<?php

require_once 'core/init.php';

$user = new UserLogin(); //Current

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $username = Input::get('username');
        $password = Input::get('password');
        $permission = Input::get('permission');

        // Check if the user exists and the password is correct
        if ($user->login($username, $password, $permission)) {
            // Check if the user's status is 0
            if ($user->getUserSession($username) == 0) {
                // Update user's online status
                try {
                    $user->update(array(
                        'online' => 1,
                    ), $user->data()->id);
                } catch(Exception $e) {
                    $error;
                }

                // Insert login details
                $logindetails = new LoginDetails();
                $lastInsertId = $logindetails->insertUserLoginDetails($user->data()->id);
                $_SESSION['login_details_id'] = $lastInsertId;

                // Redirect the user based on their role
                if($user->isSuperAdmin()) {
                    Redirect::to('admin.php');
                } else {
                    Redirect::to('admin-staff-index.php');
                }
            } else {
                // User status is not 0, so they cannot login
				Redirect::to('admin-staff-index.php');
                Session::flash('LoginError', 'Your account is deactivated.');
            }
        } else {
            // Incorrect username or password
			Redirect::to('admin-staff-index.php');
            Session::flash('LoginError', 'Incorrect username or password');
        }
    }
}

?>

<!DOCTYPE html>
<!--Code by Divinector (www.divinectorweb.com)-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Library Staff Login</title>
	<link rel="icon" type="image/png" href="images/logo.png"/>
	<link rel="stylesheet" type="text/css" href="css/fontsgoogleapis.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="css/admin-staff-index.css">
	<link rel="icon" type="image/png" href="images/logo.png"/>
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
</head>
<body>  

<div class="login-container">
	<div class="login-wrapper">
		<div class="login-col-wrapper">
			<div class="col-md-6" id="welcome-col">
				<div class="login-form">
					<img src="./images/srcblogo.png"></img><br/>
					<h1 class="welcome-back">Hi, Admin!</h1><br/>
					<p class="sign-access">Sign in to continue access</p>
				</div>
			</div>
			<div class="col-md-6" id="login-col">
				<div class="login-form-input">
					<div class="login-form-body">
						<p> LOGIN </p>
						<form method="post" action="">
							<div class="session">
								<?php if(Session::exists('login')){?>
									<div class="alert alert-info" id="login">
										<i class="glyphicon glyphicon-info-sign"></i> &nbsp;<?php echo Session::flash('login'); ?>
									</div>
								<?php }?>
								<?php if(Session::exists('LoginError')){?>
									<div class="alert alert-danger" id="LoginError">
										<i class="fa fa-close"></i> &nbsp;<?php echo Session::flash('LoginError'); ?>
									</div>
								<?php }?>
								<?php if(Session::exists('IncorrectUsername')){?>
									<div class="alert alert-danger" id="IncorrectUsername">
										<i class="fa fa-close"></i> &nbsp;<?php echo Session::flash('IncorrectUsername'); ?>
									</div>
								<?php }?>
								<?php if(Session::exists('IncorrectPass')){?>
									<div class="alert alert-danger" id="IncorrectPass">
										<i class="fa fa-close"></i> &nbsp;<?php echo Session::flash('IncorrectPass'); ?>
									</div>
								<?php }?>	
							</div>
							<div class="row">
								<div class="add-input-container"> 
									<span for="permission"><i class="fas fa-bars"></i></span>
									<select class="add-input" name="permission" id="permission" required>
										<option hidden value="">Select Role</option>
										<?php
											$permission = DB:: getInstance()->query("SELECT * FROM groups WHERE name='Administrator' OR name='HED Library Staff'  OR name='HS Library Staff'  OR name='GS Library Staff' AND is_admin = 1");							
											foreach($permission->results() as $permission){
										?>
										<option class="permission" value="<?php echo $permission->id?>"><?php echo ucwords($permission->name) ?></option>
										<?php }?>
									</select> 
								</div>
							</div>
							<div class="row">
								<div class="add-input-container"> 
									<span for="username"><i class="fas fa-user"></i></span>
									<input type="text" class="add-input" id="username" name="username" placeholder="Username" required>
								</div>
							</div>
							<div class="row">
								<div class="add-input-container"> 
									<span for="password"><i class="fas fa-lock"></i></span>
									<input type="password" class="add-input" id="password" name="password" placeholder="Password" required>
								</div>
							</div>
							<br>
							<div class="button-row">
								<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
								<input class="login" type="submit" value="Login">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>

  
<script src="css/jquery.min.js"></script>
<script src="css/bootstrap.min.js"></script>
<script type="text/javascript">
	setTimeout(function(){
		document.getElementById("login").style.display = "none";
	}, 5000);
	setTimeout(function(){
		document.getElementById("LoginError").style.display = "none";
	}, 5000);
	setTimeout(function(){
		document.getElementById("IncorrectUsername").style.display = "none";
	}, 5000);
	setTimeout(function(){
		document.getElementById("IncorrectPass").style.display = "none";
	}, 5000);
</script>
</body>
</html>