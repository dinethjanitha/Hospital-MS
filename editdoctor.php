<?php
include("./inc/dbconnect.php");
session_start();
include("./inc/datacheck.php");

?>

<?php


if (isset($_GET['docid'])) {
    $docid = $_GET['docid'];

    $query = "SELECT * FROM doctors WHERE docid = {$docid} LIMIT 1";

    $result = mysqli_query($conn, $query);

    query_check($result);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $docname = $row['docname'];
        $doctype = $row['doctype'];
        $docstatus = $row['docstatus'];
        $docid = $row['docid'];
    } else {
        header("Location: managewards.php?userfound=false");
    }
}


?>


<?php

if (isset($_POST["submit"])) {



    $docname = $_POST["docname"];
    $doctype = $_POST["doctype"];
    $docstatus = $_POST["docstatus"];
    $docid = $_POST['docid'];

    $errors = array();

    $req_feild = array('docname', 'doctype');

    $errors = array_merge($errors, required_feild($req_feild));

    $min_len = array("2" => "docname", "3" => "doctype");

    $errors = array_merge($errors, min_len_check($min_len));

    if (empty($errors)) {
        $docname = mysqli_real_escape_string($conn, $_POST["docname"]);
        $doctype = mysqli_real_escape_string($conn, $_POST["doctype"]);
        $docstatus = mysqli_real_escape_string($conn, $_POST["docstatus"]);

        $query = "UPDATE doctors SET docname='{$docname}', doctype='{$doctype}',
         docstatus='{$docstatus}' WHERE docid='{$docid}' ";

        $result = mysqli_query($conn, $query);

        query_check($result);

        $success = "Doctor Updated";

        header("refresh:2;url=managedoctors.php");
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
            <div class="row">
                <h3><?php if (isset($success)) {
                        echo $success;
                    } ?></h3>
            </div>
            <form action="editdoctor.php" method="post">
                <div class="row">
                    <h2>Edit Doctor<span><a href="managedoctors.php">+Manage Doctor</a></span></h2>
                </div>
                <input type="hidden" name="docid" <?php if (isset($docid)) {
                                                        echo "value='{$docid}'";
                                                    } ?> id="">
                <div class="inputs mt-4">
                    <div class="mb-3 row">
                        <label for="docname" class="col-sm-2 col-form-label">Doctor Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="docname" <?php if (isset($docname)) {
                                                                    echo "value='{$docname}'";
                                                                } ?> class="form-control" id="docname">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="doctype" class="col-sm-2 col-form-label">Doctor Type</label>
                        <div class="col-sm-10">
                            <input type="text" name="doctype" <?php if (isset($doctype)) {
                                                                    echo "value='{$doctype}'";
                                                                } ?> class="form-control" id="doctype">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="docstatus" class="col-sm-2 col-form-label">Doctor Status</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="docstatus" aria-label="">
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
echo "document.getElementById(\"{$docstatus}\").setAttribute(\"selected\", \"\");";
echo "</script>";


?>


</budy>