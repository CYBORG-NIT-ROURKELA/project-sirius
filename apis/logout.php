<?php

session_start();
$_SESSION['logged_in']=0;
$_SESSION['admin_id']=0;
$_SESSION['email']="";
$_SESSION['name']="";

// remove all session variables
session_unset();
// destroy the session
session_destroy();


echo(json_encode(array('status' => 'success', 'message' => 'Logged Out')));


?>
