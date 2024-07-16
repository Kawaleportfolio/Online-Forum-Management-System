<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <style>
        .form-container {
            max-width: 700px;
            margin: auto;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <?php  include 'partials/_header.php';  ?>
    <?php  include 'partials/dbconnect.php';  ?>
    <?php
    
    ob_start(); // Start output buffering
    
    

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            include 'partials/dbconnect.php';
            // $addcatsuccess = false;
            // $caterror=true;

            $cat_name = $_POST['catname'];
            $cat_desc = $_POST['catdesc'];

            $existSql= "select * from category where category_name = '$cat_name'";
            $result = mysqli_query($con, $existSql);
    
            $numrow = mysqli_num_rows($result);
            if ($numrow > 0) {
                // Category already exists
                $_SESSION['addcatsuccess'] = false;
            } else {
                // Add new category
                $sql = "INSERT INTO category (category_name, category_description) VALUES ('$cat_name', '$cat_desc')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $_SESSION['addcatsuccess'] = true;
                } else {
                    $_SESSION['addcatsuccess'] = false; // In case of a query failure
                }
            }
        
            // Redirect after processing
            // header("Location: index.php");   //itnot work
            echo '<script>window.location.href = "index.php";</script>'; //redirect using javascript
            exit();
        }
        ob_end_flush(); // End output buffering and flush output

    ?>

    <div class="container">
        <h3 class="text-center my-4">Add Category</h3>
        <div class="form-container my-3">
            <form action="addcategory.php" method="POST">
                <div class="mb-3">
                    <label for="catname" class="form-label">Enter Category Name</label>
                    <input type="text" class="form-control" name="catname" id="catname" placeholder="Category Name" required>
                </div>
                <div class="mb-3">
                    <label for="catdesc" class="form-label">Enter category description</label>
                    <textarea class="form-control" name="catdesc" id="catdesc" rows="3" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'partials/footer.php';  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>