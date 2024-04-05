<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current

if(Input::exists()) {
		$user = new UserLogin(); //Current
			try {
				$user->update(array(
					'username' => Input::get('username'),
				), Session::get(Config::get('sessions/session_name')));
				Session::flash('Updated', 'Username has been successfully updated.');
                Redirect::to('admin.php?action=settings');
			} catch(Exception $e) {
				$error;
			}
}
			
?>
