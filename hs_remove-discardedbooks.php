<?php
require_once 'core/init.php';

	if (Input::exists()) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'bookQRCodes'.DIRECTORY_SEPARATOR;
	
		$books = DB:: getInstance()->get('books', array('id','=',Input::get('remove')));							
		foreach($books->results() as $books){
			unlink($PNG_TEMP_DIR.$books->qrcode);
		}

		$books = DB:: getInstance()->get('books', array('id','=',Input::get('remove')));
		if ($books->count()){
		foreach($books->results() as $books){
			$book = new Books();
				try {
				$book->update(array(
					'remove' => 1,
				),$books->id);
			} catch(Exception $e) {
				$error;
			}
		}
	}
	Session::flash('Deleted', 'Library book has been successfully removed.');
	Redirect::to('admin.php?action=HighSchoolDiscardedBooks');	
}
?>