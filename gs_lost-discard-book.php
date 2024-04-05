<?php
require_once 'core/init.php';

	if (Input::exists()) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'gsBookQRCodes'.DIRECTORY_SEPARATOR;
	
		$books = DB:: getInstance()->get('books', array('id','=',Input::get('discard')));							
		foreach($books->results() as $books){
			unlink($PNG_TEMP_DIR.$books->qrcode);
		}

		$books = DB:: getInstance()->get('books', array('id','=',Input::get('discard')));
		if ($books->count()){
		foreach($books->results() as $books){
			$book = new Books();
				try {
				$book->update(array(
					'discarded' => 1,
				),$books->id);
			} catch(Exception $e) {
				$error;
			}
		}
	}else{
		$books = DB:: getInstance()->get('books', array('id','=',Input::get('lost')));							
		foreach($books->results() as $books){
			unlink($PNG_TEMP_DIR.$books->qrcode);
		}$books = DB:: getInstance()->get('books', array('id','=',Input::get('lost')));
		if ($books->count()){
		foreach($books->results() as $books){
			$book = new Books();
			try {
				$book->update(array(
					'lost' => 1,
				),$books->id);
			} catch(Exception $e) {
			$error;
			}
		}

		}Session::flash('Lost', 'Library book has been successfully updated.');
		Redirect::to('admin.php?action=ElementaryBookList');	
		}
	Session::flash('Discarded', 'Library book has been successfully discarded.');
	Redirect::to('admin.php?action=ElementaryBookList');	
}
?>