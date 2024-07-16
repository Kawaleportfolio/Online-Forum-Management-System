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
    $id=$_GET['threadid'];
        $sql="select * from thread where thread_id=$id";
         $result= mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc']; 
            $th_time= $row['timestamp'];  
            
            $user_id= $row['thread_user_id'];
            $sql2="select * from forums_users where Sno='$user_id'";
            $result2= mysqli_query($con,$sql2);
            $row3=mysqli_fetch_assoc($result2);
        }
        
    ?>  

    <?php
            $showalert = false;
            $method= $_SERVER['REQUEST_METHOD'];
            // echo $method;
            if($method == 'POST'){
                // insert into thread into database
                $comment = $_POST['comment'];

                //replace '<' and '>' tag into "&lt","$gt" 
                $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');

                $sno = $_POST['sno'];
                $sql="INSERT INTO comments (comment_content, thread_id,comment_by) VALUES ('$comment', $id,'$sno');";
                $result= mysqli_query($con,$sql);
                $showalert= true;
                if($showalert){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Your commenet has been posted!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?> Forums</h1><p><?php echo $th_time ?></p>
            <p class="lead"><?php echo $desc; ?> </p>
            <p><b><em>~~ <?php echo $row3['user_email']; ?></em></b></p>

            <hr class="my-4">
            <p>This forum is per to per forum for sharing knowladge with each other.<br><b>NOTE: </b> No Spam /
                Advertising / Self-promote in the forums, Do not post copyright-infringing material,Remain respectful of
                other members at all times </p>
        </div>
    </div>
    <!-- form for comments -->

    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo   '<div class="container">
        <h1 class="py-3">Post a Comment</h1>
        <form action="'. $_SERVER["REQUEST_URI"] .'" method="POST">
            <div class="form-group">
                <label for="desc" class="form-label">Type Your Comment</label>
                <textarea class="form-control" placeholder="Your comment" id="comment" name="comment"
                    style="height: 100px" required></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
            </div>
            <button type="submit" class="btn btn-success mt-3">Post Comment</button>
        </form>
    </div>';
       }else{
           echo '<div class="container">
           <h1 class="py-3">Post a Comment</h1>
           <p class="lead text-danger"><b>You are not Logged In. Please Login to post a comments</b></p>
       </div>';
       }
    ?>

    <!--  -->
    <div class="container">
        <h1 class="py-2">Discussions </h1>

        <?php
        
        $id=$_GET['threadid'];
            $sql="select * from comments where thread_id=$id";
            $result= mysqli_query($con,$sql);
            $noresult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noresult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $datetime= $row['comment_time'];
                $user_id= $row['comment_by'];
                $sql2="select * from forums_users where Sno='$user_id'";
                $result2= mysqli_query($con,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                

                echo '<div class="d-flex align-items-center my-3">
                        <div class="flex-shrink-0">
                            <img src="partials/images/default_user.png" width="54px" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3"><h5 class="mt-0 my-0">'.$row2['user_email'].' at '.$datetime.'</h5>
                            '.$content.'
                        </div>
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