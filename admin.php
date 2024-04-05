<?php

require 'core/init.php';
$user = new UserLogin(); //Current

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}else{
	if($user->isAdmin()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'settings':	
				require('admin/settings.php');
			break;

			case 'hed_view_info':	
				require('admin/hed_view_info.php');
			break;
			case 'shs_view_info':	
				require('admin/shs_view_info.php');
			break;
			case 'jhs_view_info':	
				require('admin/jhs_view_info.php');
			break;
			case 'gs_view_info':	
				require('admin/gs_view_info.php');
			break;

			case 'hedTeach_view_info':	
				require('admin/hedTeach_view_info.php');
			break;
			case 'shsTeach_view_info':	
				require('admin/shsTeach_view_info.php');
			break;
			case 'jhsTeach_view_info':	
				require('admin/jhsTeach_view_info.php');
			break;
			case 'gsTeach_view_info':	
				require('admin/gsTeach_view_info.php');
			break;

			// case 'delete_library_card':	
			// 	require('admin/delete_library_card.php');
			// break;

			// Archiving -----------------------
			case 'bookArchive':	
				require('admin/bookArchive.php');
			break;
			case 'periodicalbookArchive':	
				require('admin/periodicalbookArchive.php');
			break;
			case 'discardedbookArchive':	
				require('admin/discardedbookArchive.php');
			break;
			case 'lostbookArchive':	
				require('admin/lostbookArchive.php');
			break;
			case 'AdminArchiveList':	
				require('admin/AdminArchiveList.php');
			break;
			case 'hed_StaffArchiveList':	
				require('admin/hed_StaffArchiveList.php');
			break;
			case 'hs_StaffArchiveList':	
				require('admin/hs_StaffArchiveList.php');
			break;
			case 'gs_StaffArchiveList':	
				require('admin/gs_StaffArchiveList.php');
			break;

			// Students Archive List
			case 'HedStudArchiveList':	
				require('admin/libusersArchive/HED/students/HedStudArchiveList.php');
			break;
			case 'ShsStudArchiveList':	
				require('admin/libusersArchive/SHS/students/ShsStudArchiveList.php');
			break;
			case 'JhsStudArchiveList':	
				require('admin/libusersArchive/JHS/students/JhsStudArchiveList.php');
			break;
			case 'ElemStudArchiveList':	
				require('admin/libusersArchive/GRDS/students/ElemStudArchiveList.php');
			break;
			// Teachers Archive List
			case 'HedTeachArchiveList':	
				require('admin/libusersArchive/HED/teachers/HedTeachArchiveList.php');
			break;
			case 'ShsTeachArchiveList':	
				require('admin/libusersArchive/SHS/teachers/ShsTeachArchiveList.php');
			break;
			case 'JhsTeachArchiveList':	
				require('admin/libusersArchive/JHS/teachers/JhsTeachArchiveList.php');
			break;
			case 'ElemTeachArchiveList':	
				require('admin/libusersArchive/GRDS/teachers/ElemTeachArchiveList.php');
			break;

			// Library Cards -----------------------------------------------
			case 'staff_allLibCard':	
				require('admin/staff_allLibCard.php');
			break;

			case 'teachersArchive':	
				require('admin/teachersArchive.php');
			break;
			case 'backupdb':	
				require('admin/backupdb.php');
			break;

			// Book List (College Library) ---------------------------------------------------------------
			case 'AdminBookListRecord(ColLib)':	
				require('admin/AdminBookListRecord(ColLib).php');
			break;
			case 'AdminCollegePeriodicalList':	
				require('admin/AdminCollegePeriodicalList.php');
			break;
			case 'AdminCollegeDiscardedBooks':	
				require('admin/AdminCollegeDiscardedBooks.php');
			break;
			case 'AdminLostBooks':	
				require('admin/AdminLostBooks.php');
			break;

			// Book List (College Library) ---------------------------------------------------------------
			case 'AdminBookListRecord(HsLib)':	
				require('admin/AdminBookListRecord(HsLib).php');
			break;
			case 'AdminBookListRecord(ElLib)':	
				require('admin/AdminBookListRecord(ElLib).php');
			break;

			// Fines --------------------------------------------------------------------------------------
			case 'AdminColLibBookFinesReport':	
				require('admin/AdminColLibBookFinesReport.php');
			break;
			case 'AdminHsLibBookFinesReport':	
				require('admin/AdminHsLibBookFinesReport.php');
			break;
			case 'AdminGsLibBookFinesReport':	
				require('admin/AdminGsLibBookFinesReport.php');
			break;

			// Book Card Catalog --------------------------------------------------------------------------
			case 'AdminCollegeBookCard':	
				require('admin/AdminCollegeBookCard.php');
			break;
			case 'AdminDiscardedBookCard':	
				require('admin/AdminDiscardedBookCard.php');
			break;
			case 'AdminLostBookCard':	
				require('admin/AdminLostBookCard.php');
			break;
			case 'AdminHighSchoolBookCard':	
				require('admin/AdminHighSchoolBookCard.php');
			break;
			case 'AdminElementaryBookCard':	
				require('admin/AdminElementaryBookCard.php');
			break;

			// Most Borrowed Books ---------------------------------------------------------------------
			case 'CollegeMostBorrowedBooks(AdminReport)':	
				require('admin/MostBorrowedBooks(AdminReport)/CollegeMostBorrowedBooks(AdminReport).php');
			break;
			case 'HighSchoolMostBorrowedBooks(AdminReport)':	
				require('admin/MostBorrowedBooks(AdminReport)/HighSchoolMostBorrowedBooks(AdminReport).php');
			break;
			case 'ElementaryMostBorrowedBooks(AdminReport)':	
				require('admin/MostBorrowedBooks(AdminReport)/ElementaryMostBorrowedBooks(AdminReport).php');
			break;

			//Transaction History (Students) -------------------------------------------------
			case 'studentsHed_transactionHistory(Borrowed)':	
				require('admin/transactionHistory/students/studentsHed_transactionHistory(Borrowed).php');
			break;
			case 'studentsHed_transactionHistory(Returned)':	
				require('admin/transactionHistory/students/studentsHed_transactionHistory(Returned).php');
			break;

			case 'studentsShs_transactionHistory(Borrowed)':	
				require('admin/transactionHistory/students/studentsShs_transactionHistory(Borrowed).php');
			break;
			case 'studentsShs_transactionHistory(Returned)':	
				require('admin/transactionHistory/students/studentsShs_transactionHistory(Returned).php');
			break;

			case 'studentsJhs_transactionHistory(Borrowed)':	
				require('admin/transactionHistory/students/studentsJhs_transactionHistory(Borrowed).php');
			break;
			case 'studentsJhs_transactionHistory(Returned)':	
				require('admin/transactionHistory/students/studentsJhs_transactionHistory(Returned).php');
			break;

			case 'studentsElem_transactionHistory(Borrowed)':	
				require('admin/transactionHistory/students/studentsElem_transactionHistory(Borrowed).php');
			break;
			case 'studentsElem_transactionHistory(Returned)':	
				require('admin/transactionHistory/students/studentsElem_transactionHistory(Returned).php');
			break;

			//Transaction History (Teachers) -------------------------------------------------
			case 'teachersHed_transactionHistory(Borrowed)':	
				require('admin/transactionHistory/teachers/teachersHed_transactionHistory(Borrowed).php');
			break;
			case 'teachersHed_transactionHistory(Returned)':	
				require('admin/transactionHistory/teachers/teachersHed_transactionHistory(Returned).php');
			break;

			case 'teachersShs_transactionHistory(Borrowed)':	
				require('admin/transactionHistory/teachers/teachersShs_transactionHistory(Borrowed).php');
			break;
			case 'teachersShs_transactionHistory(Returned)':	
				require('admin/transactionHistory/teachers/teachersShs_transactionHistory(Returned).php');
			break;

			case 'teachersJhs_transactionHistory(Borrowed)':	
				require('admin/transactionHistory/teachers/teachersJhs_transactionHistory(Borrowed).php');
			break;
			case 'teachersJhs_transactionHistory(Returned)':	
				require('admin/transactionHistory/teachers/teachersJhs_transactionHistory(Returned).php');
			break;

			case 'teachersElem_transactionHistory(Borrowed)':	
				require('admin/transactionHistory/teachers/teachersElem_transactionHistory(Borrowed).php');
			break;
			case 'teachersElem_transactionHistory(Returned)':	
				require('admin/transactionHistory/teachers/teachersElem_transactionHistory(Returned).php');
			break;

			// Top Library Users (Students) -------------------------------------------------------
			case 'HedStudLibraryUsers':	
				require('admin/attendanceLogs/topLibraryUsers/students/HedStudLibraryUsers.php');
			break;
			case 'ShsStudLibraryUsers':	
				require('admin/attendanceLogs/topLibraryUsers/students/ShsStudLibraryUsers.php');
			break;
			case 'JhsStudLibraryUsers':	
				require('admin/attendanceLogs/topLibraryUsers/students/JhsStudLibraryUsers.php');
			break;
			case 'ElemStudLibraryUsers':	
				require('admin/attendanceLogs/topLibraryUsers/students/ElemStudLibraryUsers.php');
			break;

			// Top Library Users (Teachers) -------------------------------------------------------
			case 'HedTeachLibraryUsers':	
				require('admin/attendanceLogs/topLibraryUsers/teachers/HedTeachLibraryUsers.php');
			break;
			case 'ShsTeachLibraryUsers':	
				require('admin/attendanceLogs/topLibraryUsers/teachers/ShsTeachLibraryUsers.php');
			break;
			case 'JhsTeachLibraryUsers':	
				require('admin/attendanceLogs/topLibraryUsers/teachers/JhsTeachLibraryUsers.php');
			break;
			case 'ElemTeachLibraryUsers':	
				require('admin/attendanceLogs/topLibraryUsers/teachers/ElemTeachLibraryUsers.php');
			break;

			// Top Borrowers (Students) -------------------------------------------------------
			case 'HedStudTopBorrowers':	
				require('admin/transactionHistory/topBorrowers/students/HedStudTopBorrowers.php');
			break;
			case 'ShsStudTopBorrowers':	
				require('admin/transactionHistory/topBorrowers/students/ShsStudTopBorrowers.php');
			break;
			case 'JhsStudTopBorrowers':	
				require('admin/transactionHistory/topBorrowers/students/JhsStudTopBorrowers.php');
			break;
			case 'ElemStudTopBorrowers':	
				require('admin/transactionHistory/topBorrowers/students/ElemStudTopBorrowers.php');
			break;

			// Top Borrowers (Teachers) -------------------------------------------------------
			case 'HedTeachTopBorrowers':	
				require('admin/transactionHistory/topBorrowers/teachers/HedTeachTopBorrowers.php');
			break;
			case 'ShsTeachTopBorrowers':	
				require('admin/transactionHistory/topBorrowers/teachers/ShsTeachTopBorrowers.php');
			break;
			case 'JhsTeachTopBorrowers':	
				require('admin/transactionHistory/topBorrowers/teachers/JhsTeachTopBorrowers.php');
			break;
			case 'ElemTeachTopBorrowers':	
				require('admin/transactionHistory/topBorrowers/teachers/ElemTeachTopBorrowers.php');
			break;

			//Attendance (Students) --------------------------------------------
			case 'studentHedAttendance':	
				require('admin/attendanceLogs/students/studentHedAttendance.php');
			break;
			case 'studentShsAttendance':	
				require('admin/attendanceLogs/students/studentShsAttendance.php');
			break;
			case 'studentJhsAttendance':	
				require('admin/attendanceLogs/students/studentJhsAttendance.php');
			break;
			case 'studentElemAttendance':	
				require('admin/attendanceLogs/students/studentElemAttendance.php');
			break;

			//Attendance (Students) --------------------------------------------
			case 'teacherHedAttendance':	
				require('admin/attendanceLogs/teachers/teacherHedAttendance.php');
			break;
			case 'teacherShsAttendance':	
				require('admin/attendanceLogs/teachers/teacherShsAttendance.php');
			break;
			case 'teacherJhsAttendance':	
				require('admin/attendanceLogs/teachers/teacherJhsAttendance.php');
			break;
			case 'teacherElemAttendance':	
				require('admin/attendanceLogs/teachers/teacherElemAttendance.php');
			break;		

			// Online User List HED
			case 'hedStud_OnlineUserList':	
				require('admin/hedStud_OnlineUserList.php');
			break;
			case 'Add_hedStud_OnlineUser':	
				require('admin/Add_hedStud_OnlineUser.php');
			break;
			case 'Edit_hedStud_OnlineUser':	
				require('admin/Edit_hedStud_OnlineUser.php');
			break;

			case 'hedTeach_OnlineUserList':	
				require('admin/hedTeach_OnlineUserList.php');
			break;
			case 'Add_hedTeach_OnlineUser':	
				require('admin/Add_hedTeach_OnlineUser.php');
			break;
			case 'Edit_hedTeach_OnlineUser':	
				require('admin/Edit_hedTeach_OnlineUser.php');
			break;

			// Online User List SHS
			case 'shsStud_OnlineUserList':	
				require('admin/shsStud_OnlineUserList.php');
			break;
			case 'Add_shsStud_OnlineUser':	
				require('admin/Add_shsStud_OnlineUser.php');
			break;
			case 'Edit_shsStud_OnlineUser':	
				require('admin/Edit_shsStud_OnlineUser.php');
			break;

			case 'shsTeach_OnlineUserList':	
				require('admin/shsTeach_OnlineUserList.php');
			break;
			case 'Add_shsTeach_OnlineUser':	
				require('admin/Add_shsTeach_OnlineUser.php');
			break;
			case 'Edit_shsTeach_OnlineUser':	
				require('admin/Edit_shsTeach_OnlineUser.php');
			break;

			// Online User List JHS
			case 'jhsStud_OnlineUserList':	
				require('admin/jhsStud_OnlineUserList.php');
			break;
			case 'Add_jhsStud_OnlineUser':	
				require('admin/Add_jhsStud_OnlineUser.php');
			break;
			case 'Edit_jhsStud_OnlineUser':	
				require('admin/Edit_jhsStud_OnlineUser.php');
			break;

			case 'jhsTeach_OnlineUserList':	
				require('admin/jhsTeach_OnlineUserList.php');
			break;
			case 'Add_jhsTeach_OnlineUser':	
				require('admin/Add_jhsTeach_OnlineUser.php');
			break;
			case 'Edit_jhsTeach_OnlineUser':	
				require('admin/Edit_jhsTeach_OnlineUser.php');
			break;

			// Online User List GS
			case 'gsStud_OnlineUserList':	
				require('admin/gsStud_OnlineUserList.php');
			break;
			case 'Add_gsStud_OnlineUser':	
				require('admin/Add_gsStud_OnlineUser.php');
			break;
			case 'Edit_gsStud_OnlineUser':	
				require('admin/Edit_gsStud_OnlineUser.php');
			break;

			case 'gsTeach_OnlineUserList':	
				require('admin/gsTeach_OnlineUserList.php');
			break;
			case 'Add_gsTeach_OnlineUser':	
				require('admin/Add_gsTeach_OnlineUser.php');
			break;
			case 'Edit_gsTeach_OnlineUser':	
				require('admin/Edit_gsTeach_OnlineUser.php');
			break;
			
			// Manage Library Staff --------------------------------------------
			case 'userList':	
				require('admin/userList.php');
			break;
			case 'editLibStaff':	
				require('admin/editLibStaff.php');
			break;
			case 'AdminStaffView':	
				require('admin/AdminStaffView.php');
			break;

			case 'AdminHedStudView':	
				require('admin/AdminHedStudView.php');
			break;
			case 'AdminShsStudView':	
				require('admin/AdminShsStudView.php');
			break;
			case 'AdminJhsStudView':	
				require('admin/AdminJhsStudView.php');
			break;
			case 'AdminGsStudView':	
				require('admin/AdminGsStudView.php');
			break;

			case 'AdminHedTeachView':	
				require('admin/AdminHedTeachView.php');
			break;
			case 'AdminShsTeachView':	
				require('admin/AdminShsTeachView.php');
			break;
			case 'AdminJhsTeachView':	
				require('admin/AdminJhsTeachView.php');
			break;
			case 'AdminGsTeachView':	
				require('admin/AdminGsTeachView.php');
			break;

			//Activity Logs
			case 'BookLogs':	
				require('admin/activityLogs/BookLogs.php');
			break;
			case 'LibUserLogs':	
				require('admin/activityLogs/LibUserLogs.php');
			break;
			case 'LoginLogs':	
				require('admin/activityLogs/LoginLogs.php');
			break;

			//Manual Script
			case 'Help':	
				require('admin/Help.php');
			break;
			
		  default:
			require('admin/admin_dashboard.php');
		}

	}elseif($user->isCollegeStaff()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'admin_dashboard':	
				require('admin/admin_dashboard.php');
			break;
			case 'settings':	
				require('admin/settings.php');
			break;
			case 'fines':	
				require('admin/fines.php');
			break;

			// Offline Book Loaning 
			case 'hedStaff_BookLoaning':	
				require('admin/hedStaff_BookLoaning.php');
			break;

			// Online Book Loaning 
			case 'CL-OnlineBookRequested':	
				require('admin/CL-OnlineBookRequested.php');
			break;
			case 'CL-OnlineBookBorrowed':	
				require('admin/CL-OnlineBookBorrowed.php');
			break;
			case 'CL-OnlineBookReturned':	
				require('admin/CL-OnlineBookReturned.php');
			break;

			// Top Library Users ------------------------------------------------------------------------
			case 'StaffHedStudLibraryUsers':	
				require('admin/CollegeStaffAccess/topLibraryUsers/students/StaffHedStudLibraryUsers.php');
			break;
			case 'StaffHedStudLibraryUsersGraph':	
				require('admin/CollegeStaffAccess/topLibraryUsers/students/StaffHedStudLibraryUsersGraph.php');
			break;

			case 'StaffHedTeachLibraryUsers':	
				require('admin/CollegeStaffAccess/topLibraryUsers/teachers/StaffHedTeachLibraryUsers.php');
			break;
			case 'StaffHedTeachLibraryUsersGraph':	
				require('admin/CollegeStaffAccess/topLibraryUsers/teachers/StaffHedTeachLibraryUsersGraph.php');
			break;

			// Top Borrowers -------------------------------------------------------------------------
			case 'StaffHedStudTopBorrowers':	
				require('admin/CollegeStaffAccess/topBorrowers/students/StaffHedStudTopBorrowers.php');
			break;
			case 'StaffHedStudTopBorrowersGraph':	
				require('admin/CollegeStaffAccess/topBorrowers/students/StaffHedStudTopBorrowersGraph.php');
			break;

			case 'StaffHedTeachTopBorrowers':	
				require('admin/CollegeStaffAccess/topBorrowers/teachers/StaffHedTeachTopBorrowers.php');
			break;
			case 'StaffHedTeachTopBorrowersGraph':	
				require('admin/CollegeStaffAccess/topBorrowers/teachers/StaffHedTeachTopBorrowersGraph.php');
			break;
			
			// Most Borrowed Books ---------------------------------------------------------------------
			case 'CollegeMostBorrowedBooks':	
				require('admin/MostBorrowedBooks/CollegeMostBorrowedBooks.php');
			break;
			case 'CollegeMostBorrowedBooksGraph':	
				require('admin/MostBorrowedBooks/CollegeMostBorrowedBooksGraph.php');
			break;

			// Library Attendance
			case 'hedOpenCam':	
				require('admin/hedOpenCam.php');
			break;
			case 'hedLibraryUsersAttendance':	
				require('admin/hedLibraryUsersAttendance.php');
			break;
			case 'hedLibraryRecentAttendance':	
				require('admin/hedLibraryRecentAttendance.php');
			break;

			// Manage Books --------------------
			case 'hedLibBookImages':	
				require('admin/hedLibBookImages.php');
			break;
			case 'CollegeBookList':	
				require('admin/CollegeBookList.php');
			break;
			case 'CollegePeriodicalList':	
				require('admin/CollegePeriodicalList.php');
			break;
			case 'CollegeDiscardedBooks':	
				require('admin/CollegeDiscardedBooks.php');
			break;
			case 'CollegeLostBooks':	
				require('admin/CollegeLostBooks.php');
			break;
			case 'CollegeDiscardedBookCard':	
				require('admin/CollegeDiscardedBookCard.php');
			break;
			case 'CollegeLostBookCard':	
				require('admin/CollegeLostBookCard.php');
			break;
			case 'CollegeDiscardedBookEdit':	
				require('admin/CollegeDiscardedBookEdit.php');
			break;
			case 'CollegeBookCard':	
				require('admin/CollegeBookCard.php');
			break;

			case 'CollegeBookEdit':	
				require('admin/CollegeBookEdit.php');
			break;
			case 'CollegePeriodicalBookEdit':	
				require('admin/CollegePeriodicalBookEdit.php');
			break;
			case 'ColLibBorrowBooks':	
				require('admin/ColLibBorrowBooks.php');
			break;
			case 'ColLibReturnBooks':	
				require('admin/ColLibReturnBooks.php');
			break;
			case 'CollegeLibFines':	
				require('admin/CollegeLibFines.php');
			break;

			case 'hedBookViewCopies':	
				require('admin/hedBookViewCopies.php');
			break;

			// Library Cards -----------------------------------------------
			case 'hedStud_allLibCard':	
				require('admin/hedStud_allLibCard.php');
			break;
			case 'hedStud_allLibCardSelect':	
				require('admin/hedStud_allLibCardSelect.php');
			break;

			case 'hedStud_indivLibCard':	
				require('admin/hedStud_indivLibCard.php');
			break;

			case 'hedTeach_allLibCard':	
				require('admin/hedTeach_allLibCard.php');
			break;
			case 'hedTeach_allLibCardSelect':	
				require('admin/hedTeach_allLibCardSelect.php');
			break;
			case 'hedTeach_indivLibCard':	
				require('admin/hedTeach_indivLibCard.php');
			break;

			// Library Book QR -----------------------------------------------
			case 'hedLib_allQR':	
				require('admin/hedLib_allQR.php');
			break;
			case 'hedLib_allQRSelect':	
				require('admin/hedLib_allQRSelect.php');
			break;

			// Students List --------------------------------------------------
			case 'studentsHedList':	
				require('admin/CollegeStaffAccess/student/studentsHedList.php');
			break;
			case 'hedStudView':	
				require('admin/hedStudView.php');
			break;

			case 'studentsShsList':	
				require('admin/CollegeStaffAccess/student/studentsShsList.php');
			break;
			case 'studentsJhsList':	
				require('admin/CollegeStaffAccess/student/studentsJhsList.php');
			break;

			// Teachers List --------------------------------------------------
			case 'teachersHedList':	
				require('admin/CollegeStaffAccess/teacher/teachersHedList.php');
			break;
			case 'hedTeachView':	
				require('admin/hedTeachView.php');
			break;

			case 'teachersShsList':	
				require('admin/CollegeStaffAccess/teacher/teachersShsList.php');
			break;
			case 'teachersJhsList':	
				require('admin/CollegeStaffAccess/teacher/teachersJhsList.php');
			break;

			// Edit Students ---------------------------
			case 'studentsHed_editStud':	
				require('admin/studentsHed_editStud.php');
			break;
			case 'studentsShs_editStud':	
				require('admin/studentsShs_editStud.php');
			break;
			case 'studentsJhs_editStud':	
				require('admin/studentsJhs_editStud.php');
			break;
			
			// Edit Teachers ---------------------------
			case 'teachersHed_editTeach':	
				require('admin/teachersHed_editTeach.php');
			break;
			case 'teachersShs_editTeach':	
				require('admin/teachersShs_editTeach.php');
			break;
			case 'teachersJhs_editTeach':	
				require('admin/teachersJhs_editTeach.php');
			break;

			case 'CollegeLibAnnouncement':	
				require('admin/CollegeLibAnnouncement.php');
			break;

			case 'hedLogoImages':	
				require('admin/hedLogoImages.php');
			break;

			default:
			require('admin/college_dashboard.php');
		}
	}elseif($user->isHighSchoolStaff()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'settings':	
				require('admin/settings.php');
			break;
			
			// Offline Book Loaning 
			case 'hsStaff_BookLoaning':	
				require('admin/hsStaff_BookLoaning.php');
			break;

			// Online Book Loaning 
			case 'HS-OnlineBookRequested':	
				require('admin/HS-OnlineBookRequested.php');
			break;
			case 'HS-OnlineBookBorrowed':	
				require('admin/HS-OnlineBookBorrowed.php');
			break;
			case 'HS-OnlineBookReturned':	
				require('admin/HS-OnlineBookReturned.php');
			break;

			// Top Library Users ---------------------------------------------------------------
			case 'StaffShsStudLibraryUsers':	
				require('admin/HighSchoolStaffAccess/topLibraryUsers/students/StaffShsStudLibraryUsers.php');
			break;
			case 'StaffShsStudLibraryUsersGraph':	
				require('admin/HighSchoolStaffAccess/topLibraryUsers/students/StaffShsStudLibraryUsersGraph.php');
			break;
			
			case 'StaffShsTeachLibraryUsers':	
				require('admin/HighSchoolStaffAccess/topLibraryUsers/teachers/StaffShsTeachLibraryUsers.php');
			break;
			case 'StaffShsTeachLibraryUsersGraph':	
				require('admin/HighSchoolStaffAccess/topLibraryUsers/teachers/StaffShsTeachLibraryUsersGraph.php');
			break;

			case 'StaffJhsStudLibraryUsers':	
				require('admin/HighSchoolStaffAccess/topLibraryUsers/students/StaffJhsStudLibraryUsers.php');
			break;
			case 'StaffJhsTeachLibraryUsers':	
				require('admin/HighSchoolStaffAccess/topLibraryUsers/teachers/StaffJhsTeachLibraryUsers.php');
			break;

			// Library Book QR -----------------------------------------------
			case 'hsLib_allQR':	
				require('admin/hsLib_allQR.php');
			break;
			case 'hsLib_allQRSelect':	
				require('admin/hsLib_allQRSelect.php');
			break;

			// Top Borrowers --------------------------------------------------------------------
			case 'StaffShsStudTopBorrowers':	
				require('admin/HighSchoolStaffAccess/topBorrowers/students/StaffShsStudTopBorrowers.php');
			break;
			case 'StaffJhsStudTopBorrowers':	
				require('admin/HighSchoolStaffAccess/topBorrowers/students/StaffJhsStudTopBorrowers.php');
			break;

			// Most Borrowed Books ---------------------------------------------------------------------
			case 'HighSchoolMostBorrowedBooks':	
				require('admin/MostBorrowedBooks/HighSchoolMostBorrowedBooks.php');
			break;

			case 'StaffShsTeachTopBorrowers':	
				require('admin/HighSchoolStaffAccess/topBorrowers/teachers/StaffShsTeachTopBorrowers.php');
			break;
			case 'StaffJhsTeachTopBorrowers':	
				require('admin/HighSchoolStaffAccess/topBorrowers/teachers/StaffJhsTeachTopBorrowers.php');
			break;

			// Library Attendance
			case 'hsOpenCam':	
				require('admin/hsOpenCam.php');
			break;
			case 'hsLibraryUsersAttendance':	
				require('admin/hsLibraryUsersAttendance.php');
			break;

			// Manage Books --------------------
			case 'hsLibBookImages':	
				require('admin/hsLibBookImages.php');
			break;
			case 'HighSchoolBookList':	
				require('admin/HighSchoolBookList.php');
			break;
			case 'HighSchoolPeriodicalList':	
				require('admin/HighSchoolPeriodicalList.php');
			break;
			case 'HighSchoolDiscardedBookCard':	
				require('admin/HighSchoolDiscardedBookCard.php');
			break;
			case 'HighSchoolDiscardedBooks':	
				require('admin/HighSchoolDiscardedBooks.php');
			break;
			case 'HighSchoolDiscardedBookEdit':	
				require('admin/HighSchoolDiscardedBookEdit.php');
			break;
			case 'HighSchoolLostBooks':	
				require('admin/HighSchoolLostBooks.php');
			break;
			case 'HighSchoolBookCard':	
				require('admin/HighSchoolBookCard.php');
			break;
			case 'HighSchoolPeriodicalBookEdit':	
				require('admin/HighSchoolPeriodicalBookEdit.php');
			break;
			case 'HighSchoolBookEdit':	
				require('admin/HighSchoolBookEdit.php');
			break;
			case 'HighSchoolLostBookCard':	
				require('admin/HighSchoolLostBookCard.php');
			break;
			
			case 'HighSchoolLibFines':	
				require('admin/HighSchoolLibFines.php');
			break;

			case 'HsLibBorrowBooks':	
				require('admin/HsLibBorrowBooks.php');
			break;
			case 'HsLibReturnBooks':	
				require('admin/HsLibReturnBooks.php');
			break;
			case 'hsBookViewCopies':	
				require('admin/hsBookViewCopies.php');
			break;

			// Library Cards -----------------------------------------------
			case 'shsStud_allLibCard':	
				require('admin/shsStud_allLibCard.php');
			break;
			case 'shsStud_allLibCardSelect':	
				require('admin/shsStud_allLibCardSelect.php');
			break;

			case 'shsStud_indivLibCard':	
				require('admin/shsStud_indivLibCard.php');
			break;
			case 'jhsStud_allLibCard':	
				require('admin/jhsStud_allLibCard.php');
			break;
			case 'jhsStud_allLibCardSelect':	
				require('admin/jhsStud_allLibCardSelect.php');
			break;
			
			case 'jhsStud_indivLibCard':	
				require('admin/jhsStud_indivLibCard.php');
			break;

			case 'shsTeach_allLibCard':	
				require('admin/shsTeach_allLibCard.php');
			break;
			case 'shsTeach_allLibCardSelect':	
				require('admin/shsTeach_allLibCardSelect.php');
			break;
			case 'shsTeach_indivLibCard':	
				require('admin/shsTeach_indivLibCard.php');
			break;
			case 'jhsTeach_allLibCard':	
				require('admin/jhsTeach_allLibCard.php');
			break;
			case 'jhsTeach_allLibCardSelect':	
				require('admin/jhsTeach_allLibCardSelect.php');
			break;
			case 'jhsTeach_indivLibCard':	
				require('admin/jhsTeach_indivLibCard.php');
			break;

			// Online User List
			case 'shsStud_OnlineUserList':	
				require('admin/shsStud_OnlineUserList.php');
			break;
			case 'Add_shsStud_OnlineUser':	
				require('admin/Add_shsStud_OnlineUser.php');
			break;
			case 'Edit_shsStud_OnlineUser':	
				require('admin/Edit_shsStud_OnlineUser.php');
			break;
			case 'shsTeach_OnlineUserList':	
				require('admin/shsTeach_OnlineUserList.php');
			break;
			case 'Add_shsTeach_OnlineUser':	
				require('admin/Add_shsTeach_OnlineUser.php');
			break;
			case 'Edit_shsTeach_OnlineUser':	
				require('admin/Edit_shsTeach_OnlineUser.php');
			break;

			case 'jhsStud_OnlineUserList':	
				require('admin/jhsStud_OnlineUserList.php');
			break;
			case 'Add_jhsStud_OnlineUser':	
				require('admin/Add_jhsStud_OnlineUser.php');
			break;
			case 'Edit_jhsStud_OnlineUser':	
				require('admin/Edit_jhsStud_OnlineUser.php');
			break;
			case 'jhsTeach_OnlineUserList':	
				require('admin/jhsTeach_OnlineUserList.php');
			break;
			case 'Add_jhsTeach_OnlineUser':	
				require('admin/Add_jhsTeach_OnlineUser.php');
			break;
			case 'Edit_jhsTeach_OnlineUser':	
				require('admin/Edit_jhsTeach_OnlineUser.php');
			break;

			// Students List -------------------------------------------
			case 'studentsHedList':	
				require('admin/HighSchoolStaffAccess/student/studentsHedList.php');
			break;
			case 'studentsShsList':	
				require('admin/HighSchoolStaffAccess/student/studentsShsList.php');
			break;
			case 'studentsJhsList':	
				require('admin/HighSchoolStaffAccess/student/studentsJhsList.php');
			break;

			// Teacher List --------------------------------------------
			case 'teachersHedList':	
				require('admin/HighSchoolStaffAccess/teacher/teachersHedList.php');
			break;
			case 'teachersShsList':	
				require('admin/HighSchoolStaffAccess/teacher/teachersShsList.php');
			break;
			case 'teachersJhsList':	
				require('admin/HighSchoolStaffAccess/teacher/teachersJhsList.php');
			break;

			// Edit Students ---------------------------
			case 'studentsHed_editStud':	
				require('admin/studentsHed_editStud.php');
			break;
			case 'studentsShs_editStud':	
				require('admin/studentsShs_editStud.php');
			break;
			case 'studentsJhs_editStud':	
				require('admin/studentsJhs_editStud.php');
			break;
			
			// Edit Teachers ---------------------------
			case 'teachersHed_editTeach':	
				require('admin/teachersHed_editTeach.php');
			break;
			case 'teachersShs_editTeach':	
				require('admin/teachersShs_editTeach.php');
			break;
			case 'teachersJhs_editTeach':	
				require('admin/teachersJhs_editTeach.php');
			break;

			default:
			require('admin/highschool_dashboard.php');
		}
	}elseif($user->isElementaryStaff()) {
			$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
			
			include "qrLib/qrlib.php";    
			
			switch ( $action ) {
				case 'settings':	
					require('admin/settings.php');
				break;
	
				// Library Attendance
				case 'elemOpenCam':	
					require('admin/elemOpenCam.php');
				break;
				case 'elemLibraryUsersAttendance':	
					require('admin/elemLibraryUsersAttendance.php');
				break;

				// Online Book Loaning 
				case 'GS-OnlineBookRequested':	
					require('admin/GS-OnlineBookRequested.php');
				break;
				case 'GS-OnlineBookBorrowed':	
					require('admin/GS-OnlineBookBorrowed.php');
				break;
				case 'GS-OnlineBookReturned':	
					require('admin/GS-OnlineBookReturned.php');
				break;
	
				// Offline Book Loaning 
				case 'elemStaff_BookLoaning':	
					require('admin/elemStaff_BookLoaning.php');
				break;
				
				// Top Library Users -------------------------------------------------------
				case 'StaffElemStudLibraryUsers':	
					require('admin/ElemStaffAccess/topLibraryUsers/students/StaffElemStudLibraryUsers.php');
				break;
				case 'StaffElemStudLibraryUsersGraph':	
					require('admin/ElemStaffAccess/topLibraryUsers/students/StaffElemStudLibraryUsersGraph.php');
				break;

				case 'StaffElemTeachLibraryUsers':	
					require('admin/ElemStaffAccess/topLibraryUsers/teachers/StaffElemTeachLibraryUsers.php');
				break;
				case 'StaffElemTeachLibraryUsersGraph':	
					require('admin/ElemStaffAccess/topLibraryUsers/teachers/StaffElemTeachLibraryUsersGraph.php');
				break;

				// Top Borrowers -------------------------------------------------------
				case 'StaffElemStudTopBorrowers':	
					require('admin/ElemStaffAccess/topBorrowers/students/StaffElemStudTopBorrowers.php');
				break;
				case 'StaffElemTeachTopBorrowers':	
					require('admin/ElemStaffAccess/topBorrowers/teachers/StaffElemTeachTopBorrowers.php');
				break;

				// Library Book QR -----------------------------------------------
				case 'gsLib_allQR':	
					require('admin/gsLib_allQR.php');
				break;
				case 'gsLib_allQRSelect':	
					require('admin/gsLib_allQRSelect.php');
				break;

				// Most Borrowed Books ------------------------------------------------------------------
				case 'ElementaryMostBorrowedBooks':	
					require('admin/MostBorrowedBooks/ElementaryMostBorrowedBooks.php');
				break;


				// Manage Books --------------------
				case 'gsLibBookImages':	
					require('admin/gsLibBookImages.php');
				break;
				case 'ElementaryBookList':	
					require('admin/ElementaryBookList.php');
				break;
				case 'ElementaryPeriodicalList':	
					require('admin/ElementaryPeriodicalList.php');
				break;
				case 'ElementaryDiscardedBooks':	
					require('admin/ElementaryDiscardedBooks.php');
				break;
				case 'ElementaryDiscardedBookCard':	
					require('admin/ElementaryDiscardedBookCard.php');
				break;
				case 'ElementaryDiscardedBookEdit':	
					require('admin/ElementaryDiscardedBookEdit.php');
				break;
				case 'ElementaryLostBooks':	
					require('admin/ElementaryLostBooks.php');
				break;
				case 'ElementaryBookEdit':	
					require('admin/ElementaryBookEdit.php');
				break;
				case 'ElementaryBookCard':	
					require('admin/ElementaryBookCard.php');
				break;
				case 'ElementaryPeriodicalBookEdit':	
					require('admin/ElementaryPeriodicalBookEdit.php');
				break;
				case 'ElementaryLostBookCard':	
					require('admin/ElementaryLostBookCard.php');
				break;
				case 'ElementaryLibFines':	
					require('admin/ElementaryLibFines.php');
				break;
				case 'hsBookViewCopies':	
					require('admin/hsBookViewCopies.php');
				break;

				case 'GsLibBorrowBooks':	
					require('admin/GsLibBorrowBooks.php');
				break;
				case 'GsLibReturnBooks':	
					require('admin/GsLibReturnBooks.php');
				break;

				// Library Cards -----------------------------------------------
				case 'gsStud_allLibCard':	
					require('admin/gsStud_allLibCard.php');
				break;
				case 'gsStud_allLibCardSelect':	
					require('admin/gsStud_allLibCardSelect.php');
				break;

				case 'gsStud_indivLibCard':	
					require('admin/gsStud_indivLibCard.php');
				break;

				case 'gsTeach_allLibCard':	
					require('admin/gsTeach_allLibCard.php');
				break;
				case 'gsTeach_allLibCardSelect':	
					require('admin/gsTeach_allLibCardSelect.php');
				break;
				case 'gsTeach_indivLibCard':	
					require('admin/gsTeach_indivLibCard.php');
				break;
	
				// Online User List
				case 'gsStud_OnlineUserList':	
					require('admin/gsStud_OnlineUserList.php');
				break;
				case 'Add_gsStud_OnlineUser':	
					require('admin/Add_gsStud_OnlineUser.php');
				break;
				case 'Edit_gsStud_OnlineUser':	
					require('admin/Edit_gsStud_OnlineUser.php');
				break;
				case 'gsTeach_OnlineUserList':	
					require('admin/gsTeach_OnlineUserList.php');
				break;
				case 'Add_gsTeach_OnlineUser':	
					require('admin/Add_gsTeach_OnlineUser.php');
				break;
				case 'Edit_gsTeach_OnlineUser':	
					require('admin/Edit_gsTeach_OnlineUser.php');
				break;

				// Students List -------------------------------------------
				case 'studentsJhsList':	
					require('admin/ElemStaffAccess/student/studentsJhsList.php');
				break;
				case 'studentsElemList':	
					require('admin/ElemStaffAccess/student/studentsElemList.php');
				break;
	
				// Teacher List --------------------------------------------
				case 'teachersJhsList':	
					require('admin/ElemStaffAccess/teacher/teachersJhsList.php');
				break;
				case 'teachersElemList':	
					require('admin/ElemStaffAccess/teacher/teachersElemList.php');
				break;
	
				// Edit Students ---------------------------
				case 'studentsJhs_editStud':	
					require('admin/studentsJhs_editStud.php');
				break;
				case 'studentsElem_editStud':	
					require('admin/studentsElem_editStud.php');
				break;
				
				// Edit Teachers ---------------------------
				case 'teachersJhs_editTeach':	
					require('admin/teachersJhs_editTeach.php');
				break;
				case 'teachersElem_editTeach':	
					require('admin/teachersElem_editTeach.php');
				break;
	
				default:
				require('admin/gradeschool_dashboard.php');
			}
		}elseif($user->isStudent()) {
			$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
			
			include "qrLib/qrlib.php";    
			
			switch ( $action ) {
				case 'settings':	
					require('admin/settings.php');
				break;
	
				//Online Book Loaning (College) ----------------------------------------
				case 'CollegeLibOnlineBookList':	
					require('admin/CollegeLibOnlineBookList.php');
				break;
				case 'CollegeLibRequestedBooks':	
					require('admin/CollegeOnlineBookLoaning/CollegeLibRequestedBooks.php');
				break;
				case 'CollegeLibReturnedBooks':	
					require('admin/CollegeOnlineBookLoaning/CollegeLibReturnedBooks.php');
				break;
				case 'CollegeLibIssuedBooks':	
					require('admin/CollegeOnlineBookLoaning/CollegeLibIssuedBooks.php');
				break;
				case 'CollegeLibOnlineBookCard':	
					require('admin/CollegeLibOnlineBookCard.php');
				break;
				
				//Online Book Loaning (High School) -------------------------------------------
				case 'HighSchoolLibOnlineBookList':	
					require('admin/HighSchoolLibOnlineBookList.php');
				break;
				case 'HighSchoolLibRequestedBooks':	
					require('admin/HighSchoolOnlineBookLoaning/HighSchoolLibRequestedBooks.php');
				break;
				case 'HighSchoolLibReturnedBooks':	
					require('admin/HighSchoolOnlineBookLoaning/HighSchoolLibReturnedBooks.php');
				break;
				case 'HighSchoolLibIssuedBooks':	
					require('admin/HighSchoolOnlineBookLoaning/HighSchoolLibIssuedBooks.php');
				break;

				//Online Book Loaning (Elementary) ----------------------------------------
				case 'ElementaryLibOnlineBookList':	
					require('admin/ElementaryLibOnlineBookList.php');
				break;
				case 'ElementaryLibRequestedBooks':	
					require('admin/ElementaryOnlineBookLoaning/ElementaryLibRequestedBooks.php');
				break;
				case 'ElementaryLibReturnedBooks':	
					require('admin/ElementaryOnlineBookLoaning/ElementaryLibReturnedBooks.php');
				break;
				case 'ElementaryLibIssuedBooks':	
					require('admin/ElementaryOnlineBookLoaning/ElementaryLibIssuedBooks.php');
				break;
				
				case 'OnlineFines':	
					require('admin/OnlineFines.php');
				break;
	
				default:
				require('admin/ChooseLibrary.php');
			}
		}elseif($user->isTeacher()) {
			$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
			
			include "qrLib/qrlib.php";    
			
			switch ( $action ) {
				case 'settings':	
					require('admin/settings.php');
				break;
	
				//Online Book Loaning (College) ----------------------------------------
				case 'admin/CollegeLibOnlineBookList':	
					require('admin/CollegeOnlineBookLoaning/CollegeLibOnlineBookList.php');
				break;
				case 'CollegeLibRequestedBooks':	
					require('admin/CollegeOnlineBookLoaning/CollegeLibRequestedBooks.php');
				break;
				case 'CollegeLibReturnedBooks':	
					require('admin/CollegeOnlineBookLoaning/CollegeLibReturnedBooks.php');
				break;
				case 'CollegeLibIssuedBooks':	
					require('admin/CollegeOnlineBookLoaning/CollegeLibIssuedBooks.php');
				break;
				case 'CollegeLibOnlineBookCard':	
					require('admin/CollegeLibOnlineBookCard.php');
				break;
				
				//Online Book Loaning (High School) -------------------------------------------
				case 'HighSchoolLibOnlineBookList':	
					require('admin/HighSchoolLibOnlineBookList.php');
				break;
				case 'HighSchoolLibRequestedBooks':	
					require('admin/HighSchoolOnlineBookLoaning/HighSchoolLibRequestedBooks.php');
				break;
				case 'HighSchoolLibReturnedBooks':	
					require('admin/HighSchoolOnlineBookLoaning/HighSchoolLibReturnedBooks.php');
				break;
				case 'HighSchoolLibIssuedBooks':	
					require('admin/HighSchoolOnlineBookLoaning/HighSchoolLibIssuedBooks.php');
				break;

				//Online Book Loaning (Elementary) ----------------------------------------
				case 'ElementaryLibOnlineBookList':	
					require('admin/ElementaryLibOnlineBookList.php');
				break;
				case 'ElementaryLibRequestedBooks':	
					require('admin/ElementaryOnlineBookLoaning/ElementaryLibRequestedBooks.php');
				break;
				case 'ElementaryLibReturnedBooks':	
					require('admin/ElementaryOnlineBookLoaning/ElementaryLibReturnedBooks.php');
				break;
				case 'ElementaryLibIssuedBooks':	
					require('admin/ElementaryOnlineBookLoaning/ElementaryLibIssuedBooks.php');
				break;
				
				case 'OnlineFines':	
					require('admin/OnlineFines.php');
				break;
	
				default:
				require('admin/CollegeLibOnlineBookList.php');
			}
		}
		
		else{
		Redirect::to('index.php');
	}
	
}
?>