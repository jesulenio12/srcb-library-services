<!DOCTYPE html>
<!--Code by Divinector (www.divinectorweb.com)-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Homepage</title>
	<link rel="icon" type="image/png" href="images/logo.png"/>
	<link rel="stylesheet" type="text/css" href="css/fontsgoogleapis.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
</head>

<style>
    .carousel-caption h2 {
        font-size: clamp(2.5rem, 1.0774rem + 3.7936vw, 5.625rem);
    }

    .bounceInLeft, .fadeInLeft, .fadeInUp {
        font-size: clamp(1.5rem, 0.7074rem + 2.7936vw, 4.625rem);
    }

    .carousel-caption a {
        font-size: clamp(1rem, 1.0774rem + 1.7936vw, 2rem);
        padding: clamp(0.5rem, 1rem + 1vw, 2rem);
        border-radius: 5px;
    }

    .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    header,
    #carousel-example-generic,
    footer {
        margin-left: 0;
        margin-right: 0;
    }

    .navbar-header {
        text-align: left;
    }

</style>
<body>

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
                        <li><a class="btn" style="color:#3db166;" href="index.php">HOME</a></li>
                        <li><a class="btn" style="color:#163269" href="lib-users-about.php">ABOUT</a></li>
                        <li><a class="btn" style="color:#163269" href="lib-users-contact.php">CONTACT</a></li>
                        <li><a class="btn" style="color:#163269" href="lib-users-index.php">LOG IN</a></li>
                        <!-- <li><a class="btn" style="color:#3db166" href="#"><i class="fa-solid fa-bell"></i></a></li> -->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="banner img-responsive" style="background-image: url(images/lib-gb1.jpg); position:relative"></div>
                <div class="carousel-caption">
                    <h2 class="animated slideInDown" style="animation-delay: 1s">Welcome to the library!</h2>
                    <h3 class="animated bounceInLeft" style="animation-delay: 2s">Your auxiliary in unlocking knowledge</h3>
                    <p class="animated bounceInRight" style="animation-delay: 3s"><a href="lib-users-index.php">Login</a></p>
                </div>
            </div>
            <!-- <div class="item">
                <div class="banner" style="background-image: url(images/lib-gb3.jpg); position:relative"></div>
                <div class="carousel-caption">
                    <h2 class="animated zoomIn" style="animation-delay: 1s">The book</h2>
                    <h3 class="animated fadeInLeft" style="animation-delay: 2s">is not an escape from life but a shortcut to a better one.</h3>
                    <p class="animated zoomIn" style="animation-delay: 3s"><a href="lib-users-index.php">Login</a></p>
                </div>
            </div>
            <div class="item">
                <div class="banner"style="background-image: url(images/jeju.jpeg); position:relative"></div>
                <div class="carousel-caption">
                    <h2 class="animated slideInDown" style="animation-delay: 1s">READ. KNOW. LEARN. GO.</h2>
                    <h3 class="animated fadeInUp" style="animation-delay: 2s">The more you read, the more things you will know. The more you will learn, the more places you'll go.</h3>
                    <p class="animated zoomIn" style="animation-delay: 3s"><a href="lib-users-index.php">Login</a></p>
                </div>
            </div> -->
        </div>
    </div>

    <div class="copyright">
        <?php include 'includes/footer.html'; ?>
    </div>
	
<script src="css/jquery.min.js"></script>
<script src="css/bootstrap.min.js"></script>
</body>
</html>