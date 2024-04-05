        <header class="header">
        <style>
           .skin-blue .sidebar > .sidebar-menu > li > a:hover,
            .skin-blue .sidebar > .sidebar-menu > li.active > a {
            color: #f4f4f4;
            background-image: url(images/background.jpg);
            box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418);
            }

            .skin-blue .navbar, .skin-blue .left-side {
                background-image: url(images/nav2.jfif);
                background-size: cover;
                background-position: center center;
                background-repeat: no-repeat;
            }

           .skin-blue .navbar .nav a {
                color: #333;
            }

            body > .header .navbar .sidebar-toggle {
                background-color: rgba(89, 62, 62, 0.218); 
                border-radius:2px;
            }

            .skin-blue .logo {
                background-image: url(images/nav2.jfif);
                background-size: cover;
                background-position: center center;
                background-repeat: no-repeat;
                color: #333;
            }

        </style>
            <div href="#" class="logo" style="font-size: 20px; font-family:Cooper Black;">    
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="images/srcblogo.png" style="width:175px; height:40px"/>
            </div>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
				<?php 
					$group = DB:: getInstance()->get('groups', array('id', '=', $user->data()->permission));?>
				<span class="logo-title">
					<!-- Add the class icon to your logo image or logo icon to add the margining -->
					
				<?php
					foreach($group->results() as $group){?>
				</span>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user-circle"></i>
                                <span style="font-size: 15px;">
									<?php 
									if ($user->data()){
										echo $user->data()->firstname.' '.$user->data()->lastname;
                                        $_SESSION["permissionRole"] = $user->data()->permissionRole;
                                        $_SESSION["firstname"] = $user->data()->firstname;
                                        $_SESSION["lastname"] = $user->data()->lastname;
                                        $_SESSION["username"] = $user->data()->username;
                                        $_SESSION["gender"] = $user->data()->gender;
                                        $_SESSION["yearLevel"] = $user->data()->yearLevel;
                                        $_SESSION["classSection"] = $user->data()->classSection;
                                        $_SESSION["progtrack"] = $user->data()->progtrack;
                                        $_SESSION["departmentType"] = $user->data()->departmentType;
									}?> <i class="caret"></i>

                                    
								</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">>
									<?php if (!$user->data()->avatar == ''){?>
										<img src="admin/UserAvatars/<?php echo $user->data()->avatar?>" class="img-circle" style="border: 5px solid #163269;" alt="User Image" />
									<?php }else{ ?>
										 <img src="admin/images/logo.png" class="img-circle" style="border: 5px solid #163269;" alt="User Image" />
									<?php }?>
                                    <center>
                                        <div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 5px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 35px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 5px solid lightgrey;">
                                            <p id="exampleModalLabel" style="font-size:12px; transform: scale(.7, 1.5);">
                                                <?php echo $group->name;?>
                                            </p>
                                        </div>
                                    </center>
                                    <p class="username" style="width:100%; text-shadow: 2px 2px 20px #000000; color: white; margin-top:-10px; font-size:25px; font-family:Cooper Black" >
                                        <?php 
										if ($user->data()){
											echo $user->data()->username;
										}?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                               
                                <li class="user-footer">
                                    <div class="rowset">
                                        <div class="col-md-6">
                                            <a href="admin.php?action=settings"><button type="button" class="btnacc" style="color:white;">Settings</button></a> 
                                        </div>
                                        <div class="col-md-6">
                                            <?php if($user->data()->permission != 5 && $user->data()->permission != 6){?>
                                                <a href="admin-staff-index.php"><button type="button" class="btnlo">Logout</button></a> 
                                            <?php }else{?>
                                                <a href="index.php"><button type="button" class="btnlo">Logout</button></a> 
                                            <?php }?>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
				<?php }?>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
				<?php if($user->isAdmin()) {?>
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="admin.php?action=admin_dashboard">
                                <i class="fa fa-tachometer-alt"></i>  <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-clipboard"></i>
                                    <span>Daily Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="admin.php?action=studentHedAttendance">
                                        <i class="fa fa-angle-double-right"></i> <span>Students</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="admin.php?action=teacherHedAttendance">
                                        <i class="fa fa-angle-double-right"></i> <span>Teachers</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                               <i class="fa fa-book"></i>
                                <span>Book Monitoring</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview">
                                    <a href="#">
                                    <i class="fa fa-angle-double-right"></i>
                                        <span>Book Loaning Reports</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="treeview">
                                            <a href="#">
                                            <i class="fa fa-angle-right"></i>
                                                <span>Students</span>
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </a>
                                                <ul class="treeview-menu">
                                                    <li><a href="admin.php?action=studentsHed_transactionHistory(Borrowed)"><i class="fa fa-caret-right"></i>HED Department</a></li>                                   
                                                    <li><a href="admin.php?action=studentsShs_transactionHistory(Borrowed)"><i class="fa fa-caret-right"></i>SHS Department</a></li>	
                                                    <li><a href="admin.php?action=studentsJhs_transactionHistory(Borrowed)"><i class="fa fa-caret-right"></i>JHS Department</a></li>     
                                                    <li><a href="admin.php?action=studentsElem_transactionHistory(Borrowed)"><i class="fa fa-caret-right"></i>GS Department</a></li>                                     										
                                                </ul>
                                        </li>
                                        <li class="treeview">
                                            <a href="#">
                                            <i class="fa fa-angle-right"></i>
                                                <span>Teachers</span>
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </a>
                                                <ul class="treeview-menu">
                                                    <li><a href="admin.php?action=teachersHed_transactionHistory(Borrowed)"><i class="fa fa-caret-right"></i>HED Department</a></li>                                   
                                                    <li><a href="admin.php?action=teachersShs_transactionHistory(Borrowed)"><i class="fa fa-caret-right"></i>SHS Department</a></li>	
                                                    <li><a href="admin.php?action=teachersJhs_transactionHistory(Borrowed)"><i class="fa fa-caret-right"></i>JHS Department</a></li>     
                                                    <li><a href="admin.php?action=teachersElem_transactionHistory(Borrowed)"><i class="fa fa-caret-right"></i>GS Department</a></li>  
                                                </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="admin.php?action=AdminBookListRecord(ColLib)">
                                        <i class="fa fa-angle-double-right"></i> <span>Book Records</span>
                                    </a>
                                </li>
                                <li class="treeview">
                                        <a href="#">
                                        <i class="fa fa-angle-double-right"></i>
                                            <span>Book Fines</span>
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </a>
                                            <ul class="treeview-menu">
                                            <li><a href="admin.php?action=AdminColLibBookFinesReport"><i class="fa fa-caret-right"></i>HED Library</a></li>                                   
                                            <li><a href="admin.php?action=AdminHsLibBookFinesReport"><i class="fa fa-caret-right"></i>HS Library</a></li>
                                            <li><a href="admin.php?action=AdminGsLibBookFinesReport"><i class="fa fa-caret-right"></i>GS Library</a></li>		
                                            </ul>
                                    </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                               <i class="fa fa-chart-bar"></i>
                                <span>Library Statistics</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview">
                                    <a href="#">
                                    <i class="fa fa-angle-double-right"></i>
                                        <span>Most Borrowed Books</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="admin.php?action=CollegeMostBorrowedBooks(AdminReport)"><i class="fa fa-caret-right"></i>HED Library</a></li>                                   
                                        <li><a href="admin.php?action=HighSchoolMostBorrowedBooks(AdminReport)"><i class="fa fa-caret-right"></i>HS Library</a></li>
                                        <li><a href="admin.php?action=ElementaryMostBorrowedBooks(AdminReport)"><i class="fa fa-caret-right"></i>GS Library</a></li>		
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#">
                                    <i class="fa fa-angle-double-right"></i>
                                        <span>Top Borrowers</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="admin.php?action=HedStudTopBorrowers"><i class="fa fa-caret-right"></i>HED Library</a></li>                                   
                                        <li><a href="admin.php?action=ShsStudTopBorrowers"><i class="fa fa-caret-right"></i>HS Library</a></li>
                                        <li><a href="admin.php?action=ElemStudTopBorrowers"><i class="fa fa-caret-right"></i>GS Library</a></li>		
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#">
                                    <i class="fa fa-angle-double-right"></i>
                                        <span>Top Library Users</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="admin.php?action=HedStudLibraryUsers"><i class="fa fa-caret-right"></i>HED Library</a></li>                                   
                                        <li><a href="admin.php?action=ShsStudLibraryUsers"><i class="fa fa-caret-right"></i>HS Library</a></li>
                                        <li><a href="admin.php?action=ElemStudLibraryUsers"><i class="fa fa-caret-right"></i>GS Library</a></li>		
                                    </ul>
                                </li>
                        
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-archive"></i>
                                    <span>Archive</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview">
                                    <a href="#">
                                    <i class="fa fa-angle-double-right"></i>
                                        <span>Library Users</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="admin.php?action=HedStudArchiveList"><i class="fa fa-caret-right"></i>Students</a></li>                                   
                                        <li><a href="admin.php?action=HedTeachArchiveList"><i class="fa fa-caret-right"></i>Teachers</a></li>	
                                    </ul>
                                </li>
                                <li>
                                    <a href="admin.php?action=AdminArchiveList">
                                        <i class="fa fa-angle-double-right"></i> <span>Library Staff</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="admin.php?action=bookArchive">
                                        <i class="fa fa-angle-double-right"></i> <span>Library Books</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                          
                        <li class="treeview">
                            <a href="#">
                            <i class="fa fa-gear"></i>
                                <span>Settings</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="admin.php?action=#">
                                        <li><a href="admin.php?action=backupdb"><i class="fa fa-angle-double-right"></i>Backup</a></li>
                                    </a>
                                </li>	
                                <li>
                                    <a href="admin.php?action=#">
                                        <li><a href="Module.pdf" target="_blank"><i class="fa fa-angle-double-right"></i>Help</a></li>    
                                    </a>
                                </li>	
                            </ul>
                        </li>  
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user-circle"></i>
                                    <span>Manage Accounts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="admin.php?action=userList">
                                        <i class="fa fa-angle-double-right"></i> <span>Library Staff</span>
                                    </a>
                                </li>
                                <li class="treeview">
                                    <a href="#">
                                    <i class="fa fa-angle-double-right"></i>
                                        <span>Library Users</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="admin.php?action=hedStud_OnlineUserList"><i class="fa fa-caret-right"></i>Students</a></li>                                   
                                        <li><a href="admin.php?action=hedTeach_OnlineUserList"><i class="fa fa-caret-right"></i>Teachers</a></li>	
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
				<?php }?>
				
				<?php if($user->isCollegeStaff()) {?>
					<ul class="sidebar-menu">
                        <li class="active">
                            <a href="admin.php?action=college_dashboard">
                                <i class="fa fa-tachometer-alt"></i>  <span>Dashboard</span>
                            </a>
                        </li>
                        <!-- <li>
                            <a target="_blank" href="admin.php?action=hedLibraryUsersAttendance">
                                <i class="fa fa-clipboard"></i> <span>Daily Users Logs</span>
                            </a>
                        </li> -->
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-clipboard"></i>
                                <span>Daily Users Logs</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a target="_blank" href="admin.php?action=hedLibraryUsersAttendance"><i class="fa fa-angle-double-right"></i>Scan QR Code</a></li> 
                                <li><a target="_blank" href="admin.php?action=hedLibraryRecentAttendance"><i class="fa fa-angle-double-right"></i>View Logged</a></li> 
                            </ul>
                        </li> 
                        <li class="treeview">
                            <a href="#">
                               <i class="fa fa-bars"></i>
                                <span>Manage Loaning</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a target="_blank" href="admin.php?action=hedStaff_BookLoaning"><i class="fa fa-angle-double-right"></i> Walk-In Request</a></li>
                                <li class="treeview">
                                    <a href="#">
                                    <i class="fa fa-angle-double-right"></i>
                                        <span>Online Request</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="admin.php?action=CL-OnlineBookRequested"><i class="fa fa-caret-right"></i>Requested</a></li>                                   
                                        <li><a href="admin.php?action=CL-OnlineBookBorrowed"><i class="fa fa-caret-right"></i>Borrowed</a></li>	
                                        <li><a href="admin.php?action=CL-OnlineBookReturned"><i class="fa fa-caret-right"></i>Returned</a></li>	
                                    </ul>
                                </li>
                                <li><a href="admin.php?action=CollegeLibFines"><i class="fa fa-angle-double-right"></i>Fines</a></li>
                            </ul>
                        </li> 
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Manage Library Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="admin.php?action=hedLogoImages"><i class="fa fa-angle-double-right"></i>Courses Logo</a></li> 
                                <li><a href="admin.php?action=studentsHedList"><i class="fa fa-angle-double-right"></i>Students</a></li> 
                                <li><a href="admin.php?action=teachersHedList"><i class="fa fa-angle-double-right"></i>Teachers</a></li>   
                            </ul>
                        </li> 
                        
                        <li class="treeview">
                            <a href="#">
                               <i class="fa fa-book"></i>
                                <span>Manage Books</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="admin.php?action=hedLibBookImages"><i class="fa fa-angle-double-right"></i>Book Images</a></li> 
                                <li><a href="admin.php?action=CollegeBookList"><i class="fa fa-angle-double-right"></i>All Books</a></li> 
                                <li><a href="admin.php?action=CollegePeriodicalList"><i class="fa fa-angle-double-right"></i>Periodical Books</a></li>      
                                <li><a href="admin.php?action=CollegeDiscardedBooks"><i class="fa fa-angle-double-right"></i>Discarded Books</a></li>
                                <li><a href="admin.php?action=CollegeLostBooks"><i class="fa fa-angle-double-right"></i>Lost Books</a></li>
                            </ul>
                        </li> 
                        <!-- ---- -->
                        <li class="treeview">
                            <a href="#">
                            <i class="fa fa-chart-bar"></i>
                                <span>Library Statistics</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="admin.php?action=#">
                                        <li><a href="admin.php?action=CollegeMostBorrowedBooks"><i class="fa fa-angle-double-right"></i>Most Borrowed Books</a></li>
                                        <li><a href="admin.php?action=StaffHedStudTopBorrowers"><i class="fa fa-angle-double-right"></i>Top Borrowers</a></li> 
                                    <li><a href="admin.php?action=StaffHedStudLibraryUsers"><i class="fa fa-angle-double-right"></i>Top Library Users</a></li>          
                                    </a>
                                </li>
                            </ul>
                        </li>    
                        <!-- ---- -->
                        <!-- <li>
                            <a href="Module.pdf" target="_blank">
                                <i class="fa fa-question"></i> <span>Help</span>
                            </a>
                        </li>      -->
                          <!-- ---- -->
                        <!-- <li>
                            <a href="admin.php?action=CollegeAnnouncement">
                                <i class="fa fa-bell"></i> <span>Announcement</span>
                            </a>
                        </li>      -->
                    </ul>
				<?php }?>

                <?php if($user->isHighSchoolStaff()) {?>
					<ul class="sidebar-menu">
                        <li class="active">
                            <a href="admin.php?action=highschool_dashboard">
                                <i class="fa fa-tachometer-alt"></i>  <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="admin.php?action=hsLibraryUsersAttendance">
                                <i class="fa fa-clipboard"></i> <span>Daily Users Logs</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                               <i class="fa fa-bars"></i>
                                <span>Manage Loaning</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a target="_blank" href="admin.php?action=hsStaff_BookLoaning"><i class="fa fa-angle-double-right"></i>  Walk-In Request</a></li>
                                <li class="treeview">
                                    <a href="#">
                                    <i class="fa fa-angle-double-right"></i>
                                        <span>Online Request</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="admin.php?action=HS-OnlineBookRequested"><i class="fa fa-caret-right"></i>Requested</a></li>                                   
                                        <li><a href="admin.php?action=HS-OnlineBookBorrowed"><i class="fa fa-caret-right"></i>Borrowed</a></li>	
                                        <li><a href="admin.php?action=HS-OnlineBookReturned"><i class="fa fa-caret-right"></i>Returned</a></li>	
                                    </ul>
                                </li>
                                <li><a href="admin.php?action=HighSchoolLibFines"><i class="fa fa-angle-double-right"></i>Fines</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                               <i class="fa fa-users"></i>
                                <span>Manage Library Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            <li class="treeview">
                                    <a href="#">
                                    <i class="fa fa-angle-double-right"></i>
                                        <span>Students</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="admin.php?action=studentsShsList"><i class="fa fa-caret-right"></i>SHS Department</a></li>	
                                        <li><a href="admin.php?action=studentsJhsList"><i class="fa fa-caret-right"></i>JHS Department</a></li>     
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#">
                                    <i class="fa fa-angle-double-right"></i>
                                        <span>Teachers</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="admin.php?action=teachersShsList"><i class="fa fa-caret-right"></i>SHS Department</a></li>	
                                        <li><a href="admin.php?action=teachersJhsList"><i class="fa fa-caret-right"></i>JHS Department</a></li>     
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                               <i class="fa fa-book"></i>
                                <span>Manage Books</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            <li><a href="admin.php?action=hsLibBookImages"><i class="fa fa-angle-double-right"></i>Book Images</a></li> 
                                <li><a href="admin.php?action=HighSchoolBookList"><i class="fa fa-angle-double-right"></i>Book List</a></li> 
                                <li><a href="admin.php?action=HighSchoolPeriodicalList"><i class="fa fa-angle-double-right"></i>Periodical list</a></li>      
                                <li><a href="admin.php?action=HighSchoolDiscardedBooks"><i class="fa fa-angle-double-right"></i>Discarded Books</a></li>
                                <li><a href="admin.php?action=HighSchoolLostBooks"><i class="fa fa-angle-double-right"></i>Lost Books</a></li>   
                            </ul>
                        </li>    
                        <li class="treeview">
                            <a href="#">
                            <i class="fa fa-chart-bar"></i>
                                <span>Library Statistics</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="admin.php?action=#">
                                        <li><a href="admin.php?action=HighSchoolMostBorrowedBooks"><i class="fa fa-angle-double-right"></i>Most Borrowed Books</a></li>
                                        <li><a href="admin.php?action=StaffShsStudTopBorrowers"><i class="fa fa-angle-double-right"></i>Top Borrowers</a></li> 
                                    <li><a href="admin.php?action=StaffShsStudLibraryUsers"><i class="fa fa-angle-double-right"></i>Top Library Users</a></li>          
                                    </a>
                                </li>
                            </ul>
                        </li>  
                        <!-- <li>
                            <a href="Module.pdf" target="_blank">
                                <i class="fa fa-question"></i> <span>Help</span>
                            </a>
                        </li>                     -->
                    </ul>
				<?php }?>

                <?php if($user->isElementaryStaff()) {?>
					<ul class="sidebar-menu">
                        <li class="active">
                            <a href="admin.php?action=gradeschool_dashboard">
                                <i class="fa fa-tachometer-alt"></i>  <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="admin.php?action=elemLibraryUsersAttendance">
                                <i class="fa fa-clipboard"></i> <span>Daily Users Log</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                               <i class="fa fa-bars"></i>
                                <span>Manage Loaning</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a target="_blank" href="admin.php?action=elemStaff_BookLoaning"><i class="fa fa-angle-double-right"></i> Walk-In Request</a></li>
                                <li class="treeview">
                                    <a href="#">
                                    <i class="fa fa-angle-double-right"></i>
                                        <span>Online Request</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="admin.php?action=GS-OnlineBookRequested"><i class="fa fa-caret-right"></i>Requested</a></li>                                   
                                        <li><a href="admin.php?action=GS-OnlineBookBorrowed"><i class="fa fa-caret-right"></i>Borrowed</a></li>	
                                        <li><a href="admin.php?action=GS-OnlineBookReturned"><i class="fa fa-caret-right"></i>Returned</a></li>	
                                    </ul>
                                </li>
								<li><a href="admin.php?action=ElementaryLibFines"><i class="fa fa-angle-double-right"></i>Fines</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                               <i class="fa fa-users"></i>
                                <span>Manage Library Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="admin.php?action=studentsElemList"><i class="fa fa-angle-double-right"></i>Students</a></li> 
                                <li><a href="admin.php?action=teachersElemList"><i class="fa fa-angle-double-right"></i>Teachers</a></li>
                            </ul>
                        </li> 
                        <li class="treeview">
                            <a href="#">
                               <i class="fa fa-book"></i>
                                <span>Manage Books</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="admin.php?action=gsLibBookImages"><i class="fa fa-angle-double-right"></i>Book Images</a></li> 
                                <li><a href="admin.php?action=ElementaryBookList"><i class="fa fa-angle-double-right"></i>Book List</a></li> 
                                <li><a href="admin.php?action=ElementaryPeriodicalList"><i class="fa fa-angle-double-right"></i>Periodical list</a></li>      
                                <li><a href="admin.php?action=ElementaryDiscardedBooks"><i class="fa fa-angle-double-right"></i>Discarded Books</a></li> 
                                <li><a href="admin.php?action=ElementaryLostBooks"><i class="fa fa-angle-double-right"></i>Lost Books</a></li>     
                            </ul>
                        </li>        
                        <li class="treeview">
                            <a href="#">
                               <i class="fa fa-chart-bar"></i>
                                <span>Library Statistics</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="admin.php?action=ElementaryMostBorrowedBooks"><i class="fa fa-angle-double-right"></i>Most Borrowed Books</a></li> 
                                <li><a href="admin.php?action=StaffElemStudTopBorrowers"><i class="fa fa-angle-double-right"></i>Top Borrowers</a></li> 
                                <li><a href="admin.php?action=StaffElemStudLibraryUsers"><i class="fa fa-angle-double-right"></i>Top Library Users</a></li>         
                            </ul>
                        </li> 
                        <!-- <li>
                            <a href="Module.pdf" target="_blank">
                                <i class="fa fa-question"></i> <span>Help</span>
                            </a>
                        </li>                     -->
                    </ul>
				<?php }?>
                <?php if($user->isStudent()) {?>
					<ul class="sidebar-menu">
                        <li>
                            <a href="admin.php?action=ChooseLibrary">
                                <i class="glyphicon glyphicon-search"></i> <span>Search Books</span>
                            </a>
                        </li>
                        <li>
                            <a href="admin.php?action=CollegeLibRequestedBooks">
                                <i class="fa fa-book"></i> <span>Book Requested</span>
                            </a>
                        </li> 
                        <li>
                            <a href="admin.php?action=CollegeLibIssuedBooks">
                                <i class="fa fa-book"></i> <span>Book Borrowed</span>
                            </a>
                        </li> 
                        <li>
                            <a href="admin.php?action=CollegeLibReturnedBooks">
                                <i class="fa fa-book"></i> <span>Book Loaning History</span>
                            </a>
                        </li>     
                        <li>
                            <a href="admin.php?action=OnlineFines">
                                <i class="fa fa-money"></i> <span>Fines</span>
                            </a>
                        </li>                    
                    </ul>
				<?php }?>

                <?php if($user->isTeacher()) {?>
					<ul class="sidebar-menu">
                        
                    <li>
                            <a href="admin.php?action=ChooseLibrary">
                                <i class="glyphicon glyphicon-search"></i> <span>Search Books</span>
                            </a>
                        </li>
                        <li>
                            <a href="admin.php?action=CollegeLibRequestedBooks">
                                <i class="fa fa-book"></i> <span>Book Requested</span>
                            </a>
                        </li> 
                        <li>
                            <a href="admin.php?action=CollegeLibIssuedBooks">
                                <i class="fa fa-book"></i> <span>Book Issued</span>
                            </a>
                        </li> 
                        <li>
                            <a href="admin.php?action=CollegeLibReturnedBooks">
                                <i class="fa fa-book"></i> <span>Book Returned</span>
                            </a>
                        </li>     
                        <li>
                            <a href="admin.php?action=OnlineFines">
                                <i class="fa fa-money"></i> <span>Fines</span>
                            </a>
                        </li>                    
                    </ul>
				<?php }?>
				
                </section>
                <!-- /.sidebar -->
            </aside>
