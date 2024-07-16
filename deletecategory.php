<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
        .container {
            margin-top: 20px;
        }
        .search-form {
            max-width: 600px;
            margin: auto;
        }
        .form-control {
            border-radius: 0;
        }
        .btn-outline-success {
            border-radius: 0;
        }
        @media (max-width: 768px) {
            .form-control {
                margin-bottom: 10px;
            }
            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <?php  include 'partials/_header.php';  ?>

    <?php 
         if (isset($_SESSION['deletecat'])) {
            if ($_SESSION['deletecat'] == true) {
                echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                    <strong>Success!</strong> Category deleted. <br> click here go to <a class="text-decoration-none" href="index.php">Home Page</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } elseif ($_SESSION['deletecat'] == false) {
                echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                    <strong>Error!</strong> Category not deleted.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
            // Clear the session variable after displaying the message
            unset($_SESSION['addcatsuccess']);
        }

    ?>


    <?php  include 'partials/dbconnect.php';  ?>
    <div class="container">
        <h3 class="text-center">Search Category Here  </h3>
        <form method="POST" action="deletecategory.php" class="d-flex search-form" role="search">
            <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <div class="container">
        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th scope="col">CategoryNames</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //delete category
                if(isset($_GET['deleteid'])){
                    $did = $_GET['deleteid'];

                    $querydel = "DELETE FROM category WHERE category_id = $did";
                    $resultdel = mysqli_query($con, $querydel);
                    if($resultdel){
                        // header('location:deletecategory.php');
                        $_SESSION['deletecat'] = true;
                        echo '<script>window.location.href = "deletecategory.php";</script>';
                    }else{
                        $_SESSION['deletecat'] = false;
                        echo '<script>window.location.href = "deletecategory.php";</script>';
                    }
                }

                //Fetch Search data
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $catsearch = $_POST['query'];

                    $sql = "SELECT * FROM category WHERE MATCH (category_name, category_description) AGAINST ('$catsearch')";
                    $result = mysqli_query($con, $sql);
                    $noresults = true;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $noresults = false;

                        $catid = $row['category_id'];
                        $catname = $row['category_name'];
                        $catdesc = $row['category_description'];
                        echo '<tr>
                                <td>' . $catname . '</td>
                                <td>' . substr($catdesc, 0, 90) . '...</td>
                                <td><a href="deletecategory.php?deleteid='.$catid.'" class="btn btn-outline-danger btn-sm">REMOVE</a></td>
                              </tr>';
                    }

                    if($noresults){
                        echo '<div class="container d-flex flex-column align-items-center ms-3 " >
                                <h2 class="display-4">No Results Found</h2>
                                <p class="lead">Suggestions: </p><ul>
                                    <li>Make sure that all words spelled correctly. </li>
                                    <li>Try Different Keywords.</li>
                                    <li>Try more general Keywords.</li>
                                </ul>
                            </div>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>