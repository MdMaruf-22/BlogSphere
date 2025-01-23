<?php
include "./includes/db.php"; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href='register.php';</script>";
        exit();
    }

    // Check if the email already exists
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists!'); window.location.href='login.php';</script>";
        exit();
    }

    // Insert data into the database without hashing the password
    $query = "INSERT INTO users (name, email, password, join_date) VALUES ('$name', '$email', '$password', NOW())";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to register. Please try again later.'); window.location.href='register.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='login.php';</script>";
}
?>
