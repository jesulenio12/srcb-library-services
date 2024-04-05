<?php
require_once 'core/init.php';
$user = new UserLogin();

$action = $_POST['action'];
		
		switch ( $action ) {
			case 'view_book_info':	
				$books = DB:: getInstance()->get('books', array('bookAccession','=',$_POST['qrcode']));
				if ($books->count()){
					foreach($books->results() as $books){
						if ($books->is_borrowed == 1 && $books->requested == 0 ){
							$bookAccession = '';
							$callNumber = '';
							$bookSection = '';
							$bookTitle = '';
							$author = '';
							$publisher = '';
							$datePublished = '';
							$msg = '<script>
										swal({
										title: "Book is not available!",
										text: "This may have been borrowed and is not yet returned.",
										icon: "error",
										button: "OK",
										});
									</script>';

							
							
						} else{
							$callNumber = $books->callNumber;
							$bookAccession = $books->bookAccession;
							$bookSection = $books->bookSection;
							$bookTitle = $books->bookTitle;
							$author = $books->author;
							$publisher = $books->publisher;
							$datePublished = $books->datePublished;
							$msg = '<div class="alert alert-success" >
									<i class="glyphicon glyphicon-ok"></i> Book record found!
								</div>';
						}
					}
					
				}else{
					$callNumber = '';
					$bookAccession = '';
					$bookSection = '';
					$bookTitle = '';
					$author = '';
					$publisher = '';
					$datePublished = '';
					$msg = '<script>
								swal({
								title: "Sorry, no record found!",
								// text: "You clicked the button!",
								icon: "error",
								button: "OK",
								});
							</script>';
				}

				echo json_encode(['id'=>$bookAccession, 'callNumber'=>$callNumber, 'bookSection'=>$bookSection,
				'bookTitle'=>$bookTitle, 'author'=>$author, 'publisher'=>$publisher, 'datePublished'=>$datePublished,
				'msg'=>$msg]);
			break;

			case 'view_users_info':	
				$userlogin = DB:: getInstance()->get('userlogin', array('library_userID','=',$_POST['qrcode']));
				if ($userlogin->count()){
					foreach($userlogin->results() as $userlogin){
						
							$library_userID = $userlogin->library_userID;
							$userType = $userlogin->userType;
							$firstname = $userlogin->firstname;
							$lastname = $userlogin->lastname;
							$gender = $userlogin->gender;
							$yearLevel = $userlogin->yearLevel;
							$classSection = $userlogin->classSection;
							$departmentType = $userlogin->departmentType;
							$progtrack = $userlogin->progtrack;
							$msg = '<div class="alert alert-success" >
									<i class="glyphicon glyphicon-ok"></i> User found!
								</div>';
					}
					
				}else{
					$library_userID = '';
					$firstname = '';
					$lastname = '';
					$userType = '';
					$gender = '';
					$yearLevel = '';
					$classSection = '';
					$departmentType = '';
					$progtrack = '';
					$msg = '<script>
								swal({
								title: "Sorry, no record found!",
								// text: "You clicked the button!",
								icon: "error",
								button: "OK",
								});
							</script>';
				
				}
				
				echo json_encode(['userid'=>$library_userID, 'userType'=>$userType, 'firstname'=>$firstname,
				'lastname'=>$lastname, 'gender'=>$gender, 'yearLevel'=>$yearLevel, 'classSection'=>$classSection,
				'departmentType'=>$departmentType, 'progtrack'=>$progtrack, 'msg'=>$msg]);
			break;

		 default:
				;
		}
?>