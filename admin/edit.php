<?php
include "includes/db.php";
include "includes/header.php";

if (isset($_GET['id'])) {
    $post_id = intval($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $conn->real_escape_string($_POST['title']);
        $details = $conn->real_escape_string($_POST['details']);
        $category_id = intval($_POST['category']);
        $status = $conn->real_escape_string($_POST['status']);

        $update_query = "UPDATE posts SET title='$title', details='$details', category_id=$category_id, status='$status' WHERE post_id=$post_id";
        if ($conn->query($update_query)) {
            echo "<script>alert('Post updated successfully.'); window.location.href='index.php';</script>";
        } else {
            echo "<p class='alert alert-danger'>Failed to update post: " . $conn->error . "</p>";
        }
    }

    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();
        ?>
        <div class="container mt-5">
            <h2>Edit Post</h2>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="details" class="form-label">Details</label>
                    <textarea name="details" id="details" class="form-control" rows="5" required><?php echo htmlspecialchars($post['details']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" class="form-control">
                        <?php
                        $categories = $conn->query("SELECT * FROM categories");
                        while ($category = $categories->fetch_assoc()) {
                            $selected = $category['category_id'] == $post['category_id'] ? 'selected' : '';
                            echo "<option value='{$category['category_id']}' $selected>{$category['category']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="Approved" <?php echo $post['status'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
                        <option value="Rejected" <?php echo $post['status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
        <?php
    } else {
        echo "<p class='alert alert-danger'>Post not found.</p>";
    }
} else {
    echo "<p class='alert alert-danger'>Invalid Post ID.</p>";
}

include "./includes/footer.php";
?>
