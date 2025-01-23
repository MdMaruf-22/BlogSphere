<?php 

include "./includes/db.php" ;

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// echo date('d-m-Y i:s:h');
$sql = "SELECT * FROM  admins  WHERE email='$email'";
$result = $conn->query($sql);
                    
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        // session_start();
        $_SESSION['message'] = "<span class='text-warning'>You have already an Account!</span>";
        // echo $_SESSION['message'];
        // exit();
        header("location: login.php");
    }
}
else
{

    $sql = "INSERT INTO admins (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) 
    {
        $_SESSION['message'] = "<span class='text-success'>Your account create successfully!</span>";


    
        header("location: login.php");
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    

    
}