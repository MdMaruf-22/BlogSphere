<?php    
session_start(); 
//session_destroy();
unset($_SESSION['user_email']);
unset($_SESSION['user_id']);

 header('Location: login.php');  

exit;  
?>