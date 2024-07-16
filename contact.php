<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: Arial, sans-serif;
    }

    .background-container {
        position: relative;
        height: 80vh;
        background: url('partials/images/background.png') no-repeat center center/cover;
        animation: fadeBackground 2s ease-in-out;
        display: flex;
        justify-content: center;
        object-fit: cover;
    }

    @keyframes fadeBackground {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @media (max-width: 767.98px) {
        .background-container {
            background-size: cover;
            height: 30vh;
            /* Adjust height for mobile devices */
        }
    }
    </style>
</head>

<body>
    <?php  include 'partials/_header.php';  ?>
    <?php
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'partials/dbconnect.php';
        $showalert=false;
        $email = $_POST['uemail'];
        $desc = $_POST['message'];

        $sql="INSERT INTO forum_contactus (c_email, c_message) VALUES ('$email', '$desc');";
                $result= mysqli_query($con,$sql);
                $showalert= true;
                if($showalert){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thanks for contacting us!</strong> We will be in touch with you shortly.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                }
      }
    ?>

    <div class="background-container">
        <div class="title text-white ">
            <b>
                <p class="fs-1 my-5">Welcome to ContactUs Page</p>
            </b>
            <hr class="border border-primary border-3 opacity-75" style="margin-top: -40px;">
        </div>

    </div>
    <div class="bg-primary bg-opacity-75 text-white " style="max-height:250px ;">
        <p class="text-center fs-4 p-2">Our Mission <br> To connect and inform developer communities through high-quality forums,
            providing insightful discussions and innovative solutions.</p>
    </div>

    <div class="container mt-1 my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mt-3 mb-4">Contact Us</h2>
                <form action="contact.php" method="POST">
                    <div class="mb-3">
                        <label for="uemail" class="form-label">Email address</label>
                        <?php
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                           echo '<input type="email" class="form-control" name="uemail" id="uemail" value="'.$_SESSION['useremail'].'" aria-describedby="emailHelp" readonly>';
                        }else{
                         echo '<input type="email" class="form-control" name="uemail" id="uemail" aria-describedby="emailHelp">';
                        }
                        ?>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Enter Comment / Message</label>
                        <textarea class="form-control" name="message" id="message" rows="3" placeholder="Your message"></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'partials/footer.php';  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>