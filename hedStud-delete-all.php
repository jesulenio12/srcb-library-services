<?php

require 'conn.php';
require_once 'core/init.php';

// Check if delete key is provided
if(isset($_POST['deleteKey'])) {
    $deleteKey = $_POST['deleteKey'];

    // Check if the provided delete key exists in the deleteKey table
    $keyCheckSql = "SELECT * FROM deletekey WHERE deletionKey = ?";
    $keyCheckStmt = mysqli_prepare($conn, $keyCheckSql);
    mysqli_stmt_bind_param($keyCheckStmt, "s", $deleteKey);
    mysqli_stmt_execute($keyCheckStmt);
    $keyCheckResult = mysqli_stmt_get_result($keyCheckStmt);

    if(mysqli_num_rows($keyCheckResult) > 0) {
        // Delete process starts here

        // Retrieve qrcode filenames for all entries being deleted
        $sql = "SELECT qrcode FROM userlogin WHERE archive = 0 && libraryClass = 'College Library' && departmentType = 'Higher Education Department' && userType = 'Student'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Construct the full path to the qrcode image file
                $avatarPath = 'admin/hedStudQRCodes/' . $row['qrcode']; // Adjust path as needed
                
                // Check if the file exists and delete it
                if (file_exists($avatarPath)) {
                    unlink($avatarPath); // Delete the file
                }
            }

            // Delete all records from userlogin table
            $sql_delete = "DELETE FROM userlogin WHERE archive = 0 && libraryClass = 'College Library' && departmentType = 'Higher Education Department' && userType = 'Student'";
            if (mysqli_query($conn, $sql_delete)) {
                Session::flash('Success', 'All users and their qrcodes have been successfully deleted.');
                Redirect::to('admin.php?action=hedStud_OnlineUserList');
            } else {
                Session::flash('Error', 'Error occurred while deleting users.');
                Redirect::to('admin.php?action=hedStud_OnlineUserList');
            }
        } else {
            Session::flash('Error', 'Error occurred while retrieving qrcode filenames.');
            Redirect::to('admin.php?action=hedStud_OnlineUserList');
        }
    } else {
        // If delete key is invalid, show an error message
        Session::flash('Error', 'Invalid delete key.');
        Redirect::to('admin.php?action=hedStud_OnlineUserList');
    }
} else {
    // If delete key is not provided, show an error message
    Session::flash('Error', 'Delete key not provided.');
    Redirect::to('admin.php?action=hedStud_OnlineUserList');
}

mysqli_close($conn);
?>
