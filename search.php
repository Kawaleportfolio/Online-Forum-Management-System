<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <style>
            #foot{
                margin-bottom:10px;
            }
            .container{
                min-height:70vh;
            }
        </style>
</head>

<body>

    <?php  include 'partials/_header.php';  ?>
    <?php  include 'partials/dbconnect.php';  ?>
    <!-- search reults start here -->

    <div class="container my-3">
        <h1 class="py-3">Search Result for <em>"<?php echo $_GET['search'] ?>"</em></h1>

        <?php
        $noresults=true;
        $searchs=$_GET['search'];
         $sql="select * from thread where match (thread_title, thread_desc) against ('$searchs')";
         $result= mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){

            $noresults=false;

            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $th_id= $row['thread_id']; 
            $url="thread.php?threadid=".$th_id;
            echo '<div class="result">
            <h4><a href="'.$url.'" class="text-dark">'.$title.'</a></h4>
            <p>'.$desc.'</p>
        </div>'; 
            
        }
        if($noresults){
            echo '<div class="container ms-3" >
                    <h2 class="display-4">No Results Found</h2>
                    <p class="lead">Suggestions: </p><ul>
                        <li>Make sure that all words spelled correctly. </li>
                        <li>Try Different Keywords.</li>
                        <li>Try more general Keywords.</li>
                    </ul>
                </div>';
        }
    ?>
    </div>

    <?php include 'partials/footer.php';  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>