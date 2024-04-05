<?php
ob_start();
require_once 'core/init.php';

$user = new UserLogin();
try {
$user->update(array(
    'online' => 0,
    ), $user->data()->id);
} catch(Exception $e) {
    $error;
}

$_SESSION['username'] = "";
$_SESSION['userid']  = "";
$_SESSION['login_details_id']= "";

$user->logout();
Redirect::to('homepage.php');
ob_end_flush();