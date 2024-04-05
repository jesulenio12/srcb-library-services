<?php
require 'conn.php';
require_once 'core/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $logoName = $_POST['logoName'];

    // Set the default value for LibraryClass
    $logoClass = "College Library";

    if (isset($_FILES['uploadImage'])) {
        $imageName = $_FILES['uploadImage']['name'];
        $imageTmpName = $_FILES['uploadImage']['tmp_name'];

        // Check if the file has a valid extension
        $allowedExtensions = ['jpeg', 'jpg', 'png'];
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            die("Invalid file extension. Allowed extensions: jpeg, jpg, png.");
        }

        // Generate a new filename based on progtrack
        $newFilename = str_replace(' ', '', $logoName) . '_' . uniqid() . '.' . $fileExtension;

        $uploadPath = "admin/hedLogoImages/";
        $targetPath = $uploadPath . $newFilename;

        move_uploaded_file($imageTmpName, $targetPath);

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO srcblogo (logoName, logoClass, logoImage) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $logoName, $logoClass, $newFilename);

        if ($stmt->execute()) {
            Session::flash('Added', "$logoName course logo has been uploaded successfully.");
            Redirect::to('admin.php?action=hedLogoImages');	
        } else {
            echo "Error: " . $stmt->error;
            Redirect::to('admin.php?action=hedLogoImages');	
        }
        
        $stmt->close();
    } else {
        die("No file uploaded.");
    }
} else {
    die("Invalid request.");
}
?>
