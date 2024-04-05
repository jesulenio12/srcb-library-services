<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current

// Handling user information update
if(Input::exists() && isset($_POST['updateUserInfo'])) {
    try {
        $user->update(array(
            'firstname' => Input::get('firstname'),
            'lastname' => Input::get('lastname'),
            'age' => Input::get('age'),
            'gender' => Input::get('gender'),
            'email' => Input::get('email'),
            'contactNum' => Input::get('contactNum'),
            'address' => Input::get('address'),
            'strtzone' => Input::get('strtzone'),
        ), Session::get(Config::get('sessions/session_name')));
        Session::flash('userUpdated', 'User information has been successfully updated.');
        Redirect::to('admin.php?action=settings');
    } catch(Exception $e) {
        $error;
    }
}

// Handling avatar upload
// Define the function to update the user's avatar in the database
function updateAvatarInDatabase($username, $avatarName) {
    // Connect to your database (assuming you're using PDO)
    $pdo = new PDO('mysql:host=localhost;dbname=lib-system', 'root', '');
    
    // Prepare the SQL query to update the avatar column in the userlogin table
    $query = "UPDATE userlogin SET avatar = :avatarName WHERE username = :username";
    
    // Prepare the statement
    $statement = $pdo->prepare($query);
    
    // Bind parameters
    $statement->bindParam(':avatarName', $avatarName);
    $statement->bindParam(':username', $username);
    
    // Execute the statement
    if ($statement->execute()) {
        // Avatar updated successfully
        echo "Avatar updated successfully.";
    } else {
        // Error occurred while updating avatar
        echo "Error: Unable to update avatar.";
    }
}

if (Input::exists() && isset($_POST['uploadAvatar'])) {
    // Set directory for avatar
    $AVATAR_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'UserAvatars' . DIRECTORY_SEPARATOR;

    // Create directory if not exist
    if (!file_exists($AVATAR_TEMP_DIR)) {
        mkdir($AVATAR_TEMP_DIR);
    }

    // Fetch user information from the userlogin table based on the session ID
    $user = DB::getInstance()->get('userlogin', array('id', '=', Session::get(Config::get('sessions/session_name'))));

    // Check if user data exists and extract the username, firstname, lastname, yearLevel, and progtrack
    if ($user->count() > 0) {
        $userData = $user->first();
        $username = $userData->username;
        $firstname = $userData->firstname;
        $lastname = $userData->lastname;

        // Retrieve input fields
        $avatar = $_FILES['avatar'];

        // Handle avatar/image upload
        if (!empty($avatar['name'])) {
            $avatarExtension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
            $allowedExtensions = array('jpg', 'jpeg', 'png');
            if (in_array($avatarExtension, $allowedExtensions)) {
                // Concatenate username, firstname, lastname, yearLevel, progtrack, and extension to form avatarName
                $avatarName = $username . '-' . $firstname . ' ' . $lastname . '.' . $avatarExtension;
                $avatarPath = $AVATAR_TEMP_DIR . $avatarName;

                // Move uploaded file to temp directory
                if (move_uploaded_file($avatar['tmp_name'], $avatarPath)) {
                    // Resize image
                    list($width, $height) = getimagesize($avatarPath);
                    $newWidth = 330; // Standard width
                    $newHeight = 330; // Standard height
                    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                    if ($avatarExtension == 'jpg' || $avatarExtension == 'jpeg') {
                        $source = imagecreatefromjpeg($avatarPath);
                    } elseif ($avatarExtension == 'png') {
                        $source = imagecreatefrompng($avatarPath);
                    }
                    imagecopyresampled($resizedImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                    // Save resized image
                    imagejpeg($resizedImage, $avatarPath, 100); // Save as jpeg with maximum quality

                    // Free memory
                    imagedestroy($source);
                    imagedestroy($resizedImage);

                    // Update user avatar in the database
                    updateAvatarInDatabase($username, $avatarName, $firstname, $lastname);

                    // Set flash message and redirect
                    Session::flash('userUpdated', 'User information has been successfully updated.');
                    Redirect::to('admin.php?action=settings');
                } else {
                    echo "Failed to move uploaded file.";
                }
            } else {
                echo "Invalid file format for avatar. Allowed formats: jpg, jpeg, png";
                // You may want to redirect or show an appropriate message here
            }
        }
    } else {
        echo "User not found"; // Handle the case where the user data is not found
    }
}
?>
