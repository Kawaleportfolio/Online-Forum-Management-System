<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <style>
        #ques{
            min-height:43px;
        }
    </style> -->

</head>

<body>
    <?php  include 'partials/dbconnect.php';  ?>
    <?php  include 'partials/_header.php';  ?>
    

    <?php
    $id=$_GET['catid'];
        $sql="select * from category where category_id=$id";
         $result= mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $catname = $row['category_name'];
            $catdesc= $row['category_description']; 
        }
    ?>
    <?php
        $showalert = false;
        $method= $_SERVER['REQUEST_METHOD'];
        // echo $method;
        if($method == 'POST'){
            // insert into thread into database
            $th_title = $_POST['title'];

            //replace '<' and '>' tag into "&lt","$gt" 
            $th_title = htmlspecialchars($th_title, ENT_QUOTES, 'UTF-8');

            $th_desc= $_POST['desc'];

            //replace '<' and '>' tag into "&lt","$gt" 
            $th_desc = htmlspecialchars($th_desc, ENT_QUOTES, 'UTF-8');

            $sno = $_POST['sno']; //user sno
            $sql="insert into thread (thread_title,thread_desc,thread_cat_id,thread_user_id) values ('$th_title','$th_desc','$id','$sno')";
            $result= mysqli_query($con,$sql);
            $showalert= true;
            if($showalert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success !</strong> Your thread has been added!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    ?>
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display">Welcome to <?php echo $catname; ?> Forums</h1>
            <p class="lead"><?php echo $catdesc; ?> </p>
            <hr class="my-4">
            <p>This forum is per to per forum for sharing knowladge with each other.<br><b>NOTE: </b> No Spam /
                Advertising / Self-promote in the forums, Do not post copyright-infringing material,Remain respectful of
                other members at all times </p>
            <a href="" class="btn btn-success btn-lg" role="button">Learn More</a>
        </div>
    </div>

    <!-- form -->
    <?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
     echo   '<div class="container">
            <h1 class="py-3">Start Discussions</h1>
            <form action="'. $_SERVER["REQUEST_URI"] .'" method="POST" >   
            <div class="mb-3">
                <label for="title" class="form-label">Problem title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <div id="titlehelp" class="form-text">keep your title as short and crisp as possible</div>
            </div>
            <div class="form-group">
                <label for="desc" class="form-label">Ellaborate Your Concern</label>
                <textarea class="form-control" placeholder="Your Concern" id="desc" name="desc"
                    style="height: 100px" required></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
            </div>
            <button type="submit" class="btn btn-success mt-3">Submit</button>
        </form>
        </div>';
}else{
    echo '<div class="container">
    <h1 class="py-3">Start Discussions</h1>
    <p class="lead text-danger"><b>You are not Logged In. Please Login to start a Discussions</b></p>
</div>';
}
    ?>


    <div class="container">
        <h1 class="py-2">Browse Questions</h1>

        <?php
        $id=$_GET['catid'];
            $sql="select * from thread where thread_cat_id=$id";
            $result= mysqli_query($con,$sql);
            $noresult=true;
            while($row = mysqli_fetch_assoc($result)){
                $noresult=false;
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $id = $row['thread_id'];
                $time= $row['timestamp'];
                $user_id= $row['thread_user_id'];
                $sql2="select * from forums_users where Sno='$user_id'";
                $result2= mysqli_query($con,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                echo '<div class="d-flex align-items-center my-3">
                        <div class="flex-shrink-0">
                            <img src="partials/images/default_user.png" width="54px" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">'.$row2['user_email'].' at '.$time.'
                        <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                            '.$desc.'
                        </div>
                    </div>';
    }
    // echo var_dump($noresult);
    if($noresult){
        echo '<div class="jumbotron jumbotron-fluid bg-primary-subtle text-primary-emphasis ">
            <div class="container">
                <p class="display-6" >No Threads Found</p>
                <p>Be the first person to ask a Questions</p>
            </div>
        </div>' ;
        
    }
    ?>
    </div>
    

    <?php include 'partials/footer.php';  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>