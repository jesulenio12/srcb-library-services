<?php
			if (Input::exists()) {
				$booktransactions = DB:: getInstance()->get('booktransactions', array('id','=',Input::get('confirm')));
				if ($booktransactions->count()){
				foreach($booktransactions->results() as $booktransactions){
					$booktransaction = new BookTransactions();
					try {
					$booktransaction->update(array(
						'totalFines' => Input::get('totalFines'),
						'interval2' => Input::get('interval2').' '.'Day(s)',
						'payment' => 1,
					),$booktransactions->id);
					} catch(Exception $e) {
					$error;
					}
				}
				}													
				Session::flash('Paid', 'Fines has been successfully paid.');
				Redirect::to('admin.php?action=CollegeLibFines');
			}

			?>