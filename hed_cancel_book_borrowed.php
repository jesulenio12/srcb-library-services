<?php
require 'conn.php';
require_once 'core/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['bookCard'])) {
        $bookCardId = $_POST['bookCard'];

        // Fetch the latest record from booktransactions
        $latestTransactionQuery = mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE `id` = $bookCardId");

        if ($latestTransactionQuery) {
            $latestTransactionData = mysqli_fetch_assoc($latestTransactionQuery);

            // Delete the latest transaction
            $deleteTransactionQuery = mysqli_query($conn, "DELETE FROM `booktransactions` WHERE `id` = $bookCardId");

            if ($deleteTransactionQuery) {
                // Update the book status if necessary
                if ($latestTransactionData['transactionType'] == 'borrow') {
                    $updateBooksQuery = mysqli_query($conn, "UPDATE `books` SET 
                        `is_borrowed` = 0,
                        `requested` = 0,
                        `dateBorrowed` = '',
                        `status` = 'Available',
                        `library_userID` = '',
                        `userType` = '',
                        `firstname` = '',
                        `lastname` = '',
                        `gender` = '',
                        `yearLevel` = '',
                        `classSection` = '',
                        `departmentType` = '',
                        `progtrack` = '',
                        `transactionPlace` = ''
                        WHERE `bookAccession` = '{$latestTransactionData['bookAccession']}'");

                    if ($updateBooksQuery) {
                        // Flash message and redirect upon successful deletion and update
                        Session::flash('Canceled', 'Book has been successfully canceled.');
                        Redirect::to('admin.php?action=hedStaff_BookLoaning');
                    } else {
                        // Handle error if updating books table fails
                        Session::flash('Error', 'Error updating books table.');
                        Redirect::to('admin.php?action=hedStaff_BookLoaning');
                    }
                } else {
                    // Flash message and redirect if no update needed
                    Session::flash('Canceled', 'Book has been successfully canceled.');
                    Redirect::to('admin.php?action=hedStaff_BookLoaning');
                }
            } else {
                // Handle error if deleting transaction fails
                Session::flash('Error', 'Error deleting transaction.');
                Redirect::to('admin.php?action=hedStaff_BookLoaning');
            }
        } else {
            // Handle error if fetching latest transaction fails
            Session::flash('Error', 'Error fetching latest transaction.');
            Redirect::to('admin.php?action=hedStaff_BookLoaning');
        }
    } else {
        // Handle error if bookCardId is missing in the POST data
        Session::flash('Error', 'Invalid request. Missing bookCardId.');
        Redirect::to('admin.php?action=hedStaff_BookLoaning');
    }
} else {
    // Handle error for invalid request method
    Session::flash('Error', 'Invalid request method.');
    Redirect::to('admin.php?action=hedStaff_BookLoaning');
}
?>
