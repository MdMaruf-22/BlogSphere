<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>EDGE Blog Site</title>
</head>

<body>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">EDGE Blog </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="about.php">About</a>


                        </li>
                        </li>


                        <?php

                        session_start();

                        if (isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])) {

                        ?>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="post.php">Create a post</a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="my_posts.php">My posts</a>

                            </li>


                        <?php } else { ?>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="login.php">Login</a>

                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="registerSubmit.php">Registration</a>


                            </li>


                        <?php } ?>



                    </ul>
                    <form class="d-flex" action="search.php" method="GET">
                        <input class="form-control me-2" type="text" name="search" placeholder="Search" required>
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>

                </div>
            </div>
        </nav>
    </div>