<?php
require 'conn.php';
require_once 'core/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bookAccession'])) {
    $bookAccession = $_POST['bookAccession'];

    // Get the library card information from books table
    $select_query = mysqli_query($conn, "SELECT * FROM `books` WHERE bookAccession = '$bookAccession'") or die(mysqli_error($conn));
    $library_book_data = mysqli_fetch_assoc($select_query);

    if ($library_book_data) {
        // Insert the library card information into indivqrbook table
        $insert_query = mysqli_query($conn, "INSERT INTO `indivqrbook` (id, bookAccession, isbn, callNumber, bookTitle, bookDescription, authorNumber, author, otherAuthor, etAl_authors, publisher, datePublished, bookSection, subject, otherSubject, indexNumber, appendix, includes, glossary, bibliography, qrcode, dateQRfilter, timeQRfilter, libraryClass,
       finesperDueDate, totalFines, is_borrowed, dateRequested, dateBorrowed, pickupTime, pickupDate, returnDay, library_userID, userType, firstname, lastname, gender, yearLevel, progtrack, classSection, departmentType, transactionPlace, requested, approved, received, status, discarded, lost, remove )
        VALUES (
            '{$library_book_data['id']}',
            '{$library_book_data['bookAccession']}',
            '{$library_book_data['isbn']}',
            '{$library_book_data['callNumber']}',
            '{$library_book_data['bookTitle']}',
            '{$library_book_data['bookDescription']}',
            '{$library_book_data['authorNumber']}',
            '{$library_book_data['author']}',
            '{$library_book_data['otherAuthor']}',
            '{$library_book_data['etAl_authors']}',
            '{$library_book_data['publisher']}',
            '{$library_book_data['datePublished']}',
            '{$library_book_data['bookSection']}',
            '{$library_book_data['subject']}',
            '{$library_book_data['otherSubject']}',
            '{$library_book_data['indexNumber']}',
            '{$library_book_data['appendix']}',
            '{$library_book_data['includes']}',
            '{$library_book_data['glossary']}',
            '{$library_book_data['bibliography']}',
            '{$library_book_data['qrcode']}',
            '{$library_book_data['dateQRfilter']}',
            '{$library_book_data['timeQRfilter']}',
            '{$library_book_data['libraryClass']}',
            '{$library_book_data['finesperDueDate']}',
            '{$library_book_data['totalFines']}',
            '{$library_book_data['is_borrowed']}',
            '{$library_book_data['dateRequested']}',
            '{$library_book_data['dateBorrowed']}',
            '{$library_book_data['pickupTime']}',
            '{$library_book_data['pickupDate']}',
            '{$library_book_data['returnDay']}',
            '{$library_book_data['library_userID']}',
            '{$library_book_data['userType']}',
            '{$library_book_data['firstname']}',
            '{$library_book_data['lastname']}',
            '{$library_book_data['gender']}',
            '{$library_book_data['yearLevel']}',
            '{$library_book_data['progtrack']}',
            '{$library_book_data['classSection']}',
            '{$library_book_data['departmentType']}',
            '{$library_book_data['transactionPlace']}',
            '{$library_book_data['requested']}',
            '{$library_book_data['approved']}',
            '{$library_book_data['received']}',
            '{$library_book_data['status']}',
            '{$library_book_data['discarded']}',
            '{$library_book_data['lost']}',
            '{$library_book_data['remove']}'
        )") or die(mysqli_error($conn));

        if ($insert_query) {
            // Deletion from books table
            $delete_query = mysqli_query($conn, "DELETE FROM `books` WHERE bookAccession = '$bookAccession'") or die(mysqli_error($conn));

            if ($delete_query) {
                // Deletion and transfer successful
                Session::flash('Move', "{$library_book_data['bookTitle']} QR code has been successfully moved.");
                Redirect::to('admin.php?action=gsLib_allQR');	
                exit();
            } else {
                // Deletion failed
                Session::flash('Error', "{$library_book_data['bookTitle']} QR code has error deleting.");
                Redirect::to('admin.php?action=gsLib_allQR');
            }
        } else {
            // Insertion failed
            Session::flash('Error', "{$library_book_data['bookTitle']} QR code has error moving.");
            Redirect::to('admin.php?action=gsLib_allQR');
        }
    } else {
        // Library card not found
        Session::flash('Error', "Book QR code not found.");
        Redirect::to('admin.php?action=gsLib_allQR');
    }
} else {
    // Invalid request
    Session::flash('Error', "Book QR code request invalid.");
    Redirect::to('admin.php?action=gsLib_allQR');
}

// Close the database connection
mysqli_close($conn);
?>
