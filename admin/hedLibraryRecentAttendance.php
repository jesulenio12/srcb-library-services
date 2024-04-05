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
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/user/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- <link rel="stylesheet" type="text/css" href="css/dailyusers.css"> -->
<title>LIBRARY RECENT LOGGED</title>
</head>
<style>
	body {
        margin: 0;
        overflow: hidden; /* Hide scroll bars */
		background: transparent;
		background-size:cover;
		background-position:center center;
		background-repeat: no-repeat;
    }

	#video-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1; /* Place it behind other content */
    }

	/* First Record */
	.card {
		display: flex;
		justify-content: flex-start;
		align-items: center;
		gap: 30px;
		position: relative;
		margin-top: -105px;
		border-radius: 15px;
		padding: 0px 0 0px 25px;
		height: 350px;
		width: 800px;
		box-shadow: 0 4px 20px rgb(0 0 0 / 99%);
		border: 5px solid #3db166;
	}

	.avatar img {
		height: 300px;
		width: auto;
		border-radius: 50%;
	}

	span.name {
		font-size: 25px;
		font-weight: 500;
		font-family: fantasy;
	}

	.card-body p {
		font-size: 16px;
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
		font-size: 20px;
		font-family: sans-serif;
		font-weight: 600;
		text-transform: uppercase;
		padding: 4px 6px 1px 6px;
		border-radius: 5px;
		border: 1px solid white;
		width: fit-content;
	}

	.display-recent-logged {
		display: flex;
		flex-direction: column;
		gap: 105px;
	}

	/* Second - Third Record */
	.st-card {
		display: flex;
		justify-content: flex-start;
		align-items: center;
		gap: 30px;
		position: relative;
		margin-top: -105px;
		border-radius: 15px;
		padding: 0px 0 0px 20px;
		height: 153px;
		width: 455px;
		box-shadow: 0 4px 20px rgb(0 0 0 / 99%);
		border: 5px solid #3db166;
	}

	.st-avatar-row {
		display: flex;
		flex-direction: column;
	}

	.st-avatar img {
		height: 125px;
		width: auto;
		border-radius: 50%;
	}

	span.st-name {
		font-size: 12px;
		font-weight: 500;
		font-family: fantasy;
	}

	.st-card-body p {
		font-size: 9px;
		font-family: math;
		font-weight: 500;
		color: white;
	}

	span.st-time-logged {
		color: white;
		padding: 2px 5px;
		border-radius: 3px;
	}

	.st-user-type {
		font-size: 10px;
		font-family: sans-serif;
		font-weight: 700;
		text-transform: uppercase;
		padding: 1px 6px 1px 6px;
		border-radius: 5px;
		border: 1px solid white;
		width: fit-content;
	}

	.display-small-box.bg {
		display: flex;
		justify-content: center;
		margin-bottom: 25px;
	}

	.display-small-box {
		background-image: url(./images/nav2.jfif);
		background-size: cover;
		background-position: center center;
		background-repeat: no-repeat;
		padding: 23px 0px 10px 0px;
		width: 98%;
		font-family: Wide Latin;
		height: 110px;
		box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418);
		color: #163269;
		border-radius: 20px;
		border: 7px solid #3db166;
	}

	.display-small-box p {
		font-size: 30px;
		font-family: arial;
		font-weight: 900;
		transform: scale(2, 2);
		padding-top: 5px;
	}

	.display-small-box img {
		width: 40px;
		height: auto;
		margin-top: -8px;
	}

	.display-recent-logged {
		display: flex;
		flex-direction: column;
		gap: 105px;
	}

	.display-fetch-most-recent {
		display: flex;
		flex-direction: column;
		gap: 120px;
	}

	.display-all-card {
		display: flex;
		justify-content: center;
	}

	.display-text-divider {
		--display-text-divider-gap: 1rem;
		display: flex;
		align-items: center;
		font-size: 15px;
		text-transform: uppercase;
		letter-spacing: 0.1em;
		font-weight: bolder;
		font-family: Arial Black;
		margin-bottom: -4px;
		margin-top: -104px;
		color: white;
		padding: 0px 15px 0px 15px;
	}
	
	.display-text-divider::after {
		content: '';
		height: 4px;
		background-color: white;
		flex-grow: 1;
		border-radius: 10px;
	}

	.display-text-divider::after {
		margin-left: var(--display-text-divider-gap);
	}

	.display-logo-text-divider {
		--display-logo-text-divider-gap: 1rem;
		display: flex;
		align-items: center;
		margin-top: -74px;
		padding: 0px 120px 0px 120px;
	}
	
	.display-logo-text-divider::before, .display-logo-text-divider::after {
		content: '';
		height: 2px;
		background-color: #262222b8;
		flex-grow: 1;
		border-radius: 10px;
	}

	.display-logo-text-divider::before {
		margin-left: var(--display-logo-text-divider-gap);
	}

	.display-logo-text-divider::after {
		margin-left: var(--display-logo-text-divider-gap);
	}

	.display-logo {
		display: flex;
		justify-content: center;
		gap: 20px;
		margin: 0 15px;
	}

	.display-logo img {
		height: 45px;
		width: auto;
		filter: drop-shadow(10px 5px 10px black)
	}

	.copyright {
		background-color: #163269;
		height: 50px;
		color: white;
		font-size: 12px;
		padding: 16px 0 0 0;
		text-align: center;
		margin-top: -95px;
		position: relative;
	}

	.logoImage {
		position: absolute;
    	display: flex;
	}

	.logoImage img {
		width: 35px;
		height: 35px;
		position: relative;
		bottom: 40px;
    	left: 375px;
		filter: drop-shadow(10px 5px 10px black);
	}

	.logoImageScan {
		position: absolute;
    	display: flex;
	}

	.logoImageScan img {
		width: auto;
		height: 80px;
		position: relative;
		bottom: 105px;
    	left: 655px;
		filter: drop-shadow(10px 5px 10px black);
	}

</style>
<body>

	<video id="video-background" autoplay muted loop>
        <source src="video/BackgoundVideo.mp4" type="video/mp4">
    </video>

	<br>
	<div class="display-recent-logged">
		<center>
			<div class="display-small-box bg">
				<p style="color: #163269">
					<img src="images/logo.png"/>
						DAILY USERS LOG
					<img src="images/qrcode.jpg"/>
				</p>
			</div>
		</center>
	
		<div class="display-all-card">
			<div class="display-fetch">
				<?php include 'hedLibraryUsersAttendanceSorting.php'?>	
			</div>
			<div class="display-fetch-most-recent">
				<h1 class="display-text-divider"> MOST RECENT </h1>
				<?php include 'hedLibraryRecentAttendanceSorting.php'?>	
			</div>
		</div>
		<span class="display-logo-text-divider">
			<div class="display-logo">
				<?php include 'hedLibraryCoursesLogo.php'?>	
			</div>
		</span>
		<div class="copyright">
			<?php include 'includes/footer.html'; ?>
		</div>
	</div>
			
<script src="js/enter.js"></script>
<script src="js/jquery3.3.1.min.js"></script>
<script src="js/instascan.min.js"></script>
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
<!-- page script -->
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Function to refresh the page every 5 seconds
        setInterval(function() {
            location.reload();
        }, 5000); // 5000 milliseconds = 5 seconds
    });
</script>

</body>
</html>

