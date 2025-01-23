<?php 

include "./includes/db.php" ;

include "./includes/header.php";



if(isset($_SESSION['email']) && !empty($_SESSION['email']))
{

?>


    <div class="container mt-3">
        <div class="row">
            <div class="col-md-2">
                <ul>
                    <li>
                        <a href="" class="nav-item">All Post</a>
                    </li>
                </ul>
            </div>


            <div class="col-md-10">
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th class="text-center align-middle">Approved</th>
                                <th class="text-center align-middle">View</th>
                                <th class="text-center align-middle">Edit</th>
                                <th class="text-center align-middle">Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                    $i = 1;
                                    $sql = "SELECT posts.*, users.name as user_name, categories.category FROM posts JOIN users ON posts.user_id=users.user_id JOIN categories ON posts.category_id=categories.category_id;";
                                    $result = $conn->query($sql);
                                    
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) { ?>

                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['title'] ?></td>
                                    <td> <?= $row['status'] ?> </td>
                                    <td class="text-center align-middle"> 
                                        <a href="approved.php?id=<?php echo $row['post_id'] ?>" class="btn btn-success">Approved</a>
                                        <a href="reject.php?id=<?= $row['post_id'] ?>" class="btn btn-danger">Reject</a>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a href="view.php?post_id=<?= $row['post_id'] ?>" class="btn btn-primary">View</a>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a href="edit.php?id=<?= $row['post_id'] ?>" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a href="delete.php?id=<?= $row['post_id'] ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>

                                        
                            <?php   } } ?>
                        </tbody>

                    </table>
            </div>

        </div>
    </div>


    <?php 
    
}
else
{
    header("location: login.php");
}

    include('./includes/footer.php'); 
    
    ?>