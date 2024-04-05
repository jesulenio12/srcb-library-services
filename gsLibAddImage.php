<?php
require 'conn.php';
require_once 'core/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $bookImageTitle = $_POST['bookImageTitle'];
    $bookImageSection = $_POST['bookImageSection'];
    $bookImageAuthor = $_POST['bookImageAuthor'];
    $bookdatePublished = $_POST['bookdatePublished'];

    // Set the default value for LibraryClass
    $bookImageLibClass = "Grade School Library";

    if (isset($_FILES['uploadImage'])) {
        $imageName = $_FILES['uploadImage']['name'];
        $imageTmpName = $_FILES['uploadImage']['tmp_name'];

        // Check if the file has a valid extension
        $allowedExtensions = ['jpeg', 'jpg', 'png'];
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            die("Invalid file extension. Allowed extensions: jpeg, jpg, png.");
        }

        // Generate a new filename based on bookImageTitle
        $newFilename = str_replace(' ', '', $bookImageTitle) . '_' . uniqid() . '.' . $fileExtension;

        $uploadPath = "admin/gsBookImages/";
        $targetPath = $uploadPath . $newFilename;

        move_uploaded_file($imageTmpName, $targetPath);

        // Set the desired dimensions
        $desiredWidth = 250;
        $desiredHeight = 350;

        // Get the original image dimensions
        list($originalWidth, $originalHeight) = getimagesize($targetPath);

        // Calculate the aspect ratio
        $aspectRatio = $originalWidth / $originalHeight;

        // Calculate new dimensions while maintaining the aspect ratio
        if ($aspectRatio > 1) {
            $newWidth = $desiredWidth;
            $newHeight = $desiredWidth / $aspectRatio;
        } else {
            $newWidth = $desiredHeight * $aspectRatio;
            $newHeight = $desiredHeight;
        }

        // Create a new image with the desired dimensions
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        $sourceImage = imagecreatefromstring(file_get_contents($targetPath));

        // Resize and save the image
        imagecopyresized($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
        imagejpeg($newImage, $targetPath, 90);

        // Free up memory
        imagedestroy($newImage);
        imagedestroy($sourceImage);

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO bookimages (bookImageTitle, bookImageSection, bookImageAuthor, bookdatePublished, bookImageLibClass, bookImage) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $bookImageTitle, $bookImageSection, $bookImageAuthor, $bookdatePublished, $bookImageLibClass, $newFilename);

        if ($stmt->execute()) {
            Session::flash('Added', "$bookImageTitle book image has been added successfully.");
            Redirect::to('admin.php?action=gsLibBookImages');	
        } else {
            echo "Error: " . $stmt->error;
            Redirect::to('admin.php?action=gsLibBookImages');	
        }
        
        $stmt->close();
    } else {
        die("No file uploaded.");
    }
} else {
    die("Invalid request.");
}
?>
