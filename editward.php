<?php
include("./inc/dbconnect.php");
session_start();
include("./inc/datacheck.php");

?>

<?php
$wardname = "";
$warddes = "";
$wardstatus = "";


if (isset($_GET['wardid'])) {
    $wardid = $_GET['wardid'];

    $query = "SELECT * FROM wards WHERE wardid = {$wardid} LIMIT 1";

    $result = mysqli_query($conn, $query);

    query_check($result);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $wardname = $row['wardname'];
        $warddes = $row['warddes'];
        $wardstatus = $row['wardstatus'];
        $wardid = $row['wardid'];
    } else {
        header("Location: managewards.php?userfound=false");
    }
}


?>


<?php
if (isset($_POST["submit"])) {



    $wardname = $_POST["wardname"];
    $warddes = $_POST["warddes"];
    $wardstatus = $_POST["wardstatus"];
    $wardid = $_POST['wardid'];

    $errors = array();

    $req_feild = array('wardname', 'warddes');

    $errors = array_merge($errors, required_feild($req_feild));

    $min_len = array("2" => "wardname", "3" => "warddes");

    $errors = array_merge($errors, min_len_check($min_len));

    if (empty($errors)) {
        $wardname = mysqli_real_escape_string($conn, $_POST["wardname"]);
        $warddes = mysqli_real_escape_string($conn, $_POST["warddes"]);
        $wardstatus = mysqli_real_escape_string($conn, $_POST["wardstatus"]);

        $query = "UPDATE wards SET wardname='{$wardname}', warddes='{$warddes}',
         wardstatus='{$wardstatus}' WHERE wardid='{$wardid}' ";

        $result = mysqli_query($conn, $query);

        query_check($result);

        $success = "Ward Updated!";

        header("refresh:2;url=managewards.php");
    }
}


?>

<?php include("./inc/managerheader.php") ?>

<div class="container">
    <div class="row justify-content-center ">
        <div class="col-8 mt-5">
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
            <form action="editward.php" method="post">
                <div class="row">
                    <h2>Add Wards <span><a href="managewards.php">+Manage wards</a></span></h2>
                </div>

                <div class="row">
                    <h4 class="mt-3" style="color: green;"><?php if (isset($success)) {
                                                                echo $success;
                                                            } ?></h4>
                </div>
                <input type="hidden" name="wardid" <?php if (isset($wardid)) {
                                                        echo "value='{$wardid}'";
                                                    } ?> name="" id="">
                <div class="inputs mt-4">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Ward Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="wardname" <?php if (isset($wardname)) {
                                                                    echo "value='{$wardname}'";
                                                                } ?> class="form-control" id="inputward">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="warddescription" class="col-sm-2 col-form-label">Ward Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="warddes" <?php if (isset($warddes)) {
                                                                    echo "value='{$warddes}'";
                                                                } ?> class="form-control" id="warddescription">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="warddescription" class="col-sm-2 col-form-label">Ward Status</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="wardstatus" aria-label="">
                                <option id="Yes" value="Yes">Yes</option>
                                <option id="No" value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">

                            <button type="submit" class="btn" name="submit">Submit</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
echo "<script>";
echo "document.getElementById(\"{$wardstatus}\").setAttribute(\"selected\", \"\");";
echo "</script>";


?>


</budy>