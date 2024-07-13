<?php
include("./inc/dbconnect.php");
session_start();
include("./inc/datacheck.php");

?>


<?php
if (isset($_POST["submit"])) {

    $docname = $_POST["docname"];
    $doctype = $_POST["doctype"];

    $errors = array();

    $req_feild = array('docname', 'doctype');

    $errors = array_merge($errors, required_feild($req_feild));

    $min_len = array("4" => "docname", "5" => "doctype");

    $errors = array_merge($errors, min_len_check($min_len));

    if (empty($errors)) {
        $docname = mysqli_real_escape_string($conn, $_POST["docname"]);
        $doctype = mysqli_real_escape_string($conn, $_POST["doctype"]);

        $query = "INSERT INTO doctors(docname,doctype,docstatus) VALUES('{$docname}','{$doctype}','Yes')";

        $result = mysqli_query($conn, $query);

        query_check($result);

        echo "Doctor Added";

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
            <form action="adddoctor.php" method="post">
                <div class="row">
                    <h2>Add Doctor <span><a href="managewards.php">+Manage doctors</a></span></h2>
                </div>
                <div class="mb-3 row">
                    <label for="docname" class="col-sm-2 col-form-label">Doctor Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="docname" <?php if (isset($docname)) {
                                                                echo "value='{$docname}'";
                                                            } ?> class="form-control" id="docname">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="docdescription" class="col-sm-2 col-form-label">Doctor Type</label>
                    <div class="col-sm-10">
                        <input type="text" name="doctype" <?php if (isset($doctype)) {
                                                                echo "value='{$doctype}'";
                                                            } ?> class="form-control" id="docdescription">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">

                        <button type="submit" class="btn" name="submit">Submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<script src="./js/validate.js"></script>

</budy>