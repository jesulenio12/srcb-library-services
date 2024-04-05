<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {

			$announcement = new Announcement();
            try {
                $announcement->create(array(
					'title' => Input::get('title'),
                    'message' => Input::get('message'),
					'libraryClass' => 'College Library',
                    'active' => '1',
                ));
			
			Session::flash('Success', 'Annoncement has been successfully notified.');
			Redirect::to('admin.php?action=CollegeLibAnnouncement');
            } catch(Exception $e) {
               $error;
            }
}
ob_end_flush();