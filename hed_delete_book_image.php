<?php
require 'conn.php';
require_once 'core/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['bookImageId'])) {
        $id = $_POST['bookImageId'];

        // Add additional validation if necessary

        // Delete the book image from the database
        $deleteQuery = mysqli_query($conn, "DELETE FROM `bookimages` WHERE `id` = $id");

        if ($deleteQuery) {
            // Optionally, you can also delete the associated file from the server.
            // Make sure to replace 'admin/hedBookImages/' with your actual path.
            $filePath = 'admin/hedBookImages/' . $id; // Adjust this to match your file structure
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            Session::flash('Deleted', "Book image has been deleted successfully.");
            Redirect::to('admin.php?action=hedLibBookImages');    
        } else {
            echo "Error deleting book image.";
            Session::flash('Error', "Book image cannot be deleted, something went wrong.");
            Redirect::to('admin.php?action=hedLibBookImages');    
        }
    } else {
        Session::flash('Error', "Invalid request. Missing bookImageId.");
        Redirect::to('admin.php?action=hedLibBookImages');    
    }
} else {
    Session::flash('Error', "Invalid request method.");
    Redirect::to('admin.php?action=hedLibBookImages');    
}
?>
