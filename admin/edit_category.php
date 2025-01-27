<?php
include "includes/db.php";
include "includes/header.php";

if(isset($_SESSION['admin_email']) && !empty($_SESSION['admin_email'])) {

    if (isset($_GET['id'])) {
        $category_id = intval($_GET['id']);

        $query = "SELECT * FROM categories WHERE category_id = $category_id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $category = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('Category not found.'); window.location.href = 'view_category.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid request.'); window.location.href = 'view_category.php';</script>";
        exit();
    }
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-2">
            <ul>
                <li><a href="" class="nav-item">All Post</a></li>
                <li><a href="view_category.php" class="nav-item">Category</a></li>
            </ul>
        </div>

        <div class="col-md-10">
            <h3>Edit Category</h3>
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
                    <a href="view_category.php" class="btn btn-secondary btn-custom">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
} else {
    header("location: login.php");
}

include('./includes/footer.php');
?>
