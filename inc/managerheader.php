<?php if (!isset($_SESSION['username'])) {
    header("Location: index.php?access=false");
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login HMS</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="./managerpage.php">Hospital MS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="nav-item mx-auto"></div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <b style="color: black;"> Manage Doctors</b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./adddoctor.php">Add Doctors</a></li>
                            <li><a class="dropdown-item" href="./managedoctors.php">Manage Doctors</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <b style="color: black;">Manage Medicine</b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./addmedicine.php">Add Medicine</a></li>
                            <li><a class="dropdown-item" href="./managemedicines.php">Manage Medicine</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <b style="color: black;">Manage Wards</b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./addwards.php">Add Wards</a></li>
                            <li><a class="dropdown-item" href="./managewards.php">Manage Wards</a></li>
                            <li><a class="dropdown-item" href="./viewwd.php">Mange Ward Assign</a></li>
                            <li><a class="dropdown-item" href="./wardassign.php">Assign Wards</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Welcome <span style="color:blueviolet"><?php echo $_SESSION['username'] ?></span>!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>