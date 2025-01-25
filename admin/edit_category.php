<?php
include "../includes/db.php";

session_start();

if (!isset($_SESSION['admin_email']) || empty($_SESSION['admin_email'])) {
    echo "<script>alert('Access denied. Admins only.'); window.location.href = 'login.php';</script>";
    exit();
}

if (isset($_GET['id'])) {
    $category_id = intval($_GET['id']);

    $query = "SELECT * FROM categories WHERE category_id = $category_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $category = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Category not found.'); window.location.href = 'category.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'category.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .edit-category-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            padding: 20px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .edit-category-container h2 {
            font-size: 24px;
            color: #495057;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        .btn-custom {
            padding: 10px 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="edit-category-container">
    <h2>Edit Category</h2>
    <form method="POST" action="update_category.php">
        <div class="form-group mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input 
                type="text" 
                class="form-control" 
                id="category_name" 
                name="category_name" 
                value="<?= htmlspecialchars($category['category']); ?>" 
                required>
        </div>
        <input type="hidden" name="category_id" value="<?= $category['category_id']; ?>">
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success btn-custom">Update Category</button>
            <a href="category.php" class="btn btn-secondary btn-custom">Cancel</a>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
