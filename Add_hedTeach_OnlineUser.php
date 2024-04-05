<?php
ob_start();
require_once 'core/init.php';

$user = new UserLogin(); //Current

if (Input::exists()) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
				'username' => array(
				'name' => 'username',
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'userlogin'
			),
		));
		if ($validate->passed()) {
			$user = new Userlogin();
            try {
                $user->create(array(
                    'username' => 'ID-'.Input::get('username'),
                    'password' => Hash::make(Input::get('password')),
                    'joined' => date('Y-m-d'),
                    'permission' => '6',
					'permissionRole' => '6',
					'fname' => Input::get('fname'),
					'lname' => Input::get('lname'),
					'gender' => Input::get('gender'),
					'departmentType' => Input::get('departmentType'),
					'login_id' => '',
					'avatar' => '',
					'current_session' => 0,
					'online' => 0,
					'archive' => 0,
                ));
			
			Session::flash('UserAdded', 'New library user has been successfully added.');
			Redirect::to('admin.php?action=hedTeach_OnlineUserList');
            } catch(Exception $e) {
				echo ($e->getMessage());
            }
		} else {
            foreach ($validate->errors() as $error) {
				Session::flash('Error', $error);
				Redirect::to('admin.php?action=hedTeach_OnlineUserList');
            }
        }
}
ob_end_flush();