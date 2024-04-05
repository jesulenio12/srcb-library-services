<?php
require_once 'core/init.php';
$user = new UserLogin(); //Current

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
            $user = new UserLogin();
			$logindetails = new LoginDetails();
			
            $login = $user->login('ID-'.Input::get('username'), Input::get('password'), Input::get('permission'));

            if($login) {
				try {
				$user->update(array(
					'online' => 1,
					), $user->data()->id);
				} catch(Exception $e) {
					$error;
				}
				$lastInsertId = $logindetails->insertUserLoginDetails($user->data()->id);
				$_SESSION['login_details_id'] = $lastInsertId;
				
				if($user->isSuperAdmin()) {
                    Redirect::to('admin.php');
				}else{
				    Redirect::to('lib-users-index.php');
				}
            } else {
				Session::flash('incorrectData', 'Incorrect username or password');
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
	<title>Library Users Login</title>
	<link rel="icon" type="image/png" href="images/logo.png"/>
	<link rel="stylesheet" type="text/css" href="css/fontsgoogleapis.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="css/lib-users-index.css">
	<link rel="icon" type="image/png" href="images/logo.png"/>
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
</head>
<body>

<style>
	.termpol {
		display: flex;
		justify-content: center;
		background-color: transparent;
		color: white;
		border: none;
		font-size: 12px;
		margin-top: 20px;
	}

	.termpol:hover {
		color: #776e6e;
	}
	
	.term-content span {
		font-weight: bold;
		text-align: justify;
	}

	.term-content {
		text-align: justify;
	}

	.modal-header {
		border-bottom: 1px solid #e5e5e5;
		font-weight: 900;
		margin-top: 10px;
	}

	.login-form-input {
		justify-content: center
	}

	.login-container {
		background-image: url(images/lib-bg.jpg);
		background-position: center center;
		background-repeat: no-repeat;
		background-size: cover;
		min-width: 100%;
		height: 100dvh;
		display: flex;
		justify-content: center;
		padding-top: 80px;
	}
</style>

	<header>
		<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button style="background-color:#163269" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php"><img src="images/srcblogo.png" /></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a class="btn" style="color:#163269" href="index.php">HOME</a></li>
						<li><a class="btn" style="color:#163269" href="lib-users-about.php">ABOUT</a></li>
                        <li><a class="btn" style="color:#163269" href="lib-users-contact.php">CONTACT</a></li>
						<li><a class="btn" style="color:#3db166" href="lib-users-index.php">LOG IN</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>

	<div class="login-container">
		<div class="login-wrapper">
			<div class="login-col-wrapper">
				<div class="col-md-6" id="welcome-col">
					<div class="login-form">
						<img src="./images/srcblogo.png"></img><br/>
						<h1 class="welcome-back">Hi, Welcome!</h1><br/>
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
												$permission = DB:: getInstance()->query("SELECT * FROM groups WHERE name='Student' OR name='Teacher'");							
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
								<center>
									<button type="button" class="termpol" data-toggle="modal" data-target="#termpol">Terms & Policies</button>
								</center>
							</form>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>	
	
	<div class="copyright">
		<?php include 'includes/footer.html'; ?>
	</div>

	<div class="modal fade" id="termpol" tabindex="-1" role="dialog" aria-labelledby="termpolLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<center>
							<div class="small-box">
								<p id="termpolLabel">
									TERMS AND POLICIES
								</p>
							</div>
						</center>
					</div>
						<div class="modal-body">
							<p class="term-content">
								Effective Date: April 2023
								<br><br>
								Welcome to our Library Management System ("System"). This document outlines the terms and policies governing the use of our System and ensures the safety and lawful handling of user data. By accessing or using our System, you agree to comply with these terms and policies. Please read them carefully.
								<br><br>
								<span>1. Data Collection and Use</span>
								<br><br> 
								<span>1.1 User Data:</span> The System collects and stores user data, including but not limited to personal information, borrowing history, and preferences. This data is collected solely for the purpose of managing library operations, providing personalized services, and improving user experience.
								<br><br> 
								<span>1.2 Confidentiality:</span> We are committed to protecting the confidentiality of user data. We will not sell, rent, or disclose any personally identifiable information to any third parties unless required by law or with the user's explicit consent.
								<br><br> 
								<span>1.3 Data Security:</span> We implement appropriate technical and organizational measures to safeguard user data against unauthorized access, alteration, disclosure, or destruction. However, please note that no method of data transmission over the internet or electronic storage is 100% secure.
								<br><br>
								<span>2. Legal Compliance</span>
								<br><br> 
								<span>2.1 Lawful Use:</span> Users agree to use the System for lawful purposes only. Any illegal activities, including but not limited to unauthorized access, data breaches, and copyright infringement, are strictly prohibited.
								<br><br> 
								<span>2.2 Compliance with Regulations:</span> We comply with applicable data protection and privacy regulations, including but not limited to the General Data Protection Regulation (GDPR) and relevant national and regional laws. User data is processed in accordance with these regulations.
								<br><br>
								<span>3. User Rights and Responsibilities</span>
								<br><br> 
								<span>3.1 User Consent:</span> By using our System, users consent to the collection, storage, and processing of their data as outlined in these terms and policies.
								<br><br> 
								<span>3.2 User Access and Control:</span> Users have the right to access, rectify, or delete their personal data stored in the System. Requests for data access, rectification, or deletion can be made through the designated channels provided by the System.
								<br><br> 
								<span>3.3 User Responsibility:</span> Users are responsible for maintaining the confidentiality of their account credentials and ensuring the accuracy of the information provided. Users must promptly notify the System administrators of any unauthorized access or suspected security breaches.
								<br><br>
								<span>4. Third-Party Services and Links</span>
								<br><br> 
								<span>4.1 Third-Party Integration:</span> The System may integrate with third-party services or websites for enhanced functionality. Users should review the terms and privacy policies of these third parties, as they operate independently and may have their own data collection and handling practices.
								<br><br> 
								<span>4.2 External Links:</span> The System may contain links to external websites or resources. We are not responsible for the content, privacy practices, or security of these external sites. Users access them at their own risk.
								<br><br>
								<span>5. Modifications to Terms and Policies</span>
								<br><br> 
								<span>5.1 Updates:</span> We reserve the right to modify or update these terms and policies at any time. Users will be notified of any material changes via email or by prominently displaying a notice within the System. Continued use of the System after such modifications constitutes acceptance of the revised terms and policies.
								<br><br>
								By using our Library Management System, you acknowledge that you have read, understood, and agreed to these terms and policies.
							</p>
						<div class="modal-footer">
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