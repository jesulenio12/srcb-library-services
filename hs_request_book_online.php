<?php
require_once 'core/init.php';

if (Input::exists()) {
		$books = DB:: getInstance()->get('books', array('bookAccession','=',Input::get('bookAccession')));
		if ($books->count()){
			foreach($books->results() as $books){
				$book = new Books();
				 try {
					$book->update(array(
						'is_borrowed' => 1,
						'requested' => 1,
						'status' => 'Not Available',
						'dateRequested' => date('Y-m-d'),
						'library_userID' => Input::get('library_userID'),
						'userType' => Input::get('userType'),
						'firstname' => Input::get('firstname'),
						'lastname' => Input::get('lastname'),
						'gender' => Input::get('gender'),
						'yearLevel' => Input::get('yearLevel'),
						'classSection' => Input::get('classSection'),
						'departmentType' => Input::get('departmentType'),
						'progtrack' => Input::get('progtrack'),
						'libraryClass' => Input::get('libraryClass'),
					),$books->id);
				} catch(Exception $e) {
				   $error;
				}
			}
		}	
		
			Session::flash('Requested', 'Book has been successfully requested.');
			Redirect::to('admin.php?action=HighSchoolLibOnlineBookList');
            // } catch(Exception $e) {
            //    $error;
            // }
}

?>