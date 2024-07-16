<?php

$showError="false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $loginsuccess = true;

    $email = $_POST['loginemail'];
    $pass = $_POST['loginpass'];

    $sql = "select * from forums_users where user_email='$email'";
    $result = mysqli_query($con, $sql);

    $numrow = mysqli_num_rows($result);
        if($numrow == 1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($pass, $row['user_pass'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['Sno'];
                $_SESSION['useremail'] = $email;
                // echo "logged in".$email;
                header ("Location: /pkcode/FORUM/index.php?loginsuccess=true");
                exit();
            }
        }
        header ("Location: /pkcode/FORUM/index.php?loginsuccess=false");
}

?>