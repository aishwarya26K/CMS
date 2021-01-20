<?php session_start();?>

<?php

$_SESSION['username'] = null;  //assignning db values to a session variable
$_SESSION['firstname'] = null; 
$_SESSION['lastname'] = null;
$_SESSION['user_role'] = null;
session_unset();

header("Location:../index.php");

?>