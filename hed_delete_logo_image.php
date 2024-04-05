<?php
require 'conn.php';
require_once 'core/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['logoImageId'])) {
        $id = $_POST['logoImageId'];

        // Add additional validation if necessary

        // Delete the logo image from the database
        $deleteQuery = mysqli_query($conn, "DELETE FROM `srcblogo` WHERE `id` = $id");

        if ($deleteQuery) {
            // Optionally, you can also delete the associated file from the server.
            // Make sure to replace 'admin/hedlogoImages/' with your actual path.
            $filePath = 'admin/hedLogoImages/' . $id; // Adjust this to match your file structure
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            Session::flash('Deleted', "Logo image has been deleted successfully.");
            Redirect::to('admin.php?action=hedLogoImages');    
        } else {
            echo "Error deleting logo image.";
            Session::flash('Error', "Logo image cannot be deleted, something went wrong.");
            Redirect::to('admin.php?action=hedLogoImages');    
        }
    } else {
        Session::flash('Error', "Invalid request. Missing logo image ID.");
        Redirect::to('admin.php?action=hedLogoImages');    
    }
} else {
    Session::flash('Error', "Invalid request method.");
    Redirect::to('admin.php?action=hedLogoImages');    
}
?>
