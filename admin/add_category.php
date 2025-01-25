<?php
include "includes/db.php";
include "includes/header.php";

if (isset($_SESSION['admin_email']) && !empty($_SESSION['admin_email'])) {
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $category_name = trim($_POST['category_name']);

        if (!empty($category_name)) {
            $sql = "INSERT INTO categories (category) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $category_name);

            if ($stmt->execute()) {
                $success_message = "Category created successfully!";
            } else {
                $error_message = "Failed to create category. Please try again.";
            }

            $stmt->close();
        } else {
            $error_message = "Category name cannot be empty.";
        }
    }
?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="mb-4">Create New Category</h2>

                <!-- Display success or error messages -->
                <?php if (isset($success_message)) : ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success_message); ?></div>
                <?php endif; ?>
                <?php if (isset($error_message)) : ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error_message); ?></div>
                <?php endif; ?>

                <!-- Form to create a new category -->
                <form method="POST" action="">
                    <div class="form-group mb-3">
                        <label for="category_name">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter category name" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Create Category</button>
                        <a href="view_category.php" class="btn btn-secondary">Back to Categories</a>
                    </div>
                </form>
                <br><br>
            </div>
        </div>
    </div>

<?php
} else {
    header("location: login.php");
}

include "includes/footer.php";
?>
