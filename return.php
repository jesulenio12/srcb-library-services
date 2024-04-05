<?php
require_once 'core/init.php';
$user = new UserLogin();

$action = $_POST['action'];
		
		switch ( $action ) {
			case 'view_book_info':	
				$interval2 = 0;
				$dueDate = 0;
				$totalfines = 0;
				$books = DB:: getInstance()->get('books', array('bookAccession','=',$_POST['qrcode']));
				if ($books->count()){
					foreach($books->results() as $books){
						if ($books->is_borrowed == 1 && $books->requested == 0 ){
							$bookAccession = $books->bookAccession;
							$callNumber = $books->callNumber;
							$bookTitle = $books->bookTitle;
							$bookSection = $books->bookSection;
							$author = $books->author;
							$publisher = $books->publisher;
							$datePublished = $books->datePublished;
							$library_userID = $books->library_userID;
							$userType = $books->userType;
							$firstname = $books->firstname;
							$lastname = $books->lastname;
							$gender = $books->gender;
							$yearLevel = $books->yearLevel;
							$classSection = $books->classSection;
							$departmentType = $books->departmentType;
							$progtrack = $books->progtrack;
							$dateBorrowed = $books->dateBorrowed;
							$finesperDueDate = $books->finesperDueDate;
							$msg = '<div class="alert alert-success" >
									<i class="glyphicon glyphicon-ok"></i> Record found!
								</div>';
						}else{
							$bookAccession = '';
							$callNumber = '';
							$bookTitle = '';
							$bookSection = '';
							$author = '';
							$publisher = '';
							$datePublished = '';
							$library_userID = '';
							$userType = '';
							$firstname = '';
							$lastname = '';
							$gender = '';
							$yearLevel = '';
							$classSection = '';
							$departmentType = '';
							$progtrack = '';
							$dateBorrowed = '';
							$finesperDueDate = '';
							$msg = '<script>
										swal({
										title: "Oops!",
										text: "This book is not yet borrowed.",
										icon: "error",
										button: "OK",
										});
									</script>';
						}
						
					}
					
				}else{
					
					$bookAccession = '';
					$callNumber = '';
					$bookTitle = '';
					$bookSection = '';
					$author = '';
					$publisher = '';
					$datePublished = '';
					$library_userID = '';
					$userType = '';
					$firstname = '';
					$lastname = '';
					$gender = '';
					$yearLevel = '';
					$classSection = '';
					$departmentType = '';
					$progtrack = '';
					$dateBorrowed = '';
					$finesperDueDate = '';
					$msg = '<script>
								swal({
								// title: "Oops!",
								text: "Sorry, no record found!",
								icon: "error",
								button: "OK",
								});
							</script>';
				}
				// Due Date
				if($books->bookSection == 'Fiction'){
					$date = date_create($books->dateBorrowed);
					date_add($date,date_interval_create_from_date_string("7 days"));
					$dueDate =  date_format($date,"Y-m-d");
	
					// Date Interval
					$datenow = date('Y-m-d');
					$due = date_create($dueDate);
					$date_now = date_create($datenow);
				
					if($date_now>$due){
						$interval = date_diff($due, $date_now);
						$interval2 = (int) $interval->format('%d');
						$fines_perdue = $books->finesperDueDate;
						$totalfines = $fines_perdue*$interval2;
	
						echo json_encode(['id'=>$bookAccession, 'callNumber'=>$callNumber, 'bookSection'=>$bookSection, 'bookTitle'=>$bookTitle, 'author'=>$author, 'publisher'=>$publisher, 'datePublished'=>$datePublished, 
						'userid'=>$library_userID, 'userType'=>$userType, 'firstname'=>$firstname, 'lastname'=>$lastname, 'gender'=>$gender, 'yearLevel'=>$yearLevel, 'classSection'=>$classSection, 'departmentType'=>$departmentType, 'progtrack'=>$progtrack,
						'dateBorrowed'=>$dateBorrowed, 'dueDate'=>$dueDate = date_format($date,"Y-m-d"), 'finesperDueDate'=>'₱'.$finesperDueDate.'.00', 'interval2'=>$interval2 = $due->diff($date_now)->format("%d").' '.'Day(s)', 'totalFines'=>$totalFines = '₱'.$totalfines.'.00', 'remarks'=>$remarks = 'Overdue', 'msg'=>$msg]);
					}else{
						echo json_encode(['id'=>$bookAccession, 'callNumber'=>$callNumber, 'bookSection'=>$bookSection, 'bookTitle'=>$bookTitle, 'author'=>$author, 'publisher'=>$publisher, 'datePublished'=>$datePublished, 
						'userid'=>$library_userID, 'userType'=>$userType, 'firstname'=>$firstname, 'lastname'=>$lastname, 'gender'=>$gender, 'yearLevel'=>$yearLevel, 'classSection'=>$classSection, 'departmentType'=>$departmentType, 'progtrack'=>$progtrack,
						'dateBorrowed'=>$dateBorrowed, 'dueDate'=>$dueDate = date_format($date,"Y-m-d"), 'finesperDueDate'=>'₱'.$finesperDueDate.'.00', 'interval2'=>$interval2 = '0 Day(s)', 'totalFines'=>$totalFines = '₱'.$totalfines.'.00', 'remarks'=>$remarks = 'On Time', 'msg'=>$msg]);
					}
				}else if($books->bookSection != 'Fiction'){
					$date2 = date_create($books->dateBorrowed);
					date_add($date2,date_interval_create_from_date_string("3 days"));
					$dueDate2 =  date_format($date2,"Y-m-d");
	
					// Date Interval
					$datenow = date('Y-m-d');
					$due = date_create($dueDate2);
					$date_now = date_create($datenow);
				
					if($date_now>$due){
						$interval = date_diff($due, $date_now);
						$interval2 = (int) $interval->format('%d');
						$fines_perdue = $books->finesperDueDate;
						$totalfines = $fines_perdue*$interval2;
	
						echo json_encode(['id'=>$bookAccession, 'callNumber'=>$callNumber, 'bookSection'=>$bookSection, 'bookTitle'=>$bookTitle, 'author'=>$author, 'publisher'=>$publisher, 'datePublished'=>$datePublished, 
						'userid'=>$library_userID, 'userType'=>$userType, 'firstname'=>$firstname, 'lastname'=>$lastname, 'gender'=>$gender, 'yearLevel'=>$yearLevel, 'classSection'=>$classSection, 'departmentType'=>$departmentType, 'progtrack'=>$progtrack,
						'dateBorrowed'=>$dateBorrowed, 'dueDate'=>$dueDate = date_format($date2,"Y-m-d"), 'finesperDueDate'=>'₱'.$finesperDueDate.'.00', 'interval2'=>$interval2 = $due->diff($date_now)->format("%d").' '.'Day(s)', 'totalFines'=>$totalFines = '₱'.$totalfines.'.00', 'remarks'=>$remarks = 'Overdue', 'msg'=>$msg]);
					}else{
						echo json_encode(['id'=>$bookAccession, 'callNumber'=>$callNumber, 'bookSection'=>$bookSection, 'bookTitle'=>$bookTitle, 'author'=>$author, 'publisher'=>$publisher, 'datePublished'=>$datePublished, 
						'userid'=>$library_userID, 'userType'=>$userType, 'firstname'=>$firstname, 'lastname'=>$lastname, 'gender'=>$gender, 'yearLevel'=>$yearLevel, 'classSection'=>$classSection, 'departmentType'=>$departmentType, 'progtrack'=>$progtrack,
						'dateBorrowed'=>$dateBorrowed, 'dueDate'=>$dueDate = date_format($date2,"Y-m-d"), 'finesperDueDate'=>'₱'.$finesperDueDate.'.00', 'interval2'=>$interval2 = '0 Day(s)', 'totalFines'=>$totalFines = '₱'.$totalfines.'.00', 'remarks'=>$remarks = 'On Time', 'msg'=>$msg]);
					}
				}
				
			break;

		 default:
				;
		}
?>