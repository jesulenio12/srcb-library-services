<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current

if(Input::exists()) {
		$user = new UserLogin(); //Current
			$currentPass = Hash::make(Input::get('currentPassword'));
			if($user->data()->password === $currentPass) {
				$user->update(array(
					'password' => Hash::make(Input::get('newPassword')),
				));

				Session::flash('passwordChanged', 'Your password has been changed!');
                Redirect::to('admin.php?action=settings');
			} else {
				Session::flash('wrongPassword', 'Your current password is wrong!');
			}
}
			
?>
