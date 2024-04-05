<?php
require_once 'core/init.php';

	if (Input::exists()) {

		$userlogin = DB:: getInstance()->get('userlogin', array('id','=',Input::get('deactivate')));
		if ($userlogin->count()){
		foreach($userlogin->results() as $userlogin){
			$userlog = new UserLogin();
				try {
				$userlog->update(array(
					'permission' => 0,
					'archive' => 1,
				),$userlogin->id);
			} catch(Exception $e) {
				$error;
			}
		}
	}
	Session::flash('Deactivated', 'Library staff has been successfully deactivated.');
	Redirect::to('admin.php?action=userList');	
}
?>