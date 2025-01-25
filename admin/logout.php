<?php    
session_start(); 
// session_destroy();
unset($_SESSION['admin_email']);
unset($_SESSION['admin_id']);

 header('Location: login.php');  

exit;  
?>