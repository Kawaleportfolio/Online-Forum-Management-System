
<?php



  include 'partials/dbconnect.php';  
session_start();

echo '<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php">iDiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Top Categories
                </a>
                <ul class="dropdown-menu">';
                
                $sql = "SELECT category_name, category_id FROM category LIMIT 5";
                $result= mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo '<li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
                }

                
                
            echo    '</ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
            </ul>';
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

                echo '<form method="get" action="search.php" class="d-flex" role="search">
                        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
    
           <div class="dropdown">
            <button class="dropdown-toggle ms-5" type="button" style="border: none; background: none;" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="me-3" src="partials/images/default_user.png" width="34px" alt="...">'.$_SESSION['useremail'].'
            </button>
            <ul class="dropdown-menu dropdown-menu-dark ms-5"  >
                <li><a class="dropdown-item " href="#">View Profile</a></li>';
            
                if($_SESSION['useremail']=="Admin@ad.com"){
                   echo '<li><a class="dropdown-item" href="addcategory.php">Add Category</a></li>
                        <li><a class="dropdown-item" href="deletecategory.php">Delete Category</a></li>';
                }
            echo '<li><a class="dropdown-item" href="partials/logout.php">Logout</a></li>
                </ul>
            </div>
            </form>'; 
            }
            else{
                echo   '<form method="get" action="search.php" class="d-flex" role="search">
                        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <div class="mx-2">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModa">Login</button>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModa">Signup</button>';
            }
        echo '</div>
            
        </div>
        </div>
        </nav>';

    include 'partials/_loginModal.php';
    include 'partials/_signupModal.php';

    //signup
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] =="true"){
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You can now login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    elseif(isset($_GET['error']) && $_GET['signupsuccess'] =="false"){
        $showError = htmlspecialchars($_GET['error']);
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> ' . $showError . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    //login

    if (isset($_GET['loginsuccess'])) {
        if ($_GET['loginsuccess'] == "true") {
            echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                    <strong>Login successful!</strong> Welcome to the iDiscuss.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } elseif ($_GET['loginsuccess'] == "false") {
            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                    <strong>Access denied!</strong> Please verify your login details.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    // add categpry
    if (isset($_SESSION['addcatsuccess'])) {
        if ($_SESSION['addcatsuccess'] == true) {
            echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success!</strong> Category has been added.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } elseif ($_SESSION['addcatsuccess'] == false) {
            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>Error!</strong> Category already exists.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        // Clear the session variable after displaying the message
        unset($_SESSION['addcatsuccess']);
    }
    

?>