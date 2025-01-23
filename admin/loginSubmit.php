<?php 

include "./includes/db.php" ;

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM  admins  WHERE email='$email'  AND password='$password'";
$result = $conn->query($sql);
                    
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $row['user_id'];

        header("location: index.php");
    }
}
else
{
    header("location: login.php");
}