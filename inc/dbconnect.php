<?php

    $conn = mysqli_connect("localhost","root","","hospitaldb");

    if(mysqli_connect_errno()){
        die("Connection Faild!" . mysqli_connect_error());
    }


?>