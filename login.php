<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles.css">
    <title>signin-signup</title>
</head>

<body>
    <header class="header">
        <div class="container1">
           <div class="header-main">
              <div class="logo">
                 <a href="#">St. Rita's College of Balingasag</a>
              </div>
              <div class="open-nav-menu">
                 <span></span>
              </div>
              <div class="menu-overlay">
              </div>
              <!-- navigation menu start -->
              <nav class="nav-menu">
                <div class="close-nav-menu">
                   <img src="img/close.svg" alt="close">
                </div>
                <ul class="menu">
                   <li class="menu-item menu-item-has-children">
                      <a href="#" data-toggle="sub-menu">Home <i class="plus"></i></a>
                      <ul class="sub-menu">
                          <li class="menu-item"><a href="#">Home 1</a></li>
                          <li class="menu-item"><a href="#">Home 2</a></li>
                          <li class="menu-item"><a href="#">Home 3</a></li>
                          <li class="menu-item"><a href="#">Home 4</a></li>
                      </ul>
                   </li>
                   <li class="menu-item">
                      <a href="#">About</a>
                   </li>
                   <li class="menu-item">
                      <a href="#">Services</a>
                   </li>
                   <li class="menu-item menu-item-has-children">
                      <a href="#" data-toggle="sub-menu">Pages <i class="plus"></i></a>
                      <ul class="sub-menu">
                          <li class="menu-item"><a href="#">page 1</a></li>
                          <li class="menu-item"><a href="#">page 2</a></li>
                          <li class="menu-item"><a href="#">page 3</a></li>
                          <li class="menu-item"><a href="#">page 4</a></li>
                      </ul>
                   </li>
                   <li class="menu-item">
                      <a href="#">News</a>
                   </li>
                   <li class="menu-item">
                      <a href="#">Contact</a>
                   </li>
                </ul>
              </nav>
              <!-- navigation menu end -->
           </div>
        </div>
     </header>
    <div class="container">
        <div class="signin-signup">
            <form action="" class="sign-in-form">
                <h2 class="title">Student</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password">
                </div>
                <input type="submit" value="Login" class="btn">
                <!-- <p class="social-text">Or Sign in with social platform</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div> -->
                <p class="account-text">Don't have an account? <a href="#" id="sign-up-btn2">Sign up</a></p>
            </form>
            <form action="" class="sign-up-form">
                <h2 class="title">Teacher</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password">
                </div>
                <input type="submit" value="Login" class="btn">
                <!-- <p class="social-text">Or Sign in with social platform</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div> -->
                <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Are you a student?</h3>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque accusantium dolor, eos incidunt minima iure?</p> -->
                    <button class="btn" id="sign-in-btn">Yes, I'm a student.</button>
                </div>
                <img src="signin.svg" alt="" class="image">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Are you a teacher?</h3>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque accusantium dolor, eos incidunt minima iure?</p> -->
                    <button class="btn" id="sign-up-btn">Yes, I'm a teacher.</button>
                </div>
                <img src="signup.svg" alt="" class="image">
            </div>
        </div>
    </div>
    <script src="js/app.js"></script>
    <script src="js/script.js"></script>
</body>

</html>