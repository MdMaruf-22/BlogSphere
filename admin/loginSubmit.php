<?php 

include "includes/db.php" ;

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM  admins  WHERE email='$email'  AND password='$password'";
$result = $conn->query($sql);
                    
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        session_start();
        $_SESSION['admin_email'] = $email;
        $_SESSION['admin_id'] = $row['user_id'];
        // $_SESSION['role'] = 'admin';

        header("location: index.php");
    }
}
else
{
    header("location: login.php");
}