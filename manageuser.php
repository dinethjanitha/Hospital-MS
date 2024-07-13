<?php session_start() ?>
<?php include("./inc/header.php") ?>
<?php include("./inc/dbconnect.php") ?>

<?php

$username = "";
$email = "";


if (isset($_GET["userid"]) && $_SESSION["userrole"] == "SystemAdmin") {
    $userid = $_GET['userid'];
    $query = "SELECT userid,username,email,userrole FROM users WHERE userid='{$userid}'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $username = $row['username'];
            $role = $row['userrole'];
            $userid = $row['userid'];
            $email = $row['email'];
        }
    }
}

?>


<?php

if (isset($_SESSION["username"])) {
    if (isset($_POST['submit'])) {
        $username = trim($_POST["username"]);
        $userid = $_POST["userid"];
        $email = trim($_POST["email"]);
        $errors = array();

        if (empty($username) || strlen($username) < 2) {
            $errors[] = "Username Empty!";
        }

        if (empty($email) || strlen($email) < 5) {
            $errors[] = "email Empty!";
        }

        //    if(empty($password) || strlen($password) < 2){
        //         $errors[] = "Password Empty!";
        //    }

        $query = "SELECT * FROM users WHERE username='{$username}' AND userid !='{$userid}'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $errors[] = "Username already Exsit!";
        }

        $query = "SELECT * FROM users WHERE email='{$email}' AND userid !='{$userid}'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $errors[] = "Email already Exsit!";
        }

        if (empty($errors)) {
            $username = mysqli_real_escape_string($conn, $_POST["username"]);
            $password = sha1(mysqli_real_escape_string($conn, $_POST["password"]));
            $role = mysqli_real_escape_string($conn, $_POST["role"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);

            $query = "UPDATE users SET username='{$username}' , email='{$email}' ,userrole='{$role}' WHERE userid = '{$userid}' LIMIT 1";

            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "user update successfull!";
                header("Location: adminpage.php?userupdate=true");
            } else {
                $errors[] = "Modify Faild!";
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
            <form action="manageuser.php" method="post">
                <input type="hidden" name="userid" <?php if (isset($userid)) {
                                                        echo "value = '{$userid}'";
                                                    } ?>>
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
                        <span>*** | <a href="#">Change Password</a></span>
                    </div>
                </div>
                <div class="mb-3 row">

                    <label for="role-select" class="col-sm-2 col-form-label">User Role</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="role" aria-label="Default select example">
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