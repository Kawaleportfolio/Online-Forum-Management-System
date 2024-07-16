<?php

    $con=new mysqli("localhost","root","priyaj@123","demo");

    if(!$con){
        die("Sorry we failed to conect: ".mysqli_connect_error());
    }

?>