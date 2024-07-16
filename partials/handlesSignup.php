<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'dbconnect.php';
        $signupsuccess = false;
        $showError="false";

        $user_email = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];

        // check whether this email exits

        $existSql= "select * from forums_users where user_email = '$user_email'";
        $result = mysqli_query($con, $existSql);

        $numrow = mysqli_num_rows($result);
        if($numrow > 0){
            $showError = "Email is already exists";
        }else{
            if($pass == $cpass){
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql="insert into forums_users (user_email ,user_pass) values ('$user_email', '$hash')";
                $result = mysqli_query($con, $sql);
                if($result){
                    $showalert = true;
                    
                    header("Location: /pkcode/FORUM/index.php?signupsuccess=true");
                    exit();
                }
            }else{
                $showError = "Password do not match";
                exit();
            }
        }
        header("Location: /pkcode/FORUM/index.php?signupsuccess=false&error=".urlencode($showError));
    }

?>