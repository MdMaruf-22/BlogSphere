<?php
include "./includes/db.php";
session_start(); 

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must be logged in to create a post.'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id']; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);


    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif','image/jpg'];
    $maxFileSize = 2 * 1024 * 1024; 

    if ($imageError === 0) {
        if ($imageSize > $maxFileSize) {
            echo "<script>alert('File size exceeds 2MB limit.'); window.location.href='create_post.php';</script>";
            exit();
        }

        $imageType = mime_content_type($imageTmpName);
        if (!in_array($imageType, $allowedTypes)) {
            echo "<script>alert('Invalid file type. Only JPG, PNG, and GIF are allowed.'); window.location.href='create_post.php';</script>";
            exit();
        }

        $imageNewName = uniqid('', true) . "." . pathinfo($imageName, PATHINFO_EXTENSION);
        $imageDestination = 'images/blogs/' . $imageNewName; 

        if (move_uploaded_file($imageTmpName, $imageDestination)) {
            $query = "INSERT INTO posts (title, details, date_time, category_id, user_id, image) 
                      VALUES ('$title', '$details', NOW(), '$category_id', '$user_id', '$imageNewName')";

            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Post created successfully!'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error: Unable to create post.'); window.location.href='create_post.php';</script>";
            }
        } else {
            echo "<script>alert('Error uploading the image.'); window.location.href='create_post.php';</script>";
        }
    } else {
        echo "<script>alert('Error uploading the image.'); window.location.href='create_post.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='create_post.php';</script>";
}
?>