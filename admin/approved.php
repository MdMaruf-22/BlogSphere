<?php

include "./includes/db.php" ;

$post_id = $_GET['id'];
// exit();

$sql = "UPDATE posts SET status='Approved' WHERE post_id='$post_id'";
$result = $conn->query($sql);
                    
if ($conn->query($sql) === TRUE) 
{
    // echo "This post approved";

    header("location: index.php");
}
else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}