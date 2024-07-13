<?php session_start() ?>
<?php include("./inc/header.php") ?>
<?php include("./inc/dbconnect.php") ?>


<?php

if (isset($_SESSION["username"]) && $_SESSION["userrole"] == "SystemAdmin") {
    if (isset($_POST['submit'])) {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $role = $_POST["role"];
        $errors = array();
        $email = trim($_POST["email"]);

        if (empty($username) || strlen($username) < 2) {
            $errors[] = "Username Empty!";
        }

        if (empty($password) || strlen($password) < 2) {
            $errors[] = "Password Empty!";
        }

        if (empty($email) || strlen($email) < 5) {
            $errors[] = "Email is Empty!";
        }

        $query = "SELECT * FROM users WHERE username='{$username}'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result)) {
            $errors[] = "Username Already Exit!";
        }

        $query = "SELECT * FROM users WHERE email='{$email}'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result)) {
            $errors[] = "email Already Exit!";
        }

        if (empty($errors)) {
            $username = mysqli_real_escape_string($conn, $_POST["username"]);
            $password = sha1(mysqli_real_escape_string($conn, $_POST["password"]));
            $role = mysqli_real_escape_string($conn, $_POST["role"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);

            $query = "INSERT INTO users(username,email,userpass,userrole) VALUES('{$username}','{$email}','{$password}','{$role}')";

            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "user Added!";
                header("refresh:2;url=adminpage.php");
            }
        }
    }
} else {
    header("Location: index.php?err");
}


?>


<div class="container">

    <div class="row justify-content-center mt-5 ">

        <div class="col-6  ">
            <?php
            if (isset($errors) && !empty($errors)) {
                echo "<h3>Errors:</h3>";
                echo "<ul>";
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
            }



            ?>
            <form action="addusers.php" method="post">
                <div class="mb-3 row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input name="username" <?php if (isset($username)) {
                                                    echo "value = '{$username}'";
                                                } ?> class="form-control" id="username">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input name="email" type="email" <?php if (isset($email)) {
                                                                echo "value = '{$email}'";
                                                            } ?> class="form-control" id="username">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="role-select" class="col-sm-2 col-form-label">User Role</label>
                    <div class="col-sm-10">

                        <select class="form-select" <?php if (isset($role)) {
                                                        echo "value = '{$role}'";
                                                    } ?> name="role" aria-label="Default select example">
                            <option>Open this select menu</option>
                            <option id="SystemAdmin" value="SystemAdmin">System Admin</option>
                            <option id="SystemManager" value="SystemManager">System Manager</option>
                            <option id="normaluser" value="normaluser">Normal User</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button class="btn" name="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($role)) {
    echo "<script>document.getElementById('{$role}').setAttribute('selected','');</script>";
}
?>

</body>