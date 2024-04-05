<?php
require 'conn.php';
require_once 'core/init.php';

if (Input::exists()) {
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'shsStudQRCodes'.DIRECTORY_SEPARATOR;
		
		$userlogin = DB:: getInstance()->get('userlogin', array('id','=',Input::get('delete')));							
		foreach($userlogin->results() as $userlogin){
			unlink($PNG_TEMP_DIR.$userlogin->qrcode);
		}
		
		$contents = DB:: getInstance()->delete('userlogin', array('id','=',Input::get('delete')));	

		Session::flash('Deleted', 'Student has been successfully deleted.');
		Redirect::to('admin.php?action=studentsShsList');	
}
?>