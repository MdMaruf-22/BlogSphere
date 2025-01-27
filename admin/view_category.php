<?php

include "includes/db.php";

include "includes/header.php";

if (isset($_SESSION['admin_email']) && !empty($_SESSION['admin_email'])) {

?>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-2">
                <ul>
                    <li>
                        <a href="index.php" class="nav-item">All Post</a>
                    </li>
                    <li>
                        <a href="view_category.php" class="nav-item">Category</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10">
                
                <div class="mb-3">
                    <a href="add_category.php" class="btn btn-success">Create New Category</a>
                </div>

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th class="text-center align-middle">Edit</th>
                            <th class="text-center align-middle">Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT * FROM categories ORDER BY category_id DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= htmlspecialchars($row['category']) ?></td>
                                    <td class="text-center align-middle">
                                        <a href="edit_category.php?id=<?= $row['category_id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a href="delete_category.php?id=<?= $row['category_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                                    </td>
                                </tr>
                        <?php   
                            }
                        } 
                        ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

<?php

} else {
    header("location: login.php");
}

include('./includes/footer.php');

?>
