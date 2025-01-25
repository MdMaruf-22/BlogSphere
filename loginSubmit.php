<?php 

include "./includes/db.php" ;

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM  users  WHERE email='$email'  AND password='$password'";
$result = $conn->query($sql);
                    
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        session_start();
        $_SESSION['user_email'] = $email;
        $_SESSION['user_id'] = $row['user_id'];
        // $_SESSION['role'] = 'user';
        
        header("location: index.php");
    }
}
else
{
    header("location: login.php");
}