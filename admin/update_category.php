<?php
include "includes/db.php";

session_start();

if (!isset($_SESSION['admin_email']) || empty($_SESSION['admin_email'])) {
    echo "<script>alert('Access denied. Admins only.'); window.location.href = 'login.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_name'], $_POST['category_id'])) {
    $category_id = intval($_POST['category_id']);
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);

    if (!empty($category_name)) {
        $query = "UPDATE categories SET category = '$category_name' WHERE category_id = $category_id";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Category updated successfully!'); window.location.href = 'view_category.php';</script>";
        } else {
            echo "<script>alert('Error updating category: " . mysqli_error($conn) . "'); window.location.href = 'category.php';</script>";
        }
    } else {
        echo "<script>alert('Category name cannot be empty.'); window.location.href = 'edit_category.php?id=$category_id';</script>";
    }
} else {
    header("Location: category.php");
}
?>
