<?php
require_once 'core/init.php';
$user = new UserLogin();

$action = $_POST['action'];
		
		switch ( $action ) {
			case 'view_users_info':	
				$userlogin = DB:: getInstance()->get('userlogin', array('library_userID','=',$_POST['library_userID']));
				if ($userlogin->count()){
					foreach($userlogin->results() as $userlogin){
						if ($userlogin->status == 1){
						
							$library_userID = $userlogin->library_userID;
							$userType = $userlogin->userType;
							$firstname = $userlogin->firstname;
							$lastname = $userlogin->lastname;
							$gender = $userlogin->gender;
							$yearLevel = $userlogin->yearLevel;
							$classSection = $userlogin->classSection;
							$departmentType = $userlogin->departmentType;
							$progtrack = $userlogin->progtrack;
							$msg = '<script>
										swal({
										title: "Library Card is deactivated",
										text: "Please approach library in-charged.",
										icon: "error",
										button: "OK",
										});
									</script>';
						} else {

							$library_userID = $userlogin->library_userID;
							$userType = $userlogin->userType;
							$firstname = $userlogin->firstname;
							$lastname = $userlogin->lastname;
							$gender = $userlogin->gender;
							$yearLevel = $userlogin->yearLevel;
							$classSection = $userlogin->classSection;
							$departmentType = $userlogin->departmentType;
							$progtrack = $userlogin->progtrack;
							$msg = '';
						}
					}
					
				}
				else{
					$library_userID = '';
					$firstname = '';
					$lastname = '';
					$gender = '';
					$userType = '';
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

							echo json_encode(['userid'=>$library_userID, 'userType'=>$userType, 'firstname'=>$firstname,
							'lastname'=>$lastname, 'gender'=>$gender, 'yearLevel'=>$yearLevel, 'classSection'=>$classSection,
							'departmentType'=>$departmentType, 'progtrack'=>$progtrack, 'msg'=>$msg]);
							
					break;
				}
				
				echo json_encode(['userid'=>$library_userID, 'userType'=>$userType, 'firstname'=>$firstname,
				'lastname'=>$lastname, 'gender'=>$gender, 'yearLevel'=>$yearLevel, 'classSection'=>$classSection,
				'departmentType'=>$departmentType, 'progtrack'=>$progtrack, 'msg'=>$msg]);
				
			break;

		 default:
				;
		}
?>
