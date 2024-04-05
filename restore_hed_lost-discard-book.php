<?php
require_once 'core/init.php';

	if (Input::exists()) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'bookQRCodes'.DIRECTORY_SEPARATOR;
	
		$books = DB:: getInstance()->get('books', array('id','=',Input::get('restore')));							
		foreach($books->results() as $books){
			unlink($PNG_TEMP_DIR.$books->qrcode);
		}

		$books = DB:: getInstance()->get('books', array('id','=',Input::get('restore')));
		if ($books->count()){
		foreach($books->results() as $books){
			$book = new Books();
				try {
				$book->update(array(
					'lost' => 0,
				),$books->id);
			} catch(Exception $e) {
				$error;
			}
		}
	}
	Session::flash('Restored', 'Library book has been successfully restored.');
	Redirect::to('admin.php?action=CollegeLostBooks');	
}
?>