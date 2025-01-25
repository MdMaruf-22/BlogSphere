<?php
include "includes/db.php";



if(isset($_GET['id'])){
    $category_id = intval($_GET['id']);
    $query = "DELETE FROM categories WHERE category_id=$category_id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Category deleted successfully.'); window.location.href = 'view_category.php';</script>";
    } else {
        echo "<script>alert('Error deleting category: " . mysqli_error($conn) . "'); window.location.href = 'category.php';</script>";
    }
}
else {
    header("Location: view_category.php");
}
?>