<?php include("./inc/dbconnect.php") ?>
<?php session_start() ?>

<?php
if (isset($_POST['submit'])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $errors = array();

    if (empty($username) || strlen($username) < 2) {
        $errors[] = "Username is Empty!";
    }

    if (empty($password) || strlen($password) < 2) {
        $errors[] = "Password is Empty!";
    }

    if (empty($errors)) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = sha1(mysqli_real_escape_string($conn, $_POST['password']));

        $query = "SELECT * FROM users WHERE username='{$username}' AND userpass='{$password}'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION["username"] = $row['username'];
                $_SESSION["userid"] = $row['userid'];
                $_SESSION["userrole"] = $row['userrole'];
                if ($row['userrole'] == "SystemAdmin") {
                    header("Location: adminpage.php");
                } else if ($row['userrole'] == "SystemManager") {
                    header("Location: managerpage.php");
                }
            } else {
                $errors[] = "Login Faild! Incorrect Username or Password";
            }
        } else {
            die("Query Faild!");
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login HMS</title>
    <link rel="stylesheet" href="./css/login.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <div class="login">
            <div class="header">Login</div>
            <div class="login-feild">
                <div class="feild">
                    <?php
                    if (isset($errors) && !empty($errors)) {
                        foreach ($errors as $error) {
                            echo $error . "<br>";
                        }
                    }

                    ?>
                </div>
                <form action="index.php" method="post">
                    <div class="feild">
                        <label for="username">Username</label>
                        <input type="text" <?php if (isset($username)) {
                                                echo "value = '{$username}'";
                                            } ?> name="username" id="username">
                    </div>
                    <p id="usernamest"></p>
                    <div class="feild">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="indexpassword">
                    </div>
                    <p id="passwordst"></p>

                    <div class="feild feild-check">
                        <input type="checkbox" id="showpass">
                        <label for="checkbox">Show password</label>
                    </div>

                    <div class="feild feild ">
                        <button id="indexbutton" class="btn1 btn bg-secondary" type="submit" name="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <script src="./js/validate.js"></script>
</body>

</html>