<?php
require 'conn.php';
require_once 'core/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['library_userID'])) {
    $library_userID = $_POST['library_userID'];

    // Get the library card information from indivqrcard table
    $select_query = mysqli_query($conn, "SELECT * FROM `indivqrcard` WHERE library_userID = '$library_userID'") or die(mysqli_error($conn));
    $library_card_data = mysqli_fetch_assoc($select_query);

    if ($library_card_data) {
        // Insert the library card information into indivqrcard table
        $insert_query = mysqli_query($conn, "INSERT INTO `userlogin` (id, permission, permissionRole, username, password, library_userID, userType, firstname, lastname, gender, age, address, strtzone, yearLevel, classSection, progtrack, departmentType, email, contactNum, libraryClass, dateQRfilter, timeQRfilter, login_id, qrcode, avatar, current_session, online, archive) VALUES (
            '{$library_card_data['id']}',
            '{$library_card_data['permission']}',
            '{$library_card_data['permissionRole']}',
            '{$library_card_data['username']}',
            '{$library_card_data['password']}',
            '{$library_card_data['library_userID']}',
            '{$library_card_data['userType']}',
            '{$library_card_data['firstname']}',
            '{$library_card_data['lastname']}',
            '{$library_card_data['gender']}',
            '{$library_card_data['age']}',
            '{$library_card_data['address']}',
            '{$library_card_data['strtzone']}',
            '{$library_card_data['yearLevel']}',
            '{$library_card_data['classSection']}',
            '{$library_card_data['progtrack']}',
            '{$library_card_data['departmentType']}',
            '{$library_card_data['email']}',
            '{$library_card_data['contactNum']}',
            '{$library_card_data['libraryClass']}',
            '{$library_card_data['dateQRfilter']}',
            '{$library_card_data['timeQRfilter']}',
            '{$library_card_data['login_id']}',
            '{$library_card_data['qrcode']}',
            '{$library_card_data['avatar']}',
            '{$library_card_data['current_session']}',
            '{$library_card_data['online']}',
            '{$library_card_data['archive']}'
        )") or die(mysqli_error($conn));

        if ($insert_query) {
            // Deletion from indivqrcard table
            $delete_query = mysqli_query($conn, "DELETE FROM `indivqrcard` WHERE library_userID = '$library_userID'") or die(mysqli_error($conn));

            if ($delete_query) {
                // Deletion and transfer successful
                Session::flash('Return', "{$library_card_data['firstname']} {$library_card_data['lastname']}'s library card has been successfully returned.");
                Redirect::to('admin.php?action=shsTeach_allLibCardSelect');	
                exit();
            } else {
                // Deletion failed
                Session::flash('Error', "{$library_card_data['firstname']} {$library_card_data['lastname']}'s library card has error deleting.");
                Redirect::to('admin.php?action=shsTeach_allLibCardSelect');
            }
        } else {
            // Insertion failed
            Session::flash('Error', "{$library_card_data['firstname']} {$library_card_data['lastname']}'s library card has error returning.");
            Redirect::to('admin.php?action=shsTeach_allLibCardSelect');
        }
    } else {
        // Library card not found
        Session::flash('Error', "Library card not found.");
        Redirect::to('admin.php?action=shsTeach_allLibCardSelect');
    }
} else {
    // Invalid request
    Session::flash('Error', "Library card request invalid.");
    Redirect::to('admin.php?action=shsTeach_allLibCardSelect');
}

// Close the database connection
mysqli_close($conn);
?>
