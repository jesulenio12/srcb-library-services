<?php
require_once 'core/init.php';
	if (Input::exists()) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'studentsQRCodes'.DIRECTORY_SEPARATOR;
	
		$userlogin = DB:: getInstance()->get('userlogin', array('id','=',Input::get('deactivate')));							
		foreach($userlogin->results() as $userlogin){
			unlink($PNG_TEMP_DIR.$userlogin->qrcode);
		}

		$userlogin = DB:: getInstance()->get('userlogin', array('id','=',Input::get('deactivate')));
		if ($userlogin->count()){
		foreach($userlogin->results() as $userlogin){
			$userlog = new UserLogin();
				try {
				$userlog->update(array(
					'archive' => 1,
				),$userlogin->id);
			} catch(Exception $e) {
				$error;
			}
		}
	}

	Session::flash('Deactivated', 'Teacher has been successfully deactivated.');
	Redirect::to('admin.php?action=teachersElemList');	
}
?>